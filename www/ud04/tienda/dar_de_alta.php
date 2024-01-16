<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tienda IES San Clemente </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>

    <?php
        //Bloque php para comprobar si llegan datos POST y dar de alta a un usuario con ellos.
        include ("lib/base_datos.php");
        include ("lib/utilidades.php");
        //Inicializamos las variables del formulario.
        $mensajes = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
            if (empty($_POST["nombre"]) || empty($_POST["apellidos"]) || empty($_POST["edad"] || empty($_POST["contraseña"]))) {
                $mensajes =  "Falta algún dato obligatorio del formulario";
            } else {
                $nombre = test_input($_POST["nombre"]);
                $apellidos = test_input($_POST["apellidos"]);
                $edad = test_input($_POST["edad"]);
                $provincia = test_input($_POST["provincia"]);
                $pass = test_input($_POST["contraseña"]);
                $pass_hasheado = password_hash($pass, PASSWORD_DEFAULT);

                $resultado = alta_usuario($nombre, $apellidos, $edad, $provincia, $pass_hasheado);

                $mensajes = $resultado ? "Usuario dado de alta correctamente" : "Error en el alta del usuario en la base de datos";
            }
        }
    ?>

    <div class="container">

        <header class="mb-4 bg-light">
            <h1 class="display-4 text-center">Tienda IES San Clemente</h1>

            <nav class="navbar navbar-light bg-light">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="dar_de_alta.php">Alta usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="listar.php">Listar usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dar_de_alta_productos.php">Alta productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Cerrar sesión</a>
                    </li>
                </ul>
            </nav>
        </header>

        <article>
            <div class="container-fluid bg-white min-vh-100">
                <h2 class="text-center mt-4 mb-4">Alta de usuario</h2>
                <p class="text-center mb-0">Formulario de alta</p>

                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="mx-auto"
                    style="max-width: 400px;">

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" required />
                    </div>

                    <div class="mb-3">
                        <label for="apellidos" class="form-label">Apellidos:</label>
                        <input type="text" class="form-control" name="apellidos" id="apellidos" required />
                    </div>

                    <div class="mb-3">
                        <label for="contraseña" class="form-label">Contraseña:</label>
                        <input type="password" class="form-control" name="contraseña" id="contraseña" required />
                    </div>

                    <div class="mb-3">
                        <label for="edad" class="form-label">Edad:</label>
                        <input type="number" class="form-control" name="edad" id="edad" min="0" max="200" required />
                    </div>

                    <div class="mb-3">
                        <label for="provincia" class="form-label">Provincia:</label>
                        <input type="text" class="form-control" name="provincia" id="provincia" required />
                    </div>

                    <div class="mb-3 text-center">
                        <input type="submit" class="btn btn-primary" name="submit" value="Alta Usuario" />
                    </div>
                </form>

    <footer>
        <p>
            <a href='index.php'>Página de inicio</a>
        </p>
    </footer>
</body>

</html>