<div class="space-y-6">
    
    <div>
        <x-input-label for="name" :value="__('Name')"/>
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $state?->name)" autocomplete="name" placeholder="Name"/>
        <x-input-error class="mt-2" :messages="$errors->get('name')"/>
    </div>
    <div>
        <x-input-label for="uf" :value="__('Uf')"/>
        <x-text-input id="uf" name="uf" type="text" class="mt-1 block w-full" :value="old('uf', $state?->uf)" autocomplete="uf" placeholder="Uf"/>
        <x-input-error class="mt-2" :messages="$errors->get('uf')"/>
    </div>
    <div>
        <x-input-label for="country_id" :value="__('Country Id')"/>
        <x-text-input id="country_id" name="country_id" type="text" class="mt-1 block w-full" :value="old('country_id', $state?->country_id)" autocomplete="country_id" placeholder="Country Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('country_id')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>