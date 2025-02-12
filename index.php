<?php
session_start();

$str = "aHR0cHM6Ly93d3cueW91dHViZS5jb20vd2F0Y2g/dj1mQzdvVU9VRUVpNA=="; // 👀

// Verificar si el usuario está autenticado.
if (!isset($_SESSION['usuario'])) {
  header("Location: login.php");
  exit;
}

// Configuración de tema.
$tema = isset($_COOKIE['estilo']) ? $_COOKIE['estilo'] : 'claro';

// Verificar si el usuario es administrador.
$esAdmin = isset($_SESSION['usuario']) && $_SESSION['usuario'] === 'admin';

// Configuración de idioma.
$idioma = isset($_COOKIE['idioma']) ? $_COOKIE['idioma'] : 'es';

// Diccionario para traducción.
$traducciones = [
  'es' => [
    'bienvenido_admin' => 'Bienvenido, Administrador',
    'mensaje_admin' => '¡Tienes acceso total a la tienda!',
    'productos_disponibles' => 'Productos Disponibles',
    'precio' => 'Precio',
    'agregar_carrito' => 'Agregar al carrito',
    'carrito' => 'Carrito',
    'preferencias' => 'Preferencias',
    'cerrar_sesion' => 'Cerrar Sesión',
  ],
  'en' => [
    'bienvenido_admin' => 'Welcome, Administrator',
    'mensaje_admin' => 'You have full access to the store!',
    'productos_disponibles' => 'Available Products',
    'precio' => 'Price',
    'agregar_carrito' => 'Add to Cart',
    'carrito' => 'Cart',
    'preferencias' => 'Preferences',
    'cerrar_sesion' => 'Log Out',
  ],
];
$texto = $traducciones[$idioma];

// Lista de productos con imágenes.
$productos = [
  ['id' => 0, 'nombre' => 'Metal Gear Solid 3', 'precio' => 40.00, 'imagen' => 'img/producto1.jpg'],
  ['id' => 1, 'nombre' => 'Resident Evil 2 Remake', 'precio' => 35.00, 'imagen' => 'img/producto2.jpg'],
  ['id' => 2, 'nombre' => 'ICO', 'precio' => 25.00, 'imagen' => 'img/producto3.jpg'],
  ['id' => 3, 'nombre' => 'Destiny', 'precio' => 10.00, 'imagen' => 'img/producto4.jpg'],
  ['id' => 4, 'nombre' => 'The Last of Us 2', 'precio' => 60.00, 'imagen' => 'img/producto5.jpg'],
  ['id' => 5, 'nombre' => 'Super Mario Galaxy 2', 'precio' => 25.00, 'imagen' => 'img/producto6.jpg'],
  ['id' => 6, 'nombre' => "Assassin's Creed", 'precio' => 20.00, 'imagen' => 'img/producto7.jpg'],
  ['id' => 7, 'nombre' => 'Sonic The Hedgehog 2', 'precio' => 100.00, 'imagen' => 'img/producto8.jpg']
];

// Agregar productos al carrito.
if (isset($_GET['agregar'])) {
  $id = $_GET['agregar'];
  $carrito = isset($_COOKIE['carrito']) ? json_decode($_COOKIE['carrito'], true) : [];
  $carrito[$id] = isset($carrito[$id]) ? $carrito[$id] + 1 : 1;
  setcookie('carrito', json_encode($carrito), time() + 3600, "/");
  header("Location: index.php");
  exit;
}

?>
<!DOCTYPE html>
<html lang="<?php echo $idioma; ?>">

<head>
  <meta charset="UTF-8">
  <title>Index</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body class="<?php echo $tema; ?>">
  <header>
    <nav>
      <img src="img/logo.png" alt="Logo" style="width: 100px;">
      <a href="carrito.php"><?php echo $texto['carrito']; ?></a>
      <a href="preferencias.php"><?php echo $texto['preferencias']; ?></a>
      <?php if ($_SESSION['usuario'] === 'admin'): ?>
        <a href="<?php echo base64_decode($str) ?>" target=_blank>Admin</a>
      <?php endif; ?>
      <a href="logout.php"><?php echo $texto['cerrar_sesion']; ?></a>
    </nav>
  </header>
  <main>
    <?php if ($esAdmin): ?>
      <h2><?php echo $texto['bienvenido_admin']; ?></h2>
      <p><?php echo $texto['mensaje_admin']; ?></p>
    <?php endif; ?>
    <h2><?php echo $texto['productos_disponibles']; ?></h2>
    <div class="productos">
      <?php foreach ($productos as $producto): ?>
        <div class="producto">
          <img src="<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>">
          <h3><?php echo $producto['nombre']; ?></h3>
          <p><?php echo $texto['precio']; ?>: <?php echo $producto['precio']; ?>€</p>
          <a href="index.php?agregar=<?php echo $producto['id']; ?>"><?php echo $texto['agregar_carrito']; ?></a>
        </div>
      <?php endforeach; ?>
    </div>
  </main>
</body>

</html>