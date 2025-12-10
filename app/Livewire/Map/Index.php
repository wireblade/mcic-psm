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

    public $search = '';

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

    public function viewDescription($id)
    {
        $this->dispatch('open-description-modal', id: $id);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        // $projects = Project::orderBy('id', 'desc')->where('status', '0')->paginate(5);
        $projects = Project::selectRaw("id, name, latitude, longitude, LEFT(description, 51) AS description, dateStart")
            ->where('status', 0)
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhereRaw("DATE_FORMAT(dateStart, '%b %d %Y') LIKE ?", ['%' . $this->search . '%']);
            })
            ->orderBy('dateStart', 'ASC')
            ->paginate(10);

        return view('livewire.map.index', [
            'projects' => $projects,
            'title' => $this->title,
        ]);
    }
}
