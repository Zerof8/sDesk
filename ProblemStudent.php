<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1" name="viewport" />		
         <?php
//         session_start();
//        if (isset($_SESSION['user'])) {
//            require ("inc_connect.php");
//            if ($db === TRUE) {
//                $table_students = "students";
//                $email = htmlentities($_SESSION['user']);
//                $SQLstring = "SELECT * FROM " . $table_students . " WHERE e_mail=? ";
//                if ($stmt = mysqli_prepare($DBConnect, $SQLstring)) {
//                    mysqli_stmt_bind_param($stmt, 's', $email);
//                    mysqli_stmt_execute($stmt);
//                    mysqli_stmt_bind_result($stmt, $student_number, $first_name, $last_name, $group_name, $user_email, $pass_hash);
//                    mysqli_stmt_store_result($stmt);
//
//                    if (mysqli_stmt_num_rows($stmt) == 0) {
//                        header ("Location: index.php");
//                    } else {
//
//                        echo "<title>Welcome to the support desk</title>";
//                    }
//                    //Clean up the $stmt after use
//                    mysqli_stmt_close($stmt);
//                }
//            }
//        } else {
//            header ("Location: index.php");
//        }
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
                    <a href="index.php">Home</a>
                </div>

                <h1 id="title">Alnuvo Support Desk</h1>



            </header>

            <nav>

                <ul>

                    <li><a href="ProblemStudent.php">Tickets</a></li>
                    <li><a href="reservation_input.php">Reservations</a></li>
                    <li><a href="orders.html">Merch</a></li>
                </ul>

            </nav>

            <main>
                <div id="fillup_problem">
                    <div id="h1TitleProblem">
                        <h1>Problems and tickets</h1>							
                    </div>
                    <div id="probleminputbox">
                        <div id="ProblemsForm">
                            <form method="POST" action="#">
                                <label>To:</label><select name="department" id="departmentsSelect"> 
                                    <option value="Lecturers">Lectures</option>
                                    <option value="Aministration">Administration</option>
                                    <option value="Technical Support">Technical Support</option>
                                    <option value="Marketing">Marketing</option>
                                </select><br>
                                <label>Subject</label><br><br><input type="text" name="subject" class="InputFormProblems"> <br>
                                <label>Description</label><br><br>
                                <textarea name="description" id="InputFormTextArea" class="inputFormProblems" required=""></textarea> 
                                <br> <input type="submit" name="submitProblem" id="submit">
                            </form>
                        </div>					

                    </div>

                </div>
                <div id="faq_box">

                    <h1 class="faq">
                        Actions
                    </h1>

                    <ul>
                        <li><a class="signupbutton2" href="#">Submit your ticket</a></li>
                    </ul>

                </div>

            </main>

            <footer>
                <p>University of Alnuvo&copy; If you need furthur help contact us&nbsp;<a href="mailto:alnuvo@support.com">here</a></p>
            </footer>
        </div>

    </body>
</html>
