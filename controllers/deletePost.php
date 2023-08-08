<?php

header('Access-Control-Allow-Origin:https: *');
header('content-type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: DELETE');

require_once '../config/Database.php';
require_once '../models/posts.php';

if ($_SERVER['REQUEST_METHOD'] === "DELETE") {

    $database = new Database();
    $db = $database->getConnexion();

    $post = new post($db);

    $dataPost = json_decode(file_get_contents("php://input"));

    if (!empty($dataPost->id)) {
        $post->id = $dataPost->id;
        if ($post->deletePost()) {
            echo json_encode(array("Message" => "Post deleted successfully"));
        } else {
            echo json_encode(array("Message" => "Post deletion failed"));
        }
    } else {
        echo json_encode(['Message' => "you have to select a post's id"]);
    }
} else {
    echo json_encode(['Message' => "Method is not Allowed"]);
}
