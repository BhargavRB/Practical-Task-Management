<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Task Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium">{{ $task->title }}</h3>
                        <p class="text-sm text-gray-500 mt-1">Created on {{ $task->created_at->format('M d, Y') }}</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="font-medium text-gray-900 mb-2">Details</h4>
                            <div class="space-y-2">
                                <p><span class="font-medium">Description:</span> {{ $task->description ?? 'No description' }}</p>
                                <p><span class="font-medium">Category:</span> {{ $task->category?->name ?? 'Uncategorized' }}</p>
                                <p><span class="font-medium">Due Date:</span> {{ $task->due_date?->format('M d, Y H:i') ?? 'No due date' }}</p>
                            </div>
                        </div>

                        <div>
                            <h4 class="font-medium text-gray-900 mb-2">Status</h4>
                            <div class="space-y-2">
                                <p>
                                    <span class="font-medium">Status:</span> 
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $task->status === 'completed' ? 'bg-green-100 text-green-800' : 
                                           ($task->status === 'in-progress' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800') }}">
                                        {{ ucfirst($task->status) }}
                                    </span>
                                </p>
                                <p>
                                    <span class="font-medium">Priority:</span> 
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $task->priority === 'high' ? 'bg-red-100 text-red-800' : 
                                           ($task->priority === 'medium' ? 'bg-orange-100 text-orange-800' : 'bg-gray-100 text-gray-800') }}">
                                        {{ ucfirst($task->priority) }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('tasks.edit', $task) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150 mr-2">
                            Edit
                        </a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-800 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150" onclick="return confirm('Are you sure?')">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>