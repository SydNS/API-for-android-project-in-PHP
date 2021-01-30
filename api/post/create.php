<?php


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Allowed-Methods,Authorization, X-Requested-With');
header('Access-Control-Allow-Methods: POST');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

$database=new Database();
$db=$database->connect();

$post=new Post($db);

$data = json_decode(file_get_contents("php://input"));

$post->title=$data->title;
$post->body=$data->body;
$post->author=$data->author;
$post->category_id=$data->category_id;

if ($post->create()) {
    # code...
    echo json_encode(
        array('message' =>'record Created' )  );
} else {
    # code...
    echo json_encode(
        array('message' =>'Record Not Created' )  );
}