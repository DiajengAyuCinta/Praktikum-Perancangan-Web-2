<?php
session_start();
?>
<html>
    <head>
        <style>
        body {
            font-family: "Poppins", sans-serif;
            background-color: #a7d3ff;
            color: #003366;
            margin: 0;
            padding: 0;
            text-align: center;
            padding-top: 100px;
        }

        .container {
            background-color: #ffffff;
            display: inline-block;
            padding: 40px 60px;
            border-radius: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.15);
        }

        h2 {
            color: #1565c0;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.1em;
            margin: 10px 0;
            color: #003366;
        }

        a {
            display: inline-block;
            margin-top: 25px;
            padding: 10px 25px;
            background-color: #1565c0;
            color: white;
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
        <h2> Anda memasuki halaman kedua</h2>
        <?php
        echo "Nama anda ".$_SESSION["nama"]."<br>";
        echo "Umur Anda saat ini adalah ".$_SESSION["umur"]."tahun <br>";
        echo "Alamat email Anda adalah " .$_SESSION["email"]. "<br>";
        ?>
        <a href="data.php"> Klik disini </a> untuk menuju ke halaman awal
    </body>
</html>
<?php
//untuk menghapus variabel session di server
session_destroy();
?>
