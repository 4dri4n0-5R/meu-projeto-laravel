@extends('layouts.tasks-layout')

@section('title', 'Lista de Tarefas')

@section('content')

    <!-- Título da Página -->
    <h1>Lista de Tarefas</h1>

    <!-- Mensagem de Sucesso -->
    @if (session('success'))
        <div class="success-message" style="margin-bottom: 1.5rem; padding: 1rem; background-color: #dff0d8; color: #3c763d; border: 1px solid #d6e9c6; border-radius: 0.375rem;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Botão Criar Nova Tarefa -->
    <div style="margin-bottom: 2rem;">
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">
            Criar Tarefa
        </a>
    </div>

    <!-- Lista de Tarefas -->
    <ul class="task-list">
        @forelse ($tasks as $task)
            <li class="task-item">
                <!-- Detalhes da Tarefa (Título, Descrição) -->
                <div class="task-details">
                    <strong>{{ $task->title }}</strong>
                    <p>{{ $task->description ?? 'Sem descrição' }}</p>
                </div>
                
                <!-- --- NOVO MENU DE AÇÕES DA TAREFA --- -->
                <div class="task-action-wrapper">
                    <!-- O Botão (Ícone de Três Pontos) -->
                    <!-- O 'data-dropdown-toggle' é o que o JavaScript usa para encontrar o menu -->
                    <button id="task-action-button-{{ $task->id }}" 
                            data-dropdown-toggle="task-action-menu-{{ $task->id }}" 
                            class="task-action-button" 
                            type="button">
                        <!-- Ícone SVG (Três pontos verticais - Kebab) -->
                        <svg class="task-action-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                        </svg>
                    </button>

                    <!-- O Menu Suspenso (Dropdown) -->
                    <!-- O 'id' corresponde ao 'data-dropdown-toggle' do botão -->
                    <div id="task-action-menu-{{ $task->id }}" class="task-action-dropdown">
                        <!-- Item Editar -->
                        <a href="{{ route('tasks.edit', $task) }}" class="task-action-item">
                            Editar
                        </a>
                        
                        <!-- Item Excluir (dentro de um formulário) -->
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    onclick="return confirm('Tem certeza que deseja excluir esta tarefa?')" 
                                    class="task-action-item delete"
                                    style="width: 100%;">
                                Excluir
                            </button>
                        </form>
                    </div>
                </div>
                <!-- --- FIM DO NOVO MENU --- -->
                
            </li>
        @empty
            <li class="task-item">
                <div class="task-details">
                    <p>Nenhuma tarefa encontrada. Clique no botão "Criar Tarefa" para começar!</p>
                </div>
            </li>
        @endforelse
    </ul>

@endsection

