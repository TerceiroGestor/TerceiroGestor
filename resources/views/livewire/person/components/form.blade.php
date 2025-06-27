<div class="w-full">
    <form wire:submit.prevent="save" x-ref="form">
        @csrf
        <!-- Foto -->
        <fieldset class="border border-gray-300 rounded p-6 mt-4 grid grid-cols-2" x-data="photoView()">
            <legend class="text-sm font-semibold text-gray-700 px-2">Foto</legend>
            <div>
                <div class="flex items-center gap-4">
                    <label for="photo"
                        class="cursor-pointer px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                        Selecionar Foto
                    </label>
                    <span
                        x-text="document.getElementById('photo')?.files[0]?.name || 'Nenhum arquivo selecionado'"></span>
                </div>
                <input wire:model.defer="photo" id="photo" name="photo" type="file" class="hidden"
                    accept="image/png, image/jpeg" @change="previewPhoto" />
                <x-input-error class="mt-2" :messages="$errors->get('photo')" />
            </div>
            <div id="foto" class="flex items-center">
                <template x-if="photoUrl">
                    <img wire:model.defer="photo" :src="photoUrl" alt="Prévia da foto"
                        class="h-24 w-24 rounded object-cover border" />
                </template>
            </div>
        </fieldset>

        <!-- Dados Pessoais -->
        <fieldset class="border border-gray-300 rounded p-6 col-span-2 mt-4 grid grid-cols-3 gap-4">
            <legend class="text-sm font-semibold text-gray-700 px-2">Dados Pessoais</legend>
            <div class="col-span-2">
                <x-input-label for="full_name" :value="__('Nome Completo')" />
                <x-text-input wire:model.defer="full_name" id="full_name" name="full_name" type="text"
                    class="mt-1 block w-full" autocomplete="full_name" placeholder="Nome Completo" />
                <x-input-error class="mt-2" :messages="$errors->get('full_name')" />
            </div>
            <div>
                <x-input-label for="social_name" :value="__('Nome Social')" />
                <x-text-input wire:model.defer="social_name" id="social_name" name="social_name" type="text"
                    class="mt-1 block w-full" autocomplete="social_name" placeholder="Nome Social" />
                <x-input-error class="mt-2" :messages="$errors->get('social_name')" />
            </div>
            <div>
                <x-input-label for="birth_date" :value="__('Data de Nascimento')" />
                <x-text-input id="birth_date" name="birth_date" type="date" class="mt-1 block w-full"
                    wire:model.defer="birth_date" autocomplete="birth_date" placeholder="Data de Nascimento" />
                <x-input-error class="mt-2" :messages="$errors->get('birth_date')" />
            </div>
            <div>
                <x-input-label for="gender" :value="__('Gênero')" />
                <select wire:model.defer="gender" id="gender" name="gender"
                    class="block py-2.5 px-0 w-full text-sm  bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer"
                    autocomplete="gender">
                    <option value="">Selecione o gênero</option>
                    <option value="Masculino">
                        Masculino
                    </option>
                    <option value="Feminino">
                        Feminino
                    </option>
                    <option value="Outro">Outro
                    </option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('gender')" />
            </div>
            <div>
                <x-input-label for="ethnicity" :value="__('Etnia')" />
                <select wire:model.defer="ethnicity" id="ethnicity" name="ethnicity"
                    class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer"
                    autocomplete="ethnicity">
                    <option value="">Selecione a etnia</option>
                    <option value="Branca">
                        Branca
                    </option>
                    <option value="Preta">
                        Preta
                    </option>
                    <option value="Parda">
                        Parda
                    </option>
                    <option value="Amarela">
                        Amarela</option>
                    <option value="Indígena">
                        Indígena</option>
                    <option value="Outro">
                        Outro
                    </option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('ethnicity')" />
            </div>

            <div>
                <x-input-label for="marital_status" :value="__('Estado Civil')" />
                <select wire:model.defer="marital_status" id="marital_status" name="marital_status"
                    class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer"
                    autocomplete="marital_status">
                    <option value="">Selecione o estado civil</option>
                    <option value="Solteiro(a)">
                        Solteiro(a)</option>
                    <option value="Casado(a)">
                        Casado(a)</option>
                    <option value="Divorciado(a)">
                        Divorciado(a)</option>
                    <option value="Viúvo(a)">Viúvo(a)
                    </option>
                    <option value="Separado(a)">
                        Separado(a)</option>
                    <option value="Outro">Outro
                    </option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('marital_status')" />
            </div>
        </fieldset>

        <!-- Documentação Pessoal -->
        <fieldset class="border border-gray-300 rounded p-6 col-span-2 mt-4 grid grid-cols-3 gap-4 ">
            <legend class="text-sm font-semibold text-gray-700 px-2">Documentação Pessoal</legend>
            <div>
                <x-input-label for="nis" :value="__('NIS')" />
                <x-text-input wire:model.defer="nis" id="nis" name="nis" type="text"
                    class="mt-1 block w-full" autocomplete="nis" placeholder="NIS" />
                <x-input-error class="mt-2" :messages="$errors->get('nis')" />
            </div>
            <div>
                <x-input-label for="cpf" :value="__('CPF')" />
                <x-text-input wire:model.defer="cpf" id="cpf" name="cpf" type="text"
                    class="mt-1 block w-full" x-ref="cpf" x-init="IMask($refs.cpf, { mask: '000.000.000-00' })" maxlength="14"
                    autocomplete="cpf" placeholder="CPF" />
                <x-input-error class="mt-2" :messages="$errors->get('cpf')" />
            </div>
            <div>
                <x-input-label for="rg" :value="__('RG')" />
                <x-text-input wire:model.defer="rg" x-ref="rg" id="rg" name="rg" maxlength="14"
                    x-init="IMask($refs.rg, { mask: '00.000.000-00' })" type="text" class="mt-1 block w-full" autocomplete="rg"
                    placeholder="RG" />
                <x-input-error class="mt-2" :messages="$errors->get('rg')" />
            </div>
        </fieldset>

        <!-- Naturalidade -->
        <fieldset class="border border-gray-300 rounded p-6 col-span-2 mt-4 grid grid-cols-3 gap-4 ">
            <legend class="text-sm font-semibold text-gray-700 px-2">Naturalidade</legend>
            <!-- País -->
            <div class="mb-3">
                <x-input-label for="country_id" :value="__('País')" />
                <select wire:model.defer="country_id" id="country_id" name="country_id"
                    class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                    <option value="">Selecione um estado</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Estado -->
            <div class="mb-3">
                <x-input-label for="state_id" :value="__('Estado')" />
                <select wire:model.defer="state_id" id="state_id" name="state_id"
                    class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                    <option value="">Selecione um estado</option>
                    @foreach ($states as $state)
                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Cidade -->
            <div class="mb-3">
                <x-input-label for="city_id" :value="__('Cidade')" />
                <select wire:model.defer="city_id" id="city_id" name="city_id"
                    class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                    <option value="">Selecione uma cidade</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>

        </fieldset>

        <div class="mt-6 flex justify-end">
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Salvar</button>
        </div>
    </form>

    <script>
        function photoView() {
            return {
                photoUrl: null,
                previewPhoto(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = e => this.photoUrl = e.target.result;
                        reader.readAsDataURL(file);
                    } else {
                        this.photoUrl = null;
                    }
                }
            }
        }
    </script>
</div>
