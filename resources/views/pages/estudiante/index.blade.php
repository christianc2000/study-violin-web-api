<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl">
        <div class="mb-3">
            <h5 class="text-xl font-semibold mb-4">Gestionar Estudiantes</h5>
            <x-link-button href="{{ route('admin.estudiante.create') }}">
                Nuevo estudiante
            </x-link-button>
            <div class="mt-4">
                <table class="w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th scope="col"
                                class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <div class="flex items-center gap-x-3">
                                    <span>ID</span>
                                </div>
                            </th>

                            <th scope="col"
                                class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                Estudiante
                            </th>

                            <th scope="col"
                                class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                Género
                            </th>

                            <th scope="col"
                                class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                Edad
                            </th>

                            <th scope="col"
                                class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                Puntaje
                            </th>
                            <th scope="col"
                                class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                Nivel
                            </th>
                            <th scope="col" class="relative py-3.5 px-4">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                        @foreach ($estudiantes as $estudiante)
                            <tr>
                                <td
                                    class="px-4 py-4 text-sm font-medium text-gray-700 dark:text-gray-200 whitespace-nowrap">
                                    {{ $estudiante->estudiante->id }}</td>
                                <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                    <div class="flex items-center gap-x-2">
                                        <img class="object-cover w-8 h-8 rounded-full"
                                            src="{{ $estudiante->estudiante->user->image }}" alt="">
                                        <div>
                                            <h2 class="text-sm font-medium text-gray-800 dark:text-white ">
                                                {{ $estudiante->estudiante->user->name . ' ' . $estudiante->estudiante->user->lastname }}
                                            </h2>
                                            <p class="text-xs font-normal text-gray-600 dark:text-gray-400">
                                                {{ $estudiante->estudiante->user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $estudiante->estudiante->user->gender }}</td>
                                <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                    {{ $estudiante->estudiante->user->age }}
                                </td>
                                <td>{{ $estudiante->estudiante->puntuacion }}</td>
                                <td>{{ $estudiante->estudiante->niveles->nombre }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button id="myButton" class="dropbtn">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                                            </svg>
                                        </button>
                                        <div id="myDropdown" class="dropdown-content">
                                            <a href="#" class="hover:bg-gray-200">Perfil</a>
                                            <a href="#" class="hover:bg-gray-200">Tutor</a>
                                            <a href="#" class="hover:bg-gray-200">Registros</a>
                                            <a href="#" class="deleteBtn hover:bg-gray-200">Eliminar</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>

    {{-- CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <style>
        /* Estilos para el botón y el contenido del menú desplegable */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            /* Alinea el borde derecho del contenido con el borde derecho del botón */
            min-width: 160px;
            z-index: 1;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            background-color: #f9f9f9;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        /* Muestra el menú desplegable cuando se hace clic en el botón */
        .show {
            display: block;
        }

        .btn-activo {
            background-color: #f3f4f6;
            /* color de fondo cuando está activo */
            color: #374151;
            /* color del texto cuando está activo */
        }
    </style>
    {{-- JS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        // Obtén todos los menús desplegables
        var dropdowns = document.getElementsByClassName("dropbtn");

        // Agrega un evento de clic a cada botón
        for (let i = 0; i < dropdowns.length; i++) {
            dropdowns[i].addEventListener("click", function(event) {
                event.stopPropagation();

                // Encuentra el contenido del menú desplegable correspondiente
                var dropdownContent = this.nextElementSibling;

                // Cierra todos los menús desplegables abiertos
                for (let j = 0; j < dropdowns.length; j++) {
                    var openDropdown = dropdowns[j].nextElementSibling;
                    if (openDropdown !== dropdownContent && openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }

                // Muestra u oculta el contenido del menú desplegable
                dropdownContent.classList.toggle("show");
            });
        }

        // Cierra todos los menús desplegables cuando se hace clic fuera de ellos
        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (let i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
</x-app-layout>
