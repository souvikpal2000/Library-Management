<?php
	if(isset($_POST['submit']))
	{
		require "Dbh.inc.php";

		$username = $_POST['uname'];
		$complain = $_POST['complain'];


		$sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql))
		{
			header("Location: ../Registration.php?error=sqlerror");
		}
		else
		{
			mysqli_stmt_bind_param($stmt,"s",$username);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$resultCheck = mysqli_stmt_num_rows($stmt);
			if($resultCheck > 0)
			{
				$sql = "INSERT INTO contact(user,complain) VALUES(?,?)";
				$stmt = mysqli_stmt_init($connect);
				if(!mysqli_stmt_prepare($stmt, $sql))
				{
					header("Location: ../Registration.php?error=sqlerror");
				}
				else
				{
					mysqli_stmt_bind_param($stmt,"ss",$username,$complain);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_store_result($stmt);
					$text = "Complaint Registered";
					header("Location: ../Contact.php?text=".$text);
					exit();
				}
			}
			else
			{
				$text = "*Username is not Registered";
				header("Location: ../Contact.php?text=".$text);
				exit();
			}
		}
	}
	else
	{
		header("Location: ../Contact.php");
		exit();
	}
?>