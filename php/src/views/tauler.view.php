<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taula de Dames</title>
    <link rel="stylesheet" href="../css/damero.css">
</head>
<body>
  <div class="taula-de-dames">
    <?php
          for ($fila = 0; $fila < 8; $fila++) {
              for ($columna = 0; $columna < 8; $columna++) {
                  // Alternem els colors de les caselles
                  $classeCasella = ($fila + $columna) % 2 == 0 ? 'blanc' : 'negre';
                  echo "<div class='$classeCasella'></div>";
              }
          }
  ?>
  </div>
</body>
</html>
