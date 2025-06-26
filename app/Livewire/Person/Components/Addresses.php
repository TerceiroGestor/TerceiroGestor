<?php

namespace App\Livewire\Person\Components;

use Livewire\Component;
use App\Models\Address;
use App\Models\Person;
use App\Traits\HasNotification;
use App\Livewire\Traits\HandlesModals;

class Addresses extends Component
{

    use HasNotification, HandlesModals;


    public $addresses;
    public $address;
    public $addressId;
    public $person;
    public $personId;

    protected $rules = [
        'postal_code' => 'nullable|string',
        'street' => 'nullable|string',
        'number' => 'nullable|string',
        'complement' => 'nullable|string',
        'district' => 'nullable|string',
        'city' => 'nullable|string',
        'state' => 'nullable|string',
        'country' => 'nullable|string',
    ];

    public $postal_code;
    public $street;
    public $number;
    public $complement;
    public $district;
    public $city;
    public $state;
    public $country;


    public function mount($person)
    {
        $this->person = $person;
        $this->address = Address::findOrFail($person->address_id);
        $this->personId = $person->id;
    }

    public function loadAddress()
    {
        $this->address = $this->person->address()->get();
    }

    public function resetFields()
    {
        $this->addressId = null;
        $this->address = [];
    }

    public function edit($addressId = null)
    {
        $this->resetFields();

        if ($addressId) {
            $address = Address::findOrFail($addressId);
            $this->addressId = $address->id;
            $this->fill($address->toArray());
        }
    }

    public function save()
    {
        $data = $this->validate();
        $person = Person::findOrFail($this->personId);

        // 2. Verifica se já existe um endereço (por exemplo, com base em CEP e número)
        $existingAddress = Address::where('postal_code', $data['postal_code'])
            ->where('number', $data['number'])
            ->where('street', $data['street']) // ajuste os critérios conforme seu modelo
            ->first();

        if ($existingAddress) {

            // Endereço já existe — usa o mesmo
            $address = $existingAddress;

            // Atualiza os dados se necessário
            $address->update($data);

            $message = "O endereço <span class='text-blue-500'>{$address->street}, {$address->number}</span> foi atualizado!";
        } else {
            // Cria novo endereço
            $address = Address::create($data);

            $message = "O endereço <span class='text-blue-500'>{$address->street}, {$address->number}</span> foi adicionado!";
        }

        // 3. Atualiza o ID do endereço da pessoa
        $person->address_id = $address->id;
        $person->save();

        // 4. Pós-processo (recarregar dados, limpar formulário, fechar modal, etc.)
        $this->loadAddress(); // se houver
        $this->resetFields();   // se houver
        $this->closeModal('address');
        $this->sweetSuccess('Sucesso!', $message);
    }

    public function updatedPostalCode($value)
    {
        if (preg_match('/^\d{5}-?\d{3}$/', $value)) {
            $this->buscarCep($value);
        }
    }

    public function buscarCep()
    {
        $cep = preg_replace('/\D/', '', $this->postal_code);

        if (strlen($cep) !== 8) {
            $this->sweetSuccess('Erro!', 'Cep não encontrado!');
            return;
        }

        $response = @file_get_contents("https://viacep.com.br/ws/{$cep}/json/");
        $data = json_decode($response, true);

        if (isset($data['erro'])) {
            $this->sweetSuccess('Erro!', 'Cep não encontrado!');
            return;
        }

        // Preenche os campos
        $this->street = $data['logradouro'] ?? '';
        $this->district = $data['bairro'] ?? '';
        $this->city = $data['localidade'] ?? '';
        $this->state = $data['uf'] ?? '';
        $this->country = 'Brasil';

        $this->sweetSuccess('Sucesso!', 'Cep encontrado!');
    }



    public function render()
    {
        return view('livewire.person.components.addresses');
    }
}
