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

    #[On('finish-success')]
    public function finishFlashMessage()
    {
        session()->flash('success', 'Project successfully finished!');
    }

    #[On('delete-success')]
    public function deleteFlashMessage()
    {
        session()->flash('success', 'Project successfully deleted!');
    }

    #[On('no-delete-code')]
    public function noDeleteCodeFlashMessage()
    {
        session()->flash('error', 'There is no deletion code available on the system. please register one in the settings page');
    }

    public function openAddModal()
    {
        $this->dispatch('open-add-modal');
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
