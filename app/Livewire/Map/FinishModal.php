<?php

namespace App\Livewire\Map;

use App\Models\Project;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class FinishModal extends Component
{
    public $name;

    public $openFinishModal = false;
    public $projectFinishId = null;

    public string $finish = '1';

    public $end;

    public $start;

    #[On('open-finish-modal')]
    public function openFinishModal($id)
    {
        $project = Project::findOrFail($id);

        $this->projectFinishId = $id;

        $this->name = $project->name;

        $this->openFinishModal = true;
    }

    public function projectFinish()
    {

        $project = Project::find($this->projectFinishId);

        $this->start = $project->dateStart;

        $this->validate([
            'end' => [
                'nullable',
                'date',
                function ($attribute, $value, $fail) {
                    $startDate = Carbon::parse($this->start);
                    $endDate = Carbon::parse($this->end);
                    if ($this->start === null) {
                        $fail('Project start date is not set. You can set a start date before completing this project, or proceed without one.');
                    } else {
                        if ($endDate->lessThan($startDate)) {
                            $fail('Project Completed Date must be the same as or later than the Start Date.');
                        }
                    }
                }
            ]
        ]);

        $end = $this->end === '' ? null : $this->end;

        $project->update([
            'status' => $this->finish,
            'dateEnd' => $end,
        ]);

        $this->openFinishModal = false;

        $this->dispatch('showAlert', type: 'success', message: 'Project: ' . $this->name . ' successfully finished!');

        // Refresh the table
        $this->dispatch('refreshTable');
    }

    public function render()
    {
        return view('livewire.map.finish-modal');
    }
}
