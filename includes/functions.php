<?php

function validate($data): string{
    $data = trim($data);
    $data = stripslashes($data);
    return htmlspecialchars($data);
}


//function to check late task
function checkLateTasks( $conn)
{
    $sql = "SELECT * FROM tasks WHERE (status = 0 OR status = 1) AND due_date < CURDATE()";
    $result = $conn->query($sql);
    while ($row = $result->fetch()){
        $id = $row['task_id'];
        $sql = "UPDATE tasks SET status = 3 WHERE task_id = '$id'";
        $conn->query($sql);
    }
}


