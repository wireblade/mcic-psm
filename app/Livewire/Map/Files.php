<?php

namespace App\Livewire\Map;

use App\Models\Project;
use Livewire\Component;

class Files extends Component
{

    public $id;
    public $name;


    public function mount($id)
    {
        $project = Project::findOrFail($id);


        $this->id = $id;
        $this->name = $project->name;
    }

    public function render()
    {
        return view('livewire.map.files');
    }
}
