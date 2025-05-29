<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Record New Mark') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('marks.store') }}">
                        @csrf

                        <!-- School Class -->
                        <div class="mt-4">
                            <x-input-label for="school_class_id" :value="__('School Class')" />
                            <select id="school_class_id" name="school_class_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">{{ __('Select Class') }}</option>
                                @foreach ($schoolClasses as $class)
                                    <option value="{{ $class->id }}" {{ old('school_class_id') == $class->id ? 'selected' : '' }}>
                                        {{ $class->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('school_class_id')" class="mt-2" />
                        </div>

                        <!-- Student -->
                        <div class="mt-4">
                            <x-input-label for="student_id" :value="__('Student')" />
                            <select id="student_id" name="student_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">{{ __('Select Class First') }}</option>
                                {{-- Options will be populated by JS --}}
                            </select>
                            <x-input-error :messages="$errors->get('student_id')" class="mt-2" />
                        </div>

                        <!-- Subject -->
                        <div class="mt-4">
                            <x-input-label for="subject_id" :value="__('Subject')" />
                            <select id="subject_id" name="subject_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">{{ __('Select Subject') }}</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                        {{ $subject->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('subject_id')" class="mt-2" />
                        </div>

                        <!-- Marks Obtained -->
                        <div class="mt-4">
                            <x-input-label for="marks_obtained" :value="__('Marks Obtained')" />
                            <x-text-input id="marks_obtained" class="block mt-1 w-full" type="number" name="marks_obtained" :value="old('marks_obtained')" required step="0.01" />
                            <x-input-error :messages="$errors->get('marks_obtained')" class="mt-2" />
                        </div>

                        <!-- Total Marks -->
                        <div class="mt-4">
                            <x-input-label for="total_marks" :value="__('Total Marks (Optional)')" />
                            <x-text-input id="total_marks" class="block mt-1 w-full" type="number" name="total_marks" :value="old('total_marks')" step="0.01" />
                            <x-input-error :messages="$errors->get('total_marks')" class="mt-2" />
                        </div>

                        <!-- Assessment Type -->
                        <div class="mt-4">
                            <x-input-label for="assessment_type" :value="__('Assessment Type')" />
                            <x-text-input id="assessment_type" class="block mt-1 w-full" type="text" name="assessment_type" :value="old('assessment_type')" required />
                            <x-input-error :messages="$errors->get('assessment_type')" class="mt-2" />
                        </div>

                        <!-- Date of Assessment -->
                        <div class="mt-4">
                            <x-input-label for="date_of_assessment" :value="__('Date of Assessment')" />
                            <x-text-input id="date_of_assessment" class="block mt-1 w-full" type="date" name="date_of_assessment" :value="old('date_of_assessment')" required />
                            <x-input-error :messages="$errors->get('date_of_assessment')" class="mt-2" />
                        </div>

                        <!-- Comments -->
                        <div class="mt-4">
                            <x-input-label for="comments" :value="__('Comments (Optional)')" />
                            <textarea id="comments" name="comments" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('comments') }}</textarea>
                            <x-input-error :messages="$errors->get('comments')" class="mt-2" />
                        </div>


                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('marks.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">
                                {{ __('Cancel') }}
                            </a>
                            <x-primary-button>
                                {{ __('Record Mark') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const classDropdown = document.getElementById('school_class_id');
    const studentDropdown = document.getElementById('student_id');
    const oldStudentId = "{{ old('student_id') }}"; // For repopulating on validation error

    function fetchStudents(classId, selectedStudentId = null) {
        if (!classId) {
            studentDropdown.innerHTML = '<option value="">Select Class First</option>';
            return;
        }

        studentDropdown.innerHTML = '<option value="">Loading...</option>';
        // In a real Blade file, it's better to use the route() helper for URL generation:
        // const url = "{{ route('school-classes.students.json', ['schoolClass' => ':classId']) }}".replace(':classId', classId);
        // For this environment, direct path construction:
        const url = `/school-classes/${classId}/students-json`;

        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                studentDropdown.innerHTML = '<option value="">Select Student</option>';
                data.forEach(student => {
                    const option = document.createElement('option');
                    option.value = student.id;
                    option.textContent = `${student.name} (${student.admission_number})`;
                    if (selectedStudentId && student.id == selectedStudentId) {
                        option.selected = true;
                    }
                    studentDropdown.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error fetching students:', error);
                studentDropdown.innerHTML = '<option value="">Could not load students</option>';
            });
    }

    if (classDropdown) {
        classDropdown.addEventListener('change', function () {
            fetchStudents(this.value);
        });

        // If there's an old selected class (e.g., due to validation error),
        // fetch its students and try to re-select the old student.
        if (classDropdown.value) {
            fetchStudents(classDropdown.value, oldStudentId);
        }
    }
});
</script>
</x-app-layout>
