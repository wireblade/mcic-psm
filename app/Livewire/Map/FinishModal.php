<?php

namespace App\Livewire\Map;

use App\Models\Project;
use Livewire\Attributes\On;
use Livewire\Component;

class FinishModal extends Component
{
    public $name;

    public $openFinishModal = false;
    public $projectFinishId = null;

    public string $finish = '1';

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
        $this->openFinishModal = false;

        Project::find($this->projectFinishId)->update([
            'status' => $this->finish,
        ]);

        $this->dispatch('finish-success', name: $this->name);
    }

    public function render()
    {
        return view('livewire.map.finish-modal');
    }
}
