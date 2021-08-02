<div>
    <ul>
        @foreach ($tasks as $task)
            <li class="py-2 px-4">
                <div class="flex items-start justify-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                    </svg>
                    <div class="flex-1 leading-6">
                        {{ $task->description }}
                    </div>
                </div>
                <div class="flex justify-end items-end gap-2 border-b pb-2">
                    <button class="inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-red-300 disabled:opacity-25 transition">Delete</button>
                    <button class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring focus:ring-green-300 disabled:opacity-25 transition">Mark As Completed</button>
                </div>
            </li>
        @endforeach
    </ul>
</div>
