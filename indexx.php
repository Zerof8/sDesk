<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
--> 
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
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

                        $table_admin = "staff";
                        $query_admin = "SELECT first_name, last_name FROM " . $table_admin . " WHERE email=? AND departments='IT'";
                        if ($stmt_admin = mysqli_prepare($DBConnect, $query_admin)) {
                            mysqli_stmt_bind_param($stmt_admin, 's', $email);
                            mysqli_stmt_execute($stmt_admin);
                            mysqli_stmt_bind_result($stmt_admin, $admin_first_name, $admin_last_name);
                            mysqli_stmt_store_result($stmt_admin);

                            if (mysqli_stmt_num_rows($stmt_admin) == 0) {

                                $table_staff = "staff";
                                $query_staff_marketing = "SELECT * FROM " . $table_staff . " WHERE email=? AND departments = 'Marketing'";
                                if ($stmt_staff_marketing = mysqli_prepare($DBConnect, $query_staff_marketing)) {
                                    mysqli_stmt_bind_param($stmt_staff_marketing, 's', $email);
                                    mysqli_stmt_execute($stmt_staff_marketing);
                                    mysqli_stmt_bind_result($stmt_staff_marketing, $staff_id, $staff_first_name, $staff_last_name, $department, $staff_email, $staff_pass_hash);
                                    mysqli_stmt_store_result($stmt_staff_marketing);

                                    if (mysqli_stmt_num_rows($stmt_staff_marketing) == 0) {
                                        $query_staff_administration = "SELECT * FROM " . $table_staff . " WHERE email=? AND departments = 'Administration'";
                                        if ($stmt_staff_administration = mysqli_prepare($DBConnect, $query_staff_administration)) {
                                            mysqli_stmt_bind_param($stmt_staff_administration, 's', $email);
                                            mysqli_stmt_execute($stmt_staff_administration);
                                            mysqli_stmt_bind_result($stmt_staff_administration, $staff_id, $staff_first_name, $staff_last_name, $department, $staff_email, $staff_pass_hash);
                                            mysqli_stmt_store_result($stmt_staff_administration);

                                            if (mysqli_stmt_num_rows($stmt_staff_administration) == 0) {
                                                $query_staff_lecturers = "SELECT * FROM " . $table_staff . " WHERE email=? AND departments = 'Lecturers'";
                                                if ($stmt_staff_lecturers = mysqli_prepare($DBConnect, $query_staff_lecturers)) {
                                                    mysqli_stmt_bind_param($stmt_staff_lecturers, 's', $email);
                                                    mysqli_stmt_execute($stmt_staff_lecturers);
                                                    mysqli_stmt_bind_result($stmt_staff_lecturers, $staff_id, $staff_first_name, $staff_last_name, $department, $staff_email, $staff_pass_hash);
                                                    mysqli_stmt_store_result($stmt_staff_lecturers);

                                                    if (mysqli_stmt_num_rows($stmt_staff_lecturers) == 0) {
                                                        $query_staff_tech = "SELECT * FROM " . $table_staff . " WHERE email=? AND departments = 'Technical Support'";
                                                        if ($stmt_staff_tech = mysqli_prepare($DBConnect, $query_staff_tech)) {
                                                            mysqli_stmt_bind_param($stmt_staff_tech, 's', $email);
                                                            mysqli_stmt_execute($stmt_staff_tech);
                                                            mysqli_stmt_bind_result($stmt_staff_tech, $staff_id, $staff_first_name, $staff_last_name, $department, $staff_email, $staff_pass_hash);
                                                            mysqli_stmt_store_result($stmt_staff_tech);

                                                            if (mysqli_stmt_num_rows($stmt_staff_tech) == 0) {
                                                                echo "<h3 class='error'>No User Found</h3>";
                                                            } else {

                                                                include 'HRStaffTechSupport.php';
                                                            }
                                                        }
                                                    } else {

                                                        include 'HRStaffLecturer.php';
                                                    }
                                                }
                                            } else {

                                                include 'HRStaffAdministration.php';
                                            }
                                        }
                                    } else {

                                        include 'HRStaffMarketing.php';
                                    }
                                }
                            } else {

                                header("Location: admin/admin_hrm.php");
                            }
                        }
                    } else {

                        include 'StudentsIndex.php';
                    }
                    //Clean up the $stmt after use
                    mysqli_stmt_close($stmt);
                }
            }
        } else {
            include 'logIn.php';
        }
        ?>
    </body>
</html>
