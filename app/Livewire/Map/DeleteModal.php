<?php

namespace App\Livewire\Map;

use App\Models\Code;
use App\Models\Project;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteModal extends Component
{

    public $openDeleteModal = false;
    public $name;
    public $inputCode;

    public $projectDeleteId;

    public $deletionCode;

    protected $rules = [
        'inputCode' => 'required',
    ];

    protected $messages = [
        'inputCode.required' => 'please enter deletion :attribute',
    ];

    protected $validationAttributes = [
        'inputCode' => 'code', // This will replace :attribute in error messages
    ];

    #[On('open-delete-modal')]
    public function openDeleteModal($id)
    {
        $this->openDeleteModal = true;

        $project = Project::findOrFail($id);

        $this->projectDeleteId = $project->id;

        $this->name = $project->name;
    }

    public function deleteProject()
    {
        $codes = Code::first();

        if (empty($codes)) {

            $this->dispatch('no-delete-code');

            $this->openDeleteModal = false;

            $this->reset();
        } else {

            $this->deletionCode = $codes->delete_code;

            $this->validate([
                'inputCode' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        if ($value !== $this->deletionCode) {
                            $fail('error');
                        }
                    }
                ]
            ]);

            $project = Project::findOrFail($this->projectDeleteId);

            $project->delete();

            $this->dispatch('delete-success');

            $this->openDeleteModal = false;
        }
    }

    public function render()
    {
        return view('livewire.map.delete-modal');
    }
}
