<?php
	require_once("conn.php");
	if (isset($_POST['submit'])) {		
		$sql = $conn->prepare("UPDATE agreen_website SET Title=? , Description=? , Author=? , DateModified=? , Content=? WHERE ID=?");
		$title=$_POST['title'];
		$desc = $_POST['desc'];
		$author= $_POST['author'];
		$datemod= $_POST['datemod'];
		$content= $_POST['content'];				
		$sql->bind_param("ssssss",$title, $desc, $author, $datemod, $content, $_GET["id"]);	
		if($sql->execute()) {
			$success_message = "Edited Successfully";
		} else {
			$error_message = "Problem in Editing Record";
		}

	}
	$sql = $conn->prepare("SELECT * FROM agreen_website WHERE ID=?");
	$sql->bind_param("i",$_GET["id"]);			
	$sql->execute();
	$result = $sql->get_result();
	if ($result->num_rows > 0) {		
		$row = $result->fetch_assoc();
	}
	$conn->close();
?>
<html>
<head>
<link href="css/crudstyle.css" rel="stylesheet" type="text/css" />
<style>
.tbl-qa{border-spacing:0px;border-radius:4px;border:#6ab5b9 1px solid;}
</style>
<title>Website edit</title>
</head>
<body>
<?php if(!empty($success_message)) { ?>
<div class="success message"><?php echo $success_message; ?></div>
<?php } if(!empty($error_message)) { ?>
<div class="error message"><?php echo $error_message; ?></div>
<?php } ?>
<form name="frmUser" method="post" action="">
<div class="button_link"><a href="../website_master.php" >Back to List </a></div>
<table border="0" cellpadding="10" cellspacing="0" width="500" align="center" class="tbl-qa">
	<thead>
		<tr>
			<th colspan="2" class="table-header">Website Edit</th>
		</tr>
	</thead>
	<tbody>
		<tr class="table-row">
			<td><label>Title</label></td>
			<td><input type="text" name="title" class="txtField" value="<?php echo $row["Title"]?>"></td>
		</tr>
		<tr class="table-row">
			<td><label>Name</label></td>
			<td><input type="text" name="desc" class="txtField" value="<?php echo $row["Description"]?>"></td>
		</tr>
		<tr class="table-row">
			<td><label>Author</label></td>
			<td><input type="text" name="author" class="txtField" value="<?php echo $row["Author"]?>"></td>
		</tr>
		<tr class="table-row">
			<td><label>DateModified</label></td>
			<td><input type="text" name="datemod" class="txtField" value="<?php echo $row["DateModified"]?>"></td>
		</tr>	
		<tr class="table-row">
			<td><label>Content</label></td>
			<td><textarea name="content" class="txtField"><?php echo $row["Content"]?></textarea></td>
		</tr>			
		<tr class="table-row">
			<td colspan="2"><input type="submit"  name="submit" value="Submit" class="demo-form-submit"></td>
		</tr>
	</tbody>	
</table>
</form>
</body>
</html>