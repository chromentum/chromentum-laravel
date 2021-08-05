<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="flex px-4 py-2 gap-3">
                    <div class="flex-1">
                        @livewire('tasks.add-task')
                    </div>
                    <div class="w-1/4" style="height: inherit;">
                        @livewire('tasks.task-filter')
                    </div>
                </div>
                <div class="mt-4">
                    @livewire('tasks.tasks-list')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
