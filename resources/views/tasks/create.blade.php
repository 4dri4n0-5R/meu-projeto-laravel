@extends('layouts.tasks-layout')

@section('title', 'Criar Nova Tarefa')

@section('content')
    <!-- Título da Página -->
    <h1>Nova Tarefa</h1>

    <!-- O 'novalidate' impede a validação HTML5 nativa -->
    <form action="{{ route('tasks.store') }}" method="POST" id="taskForm" novalidate>
        @csrf 

        <!-- Grupo Título (com espaçamento) -->
        <div class="form-group">
            <label for="title">Título:</label>
            <!-- 'old("title")' repopula o campo se a validação falhar -->
            <input type="text" id="title" name="title" value="{{ old('title') }}">
            
            <!-- Exibição de Erro do Laravel -->
            @error('title')
                <p style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</p>
            @enderror
        </div>

        <!-- Grupo Descrição (com espaçamento) -->
        <div class="form-group">
            <label for="description">Descrição (Opcional):</label>
            <textarea id="description" name="description" rows="5">{{ old('description') }}</textarea>
            
            @error('description')
                 <p style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</p>
            @enderror
        </div>
        
        <!-- Ações do Formulário (Alinhamento dos botões) -->
        <div class="form-actions">
            <button type="submit" id="submitButton" class="btn btn-primary">
                Salvar
            </button>
            
            <a href="{{ route('tasks.index') }}" class="btn btn-link">
                Cancelar
            </a>
        </div>
    </form>
@endsection

@section('scripts')
    <!-- Script para desabilitar o botão de envio (evita double-click) -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('taskForm');
            const submitButton = document.getElementById('submitButton');

            if (form && submitButton) {
                form.addEventListener('submit', function () {
                    // Desabilita o botão e mostra feedback
                    submitButton.disabled = true;
                    submitButton.textContent = 'Salvando...';
                });
            }
        });
    </script>
@endsection

