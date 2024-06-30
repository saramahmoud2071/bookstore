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

if (isset($_GET["search"])) {

    $search = $_GET["search"];
    $sql = "SELECT b.id, title, img, author, cat.name 
    FROM books b left join categories cat 
    on b.cat_id = cat.id
    where title LIKE '%$search%'";
} elseif(isset($_GET["category"])){
    $SS = explode($_SERVER['SCRIPT_NAME']."?",$_SERVER['REQUEST_URI'])[1];
    $SS = explode("&",$SS);
    $array = array();
    foreach ($SS as $key => $value) {
        array_push($array,explode("category=",$value)[1]); 
    } 
    $category = "";

    for ($i=0; $i < count($array); $i++) 
    {
        if($i == count($array)-1){
            $category = $category."'".$array[$i]."'"; 
        }else{
            $category = $category."'".$array[$i]."'" . ",";
        }
    }

    $sql = "SELECT b.id, title, img, author, cat.name 
    FROM books b left join categories cat 
    on b.cat_id = cat.id
    where cat.name in ($category)";
}else {
    $sql = "SELECT b.id, title, img, author, cat.name 
            FROM books b left join categories cat 
            on b.cat_id = cat.id";
}

$sql2 = "SELECT *
FROM books b left join book_cart cart
on b.id = cart.book_id
where cart.cart_id";

$sql3 = "SELECT name from  categories";

$result = $conn->query($sql);
$result2 = $conn->query($sql2);
$result3 = $conn->query($sql3);
$cart_size = $result2->num_rows;

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<?php


include("templates/header.php"); ?>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="index.php" style="color: #7EB5A6;">Bookadise</a>
            <form action="index.php" method="GET">
                <div class="input-group d-sm-none d-xs-none d-md-flex" style="margin-left: 7%">
                    <div class="form-outline">
                        <input class="form-control" name="search" id="search" type="search" placeholder="Search" />
                    </div>
                    <button id="search-button" type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                    <div class="results-container">
                        <ul class="results-list" id="list">

                        </ul>
                    </div>
                </div>
            </form>
            <!-- Icon dropdown -->
            <div class="m-4">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"><i class="fa-sharp fa-solid fa-sliders"></i></button>
                    <div class="dropdown-menu">
                        <form action="index.php" method="GET"  style="margin-left: 10px">
                            <?php
                            if ($result3->num_rows > 0) {
                                while ($row3 = $result3->fetch_assoc()) {
                                    $category = $row3["name"];
                                    echo "<input type=\"checkbox\" id=\"category\" name=\"category\" value=\"$category\">";
                                    echo "<label for=\"category\">$category</label><br>";
                                }
                            }
                            echo"<input class=\"btn btn-outline-info\" type=\"submit\" value=\"Apply filter\" style=\"padding:auto\">";
                            ?>
                        </form>
                    </div>
                </div>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#portfolio">Books</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
            </div>
            <a class="btn btn-primary d-sm-none d-xs-none d-md-flex" data-bs-toggle="modal" href="#cartModal" style="margin:0 2%">
                <i class="fas fa-cart-shopping"></i>
                <span class="badge badge-default badge-outlined">
                    <?php
                    echo "$cart_size";
                    ?>
                </span></a>
            <div class="cart-hover">
                <div class="cart-hover-content"></div>
            </div>
        </div>
    </nav>

    <!-- CartModal-->
    <div class="portfolio-modal modal fade" id="cartModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="max-width: 70%;margin: auto">
                <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="modal-body">
                                <?php
                                if ($result2->num_rows > 0) {
                                    echo "<div class=\"row\">";
                                    while ($row2 = $result2->fetch_assoc()) {
                                        $img = $row2["img"];
                                        $title = $row2["title"];
                                        $author = $row2["author"];
                                        $price = $row2["price"];
                                        $book_id = $row2["id"];

                                        echo "<div class=\"col-lg-3 col-sm-6\">";
                                        echo "<img class=\"img-fluid\" src=\"$img\" alt=\"...\"/>";
                                        echo "</div>";
                                        echo "<div class=\"col-lg-3 col-sm-6\">";
                                        echo "<p class=\"item-intro text-muted\">$title</p>";
                                        echo "<p class=\"item-intro text-muted\">$author</p>";
                                        echo "<p class=\"item-intro text-muted\">$price$</p>";
                                        echo "<form action=\"cart.php\" method=\"POST\">";
                                        echo "<input id=\"delete-id\" name=\"delete\" value=\"id\" type=\"hidden\"/>";
                                        echo "<input id=\"cart-id\" name=\"id\" value=\"$book_id\" type=\"hidden\"/>";
                                        echo "<button type=\"submit\" class=\"btn btn-outline-danger\">Remove</button>";
                                        echo "</form>";
                                        echo "</div>";
                                    }
                                    echo "</div>";
                                }
                                ?>
                                <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button" onclick="location.href='order.php';">
                                    <i class="fas fa-cart-shopping" style="margin: 0 6px"></i>
                                    Go to Check out
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Masthead-->
    <header class="masthead">
        <div class="container">
            <div class="masthead-subheading">Welcome To Our Bookadise!</div>
            <div class="masthead-heading text-uppercase" style="font-size: 3rem;">“I have always imagined that Paradise will be a kind of library.”<br><span style="font-size: 1.5rem; color: #7EB5A6">― Jorge Luis Borges ―</span></div>
        </div>
    </header>
    <!-- Services-->
    <section class="page-section" id="services">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Services</h2>
                <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-primary"></i>
                        <i class="fas fa-shopping-cart fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="my-3">E-Commerce</h4>
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-primary"></i>
                        <i class="fas fa-truck-fast fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="my-3">Fast delivery time</h4>
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-primary"></i>
                        <i class="fas fa-headset fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="my-3">Customer support</h4>
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Grid-->
    <section class="page-section bg-light" id="portfolio">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Books</h2>
                <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
            </div>
            <div class="row">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $id = $row["id"];
                        $title = $row["title"];
                        $author = $row["author"];
                        $img = $row["img"];
                        $category = $row["name"];

                        echo "<div class=\"col-lg-2 col-sm-4 mb-4\">";
                        echo "<div class=\"portfolio-item\">";
                        echo "<a class=\"portfolio-link\" data-bs-toggle=\"modal\"href=\"#portfolioModal\" onclick=\"handleClick($id)\">";
                        echo "<div class=\"portfolio-hover\">";
                        echo "<div class=\"portfolio-hover-content\"><i class=\"fas fa-ellipsis fa-3x\"></i></div>";
                        echo "</div>";
                        echo "<img class=\"img-fluid\" src=\"$img\" alt=\"...\"/>";
                        echo "</a>";
                        echo "<div class=\"portfolio-caption\">";
                        echo "<div class=\"portfolio-caption-heading\" style = \"font-family:'Quicksand', sans-serif;\">$title</div>";
                        echo "<div class=\"portfolio-caption-subheading text-muted\">$category</div>";
                        echo "<div class=\"portfolio-caption-subheading text-muted\">$author</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "0 results";
                }
                ?>
            </div>
        </div>
        </div>
    </section>
    <!-- About-->
    <section class="page-section bg-primary text-white mb-0" id="about">
        <div class="container">
            <!-- About Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-white">About</h2>
            <!-- Icon Divider-->
            <div class="divider-custom divider-light">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- About Section Content-->
            <div class="row">
                <div class="col-lg-4 ms-auto">
                    <p class="lead">We work to connect readers with independent booksellers all over the world. We believe local bookstores are essential community hubs that foster culture, curiosity, and a love of reading, and we're committed to helping them survive and thrive.</p>
                </div>
                <div class="col-lg-4 me-auto">
                    <p class="lead">Our platform gives independent bookstores tools to compete online and financial support to help them maintain their presence in local communities.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact-->
    <section class="page-section" id="contact">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Contact Us</h2>
                <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>

            </div>
            <form id="contactForm" action="contacts.php" method="POST">
                <div class="row align-items-stretch mb-5">
                    <div class="col-md-6">
                        <div class="form-group">
                            <!-- Name input-->
                            <input class="form-control" id="name" type="text" name="name" placeholder="Your Name *" value="" required />

                        </div>
                        <div class="form-group">
                            <!-- Email address input-->
                            <input class="form-control" id="email" type="email" name="email" placeholder="Your Email *" required />
                        </div>
                        <div class="form-group">
                            <!-- Phone number input-->
                            <input class="form-control" id="phone" type="tel" name="phone" placeholder="Your Phone Number *" value="" required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <!-- Message input-->
                            <textarea class="form-control" id="message" name="message" type="text" placeholder="Your Message *" style="height: 250px;" required></textarea>
                        </div>
                    </div>
                </div>
                <?php
                if (isset($_SESSION["success"])) {
                    echo "<div class=\"text-center text-white mb-3\">";
                    echo "<div class=\"fw-bolder\">";
                    echo "<h3>" . $_SESSION["success"] . "</h3>";
                    echo "</div>";
                    session_destroy();
                }
                ?>
                <div class="text-center"><input class="btn btn-primary btn-xl text-uppercase" id="submitButton" type="submit" value="Send Message"></div>
            </form>
        </div>
    </section>

    <!-- Footer-->
    <?php include("templates/footer.php"); ?>

    <!-- Portfolio Modals-->
    <!-- Portfolio item modal popup-->
    <div class="portfolio-modal modal fade" id="portfolioModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="modal-body">
                                <!-- Project details-->

                                <h2 id="book-name" class="text-uppercase">Book-Name</h2>
                                <p id="cat-name" class="item-intro text-muted">category</p>
                                <img id="book-img" class="img-fluid d-block mx-auto" src="assets/img/portfolio/1.jpg" alt="..." style="width:400px;height:600px" />
                                <p id="description">description: Use this area to describe your book. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                <ul class="list-inline">
                                    <li id="author">
                                        Name
                                    </li>
                                    <li id="price">
                                        number
                                    </li>
                                    <li id="stock">
                                        stock
                                    </li>
                                </ul>
                                <form action="cart.php" method="POST">
                                    <input id="insert-id" name="insert" value="id" type="hidden" />
                                    <label><strong>quantity: </strong></label>
                                    <div class="mb-4"><input id="book-stock" name="amount" type="number" value="1" min="1" max="10"></div>
                                    <br>
                                    <input id="book-id" name="id" value="id" type="hidden" />
                                    <?php
                                    ?>
                                    <span class="btn btn-primary">
                                        <i class="fas fa-cart-shopping" style="margin-left:20px; margin-right:0;"></i>
                                        <input class="btn btn-primary btn-xl text-uppercase" id="submitButton" type="submit" value=" Add to cart">
                                        <?php

                                        ?>
                                    </span>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts-->
    <?php include("templates/JS.php"); ?>

</body>

</html>