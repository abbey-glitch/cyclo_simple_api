<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Method: GET, POST");
header("Access-Control-Allow-Content: Content-Type");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $data = file_get_contents("php://input");
    $data = JSON_decode($data);
    $name = $data->name;
    $email = $data->email;
    $comment = $data->comment;
    // connect to database
    require_once "db.php";
    require_once "read.php";
    //escape any attack via CORS
    $name = htmlspecialchars(strip_tags($name));
    $email = htmlspecialchars(strip_tags($email));
    $comment = htmlspecialchars(strip_tags($comment));
    //sanitize
    $name = mysqli_real_escape_string($_conn, trim($name));
    $email = mysqli_real_escape_string($_conn, trim($email));
    $comment = mysqli_real_escape_string($_conn, trim($comment));
    include_once "read.php";
    $table_name = "blogs";
    //add mysql query
    $query = "INSERT INTO `comments`(`name`, `email`, `comment`, `date`) VALUES ('$name', '$email', '$comment', Now())";
    $result = mysqli_query($_conn, $query);
    if($result){
       echo json_encode([
            "message"=>"you successfully entered a comment",
            "code"=>"success",
            "data"=>[
                "name"=>$name,
                "email"=>$email,
                "comment"=>$comment
            ],
        ]);
    }else{
        echo "unable to comment";
    }
}