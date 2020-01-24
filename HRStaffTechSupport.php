<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <?php
        session_start();
        if (isset($_SESSION['user'])) {
            require ("inc_connect.php");
            $email = $_SESSION['user'];
            $table_staff = "staff";
            $query_staff_tech = "SELECT * FROM " . $table_staff . " WHERE email=? AND departments = 'Technical Support'";
            if ($stmt_staff_tech = mysqli_prepare($DBConnect, $query_staff_tech)) {
                mysqli_stmt_bind_param($stmt_staff_tech, 's', $email);
                mysqli_stmt_execute($stmt_staff_tech);
                mysqli_stmt_bind_result($stmt_staff_tech, $staff_id, $staff_first_name, $staff_last_name, $department, $staff_email, $staff_pass_hash);
                mysqli_stmt_store_result($stmt_staff_tech);

                if (mysqli_stmt_num_rows($stmt_staff_tech) == 0) {
                    header("Location: index.php");
                } else {

                    echo "<title>Welcome to the control panel!</title>";
                }
            }
        }
        else {
            header ("Location: index.php");
        }
        ?>
       
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
    </head>
    <body>
        <div id="container">
            <header>

                <div id="logo_box">
                    <img src="images/logo.png" alt="Logo"/>
                </div>

                <div class="topright_box">
                    <a href="logout.php">Logout</a>
                </div>

                <h1 id="title">Alnuvo Support Desk</h1>



            </header>

            <nav>

            </nav>

            <main>

                <div id="news_box">
                    <?php
                    include "inc_connect.php";

                    $sql = "SELECT * FROM `problems` WHERE `department` = 'Technical Support';";
                    if ($stmt = mysqli_prepare($DBConnect, $sql)) {
                        $execute = mysqli_stmt_execute($stmt);
                        if (!$execute) {
                            echo "<p>Error code "
                            . mysqli_errno($DBConnect)
                            . ": " . mysqli_error($DBConnect)
                            . "</p>";
                        } else {
                            mysqli_stmt_bind_result($stmt, $problemid, $staffid, $studentNr, $department, $date, $desc);
                            mysqli_stmt_store_result($stmt);
                            if (mysqli_stmt_num_rows($stmt) == 0) {
                                echo "<p>There are no problems!</p>";
                            } else {

                                echo "<table width=100%>
                <tr>
                <th>ProblemID</th>
                <th>Student</th>
                <th>date</th>
                <th>Description</th>
                </tr>";

                                while (mysqli_stmt_fetch($stmt)) {
                                    echo "<tr>";
                                    echo "<td>" . $problemid . "</td>";
                                    echo "<td>" . $studentNr . "</td>";
                                    echo "<td>" . $date . "</td>";
                                    echo "<td>" . $desc . "</td>";
                                    echo "</tr>";
                                }
                                echo "</table>";
                            }
                        }
                        mysqli_stmt_close($stmt);
                    }
                    mysqli_close($DBConnect);
                    ?>
                </div>

                <div id="faq_box">

                    <h1 class="faq">
                        Actions
                    </h1>

                    <ul>
                        <li><a class="signupbutton2" href="HRStaffTechSupport.php">Tech Support</a></li>
                    </ul>

                </div>

            </main>
            <footer>
                <p>University of Alnuvo&copy; If you need furthur help contact us&nbsp;<a href="mailto:alnuvo@support.com">here</a></p>
            </footer>
        </div>

    </body>
</html>
