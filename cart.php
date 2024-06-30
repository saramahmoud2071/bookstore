<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "books_store";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (empty($_POST)) {
    echo "Hi";
} else if (isset($_POST["id"]) && isset($_POST["insert"])) {

    $cart_id = 1;
    $book_id = $_POST["id"];
    $amount = $_POST["amount"];

    $sql = "INSERT INTO book_cart (cart_id, book_id, amount)
    VALUES ('$cart_id', '$book_id', '$amount')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        die();
    }
    $conn->close();
} else if (isset($_POST["id"]) && isset($_POST["delete"])) {
    $book_id = $_POST["id"];

    $sql = "DELETE FROM book_cart WHERE book_id = $book_id AND cart_id = 1";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        die();
    }
    $conn->close();
}

