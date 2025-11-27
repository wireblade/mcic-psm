<?php

namespace App\Livewire\Map;

use App\Models\Project;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class FinishedProject extends Component
{
    use WithPagination;

    public string $title = "Finished Project";

    #[On('delete-success')]
    public function deleteFlashMessage()
    {
        session()->flash('success', 'Project successfully deleted');
    }

    public function openDeleteModal($id)
    {
        $this->dispatch('open-delete-modal', id: $id);
    }

    public function render()
    {
        $projects = Project::orderBy('id', 'desc')->where('status', '1')->paginate(10);

        return view('livewire.map.finished-project', [
            'projects' => $projects,
        ]);
    }
}
