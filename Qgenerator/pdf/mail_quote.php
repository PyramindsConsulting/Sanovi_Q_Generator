<title> Sanovi Q-Generator </title>
<meta charset="UTF-8">
<link rel="shortcut icon" href="../favicon.ico" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/style-bg-other-pages.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>

<?php
    session_start(); 
    ob_start();
    # Include the Autoloader (see "Libraries" for install instructions)
    require 'vendor/autoload.php';
    use Mailgun\Mailgun;

    # Instantiate the client.
    $mgClient = new Mailgun('key-d1ed1feffaa3daf3750d037e38a2e65c');
    $domain = "pyraminds.in";
    if($_SESSION["authentication"] == "passed"){
        include "../../includes/header-plain.php";
        include "../../includes/mainmenu-mobile.php";
        include "../../includes/mainmenu.php";
        $emailaddress=$_GET["emailid"];

        $Quote_Name=$_GET["Quote_Name"];

        # Make the call to the client.
        $result = $mgClient->sendMessage($domain, array(
            'from'    => 'Sanovi Technologies Pvt Ltd<quote@sanovi.com>',
            'to'      => $emailaddress,
            'subject' => 'Quote from Sanovi Technologies',
            //'text'    => 'Hello, Please check attachment for the quote',
            'html'    => '<html>Hello Sir<br><br>Please find the quote attached with reference to our discussion<br><br>With Regards,<br>Sanovi Technologies</html>'
        ), array(
            'attachment' => array($Quote_Name)

        ));
        unlink($Quote_Name);
        echo "<center>";
        echo "<span style='color:Green;'>Quote Emailed Successfully</span><br>";
        echo "<img src=\"email-sent.jpg\">";
        echo "</center>";
        ob_flush();
    }
?>