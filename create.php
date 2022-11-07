<?php
function Create(){
    // required headers
 header("Access-Control-Allow-Origin: *");
 header("Access-Control-Allow-Methods: POST");
//  header("Access-Control-Allow-Enctype: multipart/form-data");
header("Access-Control-Allow-Headers: Content-Type");
 if($_SERVER['REQUEST_METHOD'] == 'POST'){
     $data = file_get_contents("php://input");
     $data = json_decode($data);
     $title = $data->title;
     $content = $data->content;
     $author = $data->author;
     $category = $data->category;
     //$author = $data->author;
     //get database connection
     require_once 'db.php';
     $table_name = "blogs";
     //sanitize the content
     $title = mysqli_real_escape_string($_conn, trim($title));
     $content = mysqli_real_escape_string($_conn, trim($content));
     $author = mysqli_real_escape_string($_conn, trim($author));
     $category = mysqli_real_escape_string($_conn, trim($category)); 
  
     $query = "INSERT INTO `blogs`(`title`, `content`, `author`, `category`, `date_published`)VALUES('$title', '$content', '$author', '$category', Now())";
     $result = mysqli_query($_conn, $query);
     if($result){
         echo json_encode([
                 "message" => "new post was created successfully!",
                 "code" => "success", 
                 "data" => [ 
                     "title" => $title, 
                     "content" => $content,
                     "author" => $author,
                     "category" => $category,
                 ], 
                 
         ]);
     }else{
         echo "failed";
     }
   
 }
 
}
create();
?>