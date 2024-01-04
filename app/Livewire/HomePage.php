<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TaskGroup;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('layout.app')]
class HomePage extends Component
{
    public $task_gp_name;
    public $is_task_gp_urgent;
    public function render()
    {
        $data['task_gps'] = TaskGroup::where('created_by', Auth::user()->id)->get();
        return view('livewire.home-page', $data);
    }

    public function taskGroupCreate(){
        if($this->is_task_gp_urgent){
            $task_gp = TaskGroup::create([
                'task_gp_name' => $this->task_gp_name,
                'is_task_gp_urgent' => 'yes',
            ]);

        }else{

            $task_gp = TaskGroup::create([
                'task_gp_name' => $this->task_gp_name,
                'is_task_gp_urgent' => 'no',
            ]);
        }
        session()->flash('message', 'Task group create in successfully!');
        return back();
    }
}
