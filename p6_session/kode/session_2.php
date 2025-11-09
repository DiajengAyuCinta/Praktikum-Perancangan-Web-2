<?php
session_start();
$idsession = session_id();
if (!isset($_SESSION['count'])){
    $_SESSION['count'] = 0;
}
$_SESSION['count']++;
$count = $_SESSION['count'];
?>
<html>
    <head>
        <title>Demo Session 2 - Destroy</title>
        <style>
        body {
            background-color: #a7d3ff;
            font-family: Arial, sans-serif;
            text-align: center;
            color: #004080;
            margin-top: 150px;
        }
        h1 {
            color: #0059b3;
        }
    </style>
    </head>
    <body>
         <body>
        <h1> Demo Session 2 - Reset Nilai</h1>
        <?php
        echo "ID Session : " .$idsession ."<br>";
        echo "Anda mengakses server ini sebanyak :" .$count;
        ?>
    </body>
    </body>
</html>
