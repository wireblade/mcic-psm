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

    public $search = '';

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

    public function viewDescription($id)
    {
        $this->dispatch('open-description-modal', id: $id);
    }

    public function render()
    {
        // $projects = Project::orderBy('id', 'desc')->where('status', '1')->paginate(5);

        $projects = Project::selectRaw("id, name, latitude, longitude, LEFT(description, 51) AS description, dateStart, dateEnd")
            ->where('status', '1')
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhereRaw("DATE_FORMAT(dateStart, '%b %d %Y') LIKE ?", ['%' . $this->search . '%']);
            })
            ->paginate(20);

        return view('livewire.map.finished-project', [
            'projects' => $projects,
        ]);
    }
}
