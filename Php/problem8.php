<?php
$array = [
    [1, 2, 3, 'A'],
    [1, 2, 'B', 'C'],
    [1, 'D', 'E', 'F']
];

echo "Left Side:<br>";
for ($i = 0; $i < count($array); $i++) {
    for ($j = 0; $j < count($array[$i]); $j++) {
        if (is_int($array[$i][$j])) {
            echo $array[$i][$j] . " ";
        }
    }
    echo "<br>";
}

echo "<br>Right Side:<br>";
for ($i = 0; $i < count($array); $i++) {
    for ($j = 0; $j < count($array[$i]); $j++) {
        if (is_string($array[$i][$j])) {
            echo $array[$i][$j] . " ";
        }
    }
    echo "<br>";
}
?>
