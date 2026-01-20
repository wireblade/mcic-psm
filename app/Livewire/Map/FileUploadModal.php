<?php

namespace App\Livewire\Map;

use App\Models\Project;
use App\Models\ProjectFile;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class FileUploadModal extends Component
{
    use WithFileUploads;

    public $openUploadModal = false;
    public $projectId = null;
    public $projectName;

    public $files = [];
    public $accumulatedFiles = []; // New property to store all files



    public string $category;


    protected $messages = [
        'accumulatedFiles.*.required' => 'Please select at least one file.',
        'accumulatedFiles.*.file' => 'The uploaded item must be a valid file.',
        'accumulatedFiles.*.mimes' => 'File must be one of the following types: PDF, DOC, DOCX, XLS, XLSX, JPG, JPEG, PNG, PPTX, or MP4.',
        'accumulatedFiles.*.max' => 'File size must not exceed 100MB.',
    ];


    public function rules()
    {
        return [
            'accumulatedFiles.*' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png,pptx,mp4,html|max:1024000',
        ];
    }

    #[On('open-upload-modal')]
    public function openUploadModal($id)
    {
        $project = Project::findOrFail($id);

        $this->projectId = $project->id;
        $this->projectName = $project->name;
        $this->reset(['files', 'accumulatedFiles']);
        $this->resetValidation(); // Clear all validation errors
        $this->openUploadModal = true;
    }

    // This method is called whenever files are selected
    public function updatedFiles()
    {
        // Add newly selected files to accumulated files
        if (!empty($this->files)) {
            foreach ($this->files as $file) {
                $this->accumulatedFiles[] = $file;
            }

            // Clear the temporary files property
            $this->files = [];
        }
    }

    public function uploadFile()
    {

        $this->validate();

        if (empty($this->accumulatedFiles)) {
            $this->addError('files', 'No files selected!');
            return;
        }

        $uploadedCount = 0;

        foreach ($this->accumulatedFiles as $file) {
            $path = $file->store('project_files/' . $this->projectName, 'public');
            $mime = $file->getMimeType();

            // Determine category based on mime type
            $category = $this->getCategoryFromMime($mime);

            ProjectFile::create([
                'project_id' => $this->projectId,
                'original_name' => $file->getClientOriginalName(),
                'file_path' => $path,
                'mime_type' => $mime,
                'file_size' => $file->getSize(),
                'category'  => $category,
            ]);

            $uploadedCount++;
        }

        sleep(1); // Simulate processing time
        $this->reset();
        $this->dispatch('showAlert', type: 'success', message: 'File uploaded successfully!');
        $this->openUploadModal = false;
        $this->dispatch('refreshFiles');
    }

    private function getCategoryFromMime($mime)
    {
        return match ($mime) {
            'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'Power Point',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/vnd.ms-excel' => 'Excel',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'Word',
            'application/pdf' => 'PDF',
            'image/png', 'image/jpeg', 'image/jpg', 'image/webp' => 'Images',
            'video/mp4' => 'Videos',
            'text/html' => 'HTML',
            default => 'Other',
        };
    }

    public function render()
    {
        return view('livewire.map.file-upload-modal');
    }
}
