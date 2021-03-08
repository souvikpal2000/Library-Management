<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Public Library Management</title>
        <link rel="stylesheet" href="CSS/ResetStyle.css">
        <link rel="stylesheet" href="CSS/UserDetails_Style.css">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <script src="https://kit.fontawesome.com/68b0726c11.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container-fluid bg-light p-4 text-center my-3">
            <h1><b>USER DETAILS</b></h1>
        </div>
        <div class="form" action="#" style="padding-top: 20px; padding-bottom: 20px">
            <label><b>Full Name : &nbsp;&nbsp;</b></label>
            <span class="details">
                <?php
                    echo($_SESSION['name']);
                ?>
            </span>
            <br><br><label><b>Username : &nbsp;&nbsp;</b></label> 
            <span class="details">
                <?php
                    echo($_SESSION['user']);
                ?>
            </span>
            <br><br><label><b>E-Mail : &nbsp;&nbsp;</b></label>
            <span class="details">
                <?php
                    echo($_SESSION['mail']);
                ?>
            </span>
            <br><br><label><b>Date of Birth : &nbsp;&nbsp;</b></label>
            <span class="details">
                <?php
                    echo($_SESSION['birth']);
                ?>
            </span>
            <br><br><label><b>Phone Number : &nbsp;&nbsp;</b></label>
            <span class="details">
                <?php
                    echo($_SESSION['number']);
                ?>
            </span>
            <br><br><label><b>Books Borrowed : &nbsp;&nbsp;</b></label>
            <span class="details">
                <?php
                    foreach($_SESSION['book'] as $bookname)
                    {
                        echo $bookname."&nbsp; &nbsp; &nbsp; &nbsp;";
                    }
                ?>
            </span>
            <br><a href="SearchUser.php"><button  type="goback">Go Back</button></a>
        </div>
    </body>
</html>