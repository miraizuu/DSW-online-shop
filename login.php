<?php
session_start();

// Procesar inicio de sesión.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $usuario = $_POST['usuario'];
  $contrasena = $_POST['contrasena'];
  if ($usuario === 'admin' && $contrasena === '1234') {
    $_SESSION['usuario'] = 'admin';
    header("Location: index.php");
    exit;
  } else {
    $_SESSION['usuario'] = 'normal';
    header("Location: index.php");
    exit;
  }
}

// Cargar preferencias
// Configuración de tema.
$tema = isset($_COOKIE['estilo']) ? $_COOKIE['estilo'] : 'claro';

// Configuración de idioma.
$idioma = isset($_COOKIE['idioma']) ? $_COOKIE['idioma'] : 'es';

// Diccionario para traducción.
$traducciones = [
  'es' => [
    'titulo' => 'Iniciar Sesión',
    'usuario' => 'Usuario',
    'contrasena' => 'Contraseña',
    'iniciar_sesion' => 'Iniciar Sesión',
  ],
  'en' => [
    'titulo' => 'Login',
    'usuario' => 'Username',
    'contrasena' => 'Password',
    'iniciar_sesion' => 'Login',
  ],
];
$texto = $traducciones[$idioma];

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Iniciar Sesión</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body class="<?php echo $tema; ?>">
  <header>
    <nav>
      <img src="img/logo.png" alt="Logo" style="width: 100px;">
    </nav>
  </header>
  <main>
    <form method="POST">
      <label for="usuario"><?php echo $texto['usuario']; ?>:</label>
      <input type="text" name="usuario" id="usuario" required>
      <br>
      <label for="contrasena"><?php echo $texto['contrasena']; ?>:</label>
      <input type="password" name="contrasena" id="contrasena" required>
      <br>
      <button type="submit"><?php echo $texto['iniciar_sesion']; ?></button>
    </form>
  </main>
</body>

</html>