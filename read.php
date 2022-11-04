<?php
// required headers
 header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");
//function to update
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    //get database connection
    require_once 'db.php';
    $table_name = "blogs";
    //include_once "create.php";
    
    //set id of article  to be edited
    
    $query = "SELECT * FROM `blogs`";
    $result = mysqli_query($_conn, $query);
    if($result){
        $content = mysqli_fetch_all($result, MYSQLI_ASSOC); 
        echo json_encode([
                "message" => "selected successfully",
                "code" => "selected", 
                "data" => [
                    "content" => $content,   
                ]
        ]);
    }else{
        echo "failed to select";
    }
  
}

?>