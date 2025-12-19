<?php

namespace App\Livewire\Settings;

use App\Models\Code;
use COM;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;
use Livewire\Component;

class ChangeModal extends Component
{

    public $codeId = null;

    public $openChangeModal = false;

    public $currentCode;
    public $confirmCurrentCode;

    public $new;
    public $new_confirmation;

    protected $rules = [
        'confirmCurrentCode' => 'required',
        'new' => 'required|confirmed',
    ];

    protected $messages = [
        'new.required' => 'please enter a new deletion code',
        'new.confirmed' => 'The new code and confirmation code do not match.'
    ];


    #[On('open-change-modal')]
    public function openChangeModal($id)
    {
        $data = Code::select('id', 'delete_code')->findOrFail($id);

        $this->codeId = $data->id;
        $this->currentCode = $data->delete_code;

        $this->openChangeModal = true;
    }

    public function changeCode()
    {
        // 1. Validate inputs first
        $data = $this->validate([
            'confirmCurrentCode' => ['required'],
        ]);

        // 2. Check current code
        if (! Hash::check($this->confirmCurrentCode, $this->currentCode)) {
            $this->addError('confirmCurrentCode', 'The current code you entered is incorrect.');
            $this->openChangeModal = true;
            return;
        }

        $data = $this->validate([
            'new' => ['required', 'max:255', 'confirmed'],
            'new_confirmation' => ['required'],
        ]);

        // 3. Prevent reuse of old code
        if (Hash::check($this->new, $this->currentCode)) {
            $this->addError('new', 'Your new code must be different from your current code..');
            return;
        }

        // 4. Update securely
        Code::find($this->codeId)->update([
            'delete_code' => Hash::make($data['new']),
        ]);

        // 5. Notify user
        $this->dispatch('showAlert', type: 'success', message: 'Deletion code successfully updated');

        // 6. Reset UI
        $this->openChangeModal = false;
        $this->reset();
    }


    public function render()
    {
        return view('livewire.settings.change-modal');
    }
}
