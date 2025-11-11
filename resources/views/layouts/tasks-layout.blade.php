<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Tarefas | @yield('title', 'Gerenciador de Tarefas')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Estilos CSS Customizados -->
        <style>
            /* Base */
            body {
                font-family: 'Figtree', ui-sans-serif, system-ui, sans-serif;
                margin: 0;
                background-color: #f3f4f6; 
                color: #1f2937; 
            }
            .container {
                max-width: 800px;
                margin: 2rem auto;
                padding: 2rem;
                background-color: #ffffff;
                border-radius: 0.5rem; 
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); 
            }

            /* Tipografia */
            h1, h2 {
                font-weight: 600; 
                color: #1f2937; 
            }
            h1 {
                font-size: 1.25rem; 
                line-height: 1.75rem; 
                border-bottom: 1px solid #e5e7eb; 
                padding-bottom: 0.75rem;
                margin-bottom: 1.5rem;
            }
            p { line-height: 1.6; }
            a { color: #3b82f6; text-decoration: none; }
            a:hover { text-decoration: underline; }
            label {
                display: block;
                margin-bottom: 0.5rem;
                font-weight: 500; 
                color: #374151;
                font-size: 14px; 
            }

            input[type="text"], textarea {
                width: 100%;
                padding: 0.75rem 1rem;
                border: 1px solid #d1d5db; 
                border-radius: 0.375rem; 
                box-sizing: border-box; 
                transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;

                font-family: inherit; 
                font-size: 16px;
                color: #000000
            }
        
            input[type="text"]:focus, textarea:focus {
                outline: none;
                border: 2px solid #6366f1;
            }

            .main-nav {
                background-color: #ffffff;
                box-shadow: 0 4px 6px -2px rgba(0, 0, 0, 0.1);
            }
            
            .nav-container {
                max-width: 80rem; 
                margin-left: auto;
                margin-right: auto;
                padding-left: 4.25rem; 
                padding-right: 4.25rem;
                display: flex;
                justify-content: space-between;
                align-items: center;
                height: 4rem; 
            }
            @media (min-width: 640px) {
                .nav-container {
                    padding-left: 3.25rem; 
                    padding-right: 3.25rem;
                }
            }
            @media (min-width: 1024px) {
                .nav-container {
                    padding-left: 4.25rem; 
                    padding-right: 4.25rem;
                }
            }

            /* Estilos do Logo */
            .logo-link {
                display: inline-flex;       
                align-items: center;        
                gap: 2.75rem; 
                text-decoration: none;
                padding-top: 0.25rem;       
                padding-left: 0.25rem;      
                padding-right: 0.25rem;     
                border-bottom-width: 2px;   
                border-bottom-color: transparent; 
                
            }
            .logo-icon {
                display: block;
                height: 2.25rem; 
                width: auto;      
                fill: currentColor; 
                color: #1F2937;  
            }
            .logo-text {
                font-size: 0.875rem;     
                font-weight: 500;        
                color: #6B7280;         
                line-height: 1.25rem;    
            }
            .logo-link:hover {
                border-bottom-color: #D1D5DB; 
                text-decoration: none;
            }
            .logo-link:hover .logo-text {
                
            }
            .logo-link:focus {
                outline: none;
                border-bottom-color: #D1D5DB; 
            }
            .logo-link:focus .logo-text {
                
            }
            
            .main-nav .user-menu {
                display: flex;
                align-items: center;
                gap: 1.5rem;
            }
            .main-nav .user-menu form {
                margin: 0;
            }
            
            .btn {
                display: inline-flex;       
                align-items: center;         
                padding: 0.5rem 1rem;     
                font-size: 0.75rem; 
                border: 1px solid transparent; 
                border-radius: 0.375rem;     
                font-weight: 600;          
                color: #ffffff;              
                text-transform: uppercase;   
                letter-spacing: 0.1em;     
                text-decoration: none;       
                cursor: pointer;
                transition: all 0.15s ease-in-out; 
                line-height: inherit;
                font-family: inherit;
            }
            .btn:focus {
                outline: none; 
                box-shadow: none; 
            }

            .btn-primary {
                background-color: #1f2937; 
                color: #ffffff !important; 
                text-decoration: none !important;
                font-size: 0.75rem; 
                padding: 0.5rem 1rem;
            }
            .btn-primary:hover {
                background-color: #374151; 
                color: #ffffff !important;
                text-decoration: none !important;
            }
            .btn-primary:active { background-color: #111827; }
            .btn-primary:focus { 
                background-color: #374151; 
            }
            
            .btn-link {
                background: none; 
                border: none; 
                color: #3b82f6;
                text-transform: none; 
                letter-spacing: normal;
                padding: 0.5rem; 
                font-size: 0.875rem; 
            }
            .btn-link:hover { text-decoration: underline; background: none; }
            
            .btn-delete {
                background-color: #DC2626; 
                color: #ffffff !important;
                text-decoration: none !important;
                text-transform: none;
                letter-spacing: normal;
                font-size: 0.875rem; 
            }
            .btn-delete:hover { 
                background-color: #EF4444; 
                color: #ffffff !important;
                text-decoration: none !important; 
            }

            .task-list { list-style: none; padding: 0; margin-top: 2rem; }
            .task-item {
                display: flex; justify-content: space-between; align-items: center;
                padding: 1rem 1.5rem; background-color: #f9fafb;
                border: 1px solid #e5e7eb; border-radius: 0.375rem; margin-bottom: 1rem;
            }
            .task-item:last-child { margin-bottom: 0; }
            .task-details { display: flex; flex-direction: column; gap: 0.25rem; }
            .task-details strong { font-size: 1.125rem; font-weight: 600; color: #1f2937; }
            .task-details p { font-size: 0.875rem; color: #6b7280; margin: 0; }
            .task-actions { display: flex; align-items: center; gap: 1rem; }
            .task-actions form { margin: 0; }
            .form-group { margin-bottom: 1.5rem; }
            .form-actions { margin-top: 2rem; display: flex; gap: 1rem; align-items: center; }

            /* Estilos do Dropdown (Menu do Usuário) */
            .dropdown-wrapper {
                position: relative;
                display: inline-block;
            }
            .nav-dropdown-button {
                display: inline-flex;
                align-items: center;
                padding: 8px 12px; 
                background-color: #ffffff; 
                border: 1px solid transparent; 
                border-radius: 0.375rem; 
                font-family: inherit;
                font-size: 14px; 
                font-weight: 500; 
                color: #6B7280; 
                cursor: pointer;
                transition: all 0.15s ease-in-out;
            }
            .nav-dropdown-button:hover {
                color: #374151; 
                border-color: #e5e7eb; 
                text-decoration: none;
            }
            .nav-dropdown-button:focus {
                outline: none; 
                box-shadow: none; 
                border-color: #e5e7eb;
            }
            .dropdown-arrow {
                width: 1rem; height: 1rem; margin-left: 0.5rem; fill: currentColor;
            }
            .dropdown-menu {
                opacity: 0;
                visibility: hidden;
                transform: translateY(-10px); 
                pointer-events: none; 
                position: absolute;
                right: 0;
                top: 100%;
                margin-top: 0.5rem; 
                width: 200px; 
                background-color: #ffffff;
                border-radius: 0.375rem; 
                box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05);
                border: 1px solid #e5e7eb; 
                z-index: 50;
                transition: opacity 0.2s ease-out, transform 0.2s ease-out, visibility 0.2s;
            }
            .dropdown-menu.show {
                opacity: 1;
                visibility: visible;
                transform: translateY(0); 
                pointer-events: auto; 
            }
            .dropdown-item {
                display: block;
                width: 100%;
                padding: 0.75rem 1rem;
                text-align: left;
                font-size: 14px;
                color: #6B7280; /* #374151;*/
                background: none;
                border: none;
                cursor: pointer;
                box-sizing: border-box;
                font-family: inherit;  
            }
            .dropdown-item:hover {
                background-color: #e5e7eb; 
                text-decoration: none;
                color: #374151;
            }
            
            /* --- NOVO CSS: Dropdown de Ações da Tarefa --- */
            .task-action-wrapper {
                position: relative;
                display: inline-block;
            }
            
            .task-action-button {
                background-color: transparent;
                border: none;
                cursor: pointer;
                padding: 0.5rem;
                border-radius: 50%; /* Botão redondo */
                display: flex;
                align-items: center;
                justify-content: center;
                transition: background-color 0.15s ease-in-out;
            }
            .task-action-button:hover {
                background-color: #e5e7eb; /* Fundo cinza claro no hover */
            }
            
            .task-action-icon {
                width: 1.25rem; /* 20px */
                height: 1.25rem; /* 20px */
                fill: #6B7280; /* Cor cinza do ícone (text-gray-500) */
            }

            .task-action-dropdown {
                /* Copia o estilo do .dropdown-menu */
                opacity: 0;
                visibility: hidden;
                transform: translateY(-10px); 
                pointer-events: none; 
                position: absolute;
                right: 0;
                top: 100%;
                margin-top: 0.25rem; 
                width: 160px; /* Mais estreito */
                background-color: #ffffff;
                border-radius: 0.375rem; 
                box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05);
                border: 1px solid #e5e7eb; 
                z-index: 40; /* Abaixo do menu principal */
                transition: opacity 0.2s ease-out, transform 0.2s ease-out, visibility 0.2s;
            }
            .task-action-dropdown.show {
                opacity: 1;
                visibility: visible;
                transform: translateY(0); 
                pointer-events: auto; 
            }
            
            /* Itens do menu de ação */
            .task-action-item {
                display: block;
                width: 100%;
                padding: 0.75rem 1rem;
                text-align: left;
                font-size: 14px;
                color: #374151; 
                background: none;
                border: none;
                cursor: pointer;
                box-sizing: border-box; 
                text-decoration: none;
                font-family: inherit;
                
            }
            .task-action-item:hover {
                background-color: #e5e7eb;
                text-decoration: none;
            }
            .task-action-item.delete {
                color: #DC2626;
            }
            .task-action-item.delete:hover {
                background-color: #fef2f2; /* Fundo vermelho claro */
            }
            /* --- FIM DO NOVO CSS --- */

        </style>

        @yield('styles')
    </head>
    <body class="font-sans antialiased">

        <nav class="main-nav">
            <!-- O container interno centralizado -->
            <div class="nav-container">

                <!-- --- MUDANÇA 1: LOGO (AGORA UMA DIV) --- -->
                <div class="logo-link">
                    <svg viewBox="0 0 316 316" xmlns="http://www.w3.org/2000/svg" class="logo-icon">
                        <path d="M305.8 81.125C305.77 80.995 305.69 80.885 305.65 80.755C305.56 80.525 305.49 80.285 305.37 80.075C305.29 79.935 305.17 79.815 305.07 79.685C304.94 79.515 304.83 79.325 304.68 79.175C304.55 79.045 304.39 78.955 304.25 78.845C304.09 78.715 303.95 78.575 303.77 78.475L251.32 48.275C249.97 47.495 248.31 47.495 246.96 48.275L194.51 78.475C194.33 78.575 194.19 78.725 194.03 78.845C193.89 78.955 193.73 79.045 193.6 79.175C193.45 79.325 193.34 79.515 193.21 79.685C193.11 79.815 192.99 79.935 192.91 80.075C192.79 80.285 192.71 80.525 192.63 80.755C192.58 80.875 192.51 80.995 192.48 81.125C192.38 81.495 192.33 81.875 192.33 82.265V139.625L148.62 164.795V52.575C148.62 52.185 148.57 51.805 148.47 51.435C148.44 51.305 148.36 51.195 148.32 51.065C148.23 50.835 148.16 50.595 148.04 50.385C147.96 50.245 147.84 50.125 147.74 49.995C147.61 49.825 147.5 49.635 147.35 49.485C147.22 49.355 147.06 49.265 146.92 49.155C146.76 49.025 146.62 48.885 146.44 48.785L93.99 18.585C92.64 17.805 90.98 17.805 89.63 18.585L37.18 48.785C37 48.885 36.86 49.035 36.7 49.155C36.56 49.265 36.4 49.355 36.27 49.485C36.12 49.635 36.01 49.825 35.88 49.995C35.78 50.125 35.66 50.245 35.58 50.385C35.46 50.595 35.38 50.835 35.3 51.065C35.25 51.185 35.18 51.305 35.15 51.435C35.05 51.805 35 52.185 35 52.575V232.235C35 233.795 35.84 235.245 37.19 236.025L142.1 296.425C142.33 296.555 142.58 296.635 142.82 296.725C142.93 296.765 143.04 296.835 143.16 296.865C143.53 296.965 143.9 297.015 144.28 297.015C144.66 297.015 145.03 296.965 145.4 296.865C145.5 296.835 145.59 296.775 145.69 296.745C145.95 296.655 146.21 296.565 146.45 296.435L251.36 236.035C252.72 235.255 253.55 233.815 253.55 232.245V174.885L303.81 145.945C305.17 145.165 306 143.725 306 142.155V82.265C305.95 81.875 305.89 81.495 305.8 81.125ZM144.2 227.205L100.57 202.515L146.39 176.135L196.66 147.195L240.33 172.335L208.29 190.625L144.2 227.205ZM244.75 114.995V164.795L226.39 154.225L201.03 139.625V89.825L219.39 100.395L244.75 114.995ZM249.12 57.105L292.81 82.265L249.12 107.425L205.43 82.265L249.12 57.105ZM114.49 184.425L96.13 194.995V85.305L121.49 70.705L139.85 60.135V169.815L114.49 184.425ZM91.76 27.425L135.45 52.585L91.76 77.745L48.07 52.585L91.76 27.425ZM43.67 60.135L62.03 70.705L87.39 85.305V202.545V202.555V202.565C87.39 202.735 87.44 202.895 87.46 203.055C87.49 203.265 87.49 203.485 87.55 203.695V203.705C87.6 203.875 87.69 204.035 87.76 204.195C87.84 204.375 87.89 204.575 87.99 204.745C87.99 204.745 87.99 204.755 88 204.755C88.09 204.905 88.22 205.035 88.33 205.175C88.45 205.335 88.55 205.495 88.69 205.635L88.7 205.645C88.82 205.765 88.98 205.855 89.12 205.965C89.28 206.085 89.42 206.225 89.59 206.325C89.6 206.325 89.6 206.325 89.61 206.335C89.62 206.335 89.62 206.345 89.63 206.345L139.87 234.775V285.065L43.67 229.705V60.135ZM244.75 229.705L148.58 285.075V234.775L219.8 194.115L244.75 179.875V229.705ZM297.2 139.625L253.49 164.795V114.995L278.85 100.395L297.21 89.825V139.625H297.2Z"></path>
                    </svg>
                    <span class="logo-text">
                        Painel de tarefas
                    </span>
                </div>
            
                <div class="user-menu">
                    @auth 
                        <div class="dropdown-wrapper">
                            <button id="user-dropdown-toggle" class="nav-dropdown-button">
                                <div>{{ Auth::user()->name }}</div>
                                <svg class="dropdown-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div id="user-dropdown-menu" class="dropdown-menu">
                                <a href="{{ route('profile.edit') }}" class="dropdown-item">
                                    Perfil
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item" style="width: 100%;">
                                        Sair
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endauth 
                </div>

            </div> 
        </nav>

        <!-- Conteúdo da Página -->
        <main>
            <div class="container">
                @yield('content')
            </div>
        </main>

        <!-- SCRIPT PARA O DROPDOWN (Menu do Usuário) -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Lógica para o dropdown do usuário
                const userToggleButton = document.getElementById('user-dropdown-toggle');
                const userMenu = document.getElementById('user-dropdown-menu');

                if (userToggleButton && userMenu) {
                    userToggleButton.addEventListener('click', function (event) {
                        event.stopPropagation(); 
                        userMenu.classList.toggle('show');
                    });
                }
                
                const taskActionButtons = document.querySelectorAll('.task-action-button');

                taskActionButtons.forEach(button => {
                    button.addEventListener('click', function (event) {
                        event.stopPropagation();
                        // Encontra o menu específico para ESTE botão
                        const menuId = button.getAttribute('data-dropdown-toggle');
                        const menu = document.getElementById(menuId);
                        if (menu) {
                            // Fecha todos os outros menus de tarefa abertos
                            document.querySelectorAll('.task-action-dropdown.show').forEach(openMenu => {
                                if (openMenu.id !== menuId) {
                                    openMenu.classList.remove('show');
                                }
                            });
                            // Alterna (abre/fecha) o menu atual
                            menu.classList.toggle('show');
                        }
                    });
                });

                // Fecha todos os dropdowns (usuário e tarefas) se clicar fora
                window.addEventListener('click', function (event) {
                    // Fecha o menu do usuário
                    if (userToggleButton && userMenu && !userMenu.contains(event.target) && !userToggleButton.contains(event.target)) {
                        userMenu.classList.remove('show');
                    }
                    
                    // Fecha os menus de tarefas
                    const openTaskMenus = document.querySelectorAll('.task-action-dropdown.show');
                    let clickedOnTaskButton = false;
                    taskActionButtons.forEach(btn => {
                        if (btn.contains(event.target)) {
                            clickedOnTaskButton = true;
                        }
                    });

                    if (!clickedOnTaskButton && openTaskMenus.length > 0) {
                        let clickedInsideAMenu = false;
                        openTaskMenus.forEach(menu => {
                            if (menu.contains(event.target)) {
                                clickedInsideAMenu = true;
                            }
                        });
                        if (!clickedInsideAMenu) {
                            openTaskMenus.forEach(menu => menu.classList.remove('show'));
                        }
                    }
                });
            });
        </script>
        @yield('scripts')
    </body>
</html>

