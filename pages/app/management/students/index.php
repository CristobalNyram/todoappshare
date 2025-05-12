<?php
$__USER__ = null;
$__ACTIVE_URL__ = "students";
define("__ACTIVE_URL__", $__ACTIVE_URL__);
define("__DIR_BASE__LOCAL__",dirname(__FILE__)."./../../../../");
require_once(__DIR_BASE__LOCAL__."/app/Config/env.php");
require_once(__DIR_BASE__LOCAL__."/app/Database/db.php");

UserSession::start();
if (!UserSession::isAuthenticated()) {
    Redirection::to( "pages/auth/login/");
}else{
    $__USER__ = UserSession::getUser();
}

?>
<!DOCTYPE html>
<html lang="en">
<?php include_once __DIR_BASE__LOCAL__."/layouts/e-learning/head.php" ?> 
<body>
<!--==================== Preloader Start ====================-->
  <div class="preloader">
    <div class="loader"></div>
  </div>
<!--==================== Preloader End ====================-->

<!--==================== Sidebar Overlay End ====================-->
<div class="side-overlay"></div>
<!--==================== Sidebar Overlay End ====================-->

<?php include_once __DIR_BASE__LOCAL__."layouts/e-learning/side-bar.php" ?>

<?php include_once __DIR_BASE__LOCAL__."layouts/e-learning/nav.php" ?>

<div class="dashboard-body">
    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
            <div class="breadcrumb mb-24">
                <ul class="flex-align gap-4">
                    <li><a href="<?php echo BASE_URL; ?>pages/e-learning/management/dashboard/" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                    <li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
                    <li><span class="text-main-600 fw-normal text-15">Students</span></li>
                </ul>
            </div>

            <!-- Filtros -->
            <div class="flex-align gap-8 flex-wrap">
                    <div class="position-relative text-gray-500 flex-align gap-4 text-13">
                        <span class="text-inherit">Filtros: </span>
                        <div class="flex-align text-gray-500 text-13 border border-gray-100 rounded-4 ps-20 focus-border-main-600 bg-white">
                            <span class="text-lg"><i class="ph ph-user"></i></span>
                            <input type="text" id="filtro-nombre" class="form-control ps-8 pe-20 py-16 border-0 text-inherit rounded-4" placeholder="Filtrar por nombre">
                        </div>
                    </div>
                    <div class="flex-align text-gray-500 text-13 border border-gray-100 rounded-4 ps-20 focus-border-main-600 bg-white">
                        <span class="text-lg"><i class="ph ph-envelope"></i></span>
                        <input type="text" id="filtro-correo" class="form-control ps-8 pe-20 py-16 border-0 text-inherit rounded-4" placeholder="Filtrar por correo">
                    </div>
                    <div  class="flex-align text-gray-500 text-13 border border-gray-100 rounded-4 ps-20 focus-border-main-600 bg-white cursor-pointer">
                        <span class="text-lg"><i class="ph ph-magnifying-glass"></i></span>
                        <button id="btn-filtrar" class="form-control ps-8 pe-20 py-16 border-0 text-inherit rounded-4 text-center bg-transparent">Buscar</button>
                    </div>
                    <div  class="flex-align text-gray-500 text-13 border border-gray-100 rounded-4 ps-20 focus-border-main-600 bg-white cursor-pointer">
                        <span class="text-lg"><i class="ph ph-x"></i></span>
                        <button id="btn-limpiar" class="form-control ps-8 pe-20 py-16 border-0 text-inherit rounded-4 text-center bg-transparent">Limpiar</button>
                    </div>
                </div>
    </div>
            <!-- Tabla de Alumnos -->
            <div class="container mt-5 bg-white shadow-sm rounded-4 p-4">

                <div class="d-flex justify-content-end mb-4 mt-3">
                    <button id="btn-nuevo-usuario" type="button" class="btn btn-success">
                        <i class="bi bi-person-plus-fill me-1"></i> Nuevo Alumno
                    </button>
                </div>

                <!-- Tabla responsiva -->
                <div class="table-responsive mb-5 shadow-sm rounded-4 overflow-hidden">
                    <table id="tabla-alumnos" class="table table-hover align-middle table-bordered mb-0 bg-white h6 mb-0 fw-medium text-gray-300">
                        <thead class="table-light">
                            <tr>
                                <th class="h6 text-gray-300">Alumno ID</th>
                                <th class="h6 text-gray-300">Usuario ID</th>
                                <th class="h6 text-gray-300">Estudiante</th>
                                <th class="h6 text-gray-300">Apellido</th>
                                <th class="h6 text-gray-300">Teléfono</th>
                                <th class="h6 text-gray-300">Correo</th>
                                <th class="h6 text-gray-300">Carrera</th>
                                <th class="h6 text-gray-300">Estatus</th>
                                <th class="text-center h6 text-gray-300">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="alumnos-body">
                            <!-- Contenido dinámico -->
                        </tbody>
                    </table>

                        <!--  Modal para agregar nuevo alumno  -->
                        <div class="modal fade" id="modalNuevoAlumno" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <form id="form-nuevo-alumno" class="modal-content shadow rounded-4">
                                    <div class="modal-header bg-light border-bottom-0">
                                        <h5 class="modal-title" id="modalLabel">Agregar Nuevo Alumno</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body row g-3 px-4 py-3">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
                                                <label>Nombre</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" name="usuario" class="form-control" placeholder="Usuario">
                                                <label>Usuario</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" name="apellido" class="form-control" placeholder="Apellido paterno" required>
                                                <label>Apellido paterno</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" name="apellido_m" class="form-control" placeholder="Apellido materno" required>
                                                <label>Apellido materno</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <input type="text" name="sexo" class="form-control" placeholder="Sexo (M/F)" required>
                                                <label>Sexo (M/F)</label>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-floating">
                                                <input type="email" name="correo" class="form-control" placeholder="Correo" required>
                                                <label>Correo</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="password" name="contrasenia" class="form-control" placeholder="Contraseña" required>
                                                <label>Contraseña</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-floating">
                                                <input type="text" name="telefono" class="form-control" placeholder="Teléfono" required>
                                                <label>Teléfono</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-floating">
                                                <input type="text" name="carrera" class="form-control" placeholder="Carrera" required>
                                                <label>Carrera</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-light border-top-0">
                                        <button type="submit" class="btn btn-primary px-4">
                                            <i class="bi bi-save me-1"></i> Guardar
                                        </button>
                                        <button type="button" class="btn btn-danger px-4" data-bs-dismiss="modal">
                                            <i class="bi bi-x-circle me-1"></i> Cancelar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Modal editar -->
                        <div class="modal fade" id="modalEditarAlumno" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <form id="form-editar-alumno" class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalEditarLabel">Editar Alumno</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="id_usuario">
                                        <input type="hidden" name="id_alumno">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="nombre" placeholder="Nombre" required>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="usuario" placeholder="Usuario">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="apellido_p" placeholder="Apellido paterno" required>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="apellido_m" placeholder="Apellido materno" required>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="sexo" placeholder="Sexo (M/F)" required>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="email" class="form-control" name="correo" placeholder="Correo" required>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="telefono" placeholder="Teléfono" required>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="carrera" placeholder="Carrera" required>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" name="contrasenia" placeholder="Contraseña">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-light border-top-0">
                                        <button type="submit" class="btn btn-primary px-4">
                                            <i class="bi bi-pencil-square me-1"></i> Actualizar
                                        </button>
                                        <button type="button" class="btn btn-danger px-4" data-bs-dismiss="modal">
                                            <i class="bi bi-x-circle me-1"></i> Cancelar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Modal estatus 1 activo 2 inactivo -->
                        <div class="modal fade" id="modalCambiarEstatus" tabindex="-1" aria-labelledby="modalCambiarEstatusLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalCambiarEstatusLabel">
                                            <i class="bi bi-exclamation-triangle-fill text-warning me-2"></i> Confirmar Cambio de Estatus
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <p class="fs-5 mb-3">¿Estás seguro de que deseas cambiar el estatus del alumno?</p>
                                        <input type="hidden" id="cambio-estatus-id-alumno">
                                        <input type="hidden" id="cambio-estatus-valor">
                                    </div>
                                    <div class="modal-footer justify-content-center bg-light border-top-0">
                                        <button type="button" id="btn-confirmar-cambio" class="btn btn-primary px-4">
                                            <i class="bi bi-check-circle me-1"></i> Confirmar
                                        </button>
                                        <button type="button" class="btn btn-danger px-4" data-bs-dismiss="modal">
                                            <i class="bi bi-x-circle me-1"></i> Cancelar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
</div>


<?php include_once __DIR_BASE__LOCAL__."layouts/e-learning/footer.php" ?>

<?php include_once __DIR_BASE__LOCAL__."app/includes/e-learning/script.php" ?>

<!-- Script para inicializar DataTables -->
<script>
const dtUserTable = $('#tabla-alumnos');

$(function () {
    'use strict';

    const token = localStorage.getItem('Tk');
    const url = BASE_URL_API + 'V1/Students/?action=list';

if (dtUserTable.length) {
    const tabla = dtUserTable.DataTable({
        serverSide: true,
        processing: true,
        ajax: {
            url: url,
            method: 'GET',
            dataSrc: 'data',
            data: function(d) {
                d.limit = d.length;
                d.page = Math.floor(d.start / d.length) + 1;
                d.nombre = $('#filtro-nombre').val();
                d.correo = $('#filtro-correo').val();
                delete d.columns;
                delete d.order;
                delete d.search;
                delete d.start;
                delete d.length;
                delete d.draw;
            },
            beforeSend: function (xhr) {
                xhr.setRequestHeader("Authorization", `Bearer ${token}`);
            }
        },
        pageLength: 10,
        lengthMenu: [1, 10, 25, 50, 100],
        searching: false,
        language: LENGUAGE_DATATABLE,
        order: [[0, 'asc']],
        columns: [
            { data: 'id_alumno' },
            { data: 'id_usuario' },
            { data: 'nombre' },
            { data: 'apellido_p' },
            { data: 'telefono' },
            { data: 'correo' },
            { data: 'carrera' },
                { 
                    data: 'estatus',
                    render: function(data) {
                        const estatus = data === 1 || data === '1' ? 'Activo' : 'Inactivo';
                        const bgClass = data === 1 || data === '1' ? 'bg-success-50' : 'bg-danger-50';
                        const textClass = data === 1 || data === '1' ? 'text-success-600' : 'text-danger-600';
                        const dotClass = data === 1 || data === '1' ? 'bg-success-600' : 'bg-danger-600';
                        
                        return `<span class="text-13 py-2 px-8 ${bgClass} ${textClass} d-inline-flex align-items-center gap-8 rounded-pill">
                                    <span class="w-6 h-6 ${dotClass} rounded-circle flex-shrink-0"></span>
                                    ${estatus}
                                </span>`;
                    }
                },
                {
                    data: null,
                    render: function (data, type, row) {
                        const esActivo = row.estatus === 1 || row.estatus === '1';
                        // Botón de editar
                        const btnEditar = `
                            <button class="btn btn-icon btn-primary btn-editar" data-id="${row.id_alumno}" data-bs-toggle="tooltip" title="Editar alumno">
                                <i class="fas fa-edit"></i>
                            </button>`;
                        // Botón de cambiar estatus
                        const btnEstatus = esActivo 
                            ? `<button class="btn btn-icon btn-danger btn-cambiar-estatus" data-id="${row.id_alumno}" data-estatus="2" data-bs-toggle="tooltip" title="Desactivar alumno">
                                <i class="fas fa-user-slash"></i>
                            </button>`
                            : `<button class="btn btn-icon btn-success btn-cambiar-estatus" data-id="${row.id_alumno}" data-estatus="1" data-bs-toggle="tooltip" title="Activar alumno">
                                <i class="fas fa-user-check"></i>
                            </button>`;
                            
                        return `<div class="d-flex gap-2 justify-content-center">
                            ${btnEditar}
                            ${btnEstatus}
                        </div>`;
                    },
                    orderable: false
                }
            ],
            responsive: true,
            autoWidth: false,
            drawCallback: function() {
                // Inicializar tooltips después de dibujar la tabla
                $('[data-bs-toggle="tooltip"]').tooltip();
            }
        });
        
        $('#btn-filtrar').on('click', function(e) {
            e.preventDefault();
            tabla.ajax.reload();
        });

        // Botón para limpiar filtros
        $('#btn-limpiar').on('click', function() {
            $('#filtro-nombre').val('');
            $('#filtro-correo').val('');
            tabla.ajax.reload();
        });
    
        // Mostramos el modal de nuevo usuario
        $('#btn-nuevo-usuario').on('click', function () {
            $('#modalNuevoAlumno').modal('show');
        });

        // Enviar formulario para crear un nuevo usuario
        $('#form-nuevo-alumno').on('submit', function (e) {
            e.preventDefault();

            const token = localStorage.getItem('Tk');
            const url = BASE_URL_API + 'V1/Students/?action=create';

            const formData = {
                nombre: $('[name="nombre"]').val(),
                usuario: $('[name="usuario"]').val(),
                apellido_p: $('[name="apellido"]').val(),
                apellido_m: $('[name="apellido_m"]').val(),
                sexo: $('[name="sexo"]').val(),
                correo: $('[name="correo"]').val(),
                contrasenia: $('[name="contrasenia"]').val(),
                telefono: $('[name="telefono"]').val(),
                carrera: $('[name="carrera"]').val()
            };

            $.ajax({
                url: url,
                method: 'POST',
                headers: {
                    "Authorization": `Bearer ${token}`
                },
                contentType: 'application/json',
                data: JSON.stringify(formData),
                success: function (response) {
                    $('#modalNuevoAlumno').modal('hide');
                    $('#form-nuevo-alumno')[0].reset();
                    $('#tabla-alumnos').DataTable().ajax.reload();
                    
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: 'Alumno creado correctamente'
                    });
                },
                error: function (xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error al crear alumno: ' + (xhr.responseJSON?.message || xhr.statusText)
                    });
                }
            });
        });

        //Rellenamos los campos de alumno a editar
        $('#tabla-alumnos tbody').on('click', '.btn-editar', function () {
            const tabla = $('#tabla-alumnos').DataTable();
            const data = tabla.row($(this).closest('tr')).data();
            $('#form-editar-alumno [name="id_usuario"]').val(data.id_usuario);
            $('#form-editar-alumno [name="id_alumno"]').val(data.id_alumno);
            $('#form-editar-alumno [name="nombre"]').val(data.nombre);
            $('#form-editar-alumno [name="usuario"]').val(data.usuario);
            $('#form-editar-alumno [name="apellido_p"]').val(data.apellido_p);
            $('#form-editar-alumno [name="apellido_m"]').val(data.apellido_m);
            $('#form-editar-alumno [name="contrasenia"]').val(data.contrasenia);
            $('#form-editar-alumno [name="sexo"]').val(data.sexo);
            $('#form-editar-alumno [name="correo"]').val(data.correo);
            $('#form-editar-alumno [name="telefono"]').val(data.telefono);
            $('#form-editar-alumno [name="carrera"]').val(data.carrera);

            $('#modalEditarAlumno').modal('show');
        });

        // Enviar los datos a actualizar desde el formulario
        $('#form-editar-alumno').on('submit', function (e) {
            e.preventDefault();

            const token = localStorage.getItem('Tk');
            const url = BASE_URL_API + 'V1/Students/?action=edit';

            const formData = {
                id_usuario: $('#form-editar-alumno [name="id_usuario"]').val(),
                id_alumno: $('#form-editar-alumno [name="id_alumno"]').val(),
                nombre: $('#form-editar-alumno [name="nombre"]').val(),
                usuario: $('#form-editar-alumno [name="usuario"]').val(),
                apellido_p: $('#form-editar-alumno [name="apellido_p"]').val(),
                apellido_m: $('#form-editar-alumno [name="apellido_m"]').val(),
                contrasenia: $('#form-editar-alumno [name="contrasenia"]').val(),
                sexo: $('#form-editar-alumno [name="sexo"]').val(),
                correo: $('#form-editar-alumno [name="correo"]').val(),
                telefono: $('#form-editar-alumno [name="telefono"]').val(),
                carrera: $('#form-editar-alumno [name="carrera"]').val()
            };

            $.ajax({
                url: url,
                method: 'PUT',
                headers: {
                    "Authorization": `Bearer ${token}`
                },
                contentType: 'application/json',
                data: JSON.stringify(formData),
                success: function () {
                    $('#modalEditarAlumno').modal('hide');
                    $('#tabla-alumnos').DataTable().ajax.reload();
                
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: 'Alumno actualizado correctamente'
                    });
                    
                },
                error: function (xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error al actualizar: ' + (xhr.responseJSON?.message || xhr.statusText)
                    });
                }
            });
        });

        // Evento para abrir el modal de cambio de estatus
        $('#tabla-alumnos tbody').on('click', '.btn-cambiar-estatus', function () {
            const id_alumno = $(this).data('id');
            const nuevoEstatus = $(this).data('estatus');
            const estatusTexto = nuevoEstatus === '1' || nuevoEstatus === 1 ? 'activar' : 'desactivar';
            
            $('#cambio-estatus-id-alumno').val(id_alumno);
            $('#cambio-estatus-valor').val(nuevoEstatus);
            
            // Actualizar texto del modal según el tipo de cambio
            $('#modalCambiarEstatusLabel').text(`Confirmar ${estatusTexto} alumno`);
            $('.modal-body p').text(`¿Estás seguro de que deseas ${estatusTexto} este alumno?`);
            
            $('#modalCambiarEstatus').modal('show');
        });

        // Confirmar cambio de estatus
        $('#btn-confirmar-cambio').on('click', function() {
            const token = localStorage.getItem('Tk');
            const url = BASE_URL_API + 'V1/Students/?action=edit-estatus';
            
            const id_alumno = $('#cambio-estatus-id-alumno').val();
            const nuevoEstatus = $('#cambio-estatus-valor').val();
            
            const formData = {
                id_alumno: id_alumno,
                id_usuario: id_alumno,
                estatus: nuevoEstatus
            };
            
            $.ajax({
                url: url,
                method: 'PUT',
                headers: {
                    "Authorization": `Bearer ${token}`
                },
                contentType: 'application/json',
                data: JSON.stringify(formData),
                success: function() {
                    $('#modalCambiarEstatus').modal('hide');
                    $('#tabla-alumnos').DataTable().ajax.reload();
                    
                    const estatusTexto = nuevoEstatus === '1' || nuevoEstatus === 1 ? 'activado' : 'desactivado';
                    
                        Swal.fire({
                            icon: 'success',
                            title: '¡Éxito!',
                            text: `Alumno ${estatusTexto} correctamente`
                        });
                    
                },
                error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error al cambiar estatus: ' + (xhr.responseJSON?.message || xhr.statusText)
                        });
                }
            });
        });
    }
});
</script>


    <script>
        function createChart(chartId, chartColor) {

            let currentYear = new Date().getFullYear();

            var options = {
            series: [
                {
                    name: 'series1',
                    data: [18, 25, 22, 40, 34, 55, 50, 60, 55, 65],
                },
            ],
            chart: {
                type: 'area',
                width: 80,
                height: 42,
                sparkline: {
                    enabled: true // Remove whitespace
                },

                toolbar: {
                    show: false
                },
                padding: {
                    left: 0,
                    right: 0,
                    top: 0,
                    bottom: 0
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 1,
                colors: [chartColor],
                lineCap: 'round'
            },
            grid: {
                show: true,
                borderColor: 'transparent',
                strokeDashArray: 0,
                position: 'back',
                xaxis: {
                    lines: {
                        show: false
                    }
                },   
                yaxis: {
                    lines: {
                        show: false
                    }
                },  
                row: {
                    colors: undefined,
                    opacity: 0.5
                },  
                column: {
                    colors: undefined,
                    opacity: 0.5
                },  
                padding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: 0
                },  
            },
            fill: {
                type: 'gradient',
                colors: [chartColor], // Set the starting color (top color) here
                gradient: {
                    shade: 'light', // Gradient shading type
                    type: 'vertical',  // Gradient direction (vertical)
                    shadeIntensity: 0.5, // Intensity of the gradient shading
                    gradientToColors: [`${chartColor}00`], // Bottom gradient color (with transparency)
                    inverseColors: false, // Do not invert colors
                    opacityFrom: .5, // Starting opacity
                    opacityTo: 0.3,  // Ending opacity
                    stops: [0, 100],
                },
            },
            // Customize the circle marker color on hover
            markers: {
                colors: [chartColor],
                strokeWidth: 2,
                size: 0,
                hover: {
                    size: 8
                }
            },
            xaxis: {
                labels: {
                    show: false
                },
                categories: [`Jan ${currentYear}`, `Feb ${currentYear}`, `Mar ${currentYear}`, `Apr ${currentYear}`, `May ${currentYear}`, `Jun ${currentYear}`, `Jul ${currentYear}`, `Aug ${currentYear}`, `Sep ${currentYear}`, `Oct ${currentYear}`, `Nov ${currentYear}`, `Dec ${currentYear}`],
                tooltip: {
                    enabled: false,
                },
            },
            yaxis: {
                labels: {
                    show: false
                }
            },
            tooltip: {
                x: {
                    format: 'dd/MM/yy HH:mm'
                },
            },
            };

            var chart = new ApexCharts(document.querySelector(`#${chartId}`), options);
            chart.render();
        }

        // Call the function for each chart with the desired ID and color
        createChart('complete-course', '#2FB2AB');
        createChart('earned-certificate', '#27CFA7');
        createChart('course-progress', '#6142FF');
        createChart('community-support', '#FA902F');


        // =========================== Double Line Chart Start ===============================
        function createLineChart(chartId, chartColor) {
            var options = {
            series: [
                {
                    name: 'Study',
                    data: [8, 15, 9, 20, 10, 33, 13, 22, 8, 17, 10, 15],
                },
                {
                    name: 'Test',
                    data: [8, 24, 18, 40, 18, 48, 22, 38, 18, 30, 20, 28],
                },
            ],
            chart: {
                type: 'area',
                width: '100%',
                height: 300,
                sparkline: {
                    enabled: false // Remove whitespace
                },
                toolbar: {
                    show: false
                },
                padding: {
                    left: 0,
                    right: 0,
                    top: 0,
                    bottom: 0
                }
            },
            colors: ['#3D7FF9', chartColor],  // Set the color of the series
            dataLabels: {
                enabled: false,
            },
            stroke: {
                curve: 'smooth',
                width: 1,
                colors: ["#3D7FF9", chartColor],
                lineCap: 'round',
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.9,  // Decrease this value to reduce opacity
                    opacityTo: 0.2,    // Decrease this value to reduce opacity
                    stops: [0, 100]
                }
            },
            grid: {
                show: true,
                borderColor: '#E6E6E6',
                strokeDashArray: 3,
                position: 'back',
                xaxis: {
                    lines: {
                        show: false
                    }
                },   
                yaxis: {
                    lines: {
                        show: true
                    }
                },  
                row: {
                    colors: undefined,
                    opacity: 0.5
                },  
                column: {
                    colors: undefined,
                    opacity: 0.5
                },  
                padding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: 0
                },  
            },
            // Customize the circle marker color on hover
            markers: {
                colors: ["#3D7FF9", chartColor],
                strokeWidth: 3,
                size: 0,
                hover: {
                    size: 8
                }
            },
                xaxis: {
                    labels: {
                        show: false
                    },
                    categories: [`Jan`, `Feb`, `Mar`, `Apr`, `May`, `Jun`, `Jul`, `Aug`, `Sep`, `Oct`, `Nov`, `Dec`],
                    tooltip: {
                        enabled: false,        
                    },
                    labels: {
                        formatter: function (value) {
                            return value;
                        },
                        style: {
                            fontSize: "14px"
                        }
                    },
                },
                yaxis: {
                        labels: {
                            formatter: function (value) {
                                return "$" + value + "Hr";
                            },
                            style: {
                                fontSize: "14px"
                            }
                        },
                },
                tooltip: {
                    x: {
                        format: 'dd/MM/yy HH:mm'
                    },
                },
                legend: {
                    show: false,
                    position: 'top',
                    horizontalAlign: 'right',
                    offsetX: -10,
                    offsetY: -0
                }
            };

            var chart = new ApexCharts(document.querySelector(`#${chartId}`), options);
            chart.render();
        }
        createLineChart('doubleLineChart', '#27CFA7');
        // =========================== Double Line Chart End ===============================

        // ================================= Multiple Radial Bar Chart Start =============================
        var options = {
            series: [100, 60, 25],
            chart: {
                height: 172,
                type: 'radialBar',
            },
            colors: ['#3D7FF9', '#27CFA7', '#020203'], 
            stroke: {
                lineCap: 'round',
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        size: '30%',  // Adjust this value to control the bar width
                    },
                    dataLabels: {
                        name: {
                            fontSize: '16px',
                        },
                        value: {
                            fontSize: '16px',
                        },
                        total: {
                            show: true,
                            formatter: function (w) {
                                return '82%'
                            }
                        }
                    }
                }
            },
            labels: ['Completed', 'In Progress', 'Not Started'],
        };

        var chart = new ApexCharts(document.querySelector("#radialMultipleBar"), options);
        chart.render();
        // ================================= Multiple Radial Bar Chart End =============================

        // ========================== Export Js Start ==============================
        document.getElementById('exportOptions').addEventListener('change', function() {
            const format = this.value;
            const table = document.getElementById('studentTable');
            let data = [];
            const headers = [];
            
            // Get the table headers
            table.querySelectorAll('thead th').forEach(th => {
                headers.push(th.innerText.trim());
            });

            // Get the table rows
            table.querySelectorAll('tbody tr').forEach(tr => {
                const row = {};
                tr.querySelectorAll('td').forEach((td, index) => {
                    row[headers[index]] = td.innerText.trim();
                });
                data.push(row);
            });

            if (format === 'csv') {
                downloadCSV(data);
            } else if (format === 'json') {
                downloadJSON(data);
            }
        });

        function downloadCSV(data) {
            const csv = data.map(row => Object.values(row).join(',')).join('\n');
            const blob = new Blob([csv], { type: 'text/csv' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'students.csv';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        }

        function downloadJSON(data) {
            const json = JSON.stringify(data, null, 2);
            const blob = new Blob([json], { type: 'application/json' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'students.json';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        }
        // ========================== Export Js End ==============================
        
    </script>
    </body>
</html>