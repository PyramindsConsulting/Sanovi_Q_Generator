<?php 
    session_start(); 
    ob_start();
?>  

    <!doctype html>
    <html>

    <head>
        <title> Sanovi Q-Generator </title>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="../favicon.ico" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/breadcrumbs.css">
        <link rel="stylesheet" href="../css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="js/finalcrumb.js"></script>

    </head>
        <body>
           <?php 
            include "../includes/php_functions.php";
            include "../includes/php_functions_q_gen.php";
//                send_email_alert($_SESSION["emp_id"],57);
//                send_email_alert("SAN003",79);
            echo GenerateRandomString(128);
            ?>
        </body>