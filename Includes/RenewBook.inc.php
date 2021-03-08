<?php
	if(isset($_POST['submit'])==True)
	{
		require "Dbh.inc.php";

		$username = $_POST['name'];
		$bookname = $_POST['book'];
		$newreturn = $_POST['new'];

		if(!preg_match("/^[a-z0-9]*$/", $username))
		{
			$text = "*Invalid Username";
			header("Location: ../RenewBook.php?text=".$text);
			exit();
		}
		else
		{
			$sql = "SELECT * FROM users where uidUsers=?";
			$stmt = mysqli_stmt_init($connect);
			if(!mysqli_stmt_prepare($stmt,$sql))
			{
				header("Location: ../RenewBook.php?error=sqlerror");
				exit();
			}
			else
			{
				mysqli_stmt_bind_param($stmt,"s",$username);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				$resultCheck = mysqli_stmt_num_rows($stmt);
				if($resultCheck > 0)
				{
					$sql = "SELECT COUNT(*) AS count FROM issuereturn WHERE uidName=? AND bookName=?";
					$stmt = mysqli_stmt_init($connect);
					if(!mysqli_stmt_prepare($stmt,$sql))
					{
						header("Location: ../RenewBook.php?error=sqlerror");
						exit();
					}
					else
					{
						mysqli_stmt_bind_param($stmt,"ss",$username,$bookname);
						mysqli_stmt_execute($stmt);
						$result = mysqli_stmt_get_result($stmt);
						$row = mysqli_fetch_assoc($result);
						if($row['count'] > 0)
						{
							$sql = "SELECT id FROM issuereturn WHERE uidName=? AND bookName=?";
							$stmt = mysqli_stmt_init($connect);
							if(!mysqli_stmt_prepare($stmt,$sql))
							{
								header("Location: ../RenewBook.php?error=sqlerror");
								exit();
							}
							else
							{
								mysqli_stmt_bind_param($stmt,"ss",$username,$bookname);
								mysqli_stmt_execute($stmt);
								$result = mysqli_stmt_get_result($stmt);
								$row = mysqli_fetch_assoc($result);
								$id = $row['id'];
								$sql = "UPDATE issuereturn SET returnDate=? WHERE id=?";
								$stmt = mysqli_stmt_init($connect);
								if(!mysqli_stmt_prepare($stmt,$sql))
								{
									header("Location: ../RenewBook.php?error=sqlerror");
									exit();
								}
								else
								{
									mysqli_stmt_bind_param($stmt,"ss",$newreturn,$id);
									mysqli_stmt_execute($stmt);
									mysqli_stmt_store_result($stmt);
									$text = "Successfully Renewed";
									header("Location: ../RenewBook.php?text=".$text);
									exit();
								}
							}
						}
						else
						{
							$text = "*This Book is not Borrowed";
							header("Location: ../RenewBook.php?text=".$text);
							exit();
						}
					}
				}
				else
				{
					$text = "*This Username is not Registered";
					header("Location: ../RenewBook.php?text=".$text);
					exit();
				}
			}
		}
	}
	else
	{
		header("Location: ../RenewBook.php");
		exit();
	}
?>