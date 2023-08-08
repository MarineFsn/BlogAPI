<?php

class Post
{
    private $table = "posts";
    private $connexion = null;


    public $id;
    public $title;
    public $body;
    public $author;
    public $created_at;
    public $updated_at;

    public function __construct($db)
    {
        if ($this->connexion == null) {
            $this->connexion = $db;
        }
    }  

    public function readAll()
    {
        $sql = "SELECT * FROM $this->table";
        $query = $this->connexion->query($sql);
        return $query;
    }


    public function createPost()
    {
        $sql = "INSERT INTO $this->table(title, body, author, created_at)
        VALUES (:title,:body,:author, NOW())";

        $query = $this->connexion->prepare($sql);
        $query->execute([
            ':title' => $this->title,
            ':body' => $this->body,
            ':author' => $this->author
        ]);
        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updatePost()
    {
        $sql = "UPDATE $this->table SET title= :title, body= :body, author= :author, updated_at= NOW() 
        WHERE id= :id";

        $query = $this->connexion->prepare($sql);
        $query->execute([
            ':title' => $this->title,
            ':body' => $this->body,
            ':author' => $this->author,
            'id' => $this->id
        ]);
        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deletePost()
    {
        $sql = "DELETE FROM $this->table WHERE id = :id";
        $query = $this->connexion->prepare($sql);

        $exeQuery= $query->execute(array(":id" =>$this->id));

        if ($exeQuery) {
            return true;
        }else{
            return false;
        }
    }
}
