# Gestor de Usuarios

Este es un proyecto de prueba técnica. El objetivo del proyecto es desarrollar un mantenedor que permita realizar las siguientes operaciones: Crear, Editar, Eliminar y Ver registros de usuarios. La información se obtiene desde la API proporcionada en el enlace:(https://randomuser.me/api/) y se guarda en una base de datos para poder mostrarla y editarla o eliminarla posteriormente

## Características

- Crear usuario
- Editar usuario
- Eliminar usuario
- Ver usuarios
- Importar usuario desde la API y guardarlo en la base de datos

## Tecnologías Utilizadas

- PHP
- MySQL
- HTML
- CSS
- JavaScript

## Requisitos

- Servidor web con PHP y MySQL (por ejemplo, XAMPP o WAMP)
- Navegador web

## Instalación

1. Clona o descarga el repositorio en tu servidor local.
2. Crea la base de datos MySQL utilizando el script SQL proporcionado en este repositorio:

    ```sql
    CREATE DATABASE randomuser;

    USE randomuser;

    CREATE TABLE users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        first_name VARCHAR(100) NOT NULL,
        last_name VARCHAR(100) NOT NULL,
        age INT NOT NULL,
        gender VARCHAR(10) NOT NULL,
        email VARCHAR(100) NOT NULL,
        country VARCHAR(100) NOT NULL,
        city VARCHAR(100) NOT NULL,
        picture_large VARCHAR(255) NOT NULL
    );
    ```

3. Configura la conexión a la base de datos en el archivo `db.php`:

    ```php
    <?php
    $host = 'localhost';
    $db = 'randomuser';
    $user = 'root';
    $pass = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Could not connect to the database $db :" . $e->getMessage());
    }
    ?>
    ```

4. Inicia tu servidor web y navega a la carpeta del proyecto (por ejemplo, `http://localhost/Prueba_Tecnica/index.php`).

## Uso

1. **Crear Usuario**: Completa el formulario en la sección "Crear/Actualizar Usuario" y haz clic en "Crear".
2. **Editar Usuario**: Haz clic en el botón "Editar" junto al usuario que deseas editar, realiza los cambios necesarios en el formulario y haz clic en "Actualizar".
3. **Eliminar Usuario**: Haz clic en el botón "Eliminar" junto al usuario que deseas eliminar.
4. **Importar Usuario desde API**: Haz clic en el botón "Importar Usuario desde API" para obtener un usuario aleatorio desde la API y guardarlo en la base de datos.

## Estructura del Proyecto

- `index.php`: Archivo principal que contiene la lógica del backend y la interfaz de usuario.
- `db.php`: Archivo de configuración para la conexión a la base de datos.
- `css/styles.css`: Archivo de estilos CSS para la interfaz de usuario.
- `js/script.js`: Archivo JavaScript que contiene la lógica para manejar el frontend.

## Video de Demostración

Incluye un video mostrando el funcionamiento de la aplicación, realizando las operaciones de crear, editar, eliminar, ver registros y también importar datos desde la API.

"# user-manager" 
