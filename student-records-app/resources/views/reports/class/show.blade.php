<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Class Performance Report') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('reports.class.form') }}" class="text-blue-500 hover:text-blue-700 mr-4">{{ __('Back to Report Form') }}</a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-1">{{ __('School Class') }}: {{ $schoolClass->name }}</h3>
                    <p class="text-md text-gray-700 mb-4">{{ __('Subject') }}: {{ $subject->name }}</p>

                    <div class="mt-6">
                        <h4 class="text-md font-semibold">{{ __('Performance Summary') }}</h4>
                        @if (isset($averageMark))
                            <p class="text-lg">{{ __('Average Mark') }}: {{ number_format($averageMark, 2) }}</p>
                        @else
                            <p>{{ __('No marks recorded for this class and subject combination yet, or average could not be calculated.') }}</p>
                        @endif
                    </div>
                    
                    {{-- Future enhancements could include:
                        - List of students with their marks for this subject in this class
                        - Distribution of grades
                    --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
