## Documentación de ParvuloAPI.

*Bienvenido a ParvuloAPI, una solución de API-REST que te permite administrar tu establecimiento de manera eficiente y sencilla. Con ParvuloAPI puedes almacenar toda la información importante sobre tus alumnos,cursos,personal y asistencia, todo en un mismo lugar.*

## Tecnologías utilizadas en ParvuloAPI
*ParvuloAPI ha sido desarrollado utilizando Laravel 9 como framework de PHP y la base de datos se ha implementado en MySQL.*

## Descripción de roles.
*Con ParvuloAPI, puede acceder a diferentes capacidades según su rol. Aquí está una descripción de las capacidades de cada rol:*
> *Rol Directora:*
> - *Gestiona todos tus alumnos, apoderados, personal y asistencia agregándolos o actualizándolos.*
> - *Administra todos los registro de asistencia de los alumnos.*
> - *Administra todas las matrícula de alumnos.*
> - *Consulta todos los cursos con sus respectivos alumnos.*

> *Rol Educadora:*
> - *Administra todos los registro de asistencia de los alumnos.*
> - *Consulta todas las matrícula de alumnos.*
> - *Consulta todos los cursos con sus respectivos alumnos.*


## Atención importante: restricciones de implementación
*Antes de implementar la API-REST de ParvuloAPI, por favor tenga en cuenta las siguientes restricciones:*
> *Acceso a funciones de la API-REST:*
> - *Para acceder a cualquier funcionalidad de la API-REST, se requerirá un token de autenticación obtenido tras iniciar sesión como directora o educadora.*

> *Registro de asistencia:*
> - *Solo se puede registrar una asistencia por curso. Si el usuario intenta registrar la asistencia nuevamente, no podrá hacerlo. Solo el usuario director puede actualizar una asistencia ya registrada.*
> - *La asistencia registrada se asocia automáticamente al identificador de usuario del usuario autenticado.*
> - *Solo los usuarios con rol de directora y educadoras tienen permiso para registrar asistencias

## Cómo implementar ParvuloAPI.
> *Clone este repositorio:*
```
https://github.com/NicolasOrrego/ParvuloAPI_Laravel.git
```
> *Instalación de dependencias.*
```
composer install
```
> *Instalación de paquetes NPM.*
```
npm install
```
> *Creamos el archivo .env*
```
 copy .env.example .env
```
> *Ejecución de migraciones*
```
 php artisan migrate
```
## Rutas de ParvuloAPI.
1. *Auntenticación*
> - http://127.0.0.1:8000/api/v1/registrarse
> - http://127.0.0.1:8000/api/v1/login
> - http://127.0.0.1:8000/api/v1/logout

2. *Directora*
> *Informacion personal*
> - http://127.0.0.1:8000/api/v1/directora
> - http://127.0.0.1:8000/api/v1/directora/informacion
> - http://127.0.0.1:8000/api/v1/directora/deshabilitar/cuenta

> *CRUD usuario*
> - http://127.0.0.1:8000/api/v1/directora/registrar/usuario
> - http://127.0.0.1:8000/api/v1/directora/lista/usuarios
> - http://127.0.0.1:8000/api/v1/directora/buscar/usuario/{id}
> - http://127.0.0.1:8000/api/v1/directora/modificar/usuario/{id}
> - http://127.0.0.1:8000/api/v1/directora/eliminar/usuario/{id}

> *CRUD apoderado*
> - http://127.0.0.1:8000/api/v1/directora/registrar/apoderado
> - http://127.0.0.1:8000/api/v1/directora/lista/apoderado
> - http://127.0.0.1:8000/api/v1/directora/buscar/apoderado/{id}
> - http://127.0.0.1:8000/api/v1/directora/modificar/apoderado/{id}
> - http://127.0.0.1:8000/api/v1/directora/eliminar/apoderado/{id}

> *CRUD curso*
> - http://127.0.0.1:8000/api/v1/directora/registrar/curso
> - http://127.0.0.1:8000/api/v1/directora/lista/curso
> - http://127.0.0.1:8000/api/v1/directora/buscar/curso/{id}
> - http://127.0.0.1:8000/api/v1/directora/modificar/curso/{id}
> - http://127.0.0.1:8000/api/v1/directora/eliminar/curso/{id}

> *CRUD alumno*
> - http://127.0.0.1:8000/api/v1/directora/registrar/alumno
> - http://127.0.0.1:8000/api/v1/directora/lista/alumno
> - http://127.0.0.1:8000/api/v1/directora/buscar/alumno/{id}
> - http://127.0.0.1:8000/api/v1/directora/modificar/alumno/{id}
> - http://127.0.0.1:8000/api/v1/directora/eliminar/alumno/{id}

> *CRUD asistencia alumno*
> - http://127.0.0.1:8000/api/v1/directora/registrar/asistencia
> - http://127.0.0.1:8000/api/v1/directora/lista/asistencias
> - http://127.0.0.1:8000/api/v1/directora/buscar/asistencia/{fecha}/{id_curso}
> - http://127.0.0.1:8000/api/v1/directora/modificar/asistencia/{id}
> - http://127.0.0.1:8000/api/v1/directora/eliminar/asistencia/{id}

3. *Educadora*
> *Informacion personal*
> - http://127.0.0.1:8000/api/v1/educadora
> - http://127.0.0.1:8000/api/v1/educadora/informacion
> - http://127.0.0.1:8000/api/v1/educadora/deshabilitar/cuenta

> *Apoderado*
> - http://127.0.0.1:8000/api/v1/educadora/lista/apoderados
> - http://127.0.0.1:8000/api/v1/educadora/buscar/apoderado/{id}

> *Curso*
> - http://127.0.0.1:8000/api/v1/educadora/lista/curso
> - http://127.0.0.1:8000/api/v1/educadora/buscar/curso/{id}

> *Alumno*
> - http://127.0.0.1:8000/api/v1/educadora/lista/alumnos
> - http://127.0.0.1:8000/api/v1/educadora/buscar/alumno/{id}

> *Asistencia alumno*
> - http://127.0.0.1:8000/api/v1/educadora/registrar/asistencia
> - http://127.0.0.1:8000/api/v1/educadora/lista/asistencias
> - http://127.0.0.1:8000/api/v1/educadora/buscar/asistencia/{fecha}/{id_curso}

