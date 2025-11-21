<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $asset_code = $_POST['asset_code'];
    $asset_name = $_POST['asset_name'];
    $category_id = $_POST['category_id'];
    $purchase_date = $_POST['purchase_date'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    $sql = "INSERT INTO assets (asset_code, asset_name, category_id, purchase_date, price, image) 
            VALUES ('$asset_code', '$asset_name', '$category_id', '$purchase_date', '$price', '$image')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['status' => 'success', 'message' => 'Asset added successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $conn->error]);
    }
}
?>
