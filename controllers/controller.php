<?php

require_once './models/posts.php';

class Controller
{


    public function CreatePost()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            $database = new Database();
            $db = $database->getConnexion();

            $post = new Post($db);

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
    
    }




    public function DeletePost()
    {
        if ($_SERVER['REQUEST_METHOD'] === "DELETE") {

            $database = new Database();
            $db = $database->getConnexion();

            $post = new Post($db);

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
    }



    public function ReadAllPost()
    {
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
    }


    public function ReadById()
    {
        if ($_SERVER['REQUEST_METHOD'] === "GET") {

            $database = new Database();
            $db = $database->getConnexion();

            $post = new post($db);

            $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $uriSegments = explode('/', $uri);
            $postId = $uriSegments[count($uriSegments) - 1];

            if (is_numeric($postId)) {
                $post->id = intval($postId);

                $statement = $post->readOne();

                if ($statement->rowCount() > 0) {
                    $postData = $statement->fetchAll(PDO::FETCH_ASSOC);
                    echo json_encode($postData);
                } else {
                    echo json_encode(["Message" => "Post not found"]);
                }
            } else {
                echo json_encode(['Message' => "Invalid post ID"]);
            }
        } else {
            echo json_encode(['Message' => "Method is not Allowed"]);
        }
    }


    public function UpdatePost()
    {
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
                    echo json_encode(['Message' => "Your post isn't successfully modified!"]);
                }
            } else {
                echo json_encode(['Message' => "There is a missing information"]);
            }
        } else {
            echo json_encode(['Message' => "Method is not Allowed"]);
        }
    }
}
