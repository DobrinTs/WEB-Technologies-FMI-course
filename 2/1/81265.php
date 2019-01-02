<!DOCTYPE html>
<html>

<head>
  <title> 81265 </title>
</head>

<body>
    <table border="1">
    <?php
        for ($i = 1; $i < 10; $i++) {
            if ($i === 1) {
                echo "<thead>";
            } elseif ($i === 2) {
                echo "<tbody>";
            }
            echo "<tr>";

            for ($j = 1; $j < 10; $j++) {
                $mult = $i * $j;
                if ($i === 1 || $j === 1) {
                    echo "<th> $mult </th>";
                } else {
                    echo "<td> $mult </td>";
                }
            }
            echo "</tr>";

            if ($i === 1) {
                echo "</thead>";
            } elseif ($i === 9) {
                echo "</tbody>";
            }
        }
    ?>
    </table>
</body>
</html>
