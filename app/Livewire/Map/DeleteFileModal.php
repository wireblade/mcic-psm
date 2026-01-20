<?php

namespace App\Livewire\Map;

use App\Models\Project;
use App\Models\ProjectFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteFileModal extends Component
{
    public $openDeleteFileModal = false;
    public $fileId = null;
    public $fileName;

    #[On('open-delete-file-modal')]
    public function openDeleteFileModal($id)
    {
        $this->fileId = $id;

        $file = ProjectFile::findOrFail($this->fileId);

        $this->fileName = $file->original_name;

        $this->openDeleteFileModal = true;
    }

    public function deleteFile()
    {
        // find the file to be deleted
        $file = ProjectFile::findOrFail($this->fileId);

        // count how many files are in the project
        $countFiles = ProjectFile::where('project_id', $file->project_id)->count();

        // get the file path
        $file_path = $file->file_path;

        // get the project
        $project = Project::findOrFail($file->project_id);
        $projectName = $project->name;

        // delete the file from storage
        if (Storage::disk('public')->exists($file_path)) {
            Storage::disk('public')->delete($file_path);
        }

        // if there is only one file left in the project, delete the project folder as well
        $projectFolder = 'project_files' . '/' . $projectName;
        if ($countFiles <= 1) {
            if (Storage::disk('public')->exists($projectFolder)) {
                Storage::disk('public')->deleteDirectory($projectFolder);
            }
        }

        // delete the file record from the database
        $file->delete();

        // Artificial delay so UI shows "Deleting..." for 2 seconds
        sleep(1);

        // dispatch success alert
        $this->dispatch('showAlert', type: 'success', message: 'File deleted successfully.');

        // close the modal
        $this->openDeleteFileModal = false;

        // refresh the files list
        $this->dispatch('refreshFiles');
    }

    public function render()
    {
        return view('livewire.map.delete-file-modal');
    }
}
