<?php session_start();

if (!isset($_SESSION['loggedIn'])) {
    $_SESSION['loggedIn'] = false;
    $_SESSION['login'] = "";
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Station météo</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'header.php' ?>
<div id="gridError">
    <p>Error. Please go back and try again</p>
        <?php 
            if(isset($_GET['msg']))
            {
                echo "<p>Details : </p>";
                echo "<p>";
                echo $_GET['msg'];
                echo "</p>";
            }
        ?>
</div>
        <?php include 'footer.php' ?>
        <script src="script.js"></script>
</body>
</html>