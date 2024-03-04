<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Llista de Partides</title>
    <!-- Afegeix aquí els teus enllaços a CSS o JavaScript si n'hi ha -->
</head>
<body>
    <table>
        <thead>
        <tr>
            <th>Id</th>
            <th>Fecha</th>
            <th>Operacions</th>
        </tr>
        </thead>
        <tbody>
        <?php

        /** @var TYPE_NAME $partides */
        foreach ($partides as $partida) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($partida->getId()) . "</td>";
             echo "<td>" . htmlspecialchars($partida->getDatetime()) . "</td>";
             echo "<td>";
             echo "<a href='loadGame.php?id=" . $partida->getId() . "'>Mostra</a> | ";
             echo "<a href='deleteGame.php?id=" . $partida->getId() . "' onclick='return confirm(\"Estàs segur?\")'>Elimina</a>";
             echo "</td>";
             echo "</tr>";
         }
        ?>
        </tbody>
    </table>
</body>
</html>

