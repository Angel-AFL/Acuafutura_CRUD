@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Formulario Empleados</h3>
        </div>

        <form id="formEmpleado">
            <div class="card-body">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" required>
                </div>
                <div class="form-group">
                    <label for="edad">Edad</label>
                    <input type="number" class="form-control" id="edad" name="edad" required>
                </div>
                <div class="form-group">
                    <label for="correo">Correo</label>
                    <input type="email" class="form-control" id="correo" name="correo" required>
                </div>
            </div>
            <div class="card-footer">
                @if(auth()->user()->rol_id == 1 || auth()->user()->rol_id == 3 || auth()->user()->rol_id == 4)
                    <button type="submit" class="btn btn-primary">Agregar</button>
                @endif
            </div>
        </form>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lista de Empleados</h3>
        </div>
        <div class="card-body">
            <table id="tablaEmpleados" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Edad</th>
                        <th>Correo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal para Ver Empleado -->
    <div class="modal fade" id="modalEmpleado" tabindex="-1" role="dialog" aria-labelledby="modalEmpleadoLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEmpleadoLabel">Ver Empleado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="modal_nombre">Nombre</label>
                        <p id="modal_nombre"></p>
                    </div>
                    <div class="form-group">
                        <label for="modal_apellido">Apellido</label>
                        <p id="modal_apellido"></p>
                    </div>
                    <div class="form-group">
                        <label for="modal_edad">Edad</label>
                        <p id="modal_edad"></p>
                    </div>
                    <div class="form-group">
                        <label for="modal_correo">Correo</label>
                        <p id="modal_correo"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Editar Empleado -->
    <div class="modal fade" id="modalEditarEmpleado" tabindex="-1" role="dialog" aria-labelledby="modalEditarEmpleadoLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarEmpleadoLabel">Editar Empleado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditarEmpleado">
                        <input type="hidden" id="editar_id" name="id">
                        <div class="form-group">
                            <label for="editar_nombre">Nombre</label>
                            <input type="text" class="form-control" id="editar_nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="editar_apellido">Apellido</label>
                            <input type="text" class="form-control" id="editar_apellido" name="apellido" required>
                        </div>
                        <div class="form-group">
                            <label for="editar_edad">Edad</label>
                            <input type="number" class="form-control" id="editar_edad" name="edad" required>
                        </div>
                        <div class="form-group">
                            <label for="editar_correo">Correo</label>
                            <input type="email" class="form-control" id="editar_correo" name="correo" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    @if(auth()->user()->rol_id == 1 || auth()->user()->rol_id == 3)
                        <button type="submit" form="formEditarEmpleado" class="btn btn-primary">Guardar cambios</button>
                    @endif
                </div>
            </div>
        </div>
    </div>

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
@stop


@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            function cargarEmpleados() {
                $.ajax({
                    url: "{{ route('empleados.listar') }}",
                    type: "GET",
                    success: function (data) {
                        let tbody = $("#tablaEmpleados tbody");
                        tbody.empty();
                        data.forEach(empleado => {
                            let fila = `<tr>
                                <td>${empleado.nombre}</td>
                                <td>${empleado.apellido}</td>
                                <td>${empleado.edad}</td>
                                <td>${empleado.correo}</td>
                                <td>
                                    <button class="btn btn-info btn-sm verEmpleado" data-id="${empleado.id}">👁️ Ver</button>
                                    @if(auth()->user()->rol_id == 1)
                                        <button class="btn btn-warning btn-sm editarEmpleado" data-id="${empleado.id}">✏️ Editar</button>
                                    @endif
                                    @if(auth()->user()->rol_id == 1 || auth()->user()->rol_id == 3)
                                        <button class="btn btn-danger btn-sm eliminarEmpleado" data-id="${empleado.id}">🗑️ Eliminar</button>
                                    @endif
                                </td>
                            </tr>`;
                            tbody.append(fila);
                        });
                    }
                });
            }

            cargarEmpleados(); // Cargar empleados al iniciar

            // Agregar empleados
            $("#formEmpleado").submit(function (event) {
                event.preventDefault();
                $.ajax({
                    url: "{{ route('empleados.agregar') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function () {
                        $("#formEmpleado")[0].reset();
                        cargarEmpleados(); // Recargar la lista de empleados
                    }
                });
            });

            // Eliminar empleado
            $(document).on("click", ".eliminarEmpleado", function () {
                let id = $(this).data("id");
                if (confirm("¿Estás seguro de que quieres eliminar este empleado?")) {
                    $.ajax({
                        url: "/empleados/eliminar/" + id,
                        type: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function () {
                            cargarEmpleados(); // Recargar la lista
                        }
                    });
                }
            });

            // Ver empleado
            $(document).on("click", ".verEmpleado", function () {
                let id = $(this).data("id");
                $.ajax({
                    url: "/empleados/show/" + id,
                    type: "GET",
                    success: function (data) {
                        $("#modal_nombre").text(data.nombre);
                        $("#modal_apellido").text(data.apellido);
                        $("#modal_edad").text(data.edad);
                        $("#modal_correo").text(data.correo);
                        
                        // Mostrar el modal
                        $("#modalEmpleado").modal('show');
                    }
                });
            });

            // Editar empleado
            $(document).on("click", ".editarEmpleado", function () {
                let id = $(this).data("id");
                $.ajax({
                    url: "/empleados/show/" + id,
                    type: "GET",
                    success: function (data) {
                        $("#editar_id").val(data.id);
                        $("#editar_nombre").val(data.nombre);
                        $("#editar_apellido").val(data.apellido);
                        $("#editar_edad").val(data.edad);
                        $("#editar_correo").val(data.correo);

                        $("#modalEditarEmpleado").modal('show');
                    }
                });
            });

            // Guardar los cambios del empleado
            $("#formEditarEmpleado").submit(function (event) {
                event.preventDefault();
                let id = $("#editar_id").val();
                $.ajax({
                    url: "/empleados/actualizar/" + id,
                    type: "PUT",
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function () {
                        $("#modalEditarEmpleado").modal('hide');
                        cargarEmpleados();
                    }
                });
            });
        });
    </script>
@stop
