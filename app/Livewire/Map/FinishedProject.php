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

    #[On('delete-success')]
    public function deleteFlashMessage($name)
    {
        session()->flash('success', 'Project: ' . $name . ' successfully deleted!');
    }

    #[On('no-delete-code')]
    public function noDeleteCodeFlashMessage()
    {
        session()->flash('error', 'No deletion code set! Please contact the administrator.');
    }

    #[On('edit-no-changes')]
    public function editNoChangeFlashMessage($name)
    {
        session()->flash('error', 'No changes were made to Project:' . ' ' . $name);
    }

    #[On('edit-success')]
    public function editSuccessFlashMessage($name)
    {
        session()->flash('success', 'Project: ' . $name . ' successfully updated!');
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
        $projects = Project::orderBy('id', 'desc')->where('status', '1')->paginate(10);

        return view('livewire.map.finished-project', [
            'projects' => $projects,
        ]);
    }
}
