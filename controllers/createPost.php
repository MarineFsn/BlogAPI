<?php

header('Access-Control-Allow-Origin:https: *');
header('content-type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: POST');

require_once '../config/Database.php';
require_once '../models/posts.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $database = new Database();
    $db = $database->getConnexion();

    $post = new post($db);

    $dataPost = json_decode(file_get_contents("php://input"));
    if (!empty($dataPost->title) && !empty($dataPost->body) && !empty($dataPost->author)) {

        $post->title = htmlspecialchars($dataPost->title);
        $post->body = htmlspecialchars($dataPost->body);
        $post->author = htmlspecialchars($dataPost->author);

        $result = $post->createPost();
        if ($result) {
            echo json_encode(['Message' => "Your post is successfully added!"]);
        } else {
            echo json_encode(['Message' => "your post isn't successfully added!"]);
        }
    } else {
        echo json_encode(['Message' => "There is a missing information"]);
    }
} else {
    echo json_encode(['Message' => "Method is not Allowed"]);
}
