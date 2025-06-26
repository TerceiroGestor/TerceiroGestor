<div class="">

    <!-- Formulário à direita -->
    <div x-data="tabs()" class="p-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
        
        <div class="mb-6">
            <div class="border-b border-gray-200 dark:border-gray-700 dark:bg-gray-800">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400 ">

                    <template x-for="(tab, index) in tabs" :key="index">
                        <li class="me-2">
                            <button @click="step = index + 1"
                                class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg group dark:bg-gray-700"
                                :class="step === index + 1 ?
                                    'text-blue-600 border-blue-600 bg-indigo-50 dark:text-blue-500 dark:border-blue-500' :
                                    'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 bg-gray-50'">
                                <span x-html="tab.icon"
                                    class="text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300"></span>
                                <span x-text="tab.title" class="ml-1"></span>
                            </button>
                        </li>
                    </template>

                </ul>
            </div>
        </div>

        <div x-show="step === 1">

            <div class="p-5 mb-6 border border-gray-200 rounded-2xl dark:border-gray-800 lg:p-6 space-y-4">
                <div class="flex flex-col gap-5 xl:flex-row xl:items-center xl:justify-between">
                    {{-- Foto e Nome --}}
                    <div class="flex flex-col items-center w-full gap-6 xl:flex-row">
                        <div class="w-20 h-20 overflow-hidden border border-gray-200 rounded-full dark:border-gray-800">
                            <img src="{{ $person->photo ? asset('storage/' . $person->photo) : asset('storage/image/profile.png') }}"
                                alt="Foto de {{ $person->full_name }}" />
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-center text-gray-800 dark:text-white/90 xl:text-left">
                                {{ $person->full_name }}
                            </h4>
                            @if ($person->social_name)
                                <p class="text-sm italic text-gray-500 dark:text-gray-400 text-center xl:text-left">
                                    ({{ $person->social_name }})
                                </p>
                            @endif
                            <div
                                class="flex flex-col items-center gap-1 text-center xl:flex-row xl:gap-3 xl:text-left mt-2">
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $person->gender }}
                                </p>
                                <div class="hidden h-3.5 w-px bg-gray-300 dark:bg-gray-700 xl:block"></div>
                                <span class="text-sm text-indigo-500 dark:text-indigo-400">
                                    {{ \Carbon\Carbon::parse($person->birth_date)->age }} 
                                </span>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    anos  
                                </p>
                                @if ($person->ethnicity)
                                    <div class="hidden h-3.5 w-px bg-gray-300 dark:bg-gray-700 xl:block"></div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $person->ethnicity }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Botão Editar --}}
                    <button wire:click="edit('{{ $person->id }}')"
                        x-on:click="$dispatch('open-modal', { id: 'updatePerson' })"
                        class="flex w-full items-center justify-center gap-2 rounded-full border border-gray-300 bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200 lg:w-auto">
                        <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M15.0911 2.78206C14.2125 1.90338 12.7878 1.90338 11.9092 2.78206L4.57524 10.116C4.26682 10.4244 4.0547 10.8158 3.96468 11.2426L3.31231 14.3352C3.25997 14.5833 3.33653 14.841 3.51583 15.0203C3.69512 15.1996 3.95286 15.2761 4.20096 15.2238L7.29355 14.5714C7.72031 14.4814 8.11172 14.2693 8.42013 13.9609L15.7541 6.62695C16.6327 5.74827 16.6327 4.32365 15.7541 3.44497L15.0911 2.78206ZM12.9698 3.84272C13.2627 3.54982 13.7376 3.54982 14.0305 3.84272L14.6934 4.50563C14.9863 4.79852 14.9863 5.2734 14.6934 5.56629L14.044 6.21573L12.3204 4.49215L12.9698 3.84272ZM11.2597 5.55281L5.6359 11.1766C5.53309 11.2794 5.46238 11.4099 5.43238 11.5522L5.01758 13.5185L6.98394 13.1037C7.1262 13.0737 7.25666 13.003 7.35947 12.9002L12.9833 7.27639L11.2597 5.55281Z"
                                fill="" />
                        </svg>
                        Editar
                    </button>
                </div>

                {{-- Informações adicionais --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600 dark:text-gray-300">
                    <p><span class="font-semibold">CPF:</span> {{ $person->cpf ?? '—' }}</p>
                    <p><span class="font-semibold">RG:</span> {{ $person->rg ?? '—' }}</p>
                    <p><span class="font-semibold">NIS:</span> {{ $person->nis ?? '—' }}</p>
                    <p><span class="font-semibold">Estado civil:</span> {{ $person->marital_status ?? '—' }}</p>
                    <p><span class="font-semibold">País:</span> {{ $person->country_id ?? '—' }}</p>
                    <p><span class="font-semibold">Estado:</span> {{ $person->state_id ?? '—' }}</p>
                    <p><span class="font-semibold">Cidade:</span> {{ $person->city_id ?? '—' }}</p>
                </div>
            </div>

        </div>

        <div x-show="step === 2" class=''>

            <livewire:person.components.addresses :person="$person" :key="'person-addresses-' . $person->id" />

        </div>

        <!--  Contatos -->
        <div x-show="step === 3" class="">

            <livewire:person.components.contacts :person="$person" :key="'person-contacts-' . $person->id" />

        </div>

        <div x-show="step === 4">

        </div>

    </div>


    <div>
        <x-main-modal id="updatePerson" title="{{ $person->full_name }}" class="w-[60vw]">

            @livewire('person.person-form', ['personId' => $editPersonId], key('updatePerson'))

        </x-main-modal>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('tabs', () => ({
                step: 1,
                tabs: [{
                        title: 'Dados Pessoais',
                        icon: `<svg class="w-4 h-4 me-2 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z" /></svg>`
                    },
                    {
                        title: 'Endereço',
                        icon: `<svg class="w-4 h-4 me-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
</svg>
`
                    },
                    {
                        title: 'Contatos',
                        icon: `<svg class="w-4 h-4 me-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
</svg>
`
                    },
                    {
                        title: 'View',
                        icon: `<svg class="w-4 h-4 me-2 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20"><path d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2Z"/></svg>`
                    }
                ]



            }))
        });
    </script>

</div>
