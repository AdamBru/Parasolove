<?php
require_once('../db/config.php');


mysqli_report(MYSQLI_REPORT_OFF);
$conn = @mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}
mysqli_set_charset($conn, "utf8");

require_once('functions.php');

header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
log_message("Otrzymano dane wejściowe: " . json_encode($input));

if (empty($input['cart'])) {
    log_message("Koszyk jest pusty lub dane są w złym formacie.");
    echo json_encode(['html' => '<p>Twój koszyk jest pusty.</p>', 'total' => 0]);
    exit;
}

$cart = $input['cart'];
$productIds = array_map(function($item) {
    // Upewnijmy się, że ID jest liczbą całkowitą
    return isset($item['id']) ? (int)$item['id'] : 0;
}, $cart);

// Usuwamy nieprawidłowe ID (równe 0)
$productIds = array_filter($productIds);

if (empty($productIds)) {
    log_message("Brak prawidłowych ID produktów w koszyku.");
    echo json_encode(['html' => '<p>Twój koszyk jest pusty.</p>', 'total' => 0]);
    exit;
}

$idsString = implode(',', $productIds);
$sql = "SELECT product_id, name, price, color_id FROM product WHERE product_id IN ($idsString)";
log_message("Wykonywanie zapytania SQL: " . $sql);
$result = mysqli_query($conn, $sql);

$productsData = [];
while ($row = mysqli_fetch_assoc($result)) {
    $productsData[$row['product_id']] = $row;
}

log_message("Znaleziono " . count($productsData) . " produktów w bazie danych.");

if (empty($productsData)) {
    log_message("Żaden z produktów z koszyka nie został znaleziony w bazie danych.");
}

$html = '';
$totalValue = 0;

foreach ($cart as $item) {
    $productId = (int)$item['id'];
    $quantity = (int)$item['quantity'];
    if (isset($productsData[$productId])) {
        $product = $productsData[$productId];
        $totalValue += $product['price'] * $quantity;
        $html .= '
            <div class="cart-product" data-product-id="' . $productId . '">
                ' . getProductImage($productId, 0, $product['color_id']) . '
                <div class="flex-container flex-column nowrap gap-xs">
                    <a href="/produkt?id=' . $productId . '" class="link-alt">' . htmlspecialchars($product['name']) . '</a>
                </div>
                <div class="mobile-price flex-container flex-column nowrap" style="justify-content: space-between; gap: .75rem; width: fit-content; height: 100%; white-space: nowrap;">
                    <span style="font-size: 1.15rem">' . number_format($product['price'], 2, '.', '') . ' zł</span>
                    <div class="flex-container flex-column nowrap" style="justify-content: space-between; gap: .75rem; width: 100%;">
                        <div class="flex-container flex-row nowrap gap-xs">
                            <input type="number" value="' . $quantity . '" style="width: 2.5rem; height: 1.5rem; text-align: center; font-size: .85rem;" onchange="Cart.updateCartItem(' . $productId . ', parseInt(this.value)); location.reload();">
                            <label> szt.</label>
                        </div>
                        <button class="remove-icon" onclick="Cart.removeFromCart(' . $productId . '); location.reload();"></button>
                    </div>
                </div>
            </div>';
    }
    else {
        log_message("Produkt o ID " . $productId . " nie został znaleziony w tablicy \$productsData (prawdopodobnie brak w bazie).");
    }
}

echo json_encode(['html' => $html, 'total' => $totalValue]);