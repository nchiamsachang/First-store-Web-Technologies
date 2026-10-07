<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Balanced Living – Blog</title>

<style>
* { box-sizing: border-box; margin: 0; padding: 0; }

body {
    background-color: #2224A2;
    background-image: url("../images/home/bg_head2.bmp");
    font-family: Arial, sans-serif;
}

#wrapper {
    width: 95%;
    max-width: 1200px;
    margin: 10px auto;
}

#div1-banner {
    border: 3px solid black;
    background-color: #000066;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px;
}

#div1-banner img {
    height: 85px;
}

#div1-banner .heading {
    font-family: "Script MT Bold", cursive;
    font-size: 28px;
    color: white;
    text-align: center;
    flex: 1;
}

#div2-nav {
    background-color: #1a1a8c;
    border-top: 2px solid black;
    border-bottom: 2px solid black;
}

#div2-nav ul {
    list-style: none;
    display: flex;
}

#div2-nav ul li {
    position: relative;
}

#div2-nav ul li a {
    display: block;
    padding: 8px 14px;
    font-size: 11px;
    color: white;
    text-decoration: none;
    border-right: 1px solid black;
}

#div2-nav ul li a:hover {
    background-color: rgb(60,139,255);
}

#div2-nav ul li ul {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background-color: rgb(60,139,255);
    min-width: 170px;
    z-index: 999;
}

#div2-nav ul li:hover ul {
    display: block;
}

#div2-nav ul li ul li {
    width: 100%;
}

#div2-nav ul li ul li a {
    background-color: rgb(60,139,255);
    color: white;
    border-bottom: 1px solid white;
}

#div2-nav ul li ul li a:hover {
    background-color: lightblue;
    color: black;
}

#blog-area {
    margin-top: 15px;
}

.blog-entry {
    background-color: white;
    border: 1px solid #999999;
    padding: 20px;
    margin-bottom: 20px;
    text-align: center;
}

.blog-entry h2 {
    font-size: 20px;
    font-weight: bold;
    color: black;
    margin-bottom: 8px;
}

.blog-entry .blog-meta {
    font-size: 14px;
    color: black;
    margin-bottom: 12px;
}

.blog-entry img {
    display: block;
    margin: 0 auto 12px auto;
    max-width: 300px;
    border: 1px solid #cccccc;
}

.blog-entry .blog-text {
    text-align: left;
    font-size: 13px;
    line-height: 1.6;
    color: black;
    border: 1px solid #999999;
    padding: 10px;
    margin: 0 auto;
    width: 90%;
}

#footer {
    margin-top: 15px;
    text-align: center;
    color: white;
    font-size: 12px;
}
</style>
</head>

<body>

<div id="wrapper">

<div id="div1-banner">
    <img src="../images/home/logo.png" alt="Logo">
    <div class="heading">Balanced Living – A Lifestyle</div>
    <img src="../images/home/healthHeader2.png" alt="Health Header">
</div>

<div id="div2-nav">
<ul>

    <li><a href="../index.html">Home</a></li>

    <li><a href="#">About Us</a>
        <ul>
            <li><a href="#">General</a></li>
            <li><a href="#">Message</a></li>
        </ul>
    </li>

    <li><a href="#">Products</a>
        <ul>
            <li><a href="../store/store_index.html">Our Store</a></li>
            <li><a href="../store/health.html">Health</a></li>
            <li><a href="../store/Parenting.html">Parenting</a></li>
        </ul>
    </li>

    <li><a href="#">Fitness Centers</a>
        <ul>
            <li><a href="#">Anytime Fitness</a></li>
            <li><a href="#">Conway Regional</a></li>
        </ul>
    </li>

    <li><a href="#">Equipment</a>
        <ul>
            <li><a href="#">Total Gym</a></li>
            <li><a href="#">Bow Flex</a></li>
        </ul>
    </li>

    <li><a href="#">Restaurants</a>
        <ul>
            <li><a href="#">Healthy Dining</a></li>
            <li><a href="#">Organic Foods</a></li>
            <li><a href="#">All Veggies</a></li>
        </ul>
    </li>

    <li><a href="#">Members</a>
        <ul>
            <li><a href="#">Login</a></li>
            <li><a href="#">Reset Password</a></li>
            <li><a href="#">Memberships</a></li>
        </ul>
    </li>

    <li><a href="#">Visitors</a>
        <ul>
            <li><a href="#">Registering</a></li>
            <li><a href="#">Festival Pictures</a></li>
            <li><a href="Blog.php">Blogs</a></li>
        </ul>
    </li>

    <li><a href="#">Contact Us</a>
        <ul>
            <li><a href="../store/store_index.html">Our Store</a></li>
            <li><a href="#">Other Vendors</a></li>
        </ul>
    </li>

</ul>
</div>

<div id="blog-area">

<?php

if (file_exists("blog.txt")) {

    $lines = file("blog.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    $lines = array_reverse($lines);

    foreach ($lines as $line) {

        $fields = explode(",", $line, 5);

        $name = isset($fields[0]) ? $fields[0] : "";
        $title = isset($fields[1]) ? $fields[1] : "";
        $imageName = isset($fields[2]) ? $fields[2] : "";
        $blogText = isset($fields[3]) ? str_replace("&#44;", ",", $fields[3]) : "";
        $date = isset($fields[4]) ? $fields[4] : "";

        echo "<div class='blog-entry'>";
        echo "<h2>" . htmlspecialchars($title) . "</h2>";
        echo "<div class='blog-meta'>by " . htmlspecialchars($name) . " on " . htmlspecialchars($date) . "</div>";

        if ($imageName != "") {
            echo "<img src='../images/blog/" . htmlspecialchars($imageName) . "' alt='" . htmlspecialchars($title) . "' />";
        }

        echo "<div class='blog-text'>" . htmlspecialchars($blogText) . "</div>";
        echo "</div>";

    }

} else {

    echo "<p style='color:white; text-align:center;'>No blog entries yet.</p>";

}

?>

</div>

<div id="footer">
    © 2024 Balanced Living Organization
</div>

</div>

</body>
</html>