<?php
	if(isset($_POST['submit'])==True)
	{
		require "Dbh.inc.php";

		$username = $_POST['name'];
		$bookname = $_POST['book'];

		if(!preg_match("/^[a-z0-9]*$/", $username))
		{
			$text = "*Invalid Username";
			header("Location: ../ReturnBook.php?text=".$text);
			exit();
		}
		else
		{
			$sql = "SELECT * FROM users where uidUsers=?";
			$stmt = mysqli_stmt_init($connect);
			if(!mysqli_stmt_prepare($stmt,$sql))
			{
				header("Location: ../ReturnBook.php?error=sqlerror");
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
						header("Location: ../ReturnBook.php?error=sqlerror");
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
							$sql = "SELECT bid FROM issuereturn WHERE uidName=? AND bookName=?";
							$stmt = mysqli_stmt_init($connect);
							if(!mysqli_stmt_prepare($stmt,$sql))
							{
								header("Location: ../ReturnBook.php?error=sqlerror");
								exit();
							}
							else
							{
								mysqli_stmt_bind_param($stmt,"ss",$username,$bookname);
								mysqli_stmt_execute($stmt);
								$result = mysqli_stmt_get_result($stmt);
								$row = mysqli_fetch_assoc($result);
								$status = "1";
								$bookid = $row['bid'];
								$sql = "UPDATE book SET status=? WHERE bid=?";
								$stmt = mysqli_stmt_init($connect);
								if(!mysqli_stmt_prepare($stmt,$sql))
								{
									header("Location: ../ReturnBook.php?error=sqlerror");
									exit();
								}
								else
								{
									mysqli_stmt_bind_param($stmt,"ss",$status, $bookid);
									mysqli_stmt_execute($stmt);
									mysqli_stmt_store_result($stmt);
									$sql = "SELECT id FROM issuereturn WHERE uidName=? AND bookName=?";
									$stmt = mysqli_stmt_init($connect);
									if(!mysqli_stmt_prepare($stmt,$sql))
									{
										header("Location: ../ReturnBook.php?error=sqlerror");
										exit();
									}
									else
									{
										mysqli_stmt_bind_param($stmt,"ss",$username,$bookname);
										mysqli_stmt_execute($stmt);
										$result = mysqli_stmt_get_result($stmt);
										$row = mysqli_fetch_assoc($result);
										$id = $row['id'];
										$sql = "SELECT returnDate from issuereturn WHERE uidName=? AND bookName=?";
										$stmt = mysqli_stmt_init($connect);
										if(!mysqli_stmt_prepare($stmt,$sql))
										{
											header("Location: ../ReturnBook.php?error=sqlerror");
											exit();
										}
										else
										{
											mysqli_stmt_bind_param($stmt,"ss",$username,$bookname);
											mysqli_stmt_execute($stmt);
											$result = mysqli_stmt_get_result($stmt);
											$row = mysqli_fetch_assoc($result);
											$return = strtotime($row['returnDate']);
											$now = strtotime(date("Y-m-d"));
											$difference = $now - $return;
											$days = floor($difference/(60*60*24));
											$sql = "DELETE FROM issuereturn WHERE id=?";
											$stmt = mysqli_stmt_init($connect);
											if(!mysqli_stmt_prepare($stmt,$sql))
											{
												header("Location: ../ReturnBook.php?error=sqlerror");
												exit();
											}
											else
											{
												mysqli_stmt_bind_param($stmt,"s",$id);
												mysqli_stmt_execute($stmt);
												mysqli_stmt_store_result($stmt);
												if($days > 0)
												{
													$text = "*Fine Needed, Return Date was ".$row['returnDate'];
													header("Location: ../ReturnBook.php?text=".$text);
													exit();
												}
												else
												{
													$text = "Successfully Returned";
													header("Location: ../ReturnBook.php?text=".$text);
													exit();
												}
											}
										}
									}
								}	
							}
						}
						else
						{
							$text = "*This Book is not Borrowed";
							header("Location: ../ReturnBook.php?text=".$text);
							exit();
						}
					}
				}
				else
				{
					$text = "*This Username is not Registered";
					header("Location: ../ReturnBook.php?text=".$text);
					exit();
				}
			}
		}
	}
	else
	{
		header("Location: ../ReturnBook.php");
		exit();
	}
?>