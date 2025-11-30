<html>
<head>
    <title>Upload Gambar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f6f7fb;
            display: flex;
            justify-content: center;
            margin-top: 50px;
        }

        table {
            background: #ffffff;
            padding: 20px 30px;
            border-radius: 12px;
            box-shadow: 0px 4px 12px rgba(0,0,0,0.1);
            border-collapse: separate;
        }

        th {
            background: #a7c7e7;
            color: #fff;
            padding: 12px;
            border-radius: 10px;
            font-size: 18px;
        }

        td {
            padding: 10px;
            font-size: 15px;
            color: #333;
        }

        input[type="text"],
        input[type="file"] {
            padding: 8px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 6px;
            background: #fdfdfd;
        }

        input[type="submit"] {
            background: #85a6d1;
            border: none;
            padding: 10px 18px;
            color: white;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
        }

        input[type="submit"]:hover {
            background: #6a8bbd;
        }
    </style>
</head>
<body>
    <form method="post" action="script_proses.php" enctype="multipart/form-data">
        <table>
            <tr>
                <th colspan="2">FORM UPLOAD FOTO</th>
            </tr>
            <tr>
                <td>Masukan Nama</td>
                <td>Pilih Foto</td>
            </tr>
            <tr>
                <td><input type="text" name="nama" id="nama" placeholder="masukan nama" required=""></td>
                <td><input type="file" name="foto" id="foto" required=""></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="kirim" id="kirim" value="SIMPAN"></td>
            </tr>
        </table>
    </form>
</body>
</html>
