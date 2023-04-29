<?php
$conn="";
include 'includes/db.php';
include 'includes/functions.php';

session_start();



if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit;
}




checkLateTasks($conn);

if (isset($_GET['taskId']) && isset($_GET['action'])) {
    $taskId = $_GET['taskId'];
    $action = $_GET['action'];

    if ($action == 'finish') {
        $sql = "UPDATE tasks SET status = 2 WHERE task_id = '$taskId'";
        $result = $conn->query($sql);
        if ($result) {
            header("location: activeTasksPage.php");
        }
    } else if ($action == 'stop') {
        $sql = "UPDATE tasks SET status = 0 WHERE task_id = '$taskId'";
        $result = $conn->query($sql);
        if ($result) {
            header("location: activeTasksPage.php");
        }
    }
}

?>


<!DOCTYPE html>

<html lang="en">
<head>
    <title>Active Task Page</title>
    <link rel="stylesheet" href="css/main_style.css">
    <script>
        function searchOnFilter() {
            //search deppending on the filter selected in the dropdown menu
            const filter = document.getElementById("filter").value;
            const search = document.getElementById("searchInput").value;

            const table = document.getElementById("activeTable");

            const tr = table.getElementsByTagName("tr");
            for (let i = 0; i < tr.length; i++) {
                //the filter is the index of the column in the table
                const td = tr[i].getElementsByTagName("td")[filter];
                if (td) {
                    const txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(search.toUpperCase()) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }


        }
    </script>
</head>


<body>
<!-- Header -->
<?php include 'includes/header.php' ?>

<nav class="breadcrumb-nav">


</nav>

<div class="main-elements" >

    <!-- Left Navigation Bar -->
    <nav class="left-nav">
        <ul class="left-nav-nav">


            <li class="nav-item">
                <a class="nav-item-link" href="mainPage.php">

                    <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 576 512">

                        <path
                                class="fa-primary"
                                fill="#3e619b"
                                d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/>
                    </svg>

                    <span class="nav-item-text">Home</span>

                </a>
            </li>


            <li class="nav-item">
                <a class="nav-item-link" href="searchPage.php">
                    <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512">

                        <path
                                class="fa-primary"
                                fill="#3e619b"
                                d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6 0-33.9zM208 336c-70.7 0-128-57.2-128-128s57.2-128 128-128 128 57.2 128 128-57.2 128-128 128z"/>
                    </svg>
                    <span class="nav-item-text">Search</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-item-link" href="newTaskPage.php">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path
                                class="fa-primary"
                                fill="#3e619b"
                                d="M240 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H32c-17.7 0-32 14.3-32 32s14.3 32 32 32H176V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H384c17.7 0 32-14.3 32-32s-14.3-32-32-32H240V80z"/>
                    </svg>
                    <span class="nav-item-text">New</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-item-link" href="pendingTasksPage.php">

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path
                                class="fa-primary"
                                fill="#3e619b"
                                d="M304 48c0-26.5-21.5-48-48-48s-48 21.5-48 48s21.5 48 48 48s48-21.5 48-48zm0 416c0-26.5-21.5-48-48-48s-48 21.5-48 48s21.5 48 48 48s48-21.5 48-48zM48 304c26.5 0 48-21.5 48-48s-21.5-48-48-48s-48 21.5-48 48s21.5 48 48 48zm464-48c0-26.5-21.5-48-48-48s-48 21.5-48 48s21.5 48 48 48s48-21.5 48-48zM142.9 437c18.7-18.7 18.7-49.1 0-67.9s-49.1-18.7-67.9 0s-18.7 49.1 0 67.9s49.1 18.7 67.9 0zm0-294.2c18.7-18.7 18.7-49.1 0-67.9S93.7 56.2 75 75s-18.7 49.1 0 67.9s49.1 18.7 67.9 0zM369.1 437c18.7 18.7 49.1 18.7 67.9 0s18.7-49.1 0-67.9s-49.1-18.7-67.9 0s-18.7 49.1 0 67.9z"/>
                    </svg>

                    <span class="nav-item-text">Pending</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-item-link" href="activeTasksPage.php">

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                        <path
                                class="fa-primary"
                                fill="#3e619b"
                                d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM625 177L497 305c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L591 143c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/>
                    </svg>

                    <span class="nav-item-text">Active</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-item-link" href="completedTasksPage.php">

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path
                                class="fa-primary"
                                fill="#3e619b"
                                d="M32 0C49.7 0 64 14.3 64 32V48l69-17.2c38.1-9.5 78.3-5.1 113.5 12.5c46.3 23.2 100.8 23.2 147.1 0l9.6-4.8C423.8 28.1 448 43.1 448 66.1V345.8c0 13.3-8.3 25.3-20.8 30l-34.7 13c-46.2 17.3-97.6 14.6-141.7-7.4c-37.9-19-81.4-23.7-122.5-13.4L64 384v96c0 17.7-14.3 32-32 32s-32-14.3-32-32V400 334 64 32C0 14.3 14.3 0 32 0zM64 187.1l64-13.9v65.5L64 252.6V318l48.8-12.2c5.1-1.3 10.1-2.4 15.2-3.3V238.7l38.9-8.4c8.3-1.8 16.7-2.5 25.1-2.1l0-64c13.6 .4 27.2 2.6 40.4 6.4l23.6 6.9v66.7l-41.7-12.3c-7.3-2.1-14.8-3.4-22.3-3.8v71.4c21.8 1.9 43.3 6.7 64 14.4V244.2l22.7 6.7c13.5 4 27.3 6.4 41.3 7.4V194c-7.8-.8-15.6-2.3-23.2-4.5l-40.8-12v-62c-13-3.8-25.8-8.8-38.2-15c-8.2-4.1-16.9-7-25.8-8.8v72.4c-13-.4-26 .8-38.7 3.6L128 173.2V98L64 114v73.1zM320 335.7c16.8 1.5 33.9-.7 50-6.8l14-5.2V251.9l-7.9 1.8c-18.4 4.3-37.3 5.7-56.1 4.5v77.4zm64-149.4V115.4c-20.9 6.1-42.4 9.1-64 9.1V194c13.9 1.4 28 .5 41.7-2.6l22.3-5.2z"/>
                    </svg>

                    <span class="nav-item-text">Completed</span>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-item-link" href="lateTasksPage.php">

                    <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512">

                        <path
                                class="fa-primary"
                                fill="#3e619b"
                                d="M256 0a256 256 0 1 1 0 512A256 256 0 1 1 256 0zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"/>
                    </svg>

                    <span class="nav-item-text">Late</span>
                </a>
            </li>


            <!-- buy me some coffee -->
            <li class="nav-item">
                <a class="nav-item-link" href="https://www.buymeacoffee.com/om4r" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path
                                class="fa-primary"
                                fill="#3e619b"
                                d="M88 0C74.7 0 64 10.7 64 24c0 38.9 23.4 59.4 39.1 73.1l1.1 1C120.5 112.3 128 119.9 128 136c0 13.3 10.7 24 24 24s24-10.7 24-24c0-38.9-23.4-59.4-39.1-73.1l-1.1-1C119.5 47.7 112 40.1 112 24c0-13.3-10.7-24-24-24zM32 192c-17.7 0-32 14.3-32 32V416c0 53 43 96 96 96H288c53 0 96-43 96-96h16c61.9 0 112-50.1 112-112s-50.1-112-112-112H352 32zm352 64h16c26.5 0 48 21.5 48 48s-21.5 48-48 48H384V256zM224 24c0-13.3-10.7-24-24-24s-24 10.7-24 24c0 38.9 23.4 59.4 39.1 73.1l1.1 1C232.5 112.3 240 119.9 240 136c0 13.3 10.7 24 24 24s24-10.7 24-24c0-38.9-23.4-59.4-39.1-73.1l-1.1-1C231.5 47.7 224 40.1 224 24z"/>
                    </svg>


                    <span class="nav-item-text">Buy me a coffee</span>
                </a>
            </li>

        </ul>
    </nav>



    <!-- Main -->
    <main>
        <h2 class="title">Active Tasks</h2>

        <div class="search-container">
            <select name="search" id="filter">
                <option value="0" selected>Task Name</option>
                <option value="1">Description</option>
                <option value="2">Start Date</option>
                <option value="3">Due Date</option>
                <option value="4">Priority</option>
                <option value="5">Status</option>
                <option value="6">Assigned by</option>
            </select>
            <input type="text" id="searchInput" placeholder="Search..." oninput="searchOnFilter()">
        </div>


        <div class="table-container">
            <table id="activeTable">

                <thead>
                <tr>
                    <th>Task</th>
                    <th>Description</th>
                    <th>Start Date</th>
                    <th>Due</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th>Assigned by</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>

                <tbody>

                <?php
                $user_id = $_SESSION['id'];
                //select all tasks that are pending
                $sql = "SELECT * FROM tasks WHERE assigned_to = '$user_id' AND status = 1 ORDER BY priority DESC";
                $res = $conn->query($sql);

                if ($res->rowCount() > 0) {
                    while ($row = $res->fetch()) {
                        $task_name = $row['title'];
                        $task_description = $row['description'];
                        $start_date = $row['start_date'];
                        $due_date = $row['due_date'];
                        $priority = $row['priority'];

                        ?>

                        <tr>
                            <td><?php echo $task_name ?></td>
                            <td><?php echo $task_description ?></td>
                            <td><?php echo $start_date ?></td>
                            <td><?php echo $due_date ?></td>
                            <td><?php echo $priority ?></td>
                            <td class="active-status">
                                <p>
                                    Active
                                </p>
                            </td>

                            <td class="person-data">
                                <?php
                                //get the name of the person who assigned the task and the image
                                $assigned_by = $row['assigned_by'];
                                $sql2 = "SELECT * FROM members WHERE id = '$assigned_by'";
                                $res2 = $conn->query($sql2);

                                $res2 = $res2->fetch();
                                $byName = $res2['name'];
                                $byImage = $res2['photo'];

                                echo "<img src='uploads/images/$byImage' alt='profile'>";

                                echo "<h5>$byName</h5>";


                                ?>
                            </td>

                            <td>
                                <a href="?taskId=<?php echo $row['task_id'] ?>&action=finish" class="button-blue">Finish</a>
                            </td>
                            <td>
                                <a href="?taskId=<?php echo $row['task_id'] ?>&action=stop" class="button-red" >Stop</a>
                            </td>

                        </tr>







                        <?php
                    }
                    ?>



                    <?php
                }else {
                    ?>
                    <tr>
                        <td colspan="9">
                            <p>No Pending tasks</p>
                        </td>
                    </tr>
                    <?php
                }

                ?>


                </tbody>
            </table>
        </div>
    </main>


</div>
<!-- Footer -->
<?php include 'includes/footer.php' ?>


</body>


</html>