<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\StoreTaskRequest;
    use App\Http\Requests\UpdateTaskRequest;
    use App\Models\Task;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth; 

    
    class TaskController extends Controller
    {
        
        public function index()
        {
            
            $tasks = Task::where('user_id', Auth::id())
                        ->orderBy('id', 'desc')
                        ->get();
            
            return view('tasks.index', compact('tasks'));
        }

        
        public function create()
        {
            return view('tasks.create');
        }

        
        public function store(StoreTaskRequest $request)
        {
            $validatedData = $request->validated();
            
           
            $validatedData['user_id'] = Auth::id(); 

            Task::create($validatedData); 

            return redirect()->route('tasks.index')
                            ->with('success', 'Tarefa criada com sucesso!');
        }

        
        public function show(Task $task)
        {
            
            if ($task->user_id !== Auth::id()) {
                abort(403, 'Ação não autorizada. Você só pode visualizar suas próprias tarefas.');
            }

            return view('tasks.show', compact('task'));
        }

        
        public function edit(Task $task)
        {
           
            if ($task->user_id !== Auth::id()) {
                abort(403, 'Ação não autorizada. Você só pode editar suas próprias tarefas.');
            }

            return view('tasks.edit', compact('task'));
        }

        
        public function update(UpdateTaskRequest $request, Task $task)
        {
            
            if ($task->user_id !== Auth::id()) {
                abort(403, 'Ação não autorizada. Você só pode editar suas próprias tarefas.');
            }
            
            $task->update($request->validated()); 

            return redirect()->route('tasks.index')
                            ->with('success', 'Tarefa atualizada com sucesso!');
        }

        
        public function destroy(Task $task)
        {
            
            if ($task->user_id !== Auth::id()) {
                abort(403, 'Ação não autorizada. Você só pode excluir suas próprias tarefas.');
            }

            $task->delete();

            return redirect()->route('tasks.index')
                            ->with('success', 'Tarefa excluída com sucesso!');
        }
    }
