<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //
    public function index()
{
    $tasks = Task::orderBy('priority')->get();
    return view('tasks.index', compact('tasks'));
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'priority' => 'required|integer|min:1|max:3'
    ]);

    Task::create($request->all());

    return redirect()->back()->with('success', 'Task berhasil ditambahkan');
}

}