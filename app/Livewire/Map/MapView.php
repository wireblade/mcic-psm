<?php

namespace App\Livewire\Map;

use App\Models\Project;
use Livewire\Attributes\On;
use Livewire\Component;

class MapView extends Component
{
    public $projects = [];

    public string $title = 'Map View';

    public function mount()
    {
        // Load all projects with latitude & longitude
        $this->projects = Project::select('name', 'latitude', 'longitude')->get()
            ->map(function ($p) {
                return [
                    'name' => $p->name,
                    'latitude' => (float)$p->latitude,
                    'longitude' => (float)$p->longitude,
                ];
            });
    }

    public function refreshProject()
    {
        $this->projects = Project::all();
    }

    public function render()
    {
        return view('livewire.map.map-view')->layout('components.standalone');
    }
}
