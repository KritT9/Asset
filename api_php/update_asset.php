<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $asset_id = $_POST['asset_id'];
    $asset_code = $_POST['asset_code'];
    $asset_name = $_POST['asset_name'];
    $category_id = $_POST['category_id'];
    $purchase_date = $_POST['purchase_date'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    $sql = "UPDATE assets SET asset_code='$asset_code', asset_name='$asset_name', category_id='$category_id', purchase_date='$purchase_date', price='$price', image='$image' WHERE asset_id='$asset_id'";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['status' => 'success', 'message' => 'Asset updated successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $conn->error]);
    }
}
?>
