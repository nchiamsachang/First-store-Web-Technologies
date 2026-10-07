<?php

$name = $_POST["name"];
$title = $_POST["title"];
$blog = $_POST["blog"];

$date = date("d-m-y");

$imageName = "";

if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {

    $imageName = basename($_FILES["image"]["name"]);
    $uploadPath = "../images/blog/" . $imageName;
    move_uploaded_file($_FILES["image"]["tmp_name"], $uploadPath);

}

$blogEscaped = str_replace(",", "&#44;", $blog);

$record = $name . "," . $title . "," . $imageName . "," . $blogEscaped . "," . $date . "\n";

file_put_contents("blog.txt", $record, FILE_APPEND);

header("Location: Admin.html");
exit();

?>