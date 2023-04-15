<?php
session_start(); // Start PHP session to store cart data

// Set a cookie with user's IP address and session time
$ip_address = $_SERVER['REMOTE_ADDR'];
$session_time = time();
setcookie('user_data', $ip_address . '|' . $session_time, time() + 3600); // Cookie expires in 1 hour

// Check if the 'add_to_cart' form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    // Get the product ID and quantity from the form
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Validate the quantity as a positive integer
    if (!is_numeric($quantity) || $quantity <= 0 || !is_int($quantity + 0)) {
        echo 'Invalid quantity. Please enter a positive integer.';
    } else {
        // Add the product and quantity to the cart
        $_SESSION['cart'][$product_id] = $quantity;
        echo 'Product added to cart successfully!';
    }
}

// Check if the 'update_cart' form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_cart'])) {
    // Loop through the cart items and update quantities
    foreach ($_POST['quantity'] as $product_id => $quantity) {
        // Validate the quantity as a positive integer
        if (!is_numeric($quantity) || $quantity <= 0 || !is_int($quantity + 0)) {
            echo 'Invalid quantity for product ID ' . $product_id . '. Please enter a positive integer.';
        } else {
            // Update the quantity in the cart
            $_SESSION['cart'][$product_id] = $quantity;
        }
    }
    echo 'Cart updated successfully!';
}

// Check if the 'remove_from_cart' form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['remove_from_cart'])) {
    // Get the product ID to be removed from the cart
    $product_id = $_POST['product_id'];

    // Remove the product from the cart
    unset($_SESSION['cart'][$product_id]);
    echo 'Product removed from cart successfully!';
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple Shopping Cart</title>
    <style>
        body {
            background-color: #f8f8f8;
            font-family: Arial, sans-serif;
        }

        h1 {
            background-color: #333;
            color: #fff;
            padding: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="number"] {
            width: 60px;
        }

        button[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 8px 12px;
            border: none;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #666;
        }
    </style>
</head>
<body>
    <!-- Display the cart items and quantities -->
    <h1>Shopping Cart</h1>
    <form action=""
