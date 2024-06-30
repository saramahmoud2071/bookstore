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

$sql = "SELECT b.id, title, author,price, amount
FROM books b left join book_cart cart
on b.id = cart.book_id
where cart.cart_id";

$result = $conn->query($sql);

if (isset($_POST["address"])) {

    $result2 = $conn->query($sql);
    $total = 0;
    while ($row2 = $result2->fetch_assoc()) {
        $onePrice = $row2["price"];
        $amount = $row2["amount"];
        $price = $onePrice * $amount;
        $total += $price;
    }

    $address = $_POST["address"];
    $date = date('Y-m-d H:i:s', time());
    $user_id = 1;

    $sql2 = "INSERT INTO orders (total_price, address, date, user_id)
    VALUES ($total, '$address', '$date', $user_id)";

    if ($conn->query($sql2) === TRUE) {
        $order_id = $conn->insert_id;
        $_SESSION["success"] = "Form submission successful!";

        //Insert in book_order using book_cart
        $sql3 = "SELECT book_id, amount
        from book_cart";

        $result3 = $conn->query($sql3);
        while ($row3 = $result3->fetch_assoc()) {
            $book_id = $row3['book_id'];
            $amount = $row3['amount'];
            $sql4 = "INSERT INTO book_order (book_id, amount, order_id)
            VALUES ($book_id, $amount, $order_id)";
            $result4 = $conn->query($sql4);

            $sql5 = "SELECT stock from books where id = $book_id";
            $result5 = $conn->query($sql5);
            $row5 = $result5->fetch_assoc();
            $stock = $row5["stock"];

            $newStock =  $stock - $amount;

            $sql6 = "UPDATE books
            SET stock = $newStock
            WHERE id = $book_id";
            $result6 = $conn->query($sql6);
        }
        $sql7 = "DELETE FROM book_cart WHERE cart_id = 1";
        $result7 = $conn->query($sql7);

        header("Location: order.php");
        die();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<?php include("templates/header.php"); ?>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" onclick="location.href='index.php';" style="color: #7EB5A6;">Bookadise</a>
        </div>
    </nav>

    <section class="page-section bg-light" style="margin-top: 100px">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase" style="margin-bottom: 30px;">BILLING & SHIPPING</h2>
            </div>
            <div class="row">
                <div class="col-lg-4 ms-auto">
                    <form id="contactForm" action="order.php" method="POST">
                        <!-- 2 column grid layout with text inputs for the first and last names -->
                        <div class="row mb-4">
                            <div class="col">
                                <div class="form-group">
                                    <input class="form-control" id="name" type="text" name="first name" class="form-control" required />
                                    <label class="form-label" for="name">First name</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input class="form-control" id="name" type="text" name="last name" class="form-control" required />
                                    <label class="form-label" for="name">Last name</label>
                                </div>
                            </div>
                        </div>

                        <!-- Text input -->
                        <div class="form-group">
                            <input class="form-control" id="name" type="text" name="address" class="form-control" required />
                            <label class="form-label" for="name">Address</label>
                        </div>

                        <!-- Email input -->
                        <div class="form-group">
                            <input class="form-control" id="name" type="email" name="email" class="form-control" required />
                            <label class="form-label" for="name">Email</label>
                        </div>

                        <!-- Number input -->
                        <div class="form-group">
                            <input class="form-control" id="name" type="tel" name="phone" class="form-control" required />
                            <label class="form-label" for="name">Phone</label>
                        </div>

                        <!-- Message input -->
                        <div class="form-outline mb-4">
                            <textarea class="form-control" id="message" name="message" type="text" style="height: 100px;"></textarea>
                            <label class="form-label" for="form6Example7">Additional information</label>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary btn-block mb-4" style="text-align:center">Place order</button>
                    </form>
                </div>

                <div class="col-lg-4 me-auto">
                    <?php
                    $total = 0;
                    if ($result->num_rows > 0) {
                        echo "<div style=\"border-color: #7EB5A6 !important;\" class=\"row p-3 border border-3 order\">";
                        while ($row = $result->fetch_assoc()) {
                            $title = $row["title"];
                            $author = $row["author"];
                            $onePrice = $row["price"];
                            $amount = $row["amount"];
                            $price = $onePrice * $amount;
                            $total += $price;
                            echo "<div class=\"col-lg-8 col-sm-6\">";
                            echo "<p class=\"item-intro text-muted\">$title x $amount</p>";
                            echo "<p class=\"item-intro text-muted\">-$author-</p>";
                            echo "</div>";
                            echo "<div class=\"col-lg-4 col-sm-6\">";
                            echo "<p class=\"item-intro text-muted\">$price$</p>";
                            echo "</div>";
                        }
                        echo "<p class=\"item-intro text-muted\"><strong>total price:</strong>  $total$</p>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer-->
    <?php include("templates/footer.php"); ?>

    <!-- Scripts-->
    <?php include("templates/JS.php"); ?>
</body>

</html>