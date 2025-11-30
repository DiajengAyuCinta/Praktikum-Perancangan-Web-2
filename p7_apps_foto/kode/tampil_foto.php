<?php
include('koneksi.php');
$perintah = "SELECT * FROM upload_file_gambar ORDER BY id_file DESC";
$query = mysqli_query($conn, $perintah);
?>
<html>
<head>
    <title>Halaman tampil</title>
    <style>
        body {
            font-family: Arial;
            background: #f2f7ff;
            margin: 0;
            padding: 30px;
        }

        .container {
            width: 750px;
            margin: auto;
            background: #ffffff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #4169E1;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fafcff;
            border-radius: 10px;
            overflow: hidden;
        }

        th {
            background: #79a6f6;
            padding: 12px;
            font-size: 15px;
            color: white;
        }

        td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #e0e8ff;
        }

        tr:hover {
            background: #eef4ff;
        }

        img {
            border-radius: 6px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        }

        .delete-btn {
            background: #ff4d4d;
            color: white;
            padding: 7px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 13px;
        }

        .delete-btn:hover {
            background: #d93636;
        }
    </style>
</head>
<body>
    <table width="500" border="1" cellspacing="0" cellpadding="5">
        <tr>
            <th colspan="4">
                MENAMPILKAN FOTO
            </th>
        </tr>
        <tr>
            <th>NO</th>
            <th>NAMA</th>
            <th>FOTO</th>
            <th>DELETE</th>
        </tr>
        <?php
        while ($data = mysqli_fetch_array($query)) {
            ?>
            <tr>
                <td><?php echo $data['id_file']; ?></td>
                <td><?php echo $data['file_name']; ?></td>
                <td align="center">
                    <img src="<?php echo $data['file_path']; ?>" width="60" height="60">
                </td>
                <td>
                    <a href="delete_foto.php?del=<?php echo $data['id_file'];?>"
                    onclick="return confirm ('Yakin ingin menghapus?')">
                    DELETE
                </a>
                </td>
            </tr>
        <?php } ?>
    </table>
    
</body>
</html>
