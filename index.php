<?php
$products = [
    "Taro" => 130,
    "Thai tea" => 140,
    "Matcha Cheesecake" => 145,
    "Okinawa" => 125
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $orderSummary = "";
    $totalAmount = 0;
    foreach ($products as $product => $price) {
        $qty = (int)($_POST['qty'][$product] ?? 0);
        if ($qty > 0) {
            $cost = $qty * $price;
            $orderSummary .= "$qty PC of $product. P$cost<br>";
            $totalAmount += $cost;
        }
    }
    $orderSummary = "You ordered:<br>$orderSummary<strong>Total: P$totalAmount</strong>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ordering System</title>
</head>
<body>
    <h2>Ordering System</h2>
    <form method="POST">
        <?php foreach ($products as $product => $price): ?>
            <div>
                <label>
                    <?= $product ?> - P<?= $price ?>
                </label>
                <input type="number" name="qty[<?= $product ?>]" value="0">
            </div>
        <?php endforeach; ?>
        <br>
        <button type="submit">Add to basket</button>
    </form>

    <?php if (isset($orderSummary)): ?>
        <div>
            <?= $orderSummary ?>
        </div>
    <?php endif; ?>
</body>
</html> 
