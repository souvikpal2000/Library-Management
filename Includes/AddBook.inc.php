<?php
	if(isset($_POST['submit'])==True)
	{
		require "Dbh.inc.php";

		$bookname = $_POST['book'];
		$status = 1;

		$sql = "INSERT INTO book(name, status) VALUES(?,?)";
		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql))
		{
			header("Location: ../AddBook.php?error=sqlerror");
		}
		else
		{
			mysqli_stmt_bind_param($stmt,"ss",$bookname, $status);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$text = "Successfully Added";
			header("Location: ../AddBook.php?text=".$text);
			exit();
		}
		mysqli_stmt_close($stmt);
		mysqli_close($connect);
	}
	else
	{
		header("Location: ../AddBook.php");
		exit();
	}
?>