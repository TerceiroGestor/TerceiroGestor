<?php

namespace App\Livewire\Person\Components;

use Livewire\Component;
use App\Models\Address;
use App\Models\Person;

class Addresses extends Component
{
    public $addresses;
    public $address;
    public $addressId;
    protected $person;
    public $personId;

    protected $roles = [
        'street' => 'string',
        'number' => 'string',
        'complement' => 'string',
        'district' => 'string',
        'city' => 'string',
        'state' => 'string',
        'country' => 'string',
        'postal_code' => 'string',
    ];

    public function mount($person)
    {   
        $this->person = $person;
        
    }

    public function loadAddress()
    {
        $this->address = $this->person->address()->get();
    }

    public function edit($addressId = null)
    {

        if ($addressId) {
            $address = $this->addressService->findOrFail($addressId);
            $this->addressId = $address->id;
            $this->address = $address->toArray();
        }
    }


    public function save() {
        $person = Person::findOrFail($this->personId);

    }

    public function render()
    {
        return view('livewire.person.components.addresses');
    }
}
