<?php
// required headers
 header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST");
//header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type");
//function to update
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $data = file_get_contents("php://input");
    $data = json_decode($data);
    
    //get database connection
    require_once 'db.php';
    $table_name = "users";
    //get the content on mysql table and include it as data object
    $name = $data->name;
    $password = $data->password;
    $email = $data->email;
    //sanitize the column
    mysqli_real_escape_string($_conn, trim($name));
    mysqli_real_escape_string($_conn, trim($password));
    mysqli_real_escape_string($_conn, trim($email));
    //insert the admin details to access the create.php
    $query = "INSERT INTO `users`(`name`, `password`, `email`, `Date_created`)VALUE('$name', md5('$password'),'$email', Now())";
    $result = mysqli_query($_conn, $query);
    if($result){
        echo JSON_encode([
            "message" => "users Dashboard created",
            "code" => "successfully created",
            "data" => [
                "data"=>$name
            ],
        ]);
        
    }else{
        echo "unauthorize user";
    }
}