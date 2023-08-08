<?php

header('Access-Control-Allow-Origin:https: *');
header('content-type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: PUT');

require_once '../config/Database.php';
require_once '../models/posts.php';

if ($_SERVER['REQUEST_METHOD'] === "PUT") {

    $database = new Database();
    $db = $database->getConnexion();

    $post = new post($db);

    $dataPost = json_decode(file_get_contents("php://input"));

    if (!empty($dataPost->id) && !empty($dataPost->title) && !empty($dataPost->body) && !empty($dataPost->author)) {

        $post->id = intval($dataPost->id);
        $post->title = htmlspecialchars($dataPost->title);
        $post->body = htmlspecialchars($dataPost->body);
        $post->author = htmlspecialchars($dataPost->author);

        $result = $post->updatePost();
        if ($result) {
            echo json_encode(['Message' => "Your post is successfully modified!"]);
        } else {
            echo json_encode(['Message' => "your post isn't successfully modified!"]);
        }
    } else {
        echo json_encode(['Message' => "There is a missing information"]);
    }

} else {
    echo json_encode(['Message' => "Method is not Allowed"]);
}
