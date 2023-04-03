<?php 
	session_start();
    include_once 'config.php';
    $con = config::getConnexion();

    if(isset($_GET['id'])){
        $post=$_GET['post'];
		$stmt = $con->prepare("DELETE FROM `blog` WHERE `id` = :id");
		$stmt->bindValue(':id', $_GET['id']);
		$stmt->execute();
        header("Location:myblogs.php");        
	}	
?>
