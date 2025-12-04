<?php

namespace App\Livewire\Map;

use App\Models\Project;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

use function Symfony\Component\Translation\t;

class FinishedProject extends Component
{
    use WithPagination;

    public string $title = "Finished Project";

    #[On('refreshTable')]
    public function refreshTable()
    {
        // This method is intentionally left blank to trigger a re-render
    }

    public function openDeleteModal($id)
    {
        $this->dispatch('open-delete-modal', id: $id);
    }

    public function openEditModal($id)
    {
        $this->dispatch('open-edit-modal', id: $id);
    }

    public function render()
    {
        $projects = Project::orderBy('id', 'desc')->where('status', '1')->paginate(5);

        return view('livewire.map.finished-project', [
            'projects' => $projects,
        ]);
    }
}
