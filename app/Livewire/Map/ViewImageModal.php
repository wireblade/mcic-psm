<?php

namespace App\Livewire\Map;

use App\Models\Project;
use Livewire\Attributes\On;
use Livewire\Component;

class ViewImageModal extends Component
{

    public $openImageModal = false;

    public $projectId = null;
    public $images = [];
    public $currentIndex = 0;


    #[On('open-image-modal')]
    public function openImageModal($id)
    {

        $this->projectId = $id;

        // Fetch the project with files
        $project = Project::with('files')->find($id);

        if ($project && $project->files->count() > 0) {
            // Filter only image files
            $imageFiles = $project->files->filter(function ($file) {
                $allowedMimes = ['image/png', 'image/jpeg', 'image/jpg', 'image/webp'];
                return in_array($file->mime_type, $allowedMimes);

                // OR if you don't have mime_type column, filter by extension:
                // $extension = strtolower(pathinfo($file->file_path, PATHINFO_EXTENSION));
                // return in_array($extension, ['png', 'jpeg', 'jpg', 'webp']);
            });

            // Map the filtered image paths
            if ($imageFiles->count() > 0) {
                $this->images = $imageFiles->map(function ($file) {
                    return asset('storage/' . $file->file_path);
                })->values()->toArray(); // values() to reset array keys

                $this->currentIndex = 0;
                $this->openImageModal = true;
            } else {
                // No images found
                $this->images = [];
                $this->openImageModal = false;
                // Optionally show a notification
                session()->flash('message', 'No images found for this project.');
            }
        }
    }

    public function closeModal()
    {
        $this->openImageModal = false;
        $this->projectId = null;
        $this->images = [];
        $this->currentIndex = 0;
    }

    public function nextImage()
    {
        if ($this->currentIndex < count($this->images) - 1) {
            $this->currentIndex++;
        } else {
            $this->currentIndex = 0;
        }
    }

    public function previousImage()
    {
        if ($this->currentIndex > 0) {
            $this->currentIndex--;
        } else {
            $this->currentIndex = count($this->images) - 1;
        }
    }
    public function render()
    {
        return view(
            'livewire.map.view-image-modal'
        );
    }
}
