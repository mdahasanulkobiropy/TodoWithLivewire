     <div class="flex">
         @if (Auth::check())
             <div class="w-[300px] h-screen flex ">
                 <div class="p-2.5 mt-3">
                     <h1 class="font-bold text-xl w-full">Welcome {{Auth::user()->name}}</h1>
                     <h2 class="text-[#ADACB0] text-sm mt-16">Tasks Group</h2>
                     <h1 wire:click="showTasksUnderGroup({{ $urgent_task->id }})"
                         class="mt-5 ml-2 font-semibold cursor-pointer color text-sm">
                         <i class="bi bi-file-earmark p-1"></i>
                         {{ $urgent_task->task_gp_name ?? '' }}
                         <span class="text-sm ml-2 text-[#961616] bg-[#FFE3E3] p-0.5 rounded">Urgent</span>
                     </h1>
                     @foreach ($taskGroups as $taskGroup)
                         <h1 wire:click="showTasksUnderGroup({{ $taskGroup->id }})"
                             class="mt-5 ml-2 font-semibold cursor-pointer color text-sm">
                             <i class="bi bi-file-earmark p-1"></i>
                             {{ $taskGroup->task_gp_name ?? '' }}
                             @if ($taskGroup->is_task_gp_urgent == 'yes')
                                 <span class="text-sm ml-2 text-[#961616] bg-[#FFE3E3] p-0.5 rounded">Urgent</span>
                             @endif
                         </h1>
                     @endforeach

                     @if ($showInputButton)
                         <button wire:click="showInput" id="newGroupBtn"
                             class="mt-5 ml-2 inline-block cursor-pointer rounded-md px-4 py-2 text-center w-full text-sm font-semibold border border-slate-300 transition duration-200 ease-in-out">
                             + New Group
                         </button>
                     @endif

                     @if ($showSubmitButton)
                         <div id="inputContainer" class="mt-5 ml-2 w-full p-2 rounded">
                             <i class="bi bi-file-earmark p-1"></i>
                             <input class="button p-2" wire:model="task_gp_name" type="text" id="groupNameInput"
                                 placeholder="Enter group name">
                         </div>
                         <button wire:click="taskGroupCreate" id="newGroupBtn"
                             class="mt-5 ml-2 inline-block cursor-pointer rounded-md px-4 py-2 text-center w-full text-sm font-semibold border border-slate-300 transition duration-200 ease-in-out">
                             + New Group
                         </button>
                     @endif
                 </div>
             </div>
             <div class="w-3/4">
                 <div>
                     <div class="flex justify-between  mt-3 p-2.5 ">
                         <h1 class=" ml-10"><i class="bi bi-file-earmark p-1"></i>social</h1>
                         <div class="flex">
                             <i class="bi bi-search mr-3 mt-0.5 "></i>
                             <input type="search" placeholder="search" class="form-control"
                                 wire:model.live="taskSearch">
                                 <div class="relative inline-block text-left">
                                    <button id="profileBtn" type="button" class="group w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Profile
                                    </button>
                                    <div id="subButtons" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 py-1 hidden group-hover:block">
                                        <livewire:logout-page />
                                    </div>
                                </div>
                         </div>
                     </div>
                     <div class="flex">
                         <button
                             class="button mt-5 ml-10 inline-block cursor-pointer rounded-md px-4 py-2 text-center text-sm font-semibold border border-slate-300 transition duration-200 ease-in-out"><span
                                 class="bg-gray-200 px-1 mr-2 rounded">{{ count($panding_works) }}</span>To do</button>
                         <button
                             class=" button mt-5 ml-2  inline-block cursor-pointer rounded-md text-center px-4 py-2 w-28 text-sm font-semibold border border-slate-300 transition duration-200 ease-in-out"><span
                                 class="bg-blue-600 text-white px-1 mr-2 rounded">{{ count($done_works) }}</span>Done</button>
                     </div>
                     <h1 class="mt-3 p-2.5 ml-10 text-[#ADACB0] text-sm mt-16">Tasks</h1>
                     @foreach ($tasks as $task)
                         <div class="mt-3 p-2.5 ml-10 border border-slate-300 button rounded-lg">
                             <div class=" flex items-center   ">
                                 @if ($task->is_complete == 'yes')
                                     <input type="checkbox" checked wire:click="taskStatusUpdate({{ $task->id }})">
                                 @else
                                     <input type="checkbox" wire:click="taskStatusUpdate({{ $task->id }})">
                                 @endif
                                 <div class="flex flex-col ml-4">
                                     <div class="flex items-center">
                                         <h1 class="text-sm font-bold">{{ $task->task_title ?? '' }}</h1>
                                         <button
                                             class="btn bg-[#ADACB0] text-xs ml-1">{{ $task->taskGroup->task_gp_name ?? '' }}</button>
                                         @if ($task->is_task_urgent == 'yes')
                                             <span
                                                 class="text-sm ml-3 font-bold text-[#961616] bg-[#FFE3E3] p-0.5 rounded">Urgent</span>
                                         @endif
                                         <button wire:click="editTaskCreate({{ $task->id }})"><i
                                                 class="bi bi-pencil-fill ml-10 "></i></button>
                                         <button wire:click="deleteTaskCreate({{ $task->id }})"><i
                                                 class="bi bi-trash-fill ml-5 "></i></button>
                                     </div>
                                     <input type="text" placeholder="Here Task Description"
                                         class="input input-bordered w-full text-xs mt-2 max-w-xs" />
                                 </div>
                             </div>
                         </div>
                         @if ($taskEditingId == $task->id)
                             <form wire:submit.prevent="taskUpdate({{$task->id}})" class="mt-3 ml-10">
                                 <input type="text" wire:model="task_title" placeholder="New Task"
                                     class="w-1/4 border p-2 button border-slate-500 rounded">
                                 <select wire:model="task_gp_id" id="groupSelect"
                                     class="w-1/4 p-2 border border-slate-500 rounded">
                                     <option>Select Group</option>
                                     {{$task->task_gp_id}}
                                     @foreach ($taskGroups as $taskGroup)
                                         <option value="{{ $taskGroup->id }}"  {{ $task->task_gp_id == $taskGroup->id ? 'selected' : '' }}>{{ $taskGroup->task_gp_name ?? '' }}
                                         </option>
                                     @endforeach
                                 </select>

                                 <label for="urgentCheckbox"
                                     class="inline-block cursor-pointer rounded-md p-1 text-center text-sm font-semibold border border-slate-500 w-[200px] transition duration-200 p-2.5 ease-in-out form-switch">
                                     Urgent
                                     @if ($task->is_task_urgent == 'yes')
                                        <input id="urgentCheckbox" checked class="ml-1 mt-1" wire:model="is_task_urgent"
                                            type="checkbox">

                                        @else
                                        <input id="urgentCheckbox" class="ml-1 mt-1" wire:model="is_task_urgent"
                                        type="checkbox">
                                     @endif
                                 </label>

                                 <button type="submit"
                                     class="inline-block cursor-pointer rounded-md p-2.5 text-center text-white text-sm font-semibold bg-blue-600 w-[200px] transition duration-200 ease-in-out">
                                     Update Task
                                 </button>
                             </form>
                         @endif

                     @endforeach
                 </div>

                 @if (!$taskEditingId)
                 <form wire:submit="taskCreate" method="post" class="mt-3 ml-10">
                     <input type="text" wire:model="task_title" placeholder="New Task"
                         class="w-1/4 border p-2 button border-slate-500 rounded">
                     <select wire:model="task_gp_id" id="groupSelect" class="w-1/4 p-2 border border-slate-500 rounded">
                         <option>Select Group</option>
                         @foreach ($taskGroups as $taskGroup)
                             <option value="{{ $taskGroup->id }}">{{ $taskGroup->task_gp_name ?? '' }}</option>
                         @endforeach
                     </select>

                     <label for="urgentCheckbox"
                         class="inline-block cursor-pointer rounded-md p-1 text-center text-sm font-semibold border border-slate-500 w-[200px] transition duration-200 p-2.5 ease-in-out form-switch">
                         Urgent
                         <input id="urgentCheckbox" class="ml-1 mt-1" wire:model="is_task_urgent" type="checkbox">
                     </label>

                     <button type="submit"
                         class="inline-block cursor-pointer rounded-md p-2.5 text-center text-white text-sm font-semibold bg-blue-600 w-[200px] transition duration-200 ease-in-out">
                         Create Task
                     </button>
                 </form>
                 @endif
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
     <script>
        document.getElementById('profileBtn').addEventListener('click', function() {
            var subButtons = document.getElementById('subButtons');
            subButtons.classList.toggle('hidden');
        });
    </script>
     <script>
         document.getElementById('newGroupBtn').addEventListener('click', function() {
             var inputContainer = document.getElementById('inputContainer');
             inputContainer.classList.toggle('hidden');
         });

         function toggleIcons(checkbox) {
             var icons = checkbox.closest('.flex').querySelectorAll('.bi');

             icons.forEach(function(icon) {
                 if (checkbox.checked) {
                     icon.style.display = "inline";
                 } else {
                     icon.style.display = "none";
                 }
             });
         }

         var checkboxes = document.querySelectorAll(".checkbox");

         checkboxes.forEach(function(checkbox) {
             checkbox.addEventListener("change", function() {
                 toggleIcons(checkbox);
             });
             toggleIcons(checkbox);
         });

         function toggleButtonVisibility() {
             var button = document.getElementById("hiddenButton");
             button.style.display = "inline-block";
         }
     </script>
