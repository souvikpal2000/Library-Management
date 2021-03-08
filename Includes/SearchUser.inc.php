<?php
	if(isset($_POST['submit'])==True)
	{
		require "Dbh.inc.php";

		$username = $_POST['name'];

		if(!preg_match("/^[a-z0-9]*$/", $username))
		{
			$text = "*Invalid Username";
			header("Location: ../SearchUser.php?text=".$text);
			exit();
		}
		else
		{
			$sql = "SELECT uid FROM users WHERE uidusers=?";
			$stmt = mysqli_stmt_init($connect);
			if(!mysqli_stmt_prepare($stmt, $sql))
			{
				header("Location: ../SearchUser.php?error=sqlerror");
			}
			else
			{
				mysqli_stmt_bind_param($stmt,"s",$username);
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				$row = mysqli_fetch_assoc($result);
				if($row['uid'] > 0)
				{
					$id = $row['uid'];
					$sql = "SELECT fullName, uidusers, email, dob, phone FROM users WHERE uid=?";
					$stmt = mysqli_stmt_init($connect);
					if(!mysqli_stmt_prepare($stmt, $sql))
					{
						header("Location: ../SearchUser.php?error=sqlerror");
					}
					else
					{
						mysqli_stmt_bind_param($stmt,"s",$id);
						mysqli_stmt_execute($stmt);
						$result = mysqli_stmt_get_result($stmt);
						$row = mysqli_fetch_assoc($result);
						session_start();
						$_SESSION['name'] = $row['fullName'];
						$_SESSION['user'] = $row['uidusers'];
						$_SESSION['mail'] = $row['email'];
						$_SESSION['birth'] = $row['dob'];
						$_SESSION['number'] = $row['phone'];

						$sql = "SELECT bookName FROM issuereturn WHERE uidName='$username'";
						$result = mysqli_query($connect, $sql);
						$_SESSION['book']=array();
						if(mysqli_num_rows($result) > 0)
						{
							while($row = mysqli_fetch_assoc($result))
							{
								array_push($_SESSION['book'],$row['bookName']);
							}
                    		header("Location: ../UserDetails.php?text=UserFound");
							exit();
						}
						else
						{
							$_SESSION['book'] = array("No Books is Borrowed");
							header("Location: ../UserDetails.php?text=UserFound");
							exit();
						}
					}
				}
				else
				{
					$text = "*This Username is not Registered";
					header("Location: ../SearchUser.php?text=".$text);
					exit();
				}
			}
		}
	}
	else
	{
		header("Location: ../SearchUser.php");
		exit();
	}
?>