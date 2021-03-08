<?php 
	if(isset($_POST['submit'])==True)
	{
		require "Dbh.inc.php";

		$fullname = $_POST['name'];
		$username = $_POST['uname'];
		$email = $_POST['email'];
		$birth = $_POST['dob'];
		$phone = $_POST['pno'];

		if(!filter_var($email,FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-z0-9]*$/", $username))
		{
			$text = "*Invalid Email & Username";
			header("Location: ../SignUp.php?text=".$text);
			exit();
		}
		else if(!filter_var($email,FILTER_VALIDATE_EMAIL))
		{
			$text = "*Invalid Email";
			header("Location: ../SignUp.php?text=".$text);
			exit();
		}
		else if(!preg_match("/^[a-z0-9]*$/", $username))
		{
			$text = "*Invalid Username";
			header("Location: ../SignUp.php?text=".$text);
			exit();
		}
		else
		{
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
					$text = "*Username is Already Taken";
					header("Location: ../Registration.php?text=".$text);
					exit();
				}
				else
				{
					$sql = "INSERT INTO users(fullName, uidusers, email, dob, phone) VALUES(?,?,?,?,?)";
					$stmt = mysqli_stmt_init($connect);
					if(!mysqli_stmt_prepare($stmt, $sql))
					{
						header("Location: ../Registration.php?error=sqlerror");
					}
					else
					{
						mysqli_stmt_bind_param($stmt,"sssss",$fullname, $username, $email, $birth, $phone);
						mysqli_stmt_execute($stmt);
						mysqli_stmt_store_result($stmt);
						$text = "Registered Successfully";
						header("Location: ../Registration.php?text=".$text);
						exit();
					}
				}
			}
		}
		mysqli_stmt_close($stmt);
		mysqli_close($connect);
	}
	else
	{
		header("Location: ../Registration.php");
		exit();
	}
?>