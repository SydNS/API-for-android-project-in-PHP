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
    public function readSingle()
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
          where
          p.id =? 
          limit 1  ";

          $stmt= $this->conn->prepare($query);
          $stmt->bindParam(1,$this->id);
          $stmt->execute();

          $row= $stmt->fetch(PDO::FETCH_ASSOC);

          $this->title=$row['title'];
          $this->body=$row['body'];
          $this->author=$row['author'];
          $this->category_id=$row['category_id'];
          $this->category_name=$row['category_name'];



          return $stmt;
          
     }


     public function inSert()
     {
         $query="INSERT INTO posts
          
         SET
          title = :title, 
          body = :body, 
          age = :age, 
          author = :author, 
          category_id=category_id,
          created_at = :created_at";

          
        $stmt= $this->conn->prepare($query);

        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->body=htmlspecialchars(strip_tags($this->body));
        $this->author=htmlspecialchars(strip_tags($this->author));
        $this->category_id=htmlspecialchars(strip_tags($this->category_id));

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":body", $this->body);
        $stmt->bindParam(":age", $this->age);
        $stmt->bindParam(":author", $this->author);
        $stmt->bindParam(":category_id", $this->category_id);
        
        if ($stmt->execute()) {
            return true;
            # code...
        }
         printf("Error : %s  .\n",$stmt->error)
          
     } 

     


}
?>