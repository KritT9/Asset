<?php
include 'db_connection.php';

$sql = "SELECT a.asset_id, a.asset_code, a.asset_name, a.purchase_date, a.price, ac.category_name 
        FROM assets a 
        LEFT JOIN asset_categories ac ON a.category_id = ac.category_id";
$result = $conn->query($sql);

$assets = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $assets[] = $row;
    }
    echo json_encode($assets);
} else {
    echo json_encode([]);
}
?>
