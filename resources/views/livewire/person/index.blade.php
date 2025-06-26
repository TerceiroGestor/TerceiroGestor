<div class="py-6 inline-block min-w-full align-middle sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-700">

    <div class="flex justify-end">
        <button x-on:click="$dispatch('open-modal', { id: 'createPerson' })"
            class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
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
                            src="{{ $person->photo ? asset('storage/' . $person->photo) : asset('storage/image/profile.png') }}"
                            alt="Foto">
                    </td>
                    <td class="font-medium text-black-900 whitespace-nowrap dark:text-white">
                        {{ $person->social_name }}</td>
                    <td>
                        {{ $person->birth_date }}</td>

                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900">
                        <div>
                            <button type="button"
                                class="cursor-pointer shadow-xs focus:outline-none text-white bg-indigo-500 hover:bg-indigo-600 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-900"
                                onclick="window.location.href='{{ route('person.show', $person->id) }}'">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <x-main-modal id="createPerson" title="Novo Cadastro" class="w-[80vw]">

        @livewire('person.complete-form', key('createPerson'))

    </x-main-modal>

</div>
