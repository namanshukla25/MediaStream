<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Videos</title>

    <style>
        body{
            margin:0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #141e30, #243b55);
            color:white;
        }

        .container{
            width:800px;
            margin:50px auto;
        }

        h2{
            text-align:center;
            color:#ff4d4d;
        }

        table{
            width:100%;
            border-collapse: collapse;
            margin-top:20px;
        }

        table th, table td{
            padding:12px;
            text-align:center;
            border-bottom:1px solid #444;
        }

        table th{
            background:#222;
        }

        .delete-btn{
            padding:8px 15px;
            background:#ff4d4d;
            color:white;
            border:none;
            border-radius:6px;
            cursor:pointer;
            transition:0.3s;
        }

        .delete-btn:hover{
            background:#cc0000;
        }

        a{
            color:#00d4ff;
            text-decoration:none;
            display:block;
            text-align:center;
            margin-top:20px;
        }
    </style>

</head>
<body>

<div class="container">
    <h2>Delete Videos</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Action</th>
        </tr>

        <?php
        $result = mysqli_query($conn, "SELECT * FROM videos");

        while($row = mysqli_fetch_assoc($result)){
        ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['title']; ?></td>
            <td>
                <a href="delete.php?id=<?php echo $row['id']; ?>" 
                   onclick="return confirm('Are you sure?')">
                    <button class="delete-btn">Delete</button>
                </a>
            </td>
        </tr>
        <?php } ?>

    </table>

<?php
// DELETE LOGIC
if(isset($_GET['id'])){
    $id = $_GET['id'];

    // file name get karo
    $res = mysqli_query($conn, "SELECT filename FROM videos WHERE id=$id");
    $data = mysqli_fetch_assoc($res);

    $file = $data['filename'];

    // file delete karo
    unlink("uploads/".$file);

    // database se delete
    mysqli_query($conn, "DELETE FROM videos WHERE id=$id");

    echo "<script>
        alert('Video Deleted Successfully!');
        window.location='delete.php';
    </script>";
}
?>

    <a href="index.php">▶ Back to Videos</a>
</div>

</body>
</html>