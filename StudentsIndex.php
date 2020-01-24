<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1" name="viewport" />		
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
                        header ("Location: index.php");
                    } else {

                        echo "<title>Welcome to the support desk</title>";
                    }
                    //Clean up the $stmt after use
                    mysqli_stmt_close($stmt);
                }
            }
        } else {
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

                <ul>

                    <li><a href="ProblemStudent.php">Tickets</a></li>
                    <li><a href="reservation_input.php">Reservations</a></li>
                    <li><a href="orders.html">Merch</a></li>
                </ul>

            </nav>

            <main>

                <div id="news_box">

                    <div id="imgbox">

                    </div>

                </div>

                <div id="faq_box">

                    <h1 class="faq">
                        F.A.Qs
                    </h1>

                    <ul>
                        <li><a href="#">Crazy people</a></li>
                        <li><a href="#">Nonsense people</a></li>
                        <li><a href="#">Idiot people with a head without a brain</a></li>
                        <li><a href="#">Abid</a></li>
                    </ul>

                </div>

            </main>
            <footer>
                <p>University of Alnuvo&copy; If you need furthur help contact us&nbsp;<a href="mailto:alnuvo@support.com">here</a></p>
            </footer>
        </div>	

    </body>
</html>
