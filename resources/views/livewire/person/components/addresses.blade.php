<div class="p-5 border border-gray-200 rounded-2xl dark:border-gray-800 lg:p-6 space-y-4 relative">
    {{-- Título e Botões --}}
    <div class="flex items-center justify-between mb-4">
        <h5 class="text-base font-semibold text-gray-700 dark:text-gray-200">Endereço</h5>

        <div class="flex gap-2">
            <button wire:click="resetFields()" x-on:click="$dispatch('open-modal', { id: 'address' })"
                class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700">
                Novo Endereço
            </button>
            @if ($person->address)
                <button wire:click="edit('{{ $person->address->id }}')"
                    x-on:click="$dispatch('open-modal', { id: 'address' })"
                    class="flex items-center gap-2 border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 rounded hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                    <svg class="fill-current" width="16" height="16" viewBox="0 0 18 18" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M15.0911 2.78206C14.2125 1.90338 12.7878 1.90338 11.9092 2.78206L4.57524 10.116C4.26682 10.4244 4.0547 10.8158 3.96468 11.2426L3.31231 14.3352C3.25997 14.5833 3.33653 14.841 3.51583 15.0203C3.69512 15.1996 3.95286 15.2761 4.20096 15.2238L7.29355 14.5714C7.72031 14.4814 8.11172 14.2693 8.42013 13.9609L15.7541 6.62695C16.6327 5.74827 16.6327 4.32365 15.7541 3.44497L15.0911 2.78206ZM12.9698 3.84272C13.2627 3.54982 13.7376 3.54982 14.0305 3.84272L14.6934 4.50563C14.9863 4.79852 14.9863 5.2734 14.6934 5.56629L14.044 6.21573L12.3204 4.49215L12.9698 3.84272ZM11.2597 5.55281L5.6359 11.1766C5.53309 11.2794 5.46238 11.4099 5.43238 11.5522L5.01758 13.5185L6.98394 13.1037C7.1262 13.0737 7.25666 13.003 7.35947 12.9002L12.9833 7.27639L11.2597 5.55281Z"
                            fill="" />
                    </svg>
                    Editar
                </button>
            @endif
        </div>
    </div>

    {{-- Conteúdo --}}
    @if ($person->address)
        <div
            class="p-6 rounded-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 shadow-sm text-sm text-gray-700 dark:text-gray-300 space-y-4">

            {{-- Linha: Logradouro + ícone do mapa --}}
            <div class="flex items-center justify-between gap-2">
                <div class="flex-1">
                    <span class="font-semibold">Logradouro:</span>
                    {{ $person->address->street ?? '—' }}
                </div>
                @if ($map)
                    <a href="{{ $map }}" target="_blank" title="Ver no Google Maps"
                        class="text-blue-600 hover:text-blue-800 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 md:w-6 md:h-6" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                    </a>
                @endif
            </div>

            {{-- Linha: Número e Complemento --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <span class="font-semibold">Número:</span> {{ $person->address->number ?? '—' }}
                </div>
                <div>
                    <span class="font-semibold">Complemento:</span> {{ $person->address->complement ?? '—' }}
                </div>
            </div>

            {{-- Linha: Bairro e CEP --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <span class="font-semibold">Bairro:</span> {{ $person->address->district ?? '—' }}
                </div>
                <div>
                    <span class="font-semibold">CEP:</span> {{ $person->address->postal_code ?? '—' }}
                </div>
            </div>

            {{-- Linha: Estado (ou Cidade/Estado/País, se quiser expandir) --}}
            <div>
                <span class="font-semibold">Estado:</span> {{ $person->address->state ?? '—' }}
            </div>
        </div>
    @else
        <p class="text-sm text-gray-500 dark:text-gray-400 italic">Nenhum endereço cadastrado.</p>
    @endif

    <x-main-modal id="address" title="{{ $addressId ? 'Editar Endereço' : 'Novo Endereço' }}" class="w-[60vw]">

        <form wire:submit.prevent="save" class="space-y-4">
            @csrf
            <div >
                <fieldset class="border border-gray-300 rounded p-6  mt-4 ">
                    <legend class="text-sm font-semibold text-gray-700 px-2">CEP</legend>
                    <div class="col-span-2">
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            </div>
                            <input wire:model="postal_code" x-ref="cep" x-init="IMask($refs.cep, { mask: '00000-000' })" maxlength="9"
                                type="search" id="postal_code" name="postal_code" autocomplete="postal_code"
                                class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="CEP" required />
                            <button type="button" wire:click="buscarCep"
                                class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buscar
                                CEP</button>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="border border-gray-300 rounded p-6  mt-4 grid grid-cols-2 gap-4">
                    <legend class="text-sm font-semibold text-gray-700 px-2">Endereço</legend>
                    <div class="">
                        <x-input-label for="street" :value="__('Logradouro')" />
                        <x-text-input wire:model="street" id="street" name="street" type="text"
                            class="mt-1 block w-full" autocomplete="street" placeholder="Logradouro" />
                        <x-input-error class="mt-2" :messages="$errors->get('street')" />
                        @error('street')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="">
                        <x-input-label for="district" :value="__('Bairro')" />
                        <x-text-input wire:model="district" id="district" name="district" type="text"
                            class="mt-1 block w-full" autocomplete="district" placeholder="Bairro" />
                        <x-input-error class="mt-2" :messages="$errors->get('district')" />
                    </div>
                    <div class="">
                        <x-input-label for="number" :value="__('Numero')" />
                        <x-text-input wire:model="number" id="number" name="number" type="text"
                            class="mt-1 block w-full" autocomplete="number" placeholder="Numero" />
                        <x-input-error class="mt-2" :messages="$errors->get('number')" />
                    </div>
                    <div class="">
                        <x-input-label for="complement" :value="__('Complemento')" />
                        <x-text-input wire:model="complement" id="complement" name="complement" type="text"
                            class="mt-1 block w-full" autocomplete="complement" placeholder="Complemento" />
                        <x-input-error class="mt-2" :messages="$errors->get('complement')" />
                    </div>

                    <div class="">
                        <x-input-label for="city" :value="__('Cidade')" />
                        <x-text-input wire:model="city" id="city" name="city" type="text"
                            class="mt-1 block w-full" autocomplete="city" placeholder="Cidade" />
                        <x-input-error class="mt-2" :messages="$errors->get('city')" />
                    </div>
                    <div class="">
                        <x-input-label for="state" :value="__('Estado')" />
                        <x-text-input wire:model="state" id="state" name="state" type="text"
                            class="mt-1 block w-full" autocomplete="state" placeholder="Estado" />
                        <x-input-error class="mt-2" :messages="$errors->get('state')" />
                    </div>
                    <div class="">
                        <x-input-label for="country" :value="__('Pais')" />
                        <x-text-input wire:model="country" id="country" name="country" type="text"
                            class="mt-1 block w-full" autocomplete="country" placeholder="Pais" />
                        <x-input-error class="mt-2" :messages="$errors->get('country')" />
                    </div>
                </fieldset>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Salvar</button>
            </div>
        </form>

    </x-main-modal>
</div>
