<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Mark;
use App\Models\SchoolClass;
use App\Models\Subject;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function studentPerformanceForm()
    {
        $students = Student::orderBy('name')->get();
        return view('reports.student.form', compact('students'));
    }

    public function showStudentPerformance(Student $student)
    {
        $this->authorize('view', $student); // Added policy check
        $marks = Mark::where('student_id', $student->id)
                     ->with(['subject', 'schoolClass', 'user'])
                     ->orderBy('date_of_assessment', 'desc')
                     ->get();
        return view('reports.student.show', compact('student', 'marks'));
    }

    public function classPerformanceForm()
    {
        $schoolClasses = SchoolClass::orderBy('name')->get();
        $subjects = Subject::orderBy('name')->get();
        return view('reports.class.form', compact('schoolClasses', 'subjects'));
    }

    public function showClassPerformance(Request $request)
    {
        $request->validate([
            'school_class_id' => 'required|exists:school_classes,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        $schoolClassId = $request->input('school_class_id');
        $subjectId = $request->input('subject_id');

        $schoolClass = SchoolClass::findOrFail($schoolClassId);
        $this->authorize('view', $schoolClass); // Added policy check

        $subject = Subject::findOrFail($subjectId);

        $averageMark = Mark::where('school_class_id', $schoolClassId)
                           ->where('subject_id', $subjectId)
                           ->avg('marks_obtained');

        return view('reports.class.show', compact('schoolClass', 'subject', 'averageMark'));
    }
}
