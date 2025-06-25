
<!--
    Criar tudo dentro da <div> para ser processado pelo Livewire
-->

<div class="py-6 inline-block min-w-full align-middle sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-700">

    <div class="flex justify-end">
        <button x-on:click="$dispatch('open-modal', { id: 'createPerson' })"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Novo
        </button>
    </div>

    <table id="myTable" class="w-full dark:bg-gray-700">
        <thead>
            <tr>
                <th>
                    <span class="flex items-center">
                        Foto
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Nome
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Email
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Telefone

                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Nascimento
                    </span>
                </th>

                <th>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($people as $person)
                <tr class="hover:bg-gray-100 dark:hover:bg-gray-800 dark:bg-gray-700">
                    <td class="font-medium text-black-900 whitespace-nowrap dark:text-white">
                        <img class="rounded-full w-8 h-8"
                            src="{{ $person->photo ? asset('storage/' . $person->photo) : asset('images/default-user.png') }}"
                            alt="Foto">
                    </td>
                    <td class="font-medium text-black-900 whitespace-nowrap dark:text-white">
                        {{ $person->social_name }}</td>
                    <td>
                        {{ $person->email }}</td>
                    <td>
                        {{ $person->phone }}</td>
                    <td>
                        {{ $person->birth_date }}</td>

                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900">
                        <div class="inline-flex rounded-md shadow-xs" role="group">
                            <button type="button"
                                class="cursor-pointer focus:outline-none text-white bg-green-400 hover:bg-green-500 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-900"
                                onclick="window.location.href='{{ route('person.show', $person->id) }}'">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z" />
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <x-main-modal id="createPerson" title="Novo Cadastro" class="w-[60vw]">

       @livewire('person.person-form', key('createPerson'))

    </x-main-modal>

</div>
