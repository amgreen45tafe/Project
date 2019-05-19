<?php 
	require_once("conn.php");
	
	$sql = $conn->prepare("DELETE  FROM agreen_website WHERE ID=?");  
	$sql->bind_param("i", $_GET["id"]); 
	$sql->execute();
	$sql->close(); 
	$conn->close();
	header('location:../website_master.php');		
?>