<div>
    <form class="flex flex-col relative" wire:submit.prevent="submit">
        <x-jet-input wire:model.defer="description" id="text" class="mt-1 flex-1" type="text" name="text" :value="old('email')" placeholder="Enter task and hit enter" autofocus required/>
        <x-jet-button class="hidden">
            {{ __('Add Task') }}
        </x-jet-button>
        <x-jet-input-error for="description" class="mt-2" />
    </form>
</div>
