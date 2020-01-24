<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1" name="viewport" />		
        <title>Stenden Support Desk</title>
        <link rel="stylesheet" type="text/css" href="login css.css">
    </head>
    <body>
        <div id="LogIncontainer">
            <div id="h2TitleLogIn">
                <h2>Log In</h2>
            </div>
            <div id="LogInMenu">
                <ul>
                    <li><a>About us</a></li>
                    <li><a>F.A.Qs</a></li>
                </ul>
            </div>
            <div id="LogInLogo">
            </div>
            <div id="LogInForm">
                <form action="#" method="post">
                    <div class=InputWithIcon">
                        <p>Email Address:</p>
                        <input type="email" name="email" class="emailPassword" id="email" placeholder="E-mail Address">
                    </div>
                    <p>Password<p>
                        <input type="password" name="password" class="emailPassword" id="password" placeholder="Password"><br>
                        <input type="submit" name="login" id="submit">
                </form>
                <?php
                session_start();
                if (isset($_SESSION['user'])) {
                    header("Location: index.html");
                } else {
                    require ("inc_connect.php");
                    if (isset($_POST['login'])) {

                        if (empty($_POST['email']) || empty($_POST['password'])) {
                            echo "<p class='error'>You must enter both your <b>Username</b> and <b>Password</b>.</p>";
                        } else {
                            if ($db === TRUE) {
                                $table_students = "students";

                                $email = htmlentities($_POST['email']);
                                $user_pass = htmlentities($_POST['password']);

                                $SQLstring = "SELECT * FROM " . $table_students . " WHERE e_mail=? ";
                                if ($stmt = mysqli_prepare($DBConnect, $SQLstring)) {
                                    mysqli_stmt_bind_param($stmt, 's', $email);
                                    mysqli_stmt_execute($stmt);
                                    mysqli_stmt_bind_result($stmt, $student_number, $first_name, $last_name, $group_name, $user_email, $pass_hash);
                                    mysqli_stmt_store_result($stmt);

                                    if (mysqli_stmt_num_rows($stmt) == 0) {
                                        echo "<h3 class='error'>No User Found</h3>";
                                    } else {

                                        mysqli_stmt_fetch($stmt);
                                        if (password_verify($user_pass, $pass_hash)) {
                                            $_SESSION['user'] = $email;
                                            header("Location: index.php");
                                        } else {
                                            echo "<h3 class='error'>Password incorrect!<h3>";
                                        }
                                    }
                                    //Clean up the $stmt after use
                                    mysqli_stmt_close($stmt);
                                }
                                $table_admin = "staff";
                                $query_admin = "SELECT * FROM " . $table_admin . " WHERE email=? AND departments='IT'";
                                if ($stmt_admin = mysqli_prepare($DBConnect, $query_admin)) {
                                    mysqli_stmt_bind_param($stmt_admin, 's', $email);
                                    mysqli_stmt_execute($stmt_admin);
                                    mysqli_stmt_bind_result($stmt_admin, $admin_id, $admin_first_name, $admin_last_name, $admin_department, $admin_email, $admin_hashed_password);
                                    mysqli_stmt_store_result($stmt_admin);

                                    if (mysqli_stmt_num_rows($stmt_admin) == 0) {
                                        echo "<h3 class='error'>No User Found</h3>";
                                    } else {
                                        mysqli_stmt_fetch($stmt_admin);
                                        if (password_verify($user_pass, $admin_hashed_password)) {
                                            $_SESSION['admin'] = $admin_email;
                                            header("Location: admin/orders_data.php");
                                            exit();
                                        } else {
                                            echo "<h3 class='error'>Password incorrect!<h3>";
                                        }
                                    }
                                    //Clean up the $stmt after use
                                    mysqli_stmt_close($stmt_admin);
                                }

                                $table_staff = "staff";
                                $query_staff = "SELECT * FROM `staff` WHERE email=? AND departments != 'IT'";
                                if ($stmt_staff = mysqli_prepare($DBConnect, $query_staff)) {
                                    mysqli_stmt_bind_param($stmt_staff, 's', $email);
                                    mysqli_stmt_execute($stmt_staff);
                                    mysqli_stmt_bind_result($stmt_staff, $staff_id, $staff_first_name, $staff_last_name, $department, $staff_email, $staff_pass_hash);
                                    mysqli_stmt_store_result($stmt_staff);


                                    if (mysqli_stmt_num_rows($stmt_staff) == 0) {
                                        echo "<h3 class='error'>No User Found</h3>";
                                    } else {
                                        mysqli_stmt_fetch($stmt_staff);
                                        if (password_verify($user_pass, $staff_pass_hash)) {
                                            $_SESSION['staff'] = $staff_email;

                                            if ($department = "Lecturers") {
                                                header("Location: HRStaffLecturer.php");
                                            } elseif ($department = "Marketing") {
                                                header("location: HRStaffMarketing.php");
                                            } elseif ($staff_department = "Administration") {
                                                header("location: HRStaffAdministration.php");
                                            } elseif ($staff_department = "Technical Support") {
                                                header("location: HRStaffTechSupport.php");
                                            }
                                        } else {
                                            echo "<h3 class='error'>Password incorrect!<h3>";
                                        }
                                    }
                                    //Clean up the $stmt after use
                                    mysqli_stmt_close($stmt_staff);
                                }
                                mysqli_close($DBConnect);
                            }
                        }
                    }
                }
                ?>
            </div>
        </div>
    </body>
</html>