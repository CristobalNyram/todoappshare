<?php

use Symfony\Component\HttpFoundation\Request;
use Respect\Validation\Validator as v;
/**
 * Validates task creation request.
 */
function validateTaskCreate(Request $request): array
{
    $errors = [];

    if (!v::notEmpty()->length(3, 255)->validate($request->get('titulo'))) {
        $errors['titulo'] = 'Title is required and must be at least 3 characters.';
    }

    return $errors;
}

/**
 * Validates task update request.
 */
function validateTaskUpdate(Request $request): array
{
    $errors = [];

    if (!v::notEmpty()->validate($request->get('id_tarea'))) {
        $errors['id_tarea'] = 'Task ID is required.';
    }

    if ($request->get('titulo') !== null && !v::length(3, 255)->validate($request->get('titulo'))) {
        $errors['titulo'] = 'Title must be at least 3 characters.';
    }

    return $errors;
}

function validateTaskShare(Request $request): array
{
    $errors = [];

    if (!v::notEmpty()->intVal()->validate($request->get('id_tarea'))) {
        $errors['id_tarea'] = 'El ID de la tarea es obligatorio.';
    }

    return $errors;
}

function validateTaskUnshare(Request $request): array
{
    $errors = [];

    if (!v::notEmpty()->intVal()->validate($request->get('id_tarea'))) {
        $errors['id_tarea'] = 'El ID de la tarea compartida es obligatorio.';
    }

    return $errors;
}

function validateTaskLike(Request $request): array
{
    $errors = [];

    if (!v::notEmpty()->intVal()->validate($request->get('id_tarea_compartida'))) {
        $errors['id_tarea_compartida'] = 'El ID de la tarea compartida es obligatorio.';
    }

    return $errors;
}