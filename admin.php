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
    $table_name = "admin";
    //get the content on mysql table and include it as data object
    $name = $data->name;
    $password = $data->password;
    define("pattern")
    pattern = preg_match()
    //sanitize the column
    mysqli_real_escape_string($_conn, trim($name));
    mysqli_real_escape_string($_conn, trim($password));
    //insert the admin details to access the create.php
    $query = "INSERT INTO `admin`(`name`, `password`, `Date_registered`)VALUE('$name', md5('$password'), Now())";
    $result = mysqli_query($_conn, $query);
    if($result){
        echo JSON_encode([
            "message" => "admin Dashboard created",
            "code" => "successfully created",
            "data" => []
        ]);
        
    }else{
        echo "unauthorize user";
    }
}