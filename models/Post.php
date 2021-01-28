<?php


class Post{
     private $conn;
     private $table="posts";

     public $id;
     public $category;
     public $title;
     public $body;
     public $author;
     public $created_at;

     public function __construct($db){
         $this->conn=$db;   }

     public function read()
     {
         $query="SELECT
         c.name as category_name,
         p.id,
         p.category_id,
         p.title, 
         p.body,
         p.category_id,
         p.author,
         p.created_at
         from posts p
          LEFT JOIN 
            categories c ON p.category_id=c.id
          ORDER BY
            p.created_at DESC";

          $stmt= $this->conn->prepare($query);
          $stmt->execute();

          return $stmt;
          
     }

    //  read single
     public function readSingles()
     {
         $query="SELECT
         c.name as category_name,
         p.id,
         p.category_id,
         p.title, 
         p.body,
         p.category_id,
         p.author,
         p.created_at
         from posts p
          LEFT JOIN 
            categories c ON p.category_id=c.id
          ORDER BY
            p.created_at DESC
          where
          p.id =? 
          limit 0,1  ";

          $stmt= $this->conn->prepare($query);
          $stmt->bindParams(1,$this->id);
          $stmt->execute();

          $row= $this->fetch(PDO::FETCH_SSOC);
          $this->title=$row['title'];
          $this->body=$row['body'];
          $this->author=$row['author'];
          $this->category=$row['category'];
          $this->category_name=$row['category_name'];



          return $stmt;
          
     }



}
?>