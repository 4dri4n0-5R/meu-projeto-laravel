@extends('layouts.tasks-layout')

@section('title', 'Editar Tarefa')

@section('content')
    <!-- Título da Página -->
    <h1>Editar Tarefa</h1>

    <!-- O 'novalidate' impede a validação HTML5 nativa -->
    <!-- Aponta para a rota 'tasks.update' e usa o método PUT -->
    <form action="{{ route('tasks.update', $task) }}" method="POST" novalidate>
        @csrf
        @method('PUT') <!-- Essencial para o Laravel entender que é uma atualização -->

        <!-- Grupo Título (com espaçamento) -->
        <div class="form-group">
            <label for="title">Título:</label>
            <!-- 
                Usa old('title', $task->title). 
                Isso preenche com o valor antigo (se a validação falhar) 
                ou com o valor atual da tarefa ($task->title).
            -->
            <input type="text" id="title" name="title" value="{{ old('title', $task->title) }}">
            
            <!-- Exibição de Erro do Laravel -->
            @error('title')
                <p style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</p>
            @enderror
        </div>

        <!-- Grupo Descrição (com espaçamento) -->
        <div class="form-group">
            <label for="description">Descrição (Opcional):</label>
            <!-- 
                Textarea é preenchido entre as tags.
            -->
            <textarea id="description" name="description" rows="5">{{ old('description', $task->description) }}</textarea>
            
            @error('description')
                 <p style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</p>
            @enderror
        </div>
        
        <!-- Ações do Formulário (Alinhamento dos botões) -->
        <div class="form-actions">
            <!-- Botão Salvar com as classes corretas -->
            <button type="submit" class="btn btn-primary">
                Salvar
            </button>
            
            <!-- Link Cancelar com as classes corretas -->
            <a href="{{ route('tasks.index') }}" class="btn btn-link">
                Cancelar
            </a>
        </div>
    </form>
@endsection

