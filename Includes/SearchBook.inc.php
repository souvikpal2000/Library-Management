<?php
	if(isset($_POST['submit'])==True)
	{
		require "Dbh.inc.php";

		$bookname = $_POST['book'];

		$sql = "SELECT * FROM book where name=?";
		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt,$sql))
		{
			header("Location: ../SearchBook.php?error=sqlerror");
			exit();
		}
		else
		{
			mysqli_stmt_bind_param($stmt,"s",$bookname);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$resultCheck = mysqli_stmt_num_rows($stmt);
			if($resultCheck > 0)
			{
				$status = "1";
				$sql = "SELECT COUNT(*) AS count FROM book WHERE name=? AND status=?";
				$stmt = mysqli_stmt_init($connect);
				if(!mysqli_stmt_prepare($stmt,$sql))
				{
					header("Location: ../SearchBook.php?error=sqlerror");
					exit();
				}
				else
				{
					mysqli_stmt_bind_param($stmt,"ss",$bookname,$status);
					mysqli_stmt_execute($stmt);
					$result = mysqli_stmt_get_result($stmt);
					$row = mysqli_fetch_assoc($result);
					if($row['count'] > 1)
					{
						$text = $row['count']." Copies are Available";
						header("Location: ../SearchBook.php?text=".$text);
						exit();
					}
					else if($row['count'] == 1)
					{
						$text = $row['count']." Copy is Available";
						header("Location: ../SearchBook.php?text=".$text);
						exit();
					}
					else
					{
						$text = "This Book is not Available Now";
						header("Location: ../SearchBook.php?text=".$text);
						exit();
					}
				}
			}
			else
			{
				$text = "This Book is not Available in Library";
				header("Location: ../SearchBook.php?text=".$text);
				exit();
			}
		}
	}
	else
	{
		header("Location: ../SearchBook.php");
		exit();
	}
?>