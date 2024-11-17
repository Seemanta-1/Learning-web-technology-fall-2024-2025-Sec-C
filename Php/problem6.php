<?php
$numbers = array(10, 20, 30, 40, 50, 60);

$search = 30;

$flag = false;

for ($i = 0; $i < count($numbers); $i++) {
    if ($numbers[$i] == $search) {
        echo "Element $search found at index $i.";
        $flag = true;
        break;
    }
}

if (!$flag) {
    echo "Element $search not found in the array.";
}
?>
