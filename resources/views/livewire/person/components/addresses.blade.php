<div>
    <div class="flex justify-end items-center mb-2">
        <button wire:click="resetFields()" x-on:click="$dispatch('open-modal', { id: 'address' })"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Novo Contato
        </button>
    </div>
    @if ($address)
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">CEP</th>
                    <th scope="col" class="px-6 py-3">Logradouro</th>
                    <th scope="col" class="px-6 py-3">Numero</th>
                    <th scope="col" class="px-6 py-3">Complemento</th>
                    <th scope="col" class="px-6 py-3">Bairro</th>
                    <th scope="col" class="px-6 py-3">Cidade</th>
                    <th scope="col" class="px-6 py-3">Estado</th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{  $address->postal_code }}
                    </th>
                    <td class="px-6 py-4">
                         {{  $address->street }}
                        </th>
                    </td>
                    <td class="px-6 py-4"></td>
                    <td class="px-6 py-4"></td>
                    <td class="px-6 py-4"></td>
                    <td class="px-6 py-4"></td>
                    <td class="px-6 py-4">
                        <button wire:click="edit('{{ $address->id }}')"
                            x-on:click="$dispatch('open-modal', { id: 'address' })"
                            class="text-blue-600 hover:underline">Editar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    @else
        <p class="text-gray-500 mt-4">Nenhum contato encontrado.</p>
    @endif

    <x-main-modal id="address" title="{{ $addressId ? 'Editar Endereço' : 'Novo Endereço' }}" class="w-[60vw]">

        <form wire:submit.prevent="save" class="space-y-4">
            @csrf
            <div x-data="viacep()">
                <fieldset class="border border-gray-300 rounded p-6  mt-4 ">
                    <legend class="text-sm font-semibold text-gray-700 px-2">CEP</legend>
                    <div class="col-span-2">
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            </div>
                            <input wire:model="postal_code" x-ref="cep" x-init="IMask($refs.cep, { mask: '00000-000' })"
                                 maxlength="9" type="search" id="postal_code" name="postal_code" autocomplete="postal_code"
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
                        <x-text-input wire:model="street" id="street" name="street"
                            type="text" class="mt-1 block w-full" autocomplete="street" placeholder="Logradouro" />
                        <x-input-error class="mt-2" :messages="$errors->get('street')" />
                        @error('street')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="">
                        <x-input-label for="district" :value="__('Bairro')" />
                        <x-text-input wire:model="district" id="district" name="district"
                            type="text" class="mt-1 block w-full" autocomplete="district" placeholder="Bairro" />
                        <x-input-error class="mt-2" :messages="$errors->get('district')" />
                    </div>
                    <div class="">
                        <x-input-label for="number" :value="__('Numero')" />
                        <x-text-input wire:model="number" id="number" name="number"
                            type="text" class="mt-1 block w-full" autocomplete="number" placeholder="Numero" />
                        <x-input-error class="mt-2" :messages="$errors->get('number')" />
                    </div>
                    <div class="">
                        <x-input-label for="complement" :value="__('Complemento')" />
                        <x-text-input wire:model="complement" id="complement"
                            name="complement" type="text" class="mt-1 block w-full" autocomplete="complement"
                            placeholder="Complemento" />
                        <x-input-error class="mt-2" :messages="$errors->get('complement')" />
                    </div>

                    <div class="">
                        <x-input-label for="city" :value="__('Cidade')" />
                        <x-text-input wire:model="city" id="city" name="city"
                            type="text" class="mt-1 block w-full" autocomplete="city" placeholder="Cidade" />
                        <x-input-error class="mt-2" :messages="$errors->get('city')" />
                    </div>
                    <div class="">
                        <x-input-label for="state" :value="__('Estado')" />
                        <x-text-input wire:model="state" id="state" name="state"
                            type="text" class="mt-1 block w-full" autocomplete="state" placeholder="Estado" />
                        <x-input-error class="mt-2" :messages="$errors->get('state')" />
                    </div>
                    <div class="">
                        <x-input-label for="country" :value="__('Pais')" />
                        <x-text-input wire:model="country" id="country" name="country"
                            type="text" class="mt-1 block w-full" autocomplete="country" placeholder="Pais" />
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
