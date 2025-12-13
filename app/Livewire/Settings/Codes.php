<?php

namespace App\Livewire\Settings;

use App\Models\Code;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;
use Livewire\Component;

class Codes extends Component
{
    public $code;
    public $code_confirmation;

    public $openRemoveCode = false;
    public $removeCodeId;

    public $messages = [
        'code.confirmed' => 'Deletion code mismatch. Please ensure both fields contain the same code.',
        'code_confirmation.required' => 'Please confirm your deletion code.'
    ];

    public function mount()
    {
        if (auth()->user()->username !== 'admin') {
            $this->dispatch('showAlert', type: 'error', message: 'Forbidden page. Please contact Administrator');
        }
    }

    #[On('refreshPage')]
    public function refreshPage()
    {
        // This method is intentionally left blank to trigger a re-render
    }

    public function openRemoveModal($id)
    {
        $this->dispatch('open-remove-modal', id: $id);
    }

    public function openChangeModal($id)
    {
        $this->dispatch('open-change-modal', id: $id);
    }

    public function saveCode()
    {
        $validated =  $this->validate([
            'code' => 'required|max:255|confirmed',
            'code_confirmation' => 'required',
        ]);

        $validated['delete_code'] = Hash::make($validated['code']);

        Code::create($validated);

        $this->dispatch('showAlert', type: 'success', message: 'Deletion code saved successfully.');

        $this->reset();
    }

    public function render()
    {
        $id = Code::first();

        $codeCounts = Code::all();

        $count = $codeCounts->count();

        return view('livewire.settings.code', [
            'count' => $count,
            'id' => $id,
        ]);
    }
}
