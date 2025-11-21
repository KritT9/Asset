<?php
include 'db_connection.php';

$sql = "SELECT category_id, category_name FROM asset_categories";
$result = $conn->query($sql);

$categories = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
    echo json_encode($categories);
} else {
    echo json_encode([]);
}
?>
