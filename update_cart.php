<?php
session_start();
include 'connectdb.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart_id'], $_POST['action'])) {
    $cartId = $_POST['cart_id'];
    $action = $_POST['action'];

    if ($action === 'increase') {
        $stmt = $connect->prepare("UPDATE cart SET quantity = quantity + 1 WHERE id = ?");
        $stmt->bind_param("i", $cartId);
        $stmt->execute();
        $stmt->close();
    } elseif ($action === 'decrease') {

        $check = $connect->prepare("SELECT quantity FROM cart WHERE id = ?");
        $check->bind_param("i", $cartId);
        $check->execute();
        $result = $check->get_result();
        $row = $result->fetch_assoc();
        $check->close();

        if ($row && $row['quantity'] > 1) {
            $update = $connect->prepare("UPDATE cart SET quantity = quantity - 1 WHERE id = ?");
            $update->bind_param("i", $cartId);
            $update->execute();
            $update->close();
        } else {
            $delete = $connect->prepare("DELETE FROM cart WHERE id = ?");
            $delete->bind_param("i", $cartId);
            $delete->execute();
            $delete->close();
        }
    }
}

header("Location: menu.php");
exit();
?>