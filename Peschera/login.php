<?php

echo '<link rel="stylesheet" href="http://localhost/ejercicios2024/act_prog/Peschera/style.css">';
// Establece las credenciales de conexión a la base de datos
$dbhost = "localhost"; // Nombre del servidor de la base de datos
$dbuser = "root"; // Nombre de usuario de la base de datos
$dbpass = ""; // Contraseña de la base de datos
$dbname = "user"; // Nombre de la base de datos

// Crea la conexión
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// Verifica la conexión
if (!$conn) {
    die("No hay conexión: " . mysqli_connect_error());
}

if (isset($_POST["txtusuario"]) && isset($_POST["txtpassword"]) && isset($_POST["tipo"])) {
    
    $nombre = mysqli_real_escape_string($conn, $_POST["txtusuario"]);
    $pass = mysqli_real_escape_string($conn, $_POST["txtpassword"]);
    $tipo = mysqli_real_escape_string($conn, $_POST["tipo"]);

    $query = mysqli_query($conn, "SELECT * FROM login WHERE usuario = '$nombre' AND password = '$pass'");

    if (mysqli_num_rows($query) == 1) {
        $user_data = mysqli_fetch_assoc($query);
        $user_type = $user_data['tipo']; 

        if ($user_type == $tipo) {
            if ($tipo == 'vendedor') {
                echo "<div class='result1 id='result1' name='result1''>";
                echo "<p>Bienvenido, vendedor: $nombre </p>"  ;
                echo "<p class='pp'>Su catalogo como vendedor se mostrara próximamente...</p>"  ;
                echo "<a class='a' href='login.html'><input type='button' value='Regresar' class='btn2'/></a>";
                echo "</div>";
            } else if ($tipo == 'usuario') {
                echo "<div class='result1 id='result1' name='result1''>";
                echo "<p>Bienvenido, usuario: $nombre </p>"  ;
                echo "<p class='pp'>Pronto se publicarán productos...</p>"  ;
                echo "<a class='a' href='login.html'><input type='button' value='Regresar' class='btn2'/></a>";
                echo "</div>";
            }
        } else {
            echo "<div class='result1 id='result1' name='result1''>";
            echo "<p>Revisa si realmente tienes ese rol</p>";
            echo "<a class='a' href='login.html'><input type='button' value='Regresar' class='btn2'/></a>";
            echo '</div>';
        }
    } else {
        echo "<div class='result1 id='result1' name='result1''>";
        echo "<p>No registrado</p>";
        echo "<a class='a' href='login.html'><input type='button' value='Regresar' class='btn2'/></a>";
        echo '</div>';
    }
} else {
    echo "Datos no fueron recibidos correctamente";
}

mysqli_close($conn);

?>