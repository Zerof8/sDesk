<?php

if (isset($_SESSION['user'])) {
    session_start();
    require ("inc_connect.php");
    if ($db === TRUE) {
        $table_students = "students";
        $email = htmlentities($_SESSION['user']);
        $SQLstring = "SELECT * FROM " . $table_students . " WHERE e_mail=? ";
        if ($stmt = mysqli_prepare($DBConnect, $SQLstring)) {
            mysqli_stmt_bind_param($stmt, 's', $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $student_number, $first_name, $last_name, $group_name, $user_email, $pass_hash);
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) == 0) {
                header("Location: index.php");
            } else {

                echo "<title>Welcome to the support desk</title>";
            }
            //Clean up the $stmt after use
            mysqli_stmt_close($stmt);
        }
    }



    $dt = new DateTime();
    $date = $dt->format('Y-m-d');
    if (isset($_POST["submitProblem"])) {
        $subject = htmlentities($_POST["subject"]);
        $des = "Subject: " . $subject . "   Description: " . htmlentities($_POST["description"]);
        $department = $_POST["department"];
        include 'inc_connect.php';
        $SQLquery = "INSERT INTO `problems`  VALUES (NULL,?,?,?,?);";
        if ($stmt = mysqli_prepare($DBConnect, $SQLquery)) {
            mysqli_stmt_bind_param($stmt, "isss", $student_number, $department, $date, $des);
            if (mysqli_execute($stmt)) {
                echo "Ticket has been submitted";
            } else {
                echo "Could not excute";
                echo mysqli_stmt_error($stmt);
            }
            mail($user_email, $subject, $des, "alnuvo@supportdesk.com");
            mysqli_stmt_close($stmt);
        }


        mysqli_close($DBConnect);
    }
} else {
    header("Location: index.php");
}
?>
