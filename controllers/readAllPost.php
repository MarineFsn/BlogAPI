<?php

header('Access-Control-Allow-Origin:https: *');
header('content-type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: GET');

require_once '../config/Database.php';
require_once '../models/posts.php';

if ($_SERVER['REQUEST_METHOD'] === "GET") {

    $database = new Database();
    $db = $database->getConnexion();

    $post = new post($db);

    $statement = $post->readAll();

    if ($statement->rowCount() > 0) {
        $postData = [];

        $postData[] = $statement->fetchAll();

        echo json_encode($postData);
    } else {
        echo json_encode(["Message" => "There is no Data to show up"]);
    }
} else {

    echo json_encode(['Message' => "Method is not Allowed"]);
}
