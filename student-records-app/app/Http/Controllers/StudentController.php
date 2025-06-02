<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\SchoolClass; // Added
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Student::class);
        $students = Student::paginate(10); // Or Student::all();
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Student::class);
        $schoolClasses = SchoolClass::orderBy('name')->get();
        return view('students.create', compact('schoolClasses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        $this->authorize('create', Student::class);
        $student = Student::create($request->validated());
        $student->schoolClasses()->sync($request->input('school_classes', []));
        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $this->authorize('view', $student);
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $this->authorize('update', $student);
        $schoolClasses = SchoolClass::orderBy('name')->get();
        $studentClassIds = $student->schoolClasses()->pluck('school_classes.id')->all();
        return view('students.edit', compact('student', 'schoolClasses', 'studentClassIds'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $this->authorize('update', $student);
        $student->update($request->validated());
        $student->schoolClasses()->sync($request->input('school_classes', []));
        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $this->authorize('delete', $student);
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
