<?php

namespace App\Livewire\Map;

use App\Models\ProjectFile;
use Livewire\Attributes\On;
use Livewire\Component;

class OpenVideoImageModal extends Component
{
    public $openModal = false;
    public $imageId = null;

    public $fileUrl;
    public $fileMimes;

    #[On('open-video-image-modal')]
    public function openModal($id)
    {
        $this->imageId = $id;

        $data = ProjectFile::findOrFail($this->imageId);

        $this->fileUrl = asset('storage/' . $data->file_path);
        $this->fileMimes = $data->mime_type;

        $this->openModal = true;
    }

    public function closeModal()
    {
        $this->openModal = false;
    }

    public function render()
    {
        return view('livewire.map.open-video-image-modal');
    }
}
