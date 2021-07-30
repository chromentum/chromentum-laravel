<div>
    <div>
        <form class="flex relative">
            <x-jet-input id="text" class="mt-1 flex-1" type="text" name="text" :value="old('email')" placeholder="Enter task and hit enter" required autofocus />
            <x-jet-button class="hidden">
                {{ __('Add Task') }}
            </x-jet-button>
        </form>
    </div>
</div>
