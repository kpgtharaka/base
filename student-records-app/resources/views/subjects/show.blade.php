<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Subject Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <a href="{{ route('subjects.index') }}" class="text-blue-500 hover:text-blue-700 mr-4">{{ __('Back to List') }}</a>
                        <a href="{{ route('subjects.edit', $subject) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Edit Subject') }}
                        </a>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">{{ __('Name') }}</p>
                        <p class="text-lg font-semibold">{{ $subject->name }}</p>
                    </div>

                    <div class="mt-4">
                        <p class="text-sm text-gray-500">{{ __('Subject Code') }}</p>
                        <p class="text-lg font-semibold">{{ $subject->subject_code ?? 'N/A' }}</p>
                    </div>
                    
                    <div class="mt-4">
                        <p class="text-sm text-gray-500">{{ __('Created At') }}</p>
                        <p class="text-lg font-semibold">{{ $subject->created_at->format('M d, Y H:i:s') }}</p>
                    </div>

                    <div class="mt-4">
                        <p class="text-sm text-gray-500">{{ __('Updated At') }}</p>
                        <p class="text-lg font-semibold">{{ $subject->updated_at->format('M d, Y H:i:s') }}</p>
                    </div>

                     <div class="mt-6">
                        <form action="{{ route('subjects.destroy', $subject) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this subject?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Delete Subject') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
