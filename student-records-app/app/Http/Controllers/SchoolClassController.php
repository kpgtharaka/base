<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\User; // Added
use App\Http\Requests\StoreSchoolClassRequest;
use App\Http\Requests\UpdateSchoolClassRequest;
use Illuminate\Http\JsonResponse; // Added

class SchoolClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', SchoolClass::class);
        $schoolClasses = SchoolClass::paginate(10);
        return view('school-classes.index', compact('schoolClasses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', SchoolClass::class);
        return view('school-classes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSchoolClassRequest $request)
    {
        SchoolClass::create($request->validated());
        return redirect()->route('school-classes.index')->with('success', 'School class created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SchoolClass $schoolClass)
    {
        $this->authorize('view', $schoolClass);
        return view('school-classes.show', compact('schoolClass'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SchoolClass $schoolClass)
    {
        $this->authorize('update', $schoolClass);
        $teachers = User::orderBy('name')->get();
        $classTeacherIds = $schoolClass->teachers()->pluck('users.id')->all();
        return view('school-classes.edit', compact('schoolClass', 'teachers', 'classTeacherIds'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSchoolClassRequest $request, SchoolClass $schoolClass)
    {
        $this->authorize('update', $schoolClass);
        $validatedData = $request->validated();
        $schoolClass->update($validatedData);
        $schoolClass->teachers()->sync($request->input('teachers', []));
        return redirect()->route('school-classes.index')->with('success', 'School class updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SchoolClass $schoolClass)
    {
        $this->authorize('delete', $schoolClass);
        $schoolClass->delete();
        return redirect()->route('school-classes.index')->with('success', 'School class deleted successfully.');
    }

    public function getStudentsJson(SchoolClass $schoolClass): JsonResponse
    {
        // Optional: Authorize if the current teacher can access this class's students
        // For simplicity, assuming if they can see the class in the dropdown, they can see its students.
        // A more robust check: $this->authorize('viewStudents', $schoolClass); (custom policy method)

        $students = $schoolClass->students()->orderBy('name')->get(['id', 'name', 'admission_number']); // Assuming 'students' relationship on SchoolClass model
        return response()->json($students);
    }
}
