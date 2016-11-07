<!doctype html>
<html>

<head>
    <title> Sanovi Q-Generator </title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style-admin.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<body>
    <?php 
        include "../../includes/config.php";
        include "../../includes/php_functions.php";

        //print_r ($details);

        $emailError ="";
        $error="InvalidEmail";


        if(isset($_POST['submit'])){


            if (empty($_POST["email"])) {
                $emailError = "Email is mandatory";
                $error.="email";
            }else {    
                if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                    $emailError = "Invalid email format";
                    $error="InvalidEmail";
                }else{
                    $email=$_POST["email"];
                    $error="";
                }
            }

            if($error==""){
                echo "Submitted";
            }
        }
            
    ?>
        <div class="font">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-md-9 breadcrumbs_div">
                        <div class="col-sm-12 main_content">
                            <form method="post" action="">
                                <br>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label class="control-label">Email id * :</label>
                                        </div>
                                        <div class="col-sm-4">
                                            <input id="modify_user_emailid" type="text" name="email" class="form-control"> <span style='color:red;font-size:15px' class="error"><?php echo $emailError;?></span> </div>
                                        <div class="col-sm-5"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <button id="modify_user_submit_btn" type="submit" name="submit" class="btn btn-default">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>