<div>

    @if (Auth::check())
        <div class="row m-2">
            <div class="col-4">
                <!-- Task group display -->
                <table class="table border">
                    <thead>
                        <tr>
                            <th>Tasks Group</th>
                            <th>Is It Urgent?</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($task_gps as $task_gp)
                            <tr>
                                <td>{{ $task_gp->task_gp_name ?? '' }}</td>
                                <td>{{ $task_gp->is_task_gp_urgent ?? '' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <form wire:submit="taskGroupCreate">
                    <form wire:submit="taskGroupCreate">
                        <div class="col-9">
                            <label for="">Task Group</label>
                            <input wire:model="task_gp_name" class="form-control" type="text">
                            @error('task_gp_name')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="form-check form-switch">
                            <label for="">Is Task Group Urgent?</label>
                            <input class="form-check-input" wire:model="is_task_gp_urgent" type="checkbox"
                                id="flexSwitchCheckDefault">
                        </div>
                        <button class="btn"> New+</button>
                    </form>
                </form>
            </div>
            <div class="col-8">
                <div class="col-3 mb-3">
                    <label for="">Panding({{ count($panding_works) }})
                        DoneTask({{ count($done_works) }})</label>
                </div>
                <div class="col-3 mb-3">
                    <input type="search" placeholder="search" class="form-control" wire:model.live="taskSearch">
                </div>
                <table class="table border">
                    <thead>
                        <tr>
                            <th>Task Status</th>
                            <th>Tasks Title</th>
                            <th>Tasks Des</th>
                            <th>Is Urgrent</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($tasks as $task)
                            <tr>
                                <td>
                                    @if ($task->is_complete == 'yes')
                                        <input type="checkbox" checked
                                            wire:click="taskStatusUpdate({{ $task->id }})">
                                    @else
                                        <input type="checkbox" wire:click="taskStatusUpdate({{ $task->id }})">
                                    @endif

                                </td>
                                <td>{{ $task->task_title ?? '' }}</td>
                                <td>{{ $task->task_des ?? '' }}</td>
                                <td>{{ $task->is_task_urgent ?? '' }}</td>
                                <td>
                                    <button wire:click="deleteTaskCreate({{ $task->id }})">Delete</button>
                                    <button wire:click="editTaskCreate({{ $task->id }})">Edit</button>
                                </td>
                                @if ($taskEditingId == $task->id)
                                        <div class="col-9">
                                            <label for="task_gp">Create Task:</label>
                                            <select wire:model="up_task_gp_id" class="form-control" name="task_gp"
                                                id="task_gp">
                                                @foreach ($task_gps as $task_gp)
                                                    <option {{ $task->task_gp_id == $task_gp->id ? 'selected' : '' }}
                                                        value="{{ $task_gp->id }}">{{ $task_gp->task_gp_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-9">
                                            <label for="task_title">Task Title</label>
                                            <input wire:model="up_task_title" class="form-control"
                                                value="{{ $task->task_title }}" type="text" id="task_title"
                                                name="task_title">
                                            @error('up_task_title')
                                                <strong class="text-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="col-9">
                                            <label for="task_des">Task Description</label>
                                            <textarea wire:model="up_task_des" id="task_des" name="task_des" class="form-control" rows="3">{{ $task->task_des }}</textarea>
                                            @error('up_task_des')
                                                <strong class="text-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="form-check form-switch">
                                            <label for="is_task_urgent">Is Task Urgent?</label>
                                            <input class="form-check-input" wire:model="up_is_task_urgent"
                                                type="checkbox" id="is_task_urgent" name="is_task_urgent">
                                        </div>
                                        <button wire:click="updatetaskCreate({{$task->id}})" class="btn">Update</button>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <form wire:submit="taskCreate">
                    <div class="col-9">
                        <label for="">Update Task:</label>
                        <select wire:model="task_gp_id" class="form-control" name="" id="">
                            @foreach ($task_gps as $task_gp)
                                <option value="{{ $task_gp->id }}">{{ $task_gp->task_gp_name }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="col-9">
                        <label for="">Task Title</label>
                        <input wire:model="task_title" class="form-control" type="text">
                        @error('task_title')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="col-9">
                        <label for="">Task Description</label>
                        <textarea wire:model="task_des" name="" id="" class="form-control" rows="3"></textarea>
                        @error('task_des')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-check form-switch">
                        <label for="">Is Task Urgent?</label>
                        <input class="form-check-input" wire:model="is_task_urgent" type="checkbox"
                            id="flexSwitchCheckDefault">
                    </div>
                    <button class="btn"> New+</button>
                </form>
            </div>
        </div>
    @else
        <div class="row m-2">
            <div class="col-4">
                <p>Please log in to access the content.</p>
            </div>
            <div class="col-8">
                Welcome To Todo App
            </div>
        </div>
    @endif
</div>
