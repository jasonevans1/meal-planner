<div>
    <form wire:submit="submit">
        <div class="mb-4">
            <x-input-label for="title" value="Title" />
            <x-text-input wire:model="title" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-input-label for="description" value="Description" />
            <x-text-input wire:model="description" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button type="submit" class="ml-3">
                {{ __('Create List') }}
            </x-primary-button>
        </div>
    </form>
</div>
