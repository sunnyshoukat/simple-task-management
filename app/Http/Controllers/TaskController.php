<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{

    private $_task;

    public function __construct(Task $task)
    {
        $this->_task = $task;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //fetch all task
        $tasks = $this->_task->orderBy('task_priority')->get();
        return view('tasks/index')->with('tasks',$tasks);
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
        $this->validate(request(),[
            'task_name' => 'required'
        ]);

        $data = request()->all();

        $task_count = count($this->_task->all());

        $this->_task->task_name = $data['task_name'];
        $this->_task->task_priority = $task_count + 1;

        $this->_task->save();

        session()->flash('message','Task Created Successfully!');

        return redirect('/tasks');
    }

    /**
     * Reorder the tasks.
     *
     * @param  int  $request
     */
    public function reOrder(Request $request)
    {
        $reorder_task = $request->all();
        $task = $this->_task->all();
        $priority = 1;
        foreach($reorder_task['task'] as $id)
        {
            $task->find($id)->update(['task_priority' => $priority]);
            $priority++;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tasks = $this->_task->orderBy('task_priority')->get();
        $task = $tasks->find($id);
        return view('tasks/index', compact('task','tasks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(request(),[
            'task_name' => 'required',
        ]);

        $data = request()->all();

        $task = $this->_task->find($id);

        $task->task_name = $data['task_name'];

        $task->save();

        session()->flash('message','Task Updated Successfully!');

        return redirect('/tasks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = $this->_task->find($id);

        $task->delete();

        session()->flash('message','Task Deleted Successfully!');

        return redirect('/tasks');
    }
}
