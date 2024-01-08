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
    public $is_task_gp_urgent;

    public $task_title;
    public $up_task_gp_id;
    public $up_task_title;
    public $up_task_des;
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
        if(!Auth::user()){
            $data['task_gps'] = '';
            $data['tasks'] = '';
            $data['done_works'] = '';
            $data['panding_works'] = '';
        }else{
            $data['done_works'] = Task::where('created_by', Auth::user()->id)->where('is_complete', 'yes')->get();
            $data['panding_works'] = Task::where('created_by', Auth::user()->id)->where('is_complete', 'no')->get();
            $data['task_gps'] = TaskGroup::where('created_by', Auth::user()->id)->get();
            $data['tasks'] = Task::where('created_by', Auth::user()->id)->where('task_title','like',"%{$this->taskSearch}%")->get();
        }
        return view('livewire.home-page', $data);
    }

    public function taskGroupCreate(){

        $this->validate([
            'task_gp_name' => 'required|string',
        ]);
        if($this->is_task_gp_urgent){
            $task_gp = TaskGroup::create([
                'task_gp_name' => $this->task_gp_name,
                'is_task_gp_urgent' => 'yes',
                'created_by' => Auth::user()->id,
            ]);

        }else{

            $task_gp = TaskGroup::create([
                'task_gp_name' => $this->task_gp_name,
                'is_task_gp_urgent' => 'no',
                'created_by' => Auth::user()->id,
            ]);
        }
        session()->flash('message', 'Task group create in successfully!');
        $this->reset('task_gp_name', 'is_task_gp_urgent');
    }


    public function taskCreate(){

        $this->validate([
            'task_title' => 'required|string',
            'task_des' => 'required|string',
            'task_gp_id' => 'required|integer',
        ]);

        if($this->is_task_urgent){
            $task =Task::create([
                'task_title' => $this->task_title,
                'task_des' => $this->task_des,
                'task_gp_id' => $this->task_gp_id,
                'is_task_urgent' => 'yes',
                'created_by' => Auth::user()->id,
            ]);

        }else{
            $task =Task::create([
                'task_title' => $this->task_title,
                'task_des' => $this->task_des,
                'task_gp_id' => $this->task_gp_id,
                'is_task_urgent' => $this->is_task_urgent,
                'created_by' => Auth::user()->id,
            ]);
        }
        session()->flash('message', 'Task create in successfully!');
        $this->reset('task_title', 'task_des', 'is_task_urgent');

    }

    public function deleteTaskCreate($task){
        $task =Task::find($task);
        if(!$task){
            session()->flash('error', 'Task not found!');
        }else{
            $task->delete();
            session()->flash('message', 'Task delete successfully!');
        }
    }
    public function editTaskCreate($task){
        $this->taskEditingId = $task;
    }

    public function updatetaskCreate($taskId)
    {
        $task = Task::findOrFail($taskId);

        $taskData = [
            'task_title' => $this->up_task_title,
            'task_des' => $this->up_task_des,
            'task_gp_id' => $this->up_task_gp_id,
            'is_task_urgent' => $this->is_task_urgent ? 'yes' : 'no',
            'created_by' => Auth::user()->id,
        ];

        $task->update($taskData);

        session()->flash('message', 'Task updated successfully!');
        $this->reset(['up_task_title', 'up_task_des', 'is_task_urgent','taskEditingId']);
    }
    public function taskStatusUpdate($taskid){

        $task =Task::find($taskid);
        if($task->is_complete =='yes'){
            $task->is_complete = 'no';
            $task->save();
        }else{
            $task->is_complete = 'yes';
            $task->save();
        }
    }
}
