<?php
	if(isset($_POST['submit'])==True)
	{
		require "Dbh.inc.php";

		$username = $_POST['name'];
		$bookname = $_POST['book'];
		$return = $_POST['return'];

		if(!preg_match("/^[a-z0-9]*$/", $username))
		{
			$text = "*Invalid Username";
			header("Location: ../IssueBook.php?text=".$text);
			exit();
		}
		else
		{
			$sql = "SELECT * FROM users where uidUsers=?";
			$stmt = mysqli_stmt_init($connect);
			if(!mysqli_stmt_prepare($stmt,$sql))
			{
				header("Location: ../IssueBook.php?error=sqlerror");
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
					$sql = "SELECT * FROM book where name=?";
					$stmt = mysqli_stmt_init($connect);
					if(!mysqli_stmt_prepare($stmt,$sql))
					{
						header("Location: ../IssueBook.php?error=sqlerror");
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
								header("Location: ../IssueBook.php?error=sqlerror");
								exit();
							}
							else
							{
								mysqli_stmt_bind_param($stmt,"ss",$bookname,$status);
								mysqli_stmt_execute($stmt);
								$result = mysqli_stmt_get_result($stmt);
								$row = mysqli_fetch_assoc($result);
								if($row['count'] >= 1)
								{
									$issue = date("Y-m-d");
									$sql = "SELECT bid FROM book WHERE name=? AND status=?";
									$stmt = mysqli_stmt_init($connect);
									if(!mysqli_stmt_prepare($stmt,$sql))
									{
										header("Location: ../IssueBook.php?error=sqlerror");
										exit();
									}
									else
									{
										mysqli_stmt_bind_param($stmt,"ss",$bookname,$status);
										mysqli_stmt_execute($stmt);
										$result = mysqli_stmt_get_result($stmt);
										$row = mysqli_fetch_assoc($result);
										$bookid = $row['bid']; //Doubt
										$status = "0";
										$sql = "UPDATE book SET status=? WHERE bid=?";
										$stmt = mysqli_stmt_init($connect);
										if(!mysqli_stmt_prepare($stmt,$sql))
										{
											header("Location: ../IssueBook.php?error=sqlerror");
											exit();
										}
										else
										{
											mysqli_stmt_bind_param($stmt,"ss",$status, $bookid);
											mysqli_stmt_execute($stmt);
											mysqli_stmt_store_result($stmt);
											$sql = "INSERT INTO issuereturn(uidName, bid, BookName, issueDate, returnDate) VALUES(?,?,?,?,?)";
											$stmt = mysqli_stmt_init($connect);
											if(!mysqli_stmt_prepare($stmt, $sql))
											{
												header("Location: ../IssueBook.php?error=sqlerror");
											}
											else
											{
												mysqli_stmt_bind_param($stmt,"sssss",$username, $bookid, $bookname, $issue, $return);
												mysqli_stmt_execute($stmt);
												mysqli_stmt_store_result($stmt);
												$text = "Successfully Issued";
												header("Location: ../IssueBook.php?text=".$text);
												exit();
											}
										}
									}
								}
								else
								{
									$text = "This Book is not Available Now";
									header("Location: ../IssueBook.php?text=".$text);
									exit();
								}
							}
						}
						else
						{
							$text = "This Book is not Available in Library";
							header("Location: ../IssueBook.php?text=".$text);
							exit();
						}
					}
				}
				else
				{
					$text = "*This Username is not Registered";
					header("Location: ../IssueBook.php?text=".$text);
					exit();
				}
			}
		}	
	}
	else
	{
		header("Location: ../IssueBook.php");
		exit();
	}
?>