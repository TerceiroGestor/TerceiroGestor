<?php

namespace App\Livewire\Person;

use Livewire\Component;
use App\Traits\HasNotification;
use Livewire\Attributes\On;
use App\Livewire\Traits\HandlesModals;
use App\Models\Person;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Http;
use App\Models\State;
use App\Models\City;

class PersonForm extends Component
{

    use HasNotification, HandlesModals, WithFileUploads;

    public $form = [];
    public $personId;
    public $person;

    public $states;
    public $cities;

    public $photo;
    public $full_name;
    public $social_name;
    public $birth_date;
    public $gender;
    public $ethnicity;
    public $marital_status;
    public $country;
    public $state;
    public $city;
    public $nis;
    public $cpf;
    public $rg;

    protected $rules = [
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'full_name' => 'required|string',
        'social_name' => 'string',
        'birth_date' => 'required|date',
        'gender' => 'nullable|string',
        'ethnicity' => 'nullable|string',
        'marital_status' => 'nullable|string',
        'country' => 'nullable|string',
        'state' => 'nullable|string',
        'city' => 'nullable|string',
        'nis' => 'nullable|string',
        'cpf' => 'nullable|string',
        'rg' => 'nullable|string'
    ];

    protected $listeners = ['formEditPerson' => 'edit'];

    public function mount($personId = null)
    {
        $this->states = State::orderBy('name')->get();
        $this->cities = City::orderBy('name')->get();

        if ($personId) {
            $person = Person::findOrFail($this->personId);
            $this->personId = $person->id;
            $this->fill($person->toArray());
        }
    }

    public function save()
    {
        $data = $this->validate();

        if ($this->photo) {
            $data['photo'] = $this->photo->store('photos', 'public');
        }

        if ($this->personId) {
            $person = Person::findOrFail($this->personId);
            $person->update($data);
            $this->dispatch('personUpdated', $person->id);
            $this->closeModal('updatePerson');
            $this->sweetSuccess("Atualizado!", "<span class='text-green-500'>{$person->full_name}</span> foi atualizado!");
        } else {
            $person = Person::create($data);
            $this->dispatch('personCreated', $person->id);
            $this->closeModal('createPerson');
            $this->sweetSuccess("Sucesso!", "<span class='text-blue-500'>{$person->full_name}</span> foi adicionado!");
        }

        $this->photo = null;
    }

    public function update($personId = null)
    {
        $data = $this->validate();

        if ($this->photo) {
            $data['photo'] = $this->photo->store('photos', 'public');
        }

        $person = Person::findOrFail($this->personId);
        $person->update($data);
        $this->sweetSuccess("Sucesso!", "<span class='text-blue-500'>{$person->full_name}</span> foi atualizado!");
        $this->photo = null;
    }

    public function resetForm()
    {
        $this->personId = null;
        $this->form = [];
        $this->photo = null;
    }

    public function edit($personId)
    {

        $this->resetForm();

        if ($personId) {
            $person = Person::findOrFail($personId);
            $this->personId = $person->id;
            $this->fill($person->toArray());
        } else {
            $this->form = [];
        }
    }

    public function updatedSelectedState($stateId)
    {
        $this->person['state'] = $stateId;
        $this->person['city'] = '';
        $this->loadCities($stateId);
    }

    public function loadCities($stateId)
    {
        $this->cities = Http::get("https://servicodados.ibge.gov.br/api/v1/localidades/estados/{$stateId}/municipios")->json();
    }

    public function render()
    {
        return view('livewire.person.person-form');
    }
}
