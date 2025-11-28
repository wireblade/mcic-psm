<?php

namespace App\Livewire\Map;

use App\Models\Project;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $title = 'Active Projects';

    #[On('add-success')]
    public function addFlashMessage()
    {
        session()->flash('success', 'Project successfully added!');
    }

    #[On('edit-success')]
    public function editFlashMessage($name, $test)
    {
        session()->flash('success', 'Project: ' . $name  . ' successfully updated!');
    }

    #[On('edit-no-changes')]
    public function editNoChangeFlashMessage($name)
    {
        session()->flash('error', 'No changes were made to Project:' . ' ' . $name);
    }

    #[On('finish-success')]
    public function finishFlashMessage($name)
    {
        session()->flash('success', 'Project: ' . $name  . ' successfully finished!');
    }

    #[On('delete-success')]
    public function deleteFlashMessage($name)
    {
        session()->flash('success', 'Project: ' . $name  . ' successfully deleted!');
    }

    #[On('no-delete-code')]
    public function noDeleteCodeFlashMessage()
    {
        session()->flash('error', 'There is no deletion code available on the system. please register one in the settings');
    }

    public function openAddModal()
    {
        $this->dispatch('open-add-modal');
    }

    public function openEditModal($id)
    {
        $this->dispatch('open-edit-modal', id: $id);
    }

    public function openFinishModal($id)
    {
        $this->dispatch('open-finish-modal', id: $id);
    }

    public function openDeleteModal($id)
    {
        $this->dispatch('open-delete-modal', id: $id);
    }

    public function render()
    {
        $projects = Project::orderBy('id', 'desc')->where('status', '0')->paginate(5);

        return view('livewire.map.index', [
            'projects' => $projects,
            'title' => $this->title,
        ]);
    }
}
