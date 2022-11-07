<?php
// required headers
 header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");
//function to update
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $data = file_get_contents("php://input");
    $data = json_decode($data);
    
    //get database connection
    require_once 'db.php';
    $table_name = "blogs";
    //set id of article  to be edited
    $blogs_id = $data->blogs_id;
    $title = $data->title;
    $content = $data->content;
    //$author = $author->author;
    $category = $data->category;
    //update query
    
    $query = "UPDATE `blogs` SET `title`= '{$title}',  `content` = '{$content}', `category` = '{$category}' WHERE `blogs_id` = '{$blogs_id}' LIMIT 1";
    $result =ysqli_query($_conn, $query);
    if($result){
        echo json_encode([
                "message" => "updated successfully",
                "code" => "updated", 
                "data" => [
                    "title" => $title, 
                    "content" => $content,
                   // "author" => $author,
                    "category" => $category,
                ]
        ]);
    }else{
        echo "failed to update";
    }
  
}

?>