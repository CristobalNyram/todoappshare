# 📝 To Do Share App

**To Do Share App** es una aplicación web que permite a estudiantes gestionar tareas personales y compartirlas con otros usuarios. Ofrece funcionalidades como edición, filtrado, búsqueda, likes en tareas compartidas y más.

---

## 📦 Requisitos Previos

Antes de instalar la app, asegúrate de contar con lo siguiente:

- PHP ≥ 8.1.10
- Composer ≥ 2.4.1
- MySQL (o MariaDB)
- XAMPP, Laragon o similar para entorno local
- Base de datos `todoappshare` importada
- Navegador modern

---

## 🚀 Instalación

Sigue los siguientes pasos para levantar el proyecto en local:

### 1. Clona el repositorio
```bash
git clone https://github.com/CristobalNyram/todoappshare.git
cd todoappshare
```
### 2. Copia los archivos de configuración base

Renombra los siguientes archivos eliminando la extensión `.example`:

```bash
cp app/Config/env.php.example app/Config/env.php
cp app/Config/env.js.example app/Config/env.js
cp app/Database/db.php.example app/Database/db.php
```


### 3. Configura el entorno
Abre app/Config/env.php y configura según tu entorno:


```bash 
define("APP_ENV", 'DEV'); // Usa 'PRO' en producción
define("BASE_URL", "http://127.0.0.1/practicas/todoapp/");
define("BASE_URL_API", "http://127.0.0.1/practicas/todoapp/app/Api/");

define("JWT_SECRET", "todoapp2025");

define("DB_HOST", "localhost");
define("DB_NAME", "todoappshare");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_CHARSET", "utf8mb4");

date_default_timezone_set('America/Mexico_City');

```
### 🛠️ 3.1 Variables de configuración 
(`env.php`)

| Constante         | Descripción                                                                 |
|-------------------|-----------------------------------------------------------------------------|
| `APP_ENV`         | Define el entorno de ejecución (`DEV` para desarrollo, `PRO` para producción). |
| `BASE_URL`        | URL base del proyecto para cargar recursos (JS, CSS, imágenes, etc.).       |
| `BASE_URL_API`    | URL base de las APIs utilizadas en la app.                                 |
| `JWT_SECRET`      | Clave secreta usada para firmar y verificar los tokens JWT.                |
| `DB_HOST`         | Host del servidor de base de datos (por defecto `localhost`).              |
| `DB_NAME`         | Nombre de la base de datos a la que se conecta la app.                     |
| `DB_USER`         | Usuario de la base de datos.                                                |
| `DB_PASSWORD`     | Contraseña del usuario de base de datos.                                   |
| `DB_CHARSET`      | Codificación usada en las conexiones con la base de datos (`utf8mb4`).     |

> ⚠️ **Asegúrate de que el archivo `env.php` tenga los permisos adecuados y esté fuera del control de versiones.**

env.js
Edita también el archivo app/Config/env.js con:
```js
BASE_URL = "http://127.0.0.1/practicas/todoapp/";
BASE_URL_API = "http://127.0.0.1/practicas/todoapp/app/Api/";
LENGUAGE_DATATABLE = {
    "sEmptyTable": "No hay datos disponibles en la tabla",
    "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ registros",
    "sInfoEmpty": "Mostrando 0 a 0 de 0 registros",
    "sInfoFiltered": "(filtrado de _MAX_ registros en total)",
    "sLengthMenu": "Mostrar _MENU_ registros por página",
    "sLoadingRecords": "Cargando...",
    "sProcessing": "Procesando...",
    "sSearch": "Buscar:",
    "sZeroRecords": "No se encontraron registros coincidentes",
    "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Último",
        "sNext": "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    },
    "select": {
        "rows": {
            "_": "Seleccionado %d filas",
            "0": "Haga clic en una fila para seleccionarla",
            "1": "Seleccionado 1 fila"
        }
    }
};
```

### 3.2 Importa la base de datos
Importa el archivo SQL ubicado en:

``` bash
app/Database/bd.sql
```
Puedes hacerlo con PHPMyAdmin o vía línea de comandos:

``` bash 
mysql -u root -p todoappshare < app/Database/bd.sql
```


### 4. Instala dependencias PHP

Desde la raíz del proyecto, accede a la carpeta `app/` y ejecuta el siguiente comando:

```bash
cd app
composer install
```

### 📁 Estructura principal

```bash
todoappshare/
├── app/
│   ├── Config/        # Configuraciones del entorno (env.php, constantes, rutas base)
│   ├── Database/      # Conexión, configuración y helpers para la base de datos
│   ├── Api/           # Endpoints RESTful para manejar tareas, usuarios, auth, etc.
│   ├── includes/      # Includes PHP comunes reutilizables (scripts, footers, etc.)
│   └── Tools/         # Helpers, validaciones, managers de sesión, auth, permisos y JWT
├── assets/            # Archivos estáticos: imágenes, scripts, hojas de estilo, etc.
├── Pages/             # Vistas HTML y scripts JS del lado del cliente
├── layouts/           # Plantillas comunes (navbars, sidebars, head, footer) para las páginas
```


## ✅ Funcionalidades

- 📌 **Listado y filtrado de tareas** por estado:
  - Pendientes
  - Borrar
  - Completadas
  - Compartidas
  - Feed (tareas compartidas por otros usuarios)

- ✏️ **Edición y eliminación** de tareas personales.

- 👥 **Compartir y descompartir tareas** propias.

- 👍 **Likes en tareas compartidas**, con validación para evitar votos duplicados por usuario.

- 🔐 **Autenticación con JWT** para proteger los endpoints del sistema.

- 🎨 **Interfaz responsiva** construida con Bootstrap para una experiencia fluida en cualquier dispositivo.

## 📫 Prueba los endpoints en Postman

Puedes importar la colección de Postman y probar los endpoints fácilmente:

🔗 [Probar en Postman](https://app.getpostman.com/join-team?invite_code=ad98c3996f3688c47522459ffd67e6fcb39aab36f4a734f610af9cfc5ea67437&target_code=583cf1ac356484c8753598cadc8fbac2)

## 👨‍💻 Autor

**Cristobal Nyram**  
Todos los derechos reservados.  
📫 Contacto: [linkedin.com/in/cristobal-nyram](https://linkedin.com/in/cristobal-nyram)