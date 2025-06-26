<?php

namespace App\Livewire\Person;

use Livewire\Component;
use App\Models\Person;

class CompleteForm extends Component
{
    public ?Person $person = null;
    protected $listeners = ['CompleteFormReload' => 'reload'];

    public function reload($personId = null)
    {
        if ($personId) {
            $this->person = Person::findOrFail($personId);
        }
    }

    public function resetForm()
    {
        $this->person = null;
    }

    public function render()
    {
        return view('livewire.person.complete-form');
    }
}
