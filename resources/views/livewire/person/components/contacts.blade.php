<div>
    <div class="flex justify-end items-center mb-2">
        <button wire:click="resetFields()" x-on:click="$dispatch('open-modal', { id: 'contact' })"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Novo Contato
        </button>
    </div>

    @if (count($contacts) > 0)
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Tipo</th>
                    <th scope="col" class="px-6 py-3">Valor</th>
                    <th scope="col" class="px-6 py-3">Principal</th>
                    <th scope="col" class="px-6 py-3">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $contact->type }}
                        </th>
                        <td class="px-6 py-4">
                            @if ($contact->type === 'WhatsApp')
                                <a href="https://wa.me/{{ $contact->value }}" target="_blank"
                                    class="text-green-600 hover:underline">
                                    {{ preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $contact->value) }}
                                </a>
                            @elseif ($contact->type === 'Celular')
                                {{ preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $contact->value) }}
                            @elseif ($contact->type === 'Email')
                                {{ $contact->value }}
                            @endif
                        </td>
                        <td class="px-6 py-4">{{ $contact->main ? 'Principal' : '' }}</td>
                        <td class="px-6 py-4">
                            <button wire:click="edit('{{ $contact->id }}')"
                                x-on:click="$dispatch('open-modal', { id: 'contact' })"
                                class="text-blue-600 hover:underline">Editar</button>
                            <button wire:click="contactDelete('{{ $contact->id }}')"
                                class="text-red-600 hover:underline">Remover</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-gray-500 mt-4">Nenhum contato encontrado.</p>
    @endif

    <x-main-modal id="contact" title="{{ $contactId ? 'Editar Contato' : 'Novo Contato' }}" class="w-[60vw]">

        <h2 class="text-xl font-bold mb-4"></h2>

        <form wire:submit.prevent="save" class="space-y-4">
            <div>
                <label for="type" class="block font-semibold mb-1">Tipo</label>
                <select id="type" wire:model.defer="contact.type" class="w-full border rounded px-3 py-2">
                    <option value="">Selecione</option>
                    <option value="WhatsApp">WhatsApp</option>
                    <option value="Celular">Celular</option>
                    <option value="Email">Email</option>
                </select>
                @error('type')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="value" class="block font-semibold mb-1">Valor</label>
                <input id="value" type="text" wire:model.defer="contact.value" class="w-full border rounded px-3 py-2" />
                @error('value')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex items-center space-x-2">
                <input id="main" type="checkbox" wire:model.defer="contact.main" />
                <label for="main" class="select-none">Principal</label>
            </div>

            <div class="flex justify-end space-x-2 mt-6">
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                    Salvar
                </button>
            </div>
        </form>

    </x-main-modal>
</div>
