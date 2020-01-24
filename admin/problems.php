<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1" name="viewport" />	
        <?php
        session_start();
        require ("../inc_connect.php");

        if (isset($_SESSION['user'])) {
            $the_email = $_SESSION['user'];
            $table_admin = "staff";
            $query_admin = "SELECT * FROM " . $table_admin . " WHERE email=? AND departments='IT'";
            if ($stmt_admin = mysqli_prepare($DBConnect, $query_admin)) {
                mysqli_stmt_bind_param($stmt_admin, 's', $email);
                mysqli_stmt_execute($stmt_admin);
                mysqli_stmt_bind_result($stmt_admin, $first_name, $last_name);
                mysqli_stmt_store_result($stmt_admin);
                if (mysqli_stmt_num_rows($stmt_admin) !== 0) {
                    echo "<title>User Problems Data</title>";
                } else {
                    "<title>Admin not logged in</title>";
                }
            }
        } else {
            echo "<title>heading to homepage because of no one logged in</title>";
        }
        ?>
        <link rel="stylesheet" type="text/css" href="../stylesheet.css">
    </head>
    <body>

        <div id="container">
            <header>

                <div id="logo_box">
                    <img src="../images/logo.png" alt="Logo"/>
                </div>

                <div class="topright_box">
                    <a href="../logout.php">Logout</a>
                </div>

                <h1 id="title">Alnuvo Support Desk</h1>

            </header>

          <nav>

            </nav>

            <main>

                <div id="news_box">

                    <?php
                    $TableName = "problems";
                    $SQLstring = "SELECT * FROM " . $TableName;

                    if ($stmt = mysqli_prepare($DBConnect, $SQLstring)) {
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $id, $idstaff, $student_number, $department, $date, $description);
                        mysqli_stmt_store_result($stmt);
                        if (mysqli_stmt_num_rows($stmt) == 0) {
                            echo "<p>There are no entries here</p>";
                        } else {
                            echo "<table>";
                            echo "<tr><th>Problem ID</th>
                             <th>Student Number</th><th>Department</th>
                             <th>Date</th><th>Description</th>
                             <th>Action</th></tr>";
                            while (mysqli_stmt_fetch($stmt)) {
                                echo "<tr><td>" . $id . "</td>";
                                echo "<td>" . $student_number . "</td>";
                                echo "<td>" . $department . "</td>";
                                echo "<td>" . $date . "</td>";
                                echo "<td>" . $description . "</td>";
                                echo "<td><a href='problem.php?problemID=" . $id . "'>Full Article</a></td></tr>";
                            }
                            echo "</table>";
                        }
                        mysqli_stmt_close($stmt);
                    }
                    ?>

                </div>

                <div id="faq_box">

                    <h1 class="faq">
                        Actions
                    </h1>

                    <ul>
                        <li><a class="signupbutton2" href="problems.php">Problems</a></li>
                        <li><a class="signupbutton2" href="reservations.php">Reservations</a></li>
                        <li><a class="signupbutton2" href="orders_data.php">Orders</a></li>
                    </ul>

                </div>

            </main>

            <footer>
                <p>University of Alnuvo&copy; If you need furthur help contact us&nbsp;<a href="mailto:alnuvo@support.com">here</a></p>
            </footer>
        </div>	

    </body>
</html>
