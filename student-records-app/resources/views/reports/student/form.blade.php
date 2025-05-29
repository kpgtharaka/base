<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Performance Report') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form id="studentReportForm" method="GET" action="#"> <!-- Action will be set by JS -->
                        @csrf <!-- CSRF not strictly needed for GET, but good practice if form method changes -->
                        
                        <!-- Student Selection -->
                        <div class="mt-4">
                            <x-input-label for="student_id" :value="__('Select Student')" />
                            <select id="student_id" name="student_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">{{ __('Select a Student') }}</option>
                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->name }} ({{ $student->admission_number }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button type="submit">
                                {{ __('View Report') }}
                            </x-primary-button>
                        </div>
                    </form>

                    <script>
                        document.getElementById('studentReportForm').addEventListener('submit', function(event) {
                            event.preventDefault(); // Prevent default GET submission
                            var studentId = document.getElementById('student_id').value;
                            if (studentId) {
                                // Construct the URL using Laravel's route helper if possible, or fallback to string concatenation
                                // For this environment, we'll use string concatenation.
                                // In a real Blade file, you might use: {{ route('reports.student.show', ['student' => 'STUDENT_ID_PLACEHOLDER']) }}
                                // and then replace STUDENT_ID_PLACEHOLDER.
                                var reportUrl = '/reports/student-performance/' + studentId;
                                window.location.href = reportUrl; // Redirect to the report page
                            } else {
                                alert('Please select a student.');
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
