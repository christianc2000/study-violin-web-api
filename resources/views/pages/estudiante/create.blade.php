<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl">
        <h5 class="text-2xl font-semibold mb-4">Crear Estudiante</h5>
        <div id="opcion">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                {{-- <h2 class="text-sm font-medium mb-4">Seleccione una opción</h2> --}}
                {{-- <form> --}}
                <div id="opcion" class="flex items-center space-x-4 mb-4">
                    <div class="flex items-center">
                        <input id="nuevo-estudiante" type="radio" name="radioEstudiante" value="1"
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                        <label for="nuevo-estudiante" class="ml-2 block text-sm font-medium text-gray-700">Nuevo
                            estudiante</label>
                    </div>
                    <div class="flex items-center ml-4">
                        <input id="old-estudiante" type="radio" name="radioEstudiante" value="2"
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                        <label for="old-estudiante" class="ml-2 block text-sm font-medium text-gray-700">Estudiante
                            existente</label>
                    </div>
                </div>
                {{-- <button type="submit"
                        class="mt-4 bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">Submit</button>
                </form> --}}

                <div id="datos-estudiante">
                    <form action="{{ route('admin.grupo.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <x-input-text id="nombre" name="nombre" />
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <x-textarea id="descripcion" name="descripcion"></x-textarea>
                        </div>

                        <div class="mb-3">
                            <label for="fecha_creacion" class="form-label">Fecha de Creación</label>
                            <x-input-text id="fecha_creacion" name="fecha_creacion" type="date" />
                        </div>

                        <div class="mb-3">
                            <label for="nivel_id" class="form-label">Nivel</label>
                            <x-select id="nivel_id" name="nivel_id">
                                @foreach ($niveles as $nivel)
                                    <option value="{{ $nivel->id }}">{{ $nivel->nombre }}</option>
                                @endforeach
                            </x-select>
                        </div>

                        <input type="hidden" name="profesor_id" value="{{ Auth::id() }}">

                        <x-button class="m-1">
                            <i class="ti ti-plus"></i> Guardar
                        </x-button>
                    </form>
                </div>
            </div>
        </div>
</x-app-layout>
