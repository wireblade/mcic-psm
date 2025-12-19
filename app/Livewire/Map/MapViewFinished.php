<?php

namespace App\Livewire\Map;

use App\Models\Project;
use Livewire\Attributes\On;
use Livewire\Component;

class MapViewFinished extends Component
{
    public string $title = 'Map View';

    public function render()
    {
        return view('livewire.map.map-view-finished')
            ->layout('components.standalone');
    }
}
