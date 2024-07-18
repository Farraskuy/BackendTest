<?php
$input = 'Saya sangat senang mengerjakan soal algoritma';
$output = str_word_count($input);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Algoritma | Word Count</title>
</head>

<body>
    <p>Input: <?php print_r($input) ?></p>
    <p>Result: <?php print_r($output) ?></p>
</body>

</html>