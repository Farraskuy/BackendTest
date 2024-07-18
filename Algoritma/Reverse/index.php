<?php

$input = 'NEGIE1';
$output = [];

preg_match('/([a-z]+)([0-9]+)/i', $input, $output);

preg_match_all('/([a-z])/i', $output[1], $reverse);
$reverse = array_reverse($reverse[0]);
$reverse = implode('', $reverse);

$output = $reverse . $output[2];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Algoritma | Reverse</title>
</head>

<body>
    <p>Input: <?php print_r($input) ?></p>
    <p>Result: <?php print_r($output) ?></p>
</body>

</html>