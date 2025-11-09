<?php
session_start();
$nama = $_POST["nama"];
$umur = $_POST["umur"];
$email = $_POST["email"];
$waktu = date("Y-m-d H:i:s");
$_SESSION["nama"] = $nama;
$_SESSION["umur"] = $umur;
$_SESSION["email"] = $email;
?>
<html>
    <head>
        <title>proses</title>
        <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #a7d3ff;
            color: #003366;
            text-align: center;
            margin: 0;
            padding-top: 100px;
        }

        .container {
            background-color: #ffffff;
            display: inline-block;
            padding: 40px 60px;
            border-radius: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.15);
        }

        h1 {
            color: #0d47a1;
            margin-bottom: 10px;
        }

        h2 {
            color: #1565c0;
            margin-top: 0;
            font-weight: normal;
        }

        p {
            font-size: 1.1em;
            margin: 10px 0;
        }

        a {
            display: inline-block;
            margin-top: 25px;
            background-color: #1565c0;
            color: white;
            padding: 10px 25px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        a:hover {
            background-color: #0d47a1;
        }
    </style>
    </head>
    <body>
        <?php
        echo "<h1> Hallo ".$_SESSION["nama"]. "</h1>"
        ?>
        <h2> Selamat Datang Di Situs Kami</h2>
        <?php
        echo "Umur Anda saat ini adalah ".$_SESSION["umur"]."tahun <br>";
        echo "Alamat email Anda adalah " .$_SESSION["email"]. "<br>";
        ?>
        <br>
        <a href="next.php"> Klik disini</a> untuk menuju ke halaman berikut.
    </body>
</html>