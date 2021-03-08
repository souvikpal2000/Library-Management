<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Public Library Management</title>
		<link rel="stylesheet" href="CSS/ResetStyle.css">
		<link rel="stylesheet" href="CSS/Style.css">

		<!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>-->

		<script src="https://kit.fontawesome.com/68b0726c11.js" crossorigin="anonymous"></script>

		<style>
			#text{
				color: #f58080;
				margin-bottom: 10px;
				padding: 10px;
				text-align: center;
				font-weight: bold;
			}
			.login-logout{
				width: 50%;
    			color: #fff;
    			top: 55%;
    			left: 63%;
    			position: absolute;
    			transform: translate(-50%,-50%);
    			padding: 40px 30px;
    			font-size: 80px;
			}
		</style>
	</head>
	<body class="search-book">
		<nav class="nav-main">
			<div class="btn-toggle-nav" onclick="toggleNav()">
				<img src="Images/ToggleImage.png">
			</div>
			<ul>
				<li><a href="#">About Us</a></li>
				<li><a href="#">Contact</a></li>
			</ul>
		</nav>
		<aside class="nav-sidebar">
			<ul>
				<li><span>Menus</span></li>
				<li><a href="Registration.php">Registration</a></li>
				<li><a href="SearchUser.php">Search User</a></li>
				<li><a href="AddBook.php">Add New Book</a></li>
				<li><a href="SearchBook.php">Search Book</a></li>
				<li><a href="IssueBook.php">Issue Book</a></li>
				<li><a href="RenewBook.php">Renew Book</a></li>
				<li><a href="ReturnBook.php">Return Book</a></li>
				<li><a href="Login.php">Log Out</a></li>
			</ul>
		</aside>
		<p class="login-logout">
			<?php
				if(!isset($_SESSION['username']) && !isset($_SESSION['password']))
				{ 
					echo("Logged Out");
					exit();
			 	}
				else
				{

				}
			?>
		</p>
		<script src="Javascript/Main.js"></script>
		<div class="form">
			<h2>Search Book</h2>
			<form method="post" action="Includes/SearchBook.inc.php">
				<p id="text">
					<?php
						if(isset($_GET['text'])==False)
						{
							header("Location: SearchBook.php?text=");
							exit();
						}
						$text = $_GET['text'];
						echo("$text");
					?>
				</p>
				<i class="fas fa-search"></i>
				<input type="text" name="book" placeholder="Enter Book Name" required>

				<button type="search" name="submit" value="Submit">Search</button>
			</form>
		</div>
	</body>
</html>