<div class="space-y-6">
    
    <div>
        <x-input-label for="name" :value="__('Name')"/>
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $country?->name)" autocomplete="name" placeholder="Name"/>
        <x-input-error class="mt-2" :messages="$errors->get('name')"/>
    </div>
    <div>
        <x-input-label for="region" :value="__('Region')"/>
        <x-text-input id="region" name="region" type="text" class="mt-1 block w-full" :value="old('region', $country?->region)" autocomplete="region" placeholder="Region"/>
        <x-input-error class="mt-2" :messages="$errors->get('region')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>