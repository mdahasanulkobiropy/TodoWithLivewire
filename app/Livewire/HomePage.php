<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;
use App\Models\TaskGroup;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('layout.app')]
class HomePage extends Component
{


    public $task_gp_name;
    public $showInputButton = true;
    public $showSubmitButton = false;

    public $selectedTaskGroup = null;
    public $task_title;
    public $up_task_gp_id;
    public $up_task_title;
    public $up_is_task_urgent;
    public $task_des;
    public $is_task_urgent;
    public $task_gp_id;
    public $is_complete;
    public $task_id;
    public $up_id;
    public $taskSearch;
    public $taskEditingId;

    public function render()
    {
        if(Auth::user()){
            $data['done_works'] = Task::where('created_by', Auth::user()->id)->where('is_complete', 'yes')->get();
            $data['panding_works'] = Task::where('created_by', Auth::user()->id)->where('is_complete', 'no')->get();
            $data['urgent_task'] = TaskGroup::first();
            $data['taskGroups'] = TaskGroup::where('created_by', Auth::user()->id)->get();

            if ($this->selectedTaskGroup == 1) {
                $data['tasks'] = Task::where('created_by', Auth::user()->id)
                    ->where('is_task_urgent', 'yes')
                    ->where('task_title', 'like', "%{$this->taskSearch}%")
                    ->get();
            } elseif ($this->selectedTaskGroup !== null) {
                $data['tasks'] = Task::where('created_by', Auth::user()->id)
                    ->where('task_gp_id', $this->selectedTaskGroup)
                    ->where('task_title', 'like', "%{$this->taskSearch}%")
                    ->get();
            } else {
                $data['tasks'] = Task::where('created_by', Auth::user()->id)
                    ->where('task_title', 'like', "%{$this->taskSearch}%")
                    ->get();
            }

            $this->reset('selectedTaskGroup');
        }
        else{
            $data['task_gps'] = '';
            $data['tasks'] = '';
            $data['done_works'] = '';
            $data['panding_works'] = '';
        }
        return view('livewire.home-page', $data);
    }

    public function showTasksUnderGroup($taskGroupId)
    {
        $this->selectedTaskGroup = $taskGroupId;
    }
    public function showInput()
    {
        $this->showInputButton = false;
        $this->showSubmitButton = true;
    }
    public function taskGroupCreate()
    {
        $this->validate([
            'task_gp_name' => 'required|string',
        ]);
        $task_gp = TaskGroup::create([
            'task_gp_name' => $this->task_gp_name,
            'created_by' => Auth::user()->id,
        ]);
        session()->flash('message', 'Task group create in successfully!');
        $this->reset('task_gp_name', 'showInputButton', 'showSubmitButton');
    }


    public function taskCreate()
    {

        // dd($this->task_gp_id);
        $this->validate([
            'task_title' => 'required|string',
            'task_gp_id' => 'required|integer',
        ]);


        if ($this->is_task_urgent) {
            $task = Task::create([
                'task_title' => $this->task_title,
                'task_gp_id' => $this->task_gp_id,
                'is_task_urgent' => 'yes',
                'created_by' => Auth::user()->id,
            ]);
        } else {
            $task = Task::create([
                'task_title' => $this->task_title,
                'task_gp_id' => $this->task_gp_id,
                'is_task_urgent' => 'no',
                'created_by' => Auth::user()->id,
            ]);
        }
        session()->flash('message', 'Task create in successfully!');
        $this->reset('task_title', 'task_gp_id', 'is_task_urgent');
    }

    public function deleteTaskCreate($task)
    {
        $task = Task::find($task);
        if (!$task) {
            session()->flash('error', 'Task not found!');
        } else {
            $task->delete();
            session()->flash('message', 'Task delete successfully!');
        }
    }
    public function editTaskCreate($taskId)
    {
        $this->taskEditingId = $taskId;
        $task = Task::find($taskId);

        if ($task) {
            $this->task_title = $task->task_title;
            $this->task_gp_id = $task->task_gp_id;
            $this->is_task_urgent = $task->is_task_urgent;
        }
    }

    public function taskUpdate($taskId)
    {
        // dd($taskId);

        $this->validate([
            'task_title' => 'required|string',
            'task_gp_id' => 'required|integer',
        ]);
        $task = Task::findOrFail($taskId);
        if($task){
            if ($this->is_task_urgent) {
                $task->update([
                    'task_title' => $this->task_title,
                    'task_gp_id' => $this->task_gp_id,
                    'is_task_urgent' => 'yes',
                    'created_by' => Auth::user()->id,
                ]);
            } else {
                $task->update([
                    'task_title' => $this->task_title,
                    'task_gp_id' => $this->task_gp_id,
                    'is_task_urgent' => 'no',
                    'created_by' => Auth::user()->id,
                ]);
            }
        }
        session()->flash('message', 'Task update in successfully!');
        $this->reset('task_title', 'task_gp_id', 'is_task_urgent','taskEditingId');
    }
    public function taskStatusUpdate($taskid)
    {

        $task = Task::find($taskid);
        if ($task->is_complete == 'yes') {
            $task->is_complete = 'no';
            $task->save();
        } else {
            $task->is_complete = 'yes';
            $task->save();
        }
    }
}
