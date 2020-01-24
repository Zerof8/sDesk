<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1" name="viewport" />		

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
                <?php
                session_start();
                if (!isset($_SESSION['user'])) {
                    header('location: login.php');
                }
                ?>


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
                    </h1>

                    <ul>
                        <li><a class="signupbutton2"  href="mailto:alnuvo@support.com">Contact us</a></li>
                    </ul>

                </div>

            </main>
            <footer>
                <p>University of Alnuvo&copy; If you need furthur help contact us&nbsp;<a href="mailto:alnuvo@support.com">here</a></p>
            </footer>
        </div>	

    </body>
</html>
