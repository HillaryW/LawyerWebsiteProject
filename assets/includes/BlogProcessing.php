<?php

/**
 * Class for processing creating and editing blog posts.
 */
class BlogProcessing
{
    private $conn;
    public $uploadOk;

    function __construct()
    {
        $dbcon = new DbConn();
        $this->conn = $dbcon->getConnection();
    }

    //insert blog entry to database
    function postBlogEntry($title, $content, $image)
    {
        print_r($image);
        if (!is_null($image)) {
            $filePath = $this->uploadImgtoServer($image);
            $sql = "INSERT INTO posts(title, content, image) VALUES (:title, :content, :image)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':image', $filePath, PDO::PARAM_STR);

        } else {
            $sql = "INSERT INTO posts(title, content) VALUES (:title, :content)";
            $stmt = $this->conn->prepare($sql);
        }

        $stmt->bindValue(':title', $title, PDO::PARAM_STR);
        $stmt->bindValue(':content', $content, PDO::PARAM_STR);

        //if block for insert success or failed
        if ($stmt->execute()) {
            $result = "New record created successfully";
        } else {
            $result = "Please try your submission again";
        }
        return $result;
    }

    function uploadImgtoServer($image)
    {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($image["name"]);

        // Check if image file is a actual image or fake image
        $check = getimagesize($image["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $result = "File is not an image.";
            $uploadOk = 0;
        }

        //get file type
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);


        // Check file size
        if ($image["size"] > 50000000000) {
            $result = "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            $result = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            if (move_uploaded_file($image['tmp_name'], $target_file)) {
                $result = $target_file;
            } else {
                $result = "Error uploading file";
            }
        }

        return $result;

    }


    //function to retrieve all blogs
    function getBlogs()
    {

        $sql = "SELECT * FROM posts ORDER BY timestamp DESC;";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->conn = null;
        return $results;
    }

    //function to retrieve a single blog
    function getBlog($id)
    {
        $sql = "SELECT * FROM posts WHERE blog_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->conn = null;
        return $results;
    }

    //function to delete a single blog
    function deleteBlog($id)
    {
        $sql = "DELETE FROM posts WHERE blog_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $this->conn = null;
    }

    //function to update blog entry
    function updateBlog($id, $title, $content, $image)
    {

        $content = trim($content);

        if (!is_null($image)) {
            $sql = "UPDATE posts SET title = :title, content = :content, image = :image WHERE blog_id = :id;";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':image', $image, PDO::PARAM_STR);
        } else {
            $sql = "UPDATE posts SET title = :title, content = :content WHERE blog_id = :id;";
            $stmt = $this->conn->prepare($sql);
        }

        $stmt->bindValue(':title', $title, PDO::PARAM_STR);
        $stmt->bindValue(':content', $content, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);


        //if block for insert success or failed
        if ($stmt->execute()) {
            $result = "Blog edited successfully.";
            $this->conn = null;
            return $result;
        } else {
            $result = "Please try your submission again";
            $this->conn = null;
            return $result;
        }

    }

    function updateImage($id, $title, $content, $image)
    {
        if (!is_null($image)) {
            $filePath = $this->uploadImgtoServer($image);
            $this->updateBlog($id, $title, $content, $filePath);
        } else {

            $this->updateBlog($id, $title, $content, $image);
        }
    }
}
?>