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

    public $oldCode;
    public $confirmOldCode;

    public $new;
    public $new_confirmation;

    protected $rules = [
        'confirmOldCode' => 'required',
        'new' => 'required|confirmed',
    ];

    protected $messages = [
        'new.required' => 'please enter a new deletion code',
    ];


    #[On('open-change-modal')]
    public function openChangeModal($id)
    {
        $data = Code::select('id', 'delete_code')->findOrFail($id);

        $this->codeId = $data->id;
        $this->oldCode = $data->delete_code;

        $this->openChangeModal = true;
    }

    public function changeCode()
    {
        if (! Hash::check($this->confirmOldCode, $this->oldCode)) {
            $this->addError('confirmOldCode', 'The existing code registered does not match!');
            $this->openChangeModal = true;
            return;
        }

        $data = $this->validate([
            'new' => ['required', 'max:255', 'confirmed'],
            'new_confirmation' => ['required'],
        ]);


        $data['delete_code'] = Hash::make($data['new']);

        Code::find($this->codeId)->update($data);
    }


    public function render()
    {
        return view('livewire.settings.change-modal');
    }
}
