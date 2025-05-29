<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <a href="{{ route('students.index') }}" class="text-blue-500 hover:text-blue-700 mr-4">{{ __('Back to List') }}</a>
                        <a href="{{ route('students.edit', $student) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Edit Student') }}
                        </a>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">{{ __('Name') }}</p>
                        <p class="text-lg font-semibold">{{ $student->name }}</p>
                    </div>

                    <div class="mt-4">
                        <p class="text-sm text-gray-500">{{ __('Admission Number') }}</p>
                        <p class="text-lg font-semibold">{{ $student->admission_number }}</p>
                    </div>

                    <div class="mt-4">
                        <p class="text-sm text-gray-500">{{ __('Date of Birth') }}</p>
                        <p class="text-lg font-semibold">{{ $student->date_of_birth ? \Carbon\Carbon::parse($student->date_of_birth)->format('M d, Y') : 'N/A' }}</p>
                    </div>
                    
                    <div class="mt-4">
                        <p class="text-sm text-gray-500">{{ __('Created At') }}</p>
                        <p class="text-lg font-semibold">{{ $student->created_at->format('M d, Y H:i:s') }}</p>
                    </div>

                    <div class="mt-4">
                        <p class="text-sm text-gray-500">{{ __('Updated At') }}</p>
                        <p class="text-lg font-semibold">{{ $student->updated_at->format('M d, Y H:i:s') }}</p>
                    </div>

                    <div class="mt-6">
                        <form action="{{ route('students.destroy', $student) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this student?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Delete Student') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
