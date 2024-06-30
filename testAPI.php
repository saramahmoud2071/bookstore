<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "books_store";

$book_id = explode($_SERVER['SCRIPT_NAME']."/",$_SERVER['PHP_SELF'])[1];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT b.id, description, title,price,author, cat.name, img, stock FROM books b left join categories cat 
on b.cat_id = cat.id
where b.id = $book_id";

$result = $conn->query($sql);

$conn->close();

$details = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($details, $row);
    }
}
$json= json_encode($details);
header('Content-Type: application/json');
echo $json;
?>