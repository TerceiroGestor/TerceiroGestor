<div class="w-full" x-data="tabs()">

    <div class="mb-6">
        @include('person.components.tabs')
    </div>

    <div x-show="step === 1">
        <livewire:person.person-form :key="'create-person'" />
    </div>

    <div x-show="step === 2" class=''>

    </div>

    <div x-show="step === 3" class="">

    </div>

</div>
