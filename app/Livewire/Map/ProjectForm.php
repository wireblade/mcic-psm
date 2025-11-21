<?php

namespace App\Livewire\Map;

use App\Models\Project;
use Livewire\Component;

class ProjectForm extends Component
{
    public $name;
    public $description;
    public $latitude;
    public $longitude;

    public function save()
    {
        Project::create([
            'name' => $this->name,
            'description' => $this->description,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ]);

        $this->dispatch('project-added');

        $this->reset([
            'name',
            'description',
            'latitude',
            'longitude',
        ]);

        session()->flash('success', 'Project Added!');
    }

    public function render()
    {
        return view('livewire.map.project-form');
    }
}
