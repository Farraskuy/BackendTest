<?php
$input = ['xc', 'dz', 'bbb', 'dz'];
$query = ['bbb', 'ac', 'dz'];
$output = [];

foreach ($query as $item) {
    $result = array_filter($input, function ($search) use ($item) {
        return $item == $search;
    });
    array_push($output, count($result));
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Algoritma | Array Matcher</title>
</head>

<body>
    <p>Input: <?php print_r($input) ?></p>
    <p>Query: <?php print_r($query) ?></p>
    <p>Result: <?php print_r($output) ?></p>
</body>
</html>