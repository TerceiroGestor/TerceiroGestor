<div class="my-6">
    {{-- Contatos --}}
    <div class="p-5 border border-gray-200 rounded-2xl dark:border-gray-800 lg:p-6 space-y-4 relative">
        {{-- Título e Botão Novo --}}
        <div class="flex items-center justify-between mb-2">
            <h5 class="text-base font-semibold text-gray-700 dark:text-gray-200">Contatos</h5>

            <button wire:click="resetFields()" x-on:click="$dispatch('open-modal', { id: 'contact' })"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">
                Novo Contato
            </button>
        </div>

        @if (count($contacts) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($contacts as $contact)
                    <div
                        class="p-4 border border-gray-200 rounded-xl dark:border-gray-700 bg-white dark:bg-gray-900 shadow-sm">
                        <div class="flex items-center justify-between mb-2">
                            <h6 class="text-sm font-medium text-gray-800 dark:text-gray-100">
                                {{ $contact->type }}
                            </h6>
                            @if ($contact->main)
                                <span
                                    class="text-xs text-green-600 bg-green-100 dark:bg-green-900 dark:text-green-300 px-2 py-0.5 rounded-full">
                                    Principal
                                </span>
                            @endif
                        </div>

                        <div class="text-sm text-gray-600 dark:text-gray-300 mb-3">
                            @if ($contact->type === 'WhatsApp')
                                <a href="https://wa.me/{{ $contact->value }}" target="_blank"
                                    class="text-green-600 hover:underline">
                                    {{ preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $contact->value) }}
                                </a>
                            @elseif ($contact->type === 'Celular')
                                {{ preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $contact->value) }}
                            @else
                                {{ $contact->value }}
                            @endif
                        </div>

                        <div class="flex gap-4 text-sm">
                            <button wire:click="edit('{{ $contact->id }}')"
                                x-on:click="$dispatch('open-modal', { id: 'contact' })"
                                class="text-blue-600 hover:underline">
                                Editar
                            </button>
                            <button wire:click="contactDelete('{{ $contact->id }}')"
                                class="text-red-600 hover:underline">
                                Remover
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-sm text-gray-500 dark:text-gray-400 italic">Nenhum contato encontrado.</p>
        @endif
    </div>



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
                <input id="value" type="text" wire:model.defer="contact.value"
                    class="w-full border rounded px-3 py-2" />
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
