<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 public function index()
{
    $tasks = Task::all();
    return view('tasks.index', compact('tasks'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');

    }

    /**
     * Store a newly created resource in storage.
     */


public function store(Request $request)
{
    Task::create([
        'title' => $request->title,
        'description' => $request->description,
        'due_date' => $request->due_date,
        'category' => $request->category,
'completed' => $request->boolean('completed'),
        'due_time' => $request->due_time,
        'priority' => $request->priority ?? 'medium',
    ]);

    return redirect()->route('tasks.index');
}

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
public function edit(Task $task)
{
    return view('tasks.edit', compact('task'));
}

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, Task $task)
{
    // إذا كان الطلب يحتوي على عنوان (قادم من صفحة التعديل الكاملة)
    if ($request->has('title')) {
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'due_time' => $request->due_time,
            'completed' => $request->boolean('completed'),
            'priority' => $request->priority,
            'category' => $request->category,
        ]);
    } 
    else {
        $task->update([
            'completed' => $request->boolean('completed'),
        ]);
    }

    return redirect()->route('tasks.index');
}
    /**
     * Remove the specified resource from storage.
     */
public function destroy(Task $task)
{
    $task->delete();
    return redirect()->back();
}
}
