<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit School Class') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('school-classes.update', $schoolClass) }}">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Class Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $schoolClass->name)" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Grade Level -->
                        <div class="mt-4">
                            <x-input-label for="grade_level" :value="__('Grade Level')" />
                            <x-text-input id="grade_level" class="block mt-1 w-full" type="text" name="grade_level" :value="old('grade_level', $schoolClass->grade_level)" required />
                            <x-input-error :messages="$errors->get('grade_level')" class="mt-2" />
                        </div>

                        <!-- Section -->
                        <div class="mt-4">
                            <x-input-label for="section" :value="__('Section (Optional)')" />
                            <x-text-input id="section" class="block mt-1 w-full" type="text" name="section" :value="old('section', $schoolClass->section)" />
                            <x-input-error :messages="$errors->get('section')" class="mt-2" />
                        </div>

                        <!-- Assign Teachers -->
                        <div class="mt-4">
                            <x-input-label for="teachers" :value="__('Assign Teachers')" />
                            <select name="teachers[]" id="teachers" multiple class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 h-32">
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}" {{ in_array($teacher->id, $classTeacherIds ?? []) ? 'selected' : '' }}>
                                        {{ $teacher->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('teachers')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('school-classes.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">
                                {{ __('Cancel') }}
                            </a>
                            <x-primary-button>
                                {{ __('Update Class') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
