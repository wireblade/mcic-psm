<?php

namespace App\Livewire\Map;

use App\Models\Project;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

class Index extends Component
{
    use WithPagination;

    public string $title = 'Active Projects';

    #[On('refreshTable')]
    public function refreshTable()
    {
        // Table data will re-render automatically
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
