<?php

namespace App\Livewire\Map;

use App\Models\Project;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;
use Carbon\Carbon;

class EditModal extends Component
{

    public $openEditModal = false;

    public $projectEditId = null;

    public $name;
    public $latitude;
    public $longitude;
    public $description;
    public $dateStart;
    public $dateEnd;

    public $status;

    public $dateStartIfEmpty;

    protected $messages = [
        'latitude.numeric' => 'Not an actual latitude.',
        'longitude.numeric' => 'Not an actual longitude.',
        'latitude.required' => 'please enter valid latitude',
        'longitude.required' => 'please enter valid longitude',
        'dateEnd.after_or_equal' => 'End date must be the same as or later than the start date.',
    ];

    #[On('open-edit-modal')]
    public function openEditModal($id)
    {
        $project = Project::findOrFail($id);

        $dateStartIfEmpty = $project->dateStart;

        if ($project) {
            $this->projectEditId = $id;

            $this->name = $project->name;
            $this->latitude = $project->latitude;
            $this->longitude = $project->longitude;
            $this->description = $project->description;

            $this->dateStart = $project->dateStart ? $project->dateStart->format('Y-m-d') : null;
            $this->dateEnd = $project->dateEnd ? $project->dateEnd->format('Y-m-d') : null;;

            $this->status = $project->status;
            $this->dateStartIfEmpty = $dateStartIfEmpty;
            $this->openEditModal = true;

            $this->dispatch('auto-focus');
        }
    }

    public function updateProject()
    {
        $project = Project::findOrFail($this->projectEditId);

        if (
            $this->name === $project->name &&
            $this->latitude === $project->latitude &&
            $this->longitude === $project->longitude &&
            $this->description === $project->description &&
            $this->dateStart === ($project->dateStart?->format('Y-m-d')) &&
            $this->dateEnd === ($project->dateEnd?->format('Y-m-d'))
        ) {

            $flashMessage = 'No changes were made to Project:' . ' ' . $this->name;

            $this->dispatch('showAlert', type: 'error', message: $flashMessage);

            $this->openEditModal = false;
        } else {

            $data = $this->Validate([
                'name' => 'required|string|max:255|' . Rule::unique('projects', 'name')->ignore($this->projectEditId),
                'latitude' => 'required|numeric|between:-90,90',
                'description' => 'nullable|string|max:1000',
                'longitude' => 'required|numeric|between:-180,180',
                'dateStart' => [
                    'nullable',
                    'date',
                    function ($attribute, $value, $fail) {
                        if (!empty($this->dateEnd)) {
                            $startDate = Carbon::parse($value);
                            $endDate = Carbon::parse($this->dateEnd);

                            if ($startDate->greaterThan($endDate)) {
                                $fail('Start date must be the same as or before than the end date.');
                            }
                        }
                    }
                ],
                'dateEnd' => 'nullable|date|after_or_equal:dateStart',

            ], $this->messages);

            Project::find($this->projectEditId)->update($data);

            $this->dispatch('showAlert', type: 'success', message: 'Project: ' . $this->name . ' has been updated successfully.');

            $this->openEditModal = false;

            $this->reset();

            // Refresh the table
            $this->dispatch('refreshTable');
        }
    }

    public function render()
    {
        return view('livewire.map.edit-modal');
    }
}
