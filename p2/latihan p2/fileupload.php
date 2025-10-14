<html>
    <head>
        <title>Form untuk input nama file</title>
</head>
<body>
    <h1>Upload File</h1>
    <br>Klik Browse untuk memilih !
    <form enctype="multipart/form-data" method="post" action="do_upload.php"> 
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
        <label>pilih file:</label>
        <input type="file" name="file1" size="30" required>
        <br><br>
    <input type="submit" value="Upload">
    </form>
</body>
</html>

