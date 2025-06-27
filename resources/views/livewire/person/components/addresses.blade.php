<div class="p-5 border border-gray-200 rounded-2xl dark:border-gray-800 lg:p-6 space-y-4 relative">
    {{-- Título e Botões --}}
    <div class="flex items-center justify-between mb-4">
        <h5 class="text-base font-semibold text-gray-700 dark:text-gray-200">Endereço</h5>

        <div class="flex gap-2">
            <button wire:click="resetFields()" x-on:click="$dispatch('open-modal', { id: 'address' })"
                class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700">
                Novo Endereço
            </button>
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
                    {{ $address->street ?? '—' }}
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
                    <span class="font-semibold">Número:</span> {{ $address->number ?? '—' }}
                </div>
                <div>
                    <span class="font-semibold">Complemento:</span> {{ $address->complement ?? '—' }}
                </div>
            </div>

            {{-- Linha: Bairro e CEP --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <span class="font-semibold">Bairro:</span> {{ $address->district ?? '—' }}
                </div>
                <div>
                    <span class="font-semibold">CEP:</span> {{ $address->postal_code ?? '—' }}
                </div>
            </div>

            {{-- Linha: Estado (ou Cidade/Estado/País, se quiser expandir) --}}
            <div>
                <span class="font-semibold">Estado:</span> {{ $address->state ?? '—' }}
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
