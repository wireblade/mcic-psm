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

    protected $rules = [
        'confirm' => 'required',
    ];

    protected $messages = [
        'confirm.required' => 'please confirm :attribute',
    ];

    protected $validationAttributes = [
        'confirm' => 'code', // This will replace :attribute in error messages
    ];

    #[On('open-remove-modal')]
    public function openRemoveModal($id)
    {
        $this->codeRemoveId = $id;

        $this->openRemoveModal = true;
    }

    public function removeCode()
    {
        $data = Code::findOrFail($this->codeRemoveId);

        $this->validate([
            'confirm' => 'required',
        ]);

        if (! Hash::check($this->confirm, $data->delete_code)) {

            $this->addError('confirm', 'Code does not match.');
        } else {

            $data->delete();

            $this->dispatch('remove-success');

            $this->openRemoveModal = false;
        }
    }

    public function render()
    {
        return view('livewire.settings.remove-code-modal');
    }
}
