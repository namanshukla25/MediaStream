<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Video</title>
    <style>
        body{
            margin:0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            color:white;
        }

        .container{
            width:350px;
            margin:80px auto;
            background:#1c1c1c;
            padding:30px;
            border-radius:15px;
            box-shadow:0 0 20px rgba(0,0,0,0.5);
            text-align:center;
        }

        h2{
            margin-bottom:20px;
            color:#00d4ff;
        }

        input[type="text"],
        input[type="file"]{
            width:100%;
            padding:12px;
            margin:10px 0;
            border:none;
            border-radius:8px;
            background:#2a2a2a;
            color:white;
            outline:none;
        }

        input::placeholder{
            color:#aaa;
        }

        button{
            width:100%;
            padding:12px;
            background:#00d4ff;
            border:none;
            border-radius:8px;
            color:black;
            font-weight:bold;
            cursor:pointer;
            transition:0.3s;
        }

        button:hover{
            background:#00aacc;
            transform:scale(1.03);
        }

        .success{
            margin-top:15px;
            color:#00ff9d;
        }

        a{
            display:inline-block;
            margin-top:20px;
            text-decoration:none;
            color:#00d4ff;
            font-weight:bold;
            transition:0.3s;
        }

        a:hover{
            color:#fff;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Upload Video</h2>

    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Enter Video Title" required>
        <input type="file" name="video" required>
        <button name="upload">Upload Video</button>
    </form>

<?php
if(isset($_POST['upload'])){
    $title = $_POST['title'];

    $video = time() . "_" . $_FILES['video']['name']; // rename for safety
    $tmp = $_FILES['video']['tmp_name'];

    move_uploaded_file($tmp, "uploads/".$video);

    mysqli_query($conn, "INSERT INTO videos(title, filename) VALUES('$title','$video')");

    echo "<div class='success'>✅ Video Uploaded Successfully!</div>";
}
?>

    <a href="index.php">▶ Watch Videos</a>
</div>

</body>
</html>