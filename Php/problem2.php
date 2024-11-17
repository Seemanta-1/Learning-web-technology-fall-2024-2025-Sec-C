<?php
function calculateVat($amount) {
    return $amount*.15;
}

$amount = 900;   

$vat = calculateVat($amount);

echo "Amount: $amount <br>";
echo "VAT: $vat <br>";
?>

