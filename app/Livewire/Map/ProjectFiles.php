<?php

namespace App\Livewire\Map;

use App\Models\Project;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class ProjectFiles extends Component
{
    public $id;
    public $name;
    public $description;
    public $status;

    // This will keep the page parameter in the URL
    #[Url()]
    public $page = 1;

    #[On('refreshFiles')]
    public function refreshFiles()
    {
        // to refresh the page after uploading files
    }

    public function mount($id)
    {
        $project = Project::findOrFail($id);

        $this->description = $project->description;
        $this->id = $id;
        $this->name = $project->name;
        $this->status = $project->status;
    }

    public function openUploadModal($id)
    {
        $this->dispatch('open-upload-modal', id: $id);
    }

    public function render()
    {
        return view('livewire.map.project-files', [
            'project' => Project::with('files')->findOrFail($this->id)
        ]);
    }
}
