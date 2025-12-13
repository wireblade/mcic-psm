<?php

namespace App\Livewire\Settings;

use App\Models\Code;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;
use Livewire\Component;

use function Ramsey\Uuid\v1;

class RemoveCodeModal extends Component
{

    public $openRemoveModal = false;

    public $codeRemoveId;

    public $confirm;

    public $deleteCode;

    protected $messages = [
        'confirm.required' => 'please confirm deletion code',
    ];

    #[On('open-remove-modal')]
    public function openRemoveModal($id)
    {
        $this->codeRemoveId = $id;

        $this->openRemoveModal = true;
    }

    public function removeCode()
    {
        $data = Code::select('id', 'delete_code')->findOrFail($this->codeRemoveId);

        $this->deleteCode = $data->delete_code;

        $this->validate([
            'confirm' => 'required',
        ]);

        if (! Hash::check($this->confirm, $this->deleteCode)) {

            $this->addError('confirm', 'Code does not match.');
        } else {

            $data->delete();

            $this->openRemoveModal = false;

            $this->dispatch('showAlert', type: 'success', message: 'Deletion code successfully removed!');

            $this->reset();

            $this->dispatch('refreshPage');
        }
    }

    public function render()
    {
        return view('livewire.settings.remove-code-modal');
    }
}
