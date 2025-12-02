<?php

namespace App\Livewire\Map;

use App\Models\Project;
use Livewire\Attributes\On;
use Livewire\Component;

class AddModal extends Component
{
    public $openAddModal = false;

    public $name;
    public $description;
    public $latitude;
    public $longitude;
    public $dateStart;

    protected $messages = [
        'name.unique' => 'The ID has already been taken.',
        'latitude.numeric' => 'Not an actual latitude.',
        'longitude.numeric' => 'Not an actual longitude.',
        'latitude.required' => 'please enter valid latitude',
        'longitude.required' => 'please enter valid longitude',
    ];

    #[On('open-add-modal')]
    public function openAddModal()
    {
        $this->openAddModal = true;
        $this->dispatch('auto-focus');
    }

    public function saveProject()
    {
        $data = $this->validate([
            'name' => 'required|max:255|string|unique:projects,name',
            'description' => 'nullable|string|max:1000',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'dateStart' => 'nullable|date',
        ]);

        Project::create($data);

        $this->dispatch('add-success');

        $this->reset();

        $this->openAddModal = false;
    }

    public function render()
    {
        return view('livewire.map.add-modal');
    }
}
