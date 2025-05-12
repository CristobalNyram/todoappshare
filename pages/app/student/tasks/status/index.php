<?php
$__USER__ = null;
$__ACTIVE_URL__ = "student/my-courses";
define("__ACTIVE_URL__", $__ACTIVE_URL__);
define("__DIR_BASE__LOCAL__", dirname(__FILE__) . "./../../../../../");
require_once(__DIR_BASE__LOCAL__ . "/app/Config/env.php");

UserSession::start();
if (!UserSession::isAuthenticated()) {
    Redirection::to("pages/auth/login/");
} else {
    $__USER__ = UserSession::getUser();
}
if (UserSession::isAuthenticated() && UserSession::isAdmin()) {
    Redirection::to("pages/auth/logout/");
}

$activeTab = $_GET['v'] ?? 'all';


?>
<!DOCTYPE html>
<html lang="en">
<?php include_once __DIR_BASE__LOCAL__ . "/layouts/e-learning/head.php" ?>
<style>
    .custom-checkbox label {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        border: 2px solid #dee2e6;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .custom-checkbox input:checked+label {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .custom-checkbox input:focus+label {
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }

    .custom-checkbox label i {
        font-size: 12px;
    }

    .custom-checkbox input:not(:checked)+label:hover {
        background-color: rgba(13, 110, 253, 0.1);
    }

    /* Custom extra small buttons */
    .btn-xs {
        padding: 0.15rem 0.4rem;
        font-size: 0.7rem;
        line-height: 1.2;
        border-radius: 0.2rem;
    }

    /* Hide text on small screens */
    @media (max-width: 767.98px) {
        .btn-text {
            display: none;
        }
    }
</style>

<body>

    <!--==================== Preloader Start ====================-->
    <div class="preloader">
        <div class="loader"></div>
    </div>
    <!--==================== Preloader End ====================-->

    <!--==================== Sidebar Overlay End ====================-->
    <div class="side-overlay"></div>
    <!--==================== Sidebar Overlay End ====================-->

    <!-- ============================ Sidebar Start ============================ -->
    <?php include_once __DIR_BASE__LOCAL__ . "layouts/e-learning/side-bar-student.php" ?>
    <!-- ============================ Sidebar End  ============================ -->

    <?php include_once __DIR_BASE__LOCAL__ . "/layouts/e-learning/nav-student.php" ?>


    <div class="dashboard-body">
        <!-- Breadcrumb Start -->
        <div class="breadcrumb mb-24">
            <ul class="flex-align gap-4">
                <li><a href="#" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                <li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
                <li><span class="text-main-600 fw-normal text-15">Mis tareas</span></li>
            </ul>
        </div>
        <!-- Breadcrumb End -->

        <!-- Course Tab Start -->
        <div class="card">
            <div class="card-body">
                <div class="mb-24">
                    <ul class="nav nav-pills common-tab gap-20" role="tablist">

                        <li class="nav-item" role="presentation">
                            <a href="<?php echo BASE_URL; ?>pages/app/student/tasks/status/?v=pending"
                                class="nav-link <?php echo ($activeTab === 'pending') ? 'active' : ''; ?>">
                                Pendientes
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="<?php echo BASE_URL; ?>pages/app/student/tasks/status/?v=completed"
                                class="nav-link <?php echo ($activeTab === 'completed') ? 'active' : ''; ?>">
                                Completadas
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="<?php echo BASE_URL; ?>pages/app/student/tasks/status/?v=shared"
                                class="nav-link <?php echo ($activeTab === 'shared') ? 'active' : ''; ?>">
                                Compartidas por mi
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="<?php echo BASE_URL; ?>pages/app/student/tasks/status/?v=feed"
                                class="nav-link <?php echo ($activeTab === 'feed') ? 'active' : ''; ?>">
                                Feed
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="tab-content mb-5" id="pills-tabContent">

                </div>


                <div class="mt-5 text-center" id="pagination-container"></div>

            </div>
        </div>
        <!-- Course Tab End -->

    </div>

    <?php include_once __DIR_BASE__LOCAL__ . "/layouts/e-learning/footer.php" ?>
    </div>

    <?php include_once __DIR_BASE__LOCAL__ . "app/includes/e-learning/script.php" ?>

    <!-- Modal Editar Tarea -->
    <div class="modal fade" id="modalEditarTarea" tabindex="-1" aria-labelledby="modalEditarTareaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="form-editar-tarea" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarTareaLabel">Editar Tarea</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_tarea" id="editar-id-tarea">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="editar-titulo" name="titulo" placeholder="Título" required>
                        <label for="editar-titulo">Título</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="editar-descripcion" name="descripcion" placeholder="Descripción" style="height: 100px;"></textarea>
                        <label for="editar-descripcion">Descripción</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal Agregar Tarea -->
    <div class="modal fade" id="modalAgregarTarea" tabindex="-1" aria-labelledby="modalAgregarTareaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="form-agregar-tarea" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAgregarTareaLabel">Agregar Nueva Tarea</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="agregar-titulo" name="titulo" placeholder="Título" required>
                        <label for="agregar-titulo">Título</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="agregar-descripcion" name="descripcion" placeholder="Descripción" style="height: 100px;"></textarea>
                        <label for="agregar-descripcion">Descripción</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Agregar Tarea</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $(function() {
                const token = localStorage.getItem('Tk');
                const BASE_API = BASE_URL_API + 'V1/Tasks/?action=list';
                const UPDATE_API = BASE_URL_API + 'V1/Tasks/?action=edit';
                const CREATE_API = BASE_URL_API + 'V1/Tasks/?action=create';
                const DELETE_API = BASE_URL_API + 'V1/Tasks/?action=delete';
                const SHARED_API = BASE_URL_API + 'V1/Tasks/?action=shared_list';
                const SHARED_TASK_API = BASE_URL_API + 'V1/Tasks/?action=share';
                const UNSHARED_TASK_API = BASE_URL_API + 'V1/Tasks/?action=unshare';
                const LIKE_TASK = BASE_URL_API + 'V1/Tasks/?action=like';
                const FEED_API = BASE_URL_API + 'V1/Tasks/?action=feed';



                const endpoints = {
                    pending: BASE_API + '&completada=0',
                    completed: BASE_API + '&completada=1',
                    shared: SHARED_API,
                    feed: FEED_API

                };

                const limit = 5;
                let currentPage = 1;
                let totalPages = 1;
                let currentFilters = {
                    titulo: '',
                    descripcion: ''
                };

                function renderCard(task) {
                    const compartidaLabel = task.compartida ? 'Descompartir' : 'Compartir';
                    const compartidaClass = task.compartida ? 'btn-warning' : 'btn-success';

                    return `
                    <div class="col-md-6 col-lg-4 card-wrapper" data-id="${task.id_tarea}">
                    <div class="card shadow border-0 rounded-4 h-100 ${task.completada ? 'bg-light' : ''}">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex align-items-center mb-3">
                                <div class="custom-checkbox me-3">
                                <input type="checkbox" id="task-${task.id_tarea}" class="toggle-status visually-hidden" 
                                    data-id="${task.id_tarea}" ${task.completada ? 'checked' : ''}>
                                <label for="task-${task.id_tarea}" class="d-flex align-items-center justify-content-center">
                                    <i class="fas fa-check text-white ${task.completada ? 'visible' : 'invisible'}"></i>
                                </label>
                                </div>
                                <h5 class="card-title mb-0 ${task.completada ? 'text-decoration-line-through text-muted' : ''}">${task.titulo}</h5>
                            </div>
                            
                            <div class="ps-4 ms-2">
                                <p class="card-text text-muted mb-1">${task.descripcion || 'Sin descripción'}</p>
                                <small class="text-muted">Creado: ${task.fecha_creacion || 'N/D'}</small>
                            </div>
                            
                            <div class="d-flex justify-content-end gap-1 mt-auto mt-2 pt-2">
                                <button class="btn ${compartidaClass} btn-xs btn-compartir" data-id="${task.id_tarea}" data-bs-toggle="tooltip" title="${compartidaLabel} tarea">
                                    <i class="fas fa-share-alt me-1"></i> ${compartidaLabel}
                                </button>
                                <button class="btn btn-primary btn-xs btn-editar" 
                                    data-id="${task.id_tarea}" 
                                    data-titulo="${task.titulo}" 
                                    data-descripcion="${task.descripcion}">
                                    <i class="fas fa-edit"></i>
                                    Editar
                                </button>
                                <button class="btn btn-danger btn-xs btn-borrar" 
                                    data-id="${task.id_tarea}">
                                    <i class="fas fa-trash"></i>
                                    Borrar
                                </button>
                            </div>
                        </div>
                    </div>
                    </div>`;
                }



                function renderSharedCard(item) {
                    const cursorClass = item.liked_by_me ? 'cursor-not-allowed text-muted' : 'cursor-pointer';

                    return `
                    <div class="col-md-6 col-lg-4 card-wrapper" data-id="${item.id_tarea_compartida}">
                        <div class="card border rounded-4 shadow-sm h-100">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-main-600">${item.titulo}</h5>
                                <p class="card-text text-muted">${item.descripcion || 'Sin descripción'}</p>
                                <p class="mb-1 text-gray-500 small">Compartido por: ${item.nombre} ${item.apellido_p}</p>
                                
                                <div class="mt-auto pt-2 border-top">
                                    <p class="text-muted small mb-1">
                                        <strong>Creado:</strong> ${item.fecha_creacion || 'N/D'}<br>
                                        <strong>Compartido:</strong> ${item.compartida_at || 'N/D'}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-${item.completada ? 'success' : 'secondary'}">
                                            ${item.completada ? 'Completada' : 'Pendiente'}
                                        </span>
                                        <span class="text-end small btn-like ${cursorClass}" data-id="${item.id_tarea_compartida}">
                                                <i class="fas fa-thumbs-up me-1"></i>${item.likes} 
                                                ${item.liked_by_me ? '<i class="text-success fas fa-check"></i>' : ''}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;
                }


                function renderPagination(tipo) {
                    const $pagination = $('#pagination-container');
                    $pagination.html('');

                    if (totalPages <= 1) return;

                    const prevDisabled = currentPage === 1 ? 'disabled' : '';
                    const nextDisabled = currentPage === totalPages ? 'disabled' : '';

                    const prevBtn = `<button class="btn btn-secondary btn-sm me-2" ${prevDisabled} id="prev-page">Anterior</button>`;
                    const nextBtn = `<button class="btn btn-secondary btn-sm" ${nextDisabled} id="next-page">Siguiente</button>`;

                    $pagination.append(prevBtn + nextBtn);

                    $('#prev-page').click(() => {
                        if (currentPage > 1) {
                            currentPage--;
                            fetchTasks(currentTab);
                        }
                    });

                    $('#next-page').click(() => {
                        if (currentPage < totalPages) {
                            currentPage++;
                            fetchTasks(currentTab);
                        }
                    });
                }

                function fetchTasks(tipo) {
                    const $container = $(`#cards-${tipo}`);
                    $container.html('<div class="col-12 text-center">Cargando...</div>');

                    $.ajax({
                        url: endpoints[tipo],
                        method: 'GET',
                        headers: {
                            'Authorization': `Bearer ${token}`
                        },
                        data: {
                            page: currentPage,
                            limit: limit,
                            titulo: currentFilters.titulo,
                            descripcion: currentFilters.descripcion
                        },
                        success: function(response) {
                            $container.empty();
                            if (!response.status || !response.data.length) {
                                $container.html('<div class="col-12 text-center text-muted">No hay tareas que mostrar.</div>');
                                return;
                            }

                            response.data.forEach(task => {
                                $container.append(renderCard(task));
                            });

                            totalPages = Math.ceil(response.records_filtered / limit);
                            renderPagination(tipo);

                            $('.toggle-status').off('change').on('change', function() {
                                const id = $(this).data('id');
                                const newStatus = $(this).is(':checked');

                                Swal.fire({
                                    title: '¿Estás seguro?',
                                    text: `¿Deseas marcar esta tarea como ${newStatus ? 'completada' : 'pendiente'}?`,
                                    icon: 'question',
                                    showCancelButton: true,
                                    confirmButtonText: 'Sí, cambiar',
                                    cancelButtonText: 'Cancelar'
                                }).then(result => {
                                    if (result.isConfirmed) {
                                        $.ajax({
                                            url: UPDATE_API,
                                            method: 'PUT',
                                            headers: {
                                                'Authorization': `Bearer ${token}`
                                            },
                                            contentType: 'application/json',
                                            data: JSON.stringify({
                                                id_tarea: id,
                                                completada: newStatus
                                            }),
                                            success: function() {
                                                $(`.card-wrapper[data-id="${id}"]`).remove();
                                                Swal.fire('Éxito', 'El estado fue actualizado.', 'success');
                                            },
                                            error: function() {
                                                Swal.fire('Error', 'No se pudo cambiar el estado.', 'error');
                                            }
                                        });
                                    } else {
                                        fetchTasks(tipo);
                                    }
                                });
                            });

                            $('.btn-editar').off('click').on('click', function() {
                                const id = $(this).data('id');
                                const titulo = $(this).data('titulo');
                                const descripcion = $(this).data('descripcion');
                                $('#editar-id-tarea').val(id);
                                $('#editar-titulo').val(titulo);
                                $('#editar-descripcion').val(descripcion);
                                $('#modalEditarTarea').modal('show');
                            });

                            $('#form-agregar-tarea').on('submit', function(e) {
                                e.preventDefault();
                                const titulo = $('#agregar-titulo').val();
                                const descripcion = $('#agregar-descripcion').val();

                                $.ajax({
                                    url: CREATE_API,
                                    method: 'POST',
                                    headers: {
                                        'Authorization': `Bearer ${token}`
                                    },
                                    contentType: 'application/json',
                                    data: JSON.stringify({
                                        titulo: titulo,
                                        descripcion: descripcion
                                    }),
                                    success: function(res) {
                                        $('#modalAgregarTarea').modal('hide');
                                        Swal.fire('Tarea agregada', 'Se agregó correctamente la tarea.', 'success');
                                        fetchTasks('pending'); // refresca la lista
                                        $('#form-agregar-tarea')[0].reset(); // limpia el formulario
                                    },
                                    error: function() {
                                        Swal.fire('Error', 'No se pudo agregar la tarea.', 'error');
                                    }
                                });
                            });

                            $('.btn-compartir').off('click').on('click', function() {
                                const id = $(this).data('id');
                                const $card = $(`.card-wrapper[data-id="${id}"]`);
                                const $btn = $card.find('.btn-compartir');
                                const yaCompartida = $btn.hasClass('btn-warning');

                                const mensaje = yaCompartida ?
                                    '¿Estás seguro de descompartir esta tarea?' :
                                    '¿Estás seguro de compartir esta tarea?';

                                const textoBtn = yaCompartida ? 'Sí, descompartir' : 'Sí, compartir';

                                Swal.fire({
                                    title: mensaje,
                                    icon: 'question',
                                    showCancelButton: true,
                                    confirmButtonText: textoBtn,
                                    cancelButtonText: 'Cancelar'
                                }).then(result => {
                                    if (result.isConfirmed) {
                                        $.ajax({
                                            url: yaCompartida ? UNSHARED_TASK_API : SHARED_TASK_API,
                                            method: yaCompartida ? 'PUT' : 'POST',
                                            headers: {
                                                'Authorization': `Bearer ${token}`
                                            },
                                            contentType: 'application/json',
                                            data: JSON.stringify({
                                                id_tarea: id
                                            }),
                                            success: function() {
                                                if (yaCompartida) {
                                                    $btn.removeClass('btn-warning')
                                                        .addClass('btn-success')
                                                        .html('<i class="fas fa-share-alt me-1"></i> Compartir')
                                                        .attr('title', 'Compartir tarea');

                                                    Swal.fire('Actualizado', 'La tarea fue descompartida.', 'success');
                                                } else {
                                                    $btn.removeClass('btn-success')
                                                        .addClass('btn-warning')
                                                        .html('<i class="fas fa-share-alt me-1"></i> Descompartir')
                                                        .attr('title', 'Descompartir tarea');

                                                    Swal.fire('Compartida', 'La tarea fue compartida.', 'success');
                                                }
                                            },
                                            error: function() {
                                                Swal.fire('Error', 'No se pudo actualizar el estado de compartida.', 'error');
                                            }
                                        });
                                    }
                                });
                            });

                            $('.btn-borrar').off('click').on('click', function() {
                                const id = $(this).data('id');
                                Swal.fire({
                                    title: '¿Estás seguro?',
                                    text: 'Esta acción no se puede deshacer.',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonText: 'Sí, borrar',
                                    cancelButtonText: 'Cancelar'
                                }).then(result => {
                                    if (result.isConfirmed) {
                                        $.ajax({
                                            url: DELETE_API,
                                            method: 'DELETE',
                                            headers: {
                                                'Authorization': `Bearer ${token}`
                                            },
                                            contentType: 'application/json',
                                            data: JSON.stringify({
                                                id_tarea: id
                                            }),
                                            success: function() {
                                                $(`.card-wrapper[data-id="${id}"]`).remove();
                                                Swal.fire('Borrado', 'La tarea fue eliminada.', 'success');
                                            },
                                            error: function() {
                                                Swal.fire('Error', 'No se pudo borrar la tarea.', 'error');
                                            }
                                        });
                                    }
                                });
                            });
                        },
                        error: function() {
                            $container.html('<div class="col-12 text-center text-danger">Error al cargar las tareas.</div>');
                        }
                    });
                }

                function renderSharedPagination() {
                    const $pagination = $('#pagination-container');
                    $pagination.html('');

                    if (totalPages <= 1) return;

                    const prevDisabled = currentPage === 1 ? 'disabled' : '';
                    const nextDisabled = currentPage === totalPages ? 'disabled' : '';

                    const prevBtn = `<button class="btn btn-secondary btn-sm me-2" ${prevDisabled} id="prev-page">Anterior</button>`;
                    const nextBtn = `<button class="btn btn-secondary btn-sm" ${nextDisabled} id="next-page">Siguiente</button>`;

                    $pagination.append(prevBtn + nextBtn);

                    $('#prev-page').click(() => {
                        if (currentPage > 1) {
                            currentPage--;
                            fetchSharedTasks();
                        }
                    });

                    $('#next-page').click(() => {
                        if (currentPage < totalPages) {
                            currentPage++;
                            fetchSharedTasks();
                        }
                    });
                }

                function fetchSharedTasks() {
                    const $container = $('#cards-shared');
                    $container.html('<div class="col-12 text-center">Cargando...</div>');

                    $.ajax({
                        url: endpoints.shared,
                        method: 'GET',
                        headers: {
                            'Authorization': `Bearer ${token}`
                        },
                        data: {
                            page: currentPage,
                            limit: limit
                        },
                        success: function(response) {
                            $container.empty();
                            if (!response.status || !response.data.length) {
                                $container.html('<div class="col-12 text-center text-muted">No hay tareas compartidas.</div>');
                                return;
                            }

                            response.data.forEach(item => {
                                $container.append(renderSharedCard(item));
                            });

                            totalPages = Math.ceil(response.records_total / limit);
                            renderSharedPagination();

                            $('.btn-like').off('click').on('click', function() {
                                const id = $(this).data('id');
                                const $btn = $(this);

                                // Prevenir doble like si ya dio like
                                if ($btn.find('i.text-success').length) {
                                    Swal.fire('Ya votaste', 'Ya diste like a esta tarea.', 'info');
                                    return;
                                }

                                $.ajax({
                                    url: LIKE_TASK,
                                    method: 'POST',
                                    headers: {
                                        'Authorization': `Bearer ${token}`
                                    },
                                    contentType: 'application/json',
                                    data: JSON.stringify({
                                        id_tarea_compartida: id
                                    }),
                                    success: function() {
                                        Swal.fire('Gracias', 'Tu like fue registrado.', 'success');
                                        fetchSharedTasks();
                                    },
                                    error: function() {
                                        Swal.fire('Error', 'No se pudo registrar el like.', 'error');
                                    }
                                });
                            });

                        },
                        error: function() {
                            $container.html('<div class="col-12 text-center text-danger">Error al cargar tareas compartidas.</div>');
                        }
                    });
                }

                function fetchFeedTasks() {
                    const $container = $('#cards-feed');
                    $container.html('<div class="col-12 text-center">Cargando...</div>');

                    $.ajax({
                        url: endpoints.feed,
                        method: 'GET',
                        headers: {
                            'Authorization': `Bearer ${token}`
                        },
                        data: {
                            page: currentPage,
                            limit: limit
                        },
                        success: function(response) {
                            $container.empty();
                            if (!response.status || !response.data.length) {
                                $container.html('<div class="col-12 text-center text-muted">No hay tareas compartidas.</div>');
                                return;
                            }

                            response.data.forEach(item => {
                                $container.append(renderSharedCard(item));
                            });

                            totalPages = Math.ceil(response.records_total / limit);
                            renderSharedPagination();

                            $('.btn-like').off('click').on('click', function() {
                                const id = $(this).data('id');
                                const $btn = $(this);

                                // Prevenir doble like si ya dio like
                                if ($btn.find('i.text-success').length) {
                                    Swal.fire('Ya votaste', 'Ya diste like a esta tarea.', 'info');
                                    return;
                                }

                                $.ajax({
                                    url: LIKE_TASK,
                                    method: 'POST',
                                    headers: {
                                        'Authorization': `Bearer ${token}`
                                    },
                                    contentType: 'application/json',
                                    data: JSON.stringify({
                                        id_tarea_compartida: id
                                    }),
                                    success: function() {
                                        Swal.fire('Gracias', 'Tu like fue registrado.', 'success');
                                        fetchFeedTasks();
                                    },
                                    error: function() {
                                        Swal.fire('Error', 'No se pudo registrar el like.', 'error');
                                    }
                                });
                            });

                        },
                        error: function() {
                            $container.html('<div class="col-12 text-center text-danger">Error al cargar tareas compartidas.</div>');
                        }
                    });
                }

                // Buscar y recargar tareas
                $(document).on('click', '#btn-filtrar', function() {
                    currentFilters.titulo = $('#filtro-titulo').val();
                    currentFilters.descripcion = $('#filtro-descripcion').val();
                    currentPage = 1;
                    fetchTasks(currentTab);
                });

                // Guardar edición desde modal
                $('#form-editar-tarea').on('submit', function(e) {
                    e.preventDefault();
                    const id = $('#editar-id-tarea').val();
                    const titulo = $('#editar-titulo').val();
                    const descripcion = $('#editar-descripcion').val();

                    $.ajax({
                        url: UPDATE_API,
                        method: 'PUT',
                        headers: {
                            'Authorization': `Bearer ${token}`
                        },
                        contentType: 'application/json',
                        data: JSON.stringify({
                            id_tarea: id,
                            titulo: titulo,
                            descripcion: descripcion
                        }),
                        success: function(res) {
                            console.log(res);
                            $('#modalEditarTarea').modal('hide');
                            Swal.fire('Actualizado', 'La tarea fue actualizada.', 'success');
                            fetchTasks(currentTab);
                        },
                        error: function() {
                            Swal.fire('Error', 'No se pudo actualizar la tarea.', 'error');
                        }
                    });
                });

                const activeTab = '<?php echo $activeTab; ?>';
                window.currentTab = activeTab;

                if (activeTab === 'pending') {
                    $('#pills-tabContent').html(`


                    <div class="row mb-4">
                        <div class="col-md-5">
                            <input id="filtro-titulo" type="text" class="form-control" placeholder="Buscar por título">
                        </div>
                        <div class="col-md-5">
                            <input id="filtro-descripcion" type="text" class="form-control" placeholder="Buscar por descripción">
                        </div>
                        <div class="col-md-2 d-flex gap-2">
                            <button id="btn-filtrar" class="btn btn-primary w-100">Buscar</button>
                  
                        </div>
                    </div>
                                        <div class="row mb-4 d-flex justify-content-end">
                        <button id="btn-agregar-tarea" class="btn btn-success" style="width: 150px;" data-bs-toggle="modal" data-bs-target="#modalAgregarTarea">
                            <i class="fas fa-plus"></i> <span class="btn-text">Agregar</span>
                        </button>
                    </div>
                    <hr class="pt-2 pb-2">
                    <div class="row g-4" id="cards-pending"></div>
                    `);
                    fetchTasks('pending');
                } else if (activeTab === 'completed') {
                    $('#pills-tabContent').html(`
                <div class="row mb-4">
                    <div class="col-md-5">
                    <input id="filtro-titulo" type="text" class="form-control" placeholder="Buscar por título">
                    </div>
                    <div class="col-md-5">
                    <input id="filtro-descripcion" type="text" class="form-control" placeholder="Buscar por descripción">
                    </div>
                    <div class="col-md-2">
                    <button id="btn-filtrar" class="btn btn-primary w-100">Buscar</button>
                    </div>
                </div>
                 <hr class="pt-2 pb-2">

                <div class="row g-4" id="cards-completed"></div>
                `);
                    fetchTasks('completed');
                } else if (activeTab === 'shared') {
                    $('#pills-tabContent').html('<div class="row g-4" id="cards-shared"></div>');
                    fetchSharedTasks();
                } else if (activeTab === 'feed') {
                    $('#pills-tabContent').html('<div class="row g-4" id="cards-feed"></div>');
                    fetchFeedTasks();

                } else {
                    window.location.href = BASE_URL + 'pages/app/student/tasks/status/?v=pending';
                }
            });
        });
    </script>
</body>

</html>