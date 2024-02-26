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
        if (!request()->ajax()) {
            return view('tasks.index');
        }

        $tasks = Task::where('id', '<>', 0);
        return datatables()->of($tasks)
            ->addColumn('title', function ($task) {
                $task_url = route('tasks.show', $task->id);
                return "<a href='{$task_url}'>{$task->title}</a>";
            })
            ->editColumn('status', function ($task) {
                return ucfirst($task->status); // Capitalize the status
            })
            ->editColumn('due_date', function ($task) {
                return $task->due_date ? date('d M Y', strtotime($task->due_date)) : 'No Due Date';
            })
            ->editColumn('created_at', function ($task) {
                return date('d M Y h:i A', strtotime($task->created_at));
            })
            ->addColumn('action', function ($task) {
                return view("tasks.action", compact('task')); // Assuming you have an action view
            })
            ->rawColumns(['title', 'description', 'action', 'status', 'due_date', 'title'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $record = new Task();
        return view('tasks.manage', compact('record'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->validationRules());

        $task = new Task();

        $this->manage($request, $task);

        return back()->with(['success' => true, 'type' => 'success', 'title' => 'Congratulations!', 'message' => 'Changes Saved!']);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::findOrFail($id);

        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $record = Task::findOrFail($id);

        return view('tasks.manage', compact('record'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $blog = Task::findOrFail($id);

        $this->manage($request, $blog);

        return back()->with(['success' => true, 'type' => 'success', 'title' => 'Congratulations!', 'message' => 'Changes Saved!']);

    }

    public function manage(Request $request, Task $task)
    {
        $task->title = $request->title;
        $task->description = $request->description;
        if ($request->status == Task::COMPLETED) {
            $task->status = Task::COMPLETED;
        } else {
            $task->status = Task::PENDING;
        }
        $task->due_date = date('Y-m-d', strtotime($request->due_date));
        $task->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Task::findOrFail($id);

        $blog->delete();

        return redirect()->route('tasks.index')->with(['success' => true, 'type' => 'success', 'title' => 'Congratulations!', 'message' => 'Task deleted!']);

    }

    public function validationRules($overrideRule = [])
    {
        $rules = [
            'title' => 'required|max:255',
            'description' => 'nullable|max:1000',
            'status' => 'required|in:' . implode(",", array_keys(config('site.task_statuses'))),
            'due_date' => 'required|date|after_or_equal:today',
        ];

        return array_merge($rules, $overrideRule);
    }
}
