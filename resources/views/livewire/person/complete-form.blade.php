<div class="w-full" x-data="tabs()">

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
        <livewire:person.components.form :key="'create-person'" />
    </div>

    <div x-show="step === 2" class=''>
        @if ($person)
            <livewire:person.components.addresses :person="$person" :key="'person-address-' . $person->id" />
        @endif
    </div>

    <div x-show="step === 3" class="">

        @if ($person)
            <livewire:person.components.contacts :person="$person" :key="'person-contacts-' . $person->id" />
        @endif
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
                        title: 'Composição Familiar',
                        icon: `<svg class="w-4 h-4 me-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
</svg>
`
                    },
                    {
                        title: 'Saúde',
                        icon: `<svg <svg class="w-4 h-4 me-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
</svg>

`
                    }
                ]



            }))
        });
    </script>

</div>
