<html>
<head>
    <title>data</title>
    <style>
        body {
            background-color: #a7d3ff;
            font-family: Arial, sans-serif;
            text-align: center;
            color: #003366; 
            margin: 0;
            padding-top: 100px;
        }

        h1 {
            color: #004c99;
            margin-bottom: 20px;
        }

        form {
            background-color: #ffffff;
            display: inline-block;
            padding: 30px 50px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        label {
            font-weight: bold;
            color: #004c99;
        }

        input[type="text"] {
            width: 250px;
            padding: 6px 8px;
            margin: 5px 0 10px 0;
            border: 1px solid #aaa;
            border-radius: 6px;
            font-size: 14px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 8px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .note {
            margin-top: 20px;
            font-size: 13px;
            color: #004c99;
        }
    </style>
</head>
<body>
    <h1> Selamat Datang di Situs Kami</h1>
    Silahkan isi identitas Anda <br>
    <form method="post" action="proses.php">
        <pre>
            Nama : <input type="text" name="nama">
            Umur : <input type="text" name="umur"> tahun
            Email: <input type="text" name="email">
            <input type="submit" value="submit">
        </pre>
    </form>
</body>
</html>
