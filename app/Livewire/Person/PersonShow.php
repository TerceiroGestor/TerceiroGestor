<?php


namespace App\Livewire\Person;

use Livewire\Component;
use App\Traits\HasNotification;
use Livewire\Attributes\On;
use App\Livewire\Traits\HandlesModals;
use App\Models\Person;

class PersonShow extends Component
{
    use HasNotification, HandlesModals;

    public $personId;
    public $editPersonId = null;
    public $person;

    protected $listeners = ['personUpdated' => 'refreshPerson'];

    public function mount($personId)
    {
        $this->person = Person::with([
            'address',
            'contacts',
            'country',
            'state',
            'city'
        ])->find($this->personId);
    }

    public function refreshPerson() {}

    public function edit($personId)
    {
        $this->dispatch('formEditPerson', $personId);
    }

    public function render()
    {
        return view('livewire.person.show');
    }
}
