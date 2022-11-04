<?php
// required headers
 header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type");
//function for deleting


if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
    //get database connection
    require_once 'db.php';
    $table_name = "blogs";

    //set the content to delete

     $delete_query = "DELETE FROM `blogs`";
    $result = mysqli_query($_conn, $delete_query);

    if($result){    
        echo json_encode([
                'message' => "post deleted successfully!",
                "code" => "success",
                "data" => [],
                "type" => "delete-post"
        ]);
    }else{
        //the query did not run
        echo json_encode([
            'message' => "post could not be deleted: ".mysqli_error($_conn),
            "code" => "error",
            "data" => [],
            "type" => "delete-post"
    ]);
    }

  
}

?>