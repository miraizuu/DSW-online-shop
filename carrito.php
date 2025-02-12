<?php
// Obtener carrito y productos.
$carrito = isset($_COOKIE['carrito']) ? json_decode($_COOKIE['carrito'], true) : [];
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

// Calcular totales.
$totalCantidad = 0;
$totalPrecio = 0;
foreach ($carrito as $id => $cantidad) {
  $totalCantidad += $cantidad;
  $totalPrecio += $productos[$id]['precio'] * $cantidad;
}

// Vaciar carrito.
if (isset($_GET['vaciar'])) {
  setcookie('carrito', '', time() - 3600, "/"); // Elimina la cookie del carrito.
  header("Location: carrito.php");
  exit;
}

// Configuración de tema.
$tema = isset($_COOKIE['estilo']) ? $_COOKIE['estilo'] : 'claro';

// COnfiguración de idioma.
$idioma = isset($_COOKIE['idioma']) ? $_COOKIE['idioma'] : 'es';

?>

<!DOCTYPE html>
<html lang="es" class="<?php echo $tema; ?>">

<head>
  <meta charset="UTF-8">
  <title>Carrito</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body class="<?php echo $tema; ?>">
  <header>
    <nav>
      <img src="img/logo.png" alt="Logo" style="width: 100px;">
      <a href="index.php"><?php if ($_COOKIE['idioma'] === 'es'): ?>Volver a Tienda<?php else: ?>Home<?php endif; ?></a>
    </nav>
  </header>
  <main>
    <?php if ($_COOKIE['idioma'] === 'es'): ?>
      <h1>🛒Carrito</h1>
    <?php else: ?>
      <h1>🛒Cart</h1>
    <?php endif; ?>
   <?php if (!empty($carrito)): ?>
    <div class="container">
      <ul>
        <?php foreach ($carrito as $id => $cantidad): ?>
          <div class="card-container">
            <li>
              <img src="<?php echo $productos[$id]['imagen']; ?>" alt="<?php echo $productos[$id]['nombre']; ?>" style="width: 100px;">
              <?php echo $productos[$id]['nombre']; ?> - Cantidad: <?php echo $cantidad; ?> - Precio: <?php echo $productos[$id]['precio'] * $cantidad; ?>€
            </li>
          </div>
        <?php endforeach; ?>
      </ul>
    </div>
    <p>Total de Productos: <?php echo $totalCantidad; ?></p>
    <p>Precio Total: <?php echo $totalPrecio; ?>€</p>
    <a href="carrito.php?vaciar">Vaciar Carrito</a>
   <?php else: ?>
    <p>Su carrito está vacío.</p>
   <?php endif; ?>
  </main>
</body>

</html>