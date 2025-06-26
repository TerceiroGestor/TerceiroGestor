<div class="space-y-6">
    
    <div>
        <x-input-label for="state_id" :value="__('State Id')"/>
        <x-text-input id="state_id" name="state_id" type="text" class="mt-1 block w-full" :value="old('state_id', $city?->state_id)" autocomplete="state_id" placeholder="State Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('state_id')"/>
    </div>
    <div>
        <x-input-label for="name" :value="__('Name')"/>
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $city?->name)" autocomplete="name" placeholder="Name"/>
        <x-input-error class="mt-2" :messages="$errors->get('name')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>