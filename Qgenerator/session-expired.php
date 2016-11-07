    <!doctype html>
    <html>

    <head>
        <title> Sanovi Q-Generator </title>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="favicon.ico" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<!--        <script src="../js/menu.js"></script>-->
    </head>

    <body onresize="change_menus()">
        <?php 
            include "../includes/header-plain.php";
        ?>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <br>
                        <center>
                            <img src="images/Session-Expired.jpg" width=35%>
                            <br><br>
                            <form action="localhost/sanovi" method="post">
                            <button class="btn btn-success" onclick="http://localhost/sanovi">LOGIN AGAIN</button>
                                </form>
                        </center>
                    </div>
                </div>
            </div>
    </body>

    </html>
<!--<img src="images/Session-Expired.jpg" width=25%>-->