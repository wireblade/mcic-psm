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

        $data['dateStart'] = $this->dateStart === '' ? null : $this->dateStart;

        Project::create($data);

        $flashMessage = 'Project "' . $this->name . '" has been added successfully.';

        $this->dispatch('showAlert', type: 'success', message: $flashMessage);

        $this->reset();

        $this->openAddModal = false;

        // Refresh the table
        $this->dispatch('refreshTable');
    }

    public function render()
    {
        return view('livewire.map.add-modal');
    }
}
