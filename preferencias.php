<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  setcookie('idioma', $_POST['idioma'], time() + 3600, "/");
  setcookie('estilo', $_POST['estilo'], time() + 3600, "/");
  header("Location: preferencias.php");
  exit;
}

// Cargar preferencias.
$idioma = isset($_COOKIE['idioma']) ? $_COOKIE['idioma'] : 'es';
$estilo = isset($_COOKIE['estilo']) ? $_COOKIE['estilo'] : 'claro';
?>
<!DOCTYPE html>
<html lang="es" >

<head>
  <meta charset="UTF-8">
  <title>Preferencias</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body class="<?php echo $estilo; ?>">
  <header>
    <nav>
      <img src="img/logo.png" alt="Logo" style="width: 100px;">
      <?php if ($_COOKIE['idioma'] === 'es'): ?>
        <a href="index.php">Inicio</a>
        <a href="carrito.php">Carrito</a>
        <a href="preferencias.php">Preferencias</a>
        <a href="logout.php">Cerrar Sesión</a>
      <?php else: ?>
        <a href="index.php">Home</a>
        <a href="carrito.php">Cart</a>
        <a href="preferencias.php">Preferences</a>
        <a href="logout.php">Logout</a>
      <?php endif; ?>    
    </nav>
  </header>

  <?php if ($_COOKIE['idioma'] === 'es'): ?>
    <h1>Preferencias</h1>
  <?php else: ?>
    <h1>Preferences</h1>
  <?php endif; ?>
  <form method="POST">
  <?php if ($_COOKIE['idioma'] === 'es'): ?>
  <label for="idioma">Idioma:</label>
    <select name="idioma" id="idioma">
      <option value="es" <?php echo $idioma === 'es' ? 'selected' : ''; ?>>Español</option>
      <option value="en" <?php echo $idioma === 'en' ? 'selected' : ''; ?>>Inglés</option>
    </select>
    <br>
    <label for="estilo">Estilo:</label>
    <select name="estilo" id="estilo">
      <option value="claro" <?php echo $estilo === 'claro' ? 'selected' : ''; ?>>Claro</option>
      <option value="oscuro" <?php echo $estilo === 'oscuro' ? 'selected' : ''; ?>>Oscuro</option>
    </select>
    <br>
    <button type="submit">Guardar</button>
    <?php else: ?>
    <label for="idioma">Language:</label>
    <select name="idioma" id="idioma">
      <option value="en" <?php echo $idioma === 'en' ? 'selected' : ''; ?>>English</option>
      <option value="es" <?php echo $idioma === 'es' ? 'selected' : ''; ?>>Spanish</option>
    </select>
    <br>
    <label for="estilo">Style:</label>
    <select name="estilo" id="estilo">
      <option value="claro" <?php echo $estilo === 'claro' ? 'selected' : ''; ?>>Light</option>
      <option value="oscuro" <?php echo $estilo === 'oscuro' ? 'selected' : ''; ?>>Dark</option>
    </select>
    <br>
    <button type="submit">Save</button>
    <?php endif; ?>
  </form>
</body>

</html>