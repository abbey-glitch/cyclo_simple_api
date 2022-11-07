<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Method: GET, POST");
header("Access-Control-Allow-Content: Content-Type");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $data = file_get_contents("php://input");
    $data = JSON_decode($data);
    $name = $data->name;
    $email = $data->email;
    $content = $data->content;
    $category = $data->category;
    // connect to database
    require_once "db.php";
    //escape any attack via CORS
    $name = htmlspecialchars(strip_tags($name));
    $email = htmlspecialchars(strip_tags($email));
    $content = htmlspecialchars(strip_tags($content));
    $category = htmlspecialchars(strip_tags($category));
    //sanitize
    $name = mysqli_real_escape_string($_conn, trim($name));
    $email = mysqli_real_escape_string($_conn, trim($email));
    $content = mysqli_real_escape_string($_conn, trim($content));
    $category = mysqli_real_escape_string($_conn, trim($category));
    //include_once "read.php";
    $table_name = "comments";
    //add mysql query 
    $query = "INSERT INTO `comments` ( `content`, `name`, `email`, `category`, `date_commented`) VALUES ('$content','$name','$email','$category',Now())";
    $result = mysqli_query($_conn, $query);
    if($result){
        $query = "SELECT b.title, b.content, b.author, b.category, c.name, c.email, c.content FROM blogs b JOIN comments c ON b.category = c.category";
        $result = mysqli_query($_conn, $query);
       echo json_encode([
            "message"=>"you successfully entered a comment",
            "code"=>"success",
            "data"=>[
                "name"=>$name,
                "email"=>$email,
                "content"=>$content,
                "category"=>$category
            ],
        ]);
    }else{
        echo "unable to comment";
    }
}