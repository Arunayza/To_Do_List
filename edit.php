<?php
include 'koneksi.php';

//proses show data
$q_sel = "select * from tasks where taskid ='" . $_GET['id'] . "' ";
$run_q_sel = mysqli_query($conn, $q_sel);
$d = mysqli_fetch_object($run_q_sel);

//proses edit
if (isset ($_POST['edit'])) {
    $q_edit = "update tasks set tasklabel = '" . $_POST['task'] . "' where taskid ='" . $_GET['id'] . "' ";
    $run_q_edit = mysqli_query($conn, $q_edit);

    header('Refresh:0; url=index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todolist</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #b47ede;

        }

        .container {
            width: 590px;
            height: 100vh;
            margin: 0 auto;
        }

        .header {
            padding: 15px;
            color: #fff;
        }

        .header .title {
            display: flex;
            align-items: center;
        }

        .header .title i {
            font-size: 32px;
            margin-right: 10px;
            color: white;
        }

        .header .title span {
            font-size: 28px;
        }

        .content {
            padding: 15px;
        }

        .card {
            background-color: #fff;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 10px;
        }

        .input-control {
            width: 100%;
            display: block;
            padding: 0.5rem;
            font-size: 1rem;
            margin-bottom: 10px;
        }

        .text-right {
            text-align: right;
        }

        button {
            padding: 0.5rem 1rem;
            font-size: 1rem;
            cursor: pointer;
            background-color: #87cefa;
            border: 1px solid;
            border-radius: 3px;
        }

        @media (max-width: 768px) {
            .container {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="title">
                <a href="index.php"><i class="bx bx-chevron-left"></i></a>
                <Span>Back</Span>
            </div>
        </div>

        <div class="content">
            <div class="card">
                <form action="" method="post">
                    <input type="text" name="task" class="input-control" placeholder="Edit Task"
                        value="<?= $d->tasklabel ?>">
                    <div class="text-right">
                        <button type="submit" name="edit">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>