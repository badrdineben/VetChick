<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $image_name = time() . "_" . basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $image_name;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo json_encode(["url" => "https://yourdomain.com/uploads/" . $image_name]);
    } else {
        echo json_encode(["error" => "Failed to upload"]);
    }
} else {
    echo json_encode(["error" => "Invalid request"]);
}
?>
