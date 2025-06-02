<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use App\Models\Student;
use App\Models\Subject;
use App\Models\SchoolClass;
use App\Http\Requests\StoreMarkRequest;
use Illuminate\Support\Facades\Redirect; // Required for Redirect::route()
use Illuminate\Support\Facades\Auth; // Added
use Illuminate\Support\Collection; // Added for collect()

class MarkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Mark::class); // Added policy check

        $user = Auth::user();
        $userClassIds = $user->schoolClasses()->pluck('id')->all();

        $marks = Mark::with(['student', 'subject', 'schoolClass', 'user'])
                    ->where(function ($query) use ($user, $userClassIds) {
                        $query->where('user_id', $user->id) // Marks entered by the current teacher
                              ->orWhereIn('school_class_id', $userClassIds); // Marks for students in teacher's classes
                    })
                    ->latest()
                    ->paginate(15);

        return view('marks.index', compact('marks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $schoolClasses = $user->schoolClasses()->orderBy('name')->get(); // Assuming schoolClasses relationship is defined on User model
        
        // Students list should initially be empty or show students from the first available class,
        // or be populated dynamically. For now, let's make it empty and rely on dynamic loading.
        $students = collect(); // Empty collection initially
        
        $subjects = Subject::orderBy('name')->get();
        return view('marks.create', compact('schoolClasses', 'students', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMarkRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id(); // Assign the currently authenticated user's ID
        Mark::create($data);
        return Redirect::route('marks.index')->with('success', 'Mark recorded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mark $mark)
    {
        // Not included in this subtask's scope
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mark $mark)
    {
        // Not included in this subtask's scope
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreMarkRequest $request, Mark $mark) // Should be UpdateMarkRequest if exists
    {
        // Not included in this subtask's scope
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mark $mark)
    {
        // Not included in this subtask's scope
        abort(404);
    }
}
