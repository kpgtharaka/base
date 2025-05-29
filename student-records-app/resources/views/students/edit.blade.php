<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Student') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('students.update', $student) }}">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $student->name)" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Admission Number -->
                        <div class="mt-4">
                            <x-input-label for="admission_number" :value="__('Admission Number')" />
                            <x-text-input id="admission_number" class="block mt-1 w-full" type="text" name="admission_number" :value="old('admission_number', $student->admission_number)" required />
                            <x-input-error :messages="$errors->get('admission_number')" class="mt-2" />
                        </div>

                        <!-- Date of Birth -->
                        <div class="mt-4">
                            <x-input-label for="date_of_birth" :value="__('Date of Birth')" />
                            <x-text-input id="date_of_birth" class="block mt-1 w-full" type="date" name="date_of_birth" :value="old('date_of_birth', $student->date_of_birth)" />
                            <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
                        </div>

                        <!-- Assign School Classes -->
                        <div class="mt-4">
                            <x-input-label for="school_classes" :value="__('Assign to Classes')" />
                            <select name="school_classes[]" id="school_classes" multiple class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 h-32">
                                @foreach($schoolClasses as $class)
                                    <option value="{{ $class->id }}"
                                        @if( (is_array(old('school_classes')) && in_array($class->id, old('school_classes'))) || (isset($studentClassIds) && in_array($class->id, $studentClassIds) && !is_array(old('school_classes'))) )
                                            selected
                                        @endif
                                    >
                                        {{ $class->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('school_classes')" class="mt-2" />
                            <x-input-error :messages="$errors->get('school_classes.*')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('students.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">
                                {{ __('Cancel') }}
                            </a>
                            <x-primary-button>
                                {{ __('Update Student') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
