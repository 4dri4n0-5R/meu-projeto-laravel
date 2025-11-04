<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\StoreTaskRequest;
    use App\Http\Requests\UpdateTaskRequest;
    use App\Models\Task;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth; // Importa a facade para acessar o usuário logado

    /**
     * Controlador responsável por manipular as tarefas (CRUD).
     * Usa o Route::resource('tasks', TaskController::class).
     */
    class TaskController extends Controller
    {
        /**
         * Exibe uma lista das tarefas do usuário logado.
         */
        public function index()
        {
            // FILTRA: Busca apenas as tarefas onde 'user_id' é igual ao ID do usuário autenticado.
            $tasks = Task::where('user_id', Auth::id())
                        ->orderBy('id', 'desc')
                        ->get();
            
            return view('tasks.index', compact('tasks'));
        }

        /**
         * Exibe o formulário para criar uma nova tarefa.
         * ESTE É O MÉTODO QUE ESTAVA CAUSANDO O ERRO.
         */
        public function create()
        {
            return view('tasks.create');
        }

        /**
         * Armazena uma nova tarefa no banco de dados.
         */
        public function store(StoreTaskRequest $request)
        {
            $validatedData = $request->validated();
            
            // SEGURANÇA: Adiciona o ID do usuário logado antes de criar.
            $validatedData['user_id'] = Auth::id(); 

            Task::create($validatedData); 

            return redirect()->route('tasks.index')
                            ->with('success', 'Tarefa criada com sucesso!');
        }

        /**
         * Exibe os detalhes de uma tarefa específica.
         */
        public function show(Task $task)
        {
            // AUTORIZAÇÃO: Impede que o usuário veja tarefas de outros.
            if ($task->user_id !== Auth::id()) {
                abort(403, 'Ação não autorizada. Você só pode visualizar suas próprias tarefas.');
            }

            return view('tasks.show', compact('task'));
        }

        /**
         * Exibe o formulário para editar uma tarefa existente.
         */
        public function edit(Task $task)
        {
            // AUTORIZAÇÃO: Impede que o usuário edite tarefas de outros.
            if ($task->user_id !== Auth::id()) {
                abort(403, 'Ação não autorizada. Você só pode editar suas próprias tarefas.');
            }

            return view('tasks.edit', compact('task'));
        }

        /**
         * Atualiza uma tarefa existente no banco de dados.
         */
        public function update(UpdateTaskRequest $request, Task $task)
        {
            // AUTORIZAÇÃO: Impede que o usuário atualize tarefas de outros.
            if ($task->user_id !== Auth::id()) {
                abort(403, 'Ação não autorizada. Você só pode editar suas próprias tarefas.');
            }
            
            $task->update($request->validated()); 

            return redirect()->route('tasks.index')
                            ->with('success', 'Tarefa atualizada com sucesso!');
        }

        /**
         * Remove uma tarefa do banco de dados.
         */
        public function destroy(Task $task)
        {
            // AUTORIZAÇÃO: Impede que o usuário exclua tarefas de outros.
            if ($task->user_id !== Auth::id()) {
                abort(403, 'Ação não autorizada. Você só pode excluir suas próprias tarefas.');
            }

            $task->delete();

            return redirect()->route('tasks.index')
                            ->with('success', 'Tarefa excluída com sucesso!');
        }
    }
