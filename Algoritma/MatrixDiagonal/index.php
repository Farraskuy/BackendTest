<?php
$input = [
    [1, 2, 0],
    [4, 5, 6],
    [7, 8, 9]
];
$output = 0;

for ($i = 0; $i < count($input); $i++) {
    $output += $input[$i][$i] - $input[$i][count($input) - 1 - $i];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Algoritma | Selisih penjumlahan matrix diagonal</title>
</head>

<body>
    <p>Input: <?php print_r($input) ?></p>
    <p>Result: <?= $output ?></p>
</body>

</html>