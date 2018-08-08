<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Session;
use Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::orderBy('id', 'desc')->get();

        return view ('tasks.index')->with('savedTasks', $tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'newTaskName' => 'required|min:10|max:199',
            'taskDescription' => 'required',
            'taskDate' => 'required'
            ]);

        $task = new Task;

        $task->name = $request->newTaskName;
        $task->description = $request->taskDescription;
        $task->date = $request->taskDate;
        $task->user_id = Auth::id();
        $task->done = 0;

        $task->save();

        Session::flash('success', 'Jouw nieuwe taak is succesvol toegevoegd!');

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);

        return view('tasks.edit')->with('taskBeingEdited', $task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'taskNameUpdate' => 'required|min:10|max:199',
            'taskDescriptionUpdate' => 'required',
            'taskDateUpdate' => 'required',
            ]);
        
        $task = Task::find($id);

        $task->name = $request->taskNameUpdate;
        $task->description = $request->taskDescriptionUpdate;
        $task->date = $request->taskDateUpdate;

        $task->save();
        
        Session::flash('success', 'Jouw taak is succesvol aangepast!');

        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);

        $task->delete();

        Session::flash('success', 'Jouw taak is succesvol verwijdert!');

        return redirect()->route('tasks.index');
    }
}
