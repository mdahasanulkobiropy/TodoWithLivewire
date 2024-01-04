<div class="row m-2">
    <div class="col-4">
        <table class="table">
            <tr>
                <th>Tasks Group</th>
                <th></th>
            </tr>
            @foreach ($task_gps as $task_gp)
                <tr>
                    <td>{{ $task_gp->task_gp_name ?? '' }}</td>
                    <td>{{ $task_gp->is_task_gp_urgent ?? '' }}</td>
                </tr>
            @endforeach
        </table>
        <form wire:submit="taskGroupCreate">
            <div class="col-9">
                <label for="">Task Group</label>
                <input wire:model="task_gp_name" class="form-control" type="text">
            </div>
            <div class="form-check form-switch">
                <label for="">Is Task Group Urgent?</label>
                <input class="form-check-input"  wire:model="is_task_gp_urgent" type="checkbox" id="flexSwitchCheckDefault">
              </div>
            <button class="btn"> New+</button>
        </form>

    </div>
    <div class="col-8">
        Hello
    </div>
</div>
