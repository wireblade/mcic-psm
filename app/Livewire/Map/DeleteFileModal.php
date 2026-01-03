<?php

namespace App\Livewire\Map;

use Livewire\Attributes\On;
use Livewire\Component;

class DeleteFileModal extends Component
{
    public $openDeleteFileModal = false;
    public $fileId = null;

    #[On('open-delete-file-modal')]
    public function openDeleteFileModal($id)
    {
        $this->fileId = $id;

        $this->openDeleteFileModal = true;
    }

    public function render()
    {
        return view('livewire.map.delete-file-modal');
    }
}
