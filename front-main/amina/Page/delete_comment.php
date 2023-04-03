<?php 
	session_start();
    include_once 'config.php';
    $con = config::getConnexion();

    if(isset($_GET['id'])){
        $post=$_GET['post'];
		$stmt = $con->prepare("DELETE FROM `comments` WHERE `id` = :id");
		$stmt->bindValue(':id', $_GET['id']);
		$stmt->execute();
        header("Location:blog-post.php?id=$post");        
	}	
?>
