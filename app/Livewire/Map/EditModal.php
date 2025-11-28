<?php

namespace App\Livewire\Map;

use App\Models\Project;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;

class EditModal extends Component
{

    public $openEditModal = false;

    public $projectEditId = null;

    public $name;
    public $latitude;
    public $longitude;
    public $description;

    protected $messages = [
        'latitude.numeric' => 'Not an actual latitude.',
        'longitude.numeric' => 'Not an actual longitude.',
        'latitude.required' => 'please enter valid latitude',
        'longitude.required' => 'please enter valid longitude',
    ];

    #[On('open-edit-modal')]
    public function openEditModal($id)
    {
        $project = Project::findOrFail($id);

        if ($project) {
            $this->projectEditId = $id;

            $this->name = $project->name;
            $this->latitude = $project->latitude;
            $this->longitude = $project->longitude;
            $this->description = $project->description;

            $this->openEditModal = true;
        }
    }

    public function updateProject()
    {
        $project = Project::findOrFail($this->projectEditId);

        if (
            $this->name === $project->name &&
            $this->latitude === $project->latitude &&
            $this->longitude === $project->longitude &&
            $this->description === $project->description
        ) {

            $this->dispatch('edit-no-changes', name: $this->name);

            $this->openEditModal = false;
        } else {

            $data = $this->Validate([
                'name' => 'required|string|max:255|' . Rule::unique('projects', 'name')->ignore($this->projectEditId),
                'latitude' => 'required|numeric|between:-90,90',
                'description' => 'nullable|string|max:1000',
                'longitude' => 'required|numeric|between:-180,180',
            ], $this->messages);

            Project::find($this->projectEditId)->update($data);

            $this->openEditModal = false;

            $this->dispatch('edit-success', name: $this->name);

            $this->reset();
        }
    }

    public function render()
    {
        return view('livewire.map.edit-modal');
    }
}
