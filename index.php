<?php
include 'koneksi.php';
//Proses insert data ke database
if (isset ($_POST['add'])) {

    $q_ins = "insert into tasks (tasklabel, taskstatus) value (
        '" . $_POST['task'] . "', 'open'
    )";
    $run_q_ins = mysqli_query($conn, $q_ins);

    if ($run_q_ins) {
        header('Refresh:0;url=index.php');
    }
}

//proses show data
$q_sel = "select * from tasks order by taskid desc";
$run_q_sel = mysqli_query($conn, $q_sel);

//proses delete
if (isset ($_GET['delete'])) {

    $q_del = "delete from tasks where taskid = '" . $_GET['delete'] . "' ";
    $run_q_del = mysqli_query($conn, $q_del);

    header('Refresh:0; url=index.php');
}

//proses update data (close or open)
if (isset ($_GET['done'])) {
    $status = 'close';

    if ($_GET['status'] == 'open') {
        $status = 'close';
    } else {
        $status = 'open';
    }

    $q_upd = "update tasks set taskstatus = '" . $status . "' where taskid = '" . $_GET['done'] . "' ";
    $run_q_upd = mysqli_query($conn, $q_upd);

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
            background: #654ea3;
            /* fallback for old browsers */
            background-color: #b47ede;
            
        }

        .container {
            width: 590px;
            height: 100vh;
            margin: 0 auto;

        }

        .header {
            padding: 15px;
            color: azure;
        }

        .header .title {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }

        .header .title i {
            font-size: 24px;
            margin-right: 10px;
        }

        .header .title span {
            font-size: 18px;
        }

        .header .description {
            font-size: 14px;
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

        .btn {
            display: flex;
            justify-content: space-between;
        }

        button {
            padding: 0.5rem 1rem;
            font-size: 1rem;
            cursor: pointer;
            background-color: #87cefa;
            border: 1px solid;
            border-radius: 3px;
        }

        .task-item {
            display: flex;
            justify-content: space-between;
        }

        .text-orange {
            color: orange;
        }

        .text-red {
            color: red;
        }

        .task-item.done {
            text-decoration: line-through;
            color: #ccc
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
                <i class='bx bx-notepad'></i>
                <Span>To Do List</Span>
            </div>

            <div class="description">
                <?= date("l, d M Y") ?>
            </div>
        </div>

        <div class="content" style="height: calc(100vh - 60px); overflow-y: auto;">
            <div class="card">
                <form action="" method="post">
                    <input type="text" name="task" class="input-control" placeholder="Add Task" required>
                    <div class="btn">
                        <a href="del_all.php"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus semua tugas?')">
                            <button type="button">Delete All</button>
                        </a>
                        <button type="submit" name="add">Add</button>
                    </div>
                </form>
            </div>

            <?php
            if (mysqli_num_rows($run_q_sel) > 0) {
                while ($r = mysqli_fetch_array($run_q_sel)) {
                    ?>
                    <div class="card">
                        <div class="task-item <?= $r['taskstatus'] == 'close' ? 'done' : '' ?>">
                            <div>
                                <input type="checkbox"
                                    onclick="window.location.href = '?done=<?= $r['taskid'] ?>&status=<?= $r['taskstatus'] ?>'"
                                    <?= $r['taskstatus'] == 'close' ? 'checked' : '' ?>>
                                <span>
                                    <?= $r['tasklabel'] ?>
                                </span>
                            </div>
                            <div>
                                <a href="edit.php?id=<?= $r['taskid'] ?>" class="text-orange" title="Edit"><i
                                        class="bx bx-edit"></i></a>
                                <a href="?delete=<?= $r['taskid'] ?>" class="text-red" title="Remove"
                                    onclick="return confirm('Apakah anda yakin ingin Menghapus?')"><i
                                        class="bx bx-trash"></i></a>
                            </div>
                        </div>
                    </div>
                <?php }
            } else { ?>
                <div class='card'>Belum ada Tasks</div>
            <?php } ?>
        </div>
    </div>
</body>

</html>