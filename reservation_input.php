<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1" name="viewport" />		
        <title>Alnuvo Support Desk</title>
        <?php
//        session_start();
//        if (!isset($_SESSION['user'])) {
//            header("Location: index.php");
//        }
//        ?>
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
                    <div id="h1TitleReserve">
                        <h1>Reserve a room</h1>							
                    </div>
                    <div id="reservinputbox">
                        <form method="POST" action="#" id="orderform">                                
                            <b>Room: </b>
                            <select name="room_number">
                                <option value="100">100</option>
                                <option value="101">101</option>
                                <option value="102">102</option>
                                <option value="103">103</option>
                                <option value="104">104</option>
                                <option value="105">105</option>
                                <option value="106">106</option>
                                <option value="107">107</option>
                                <option value="108">108</option>
                                <option value="109">109</option>
                                <option value="110">110</option>
                                <option value="111">111</option>
                                <option value="112">112</option>
                                <option value="113">113</option>
                                <option value="114">114</option>
                                <option value="115">115</option>
                                <option value="116">116</option>
                                <option value="117">117</option>
                                <option value="118">118</option>
                            </select>
                            <p id="reservinput"><b>Time: </b>
                                <select name="time">
                                    <option value="08:30-09:15">08:30-09:15</option>
                                    <option value="09:15-10:00">09:15-10:00</option>
                                    <option value="10:00-10:45">10:00-10:45</option>
                                    <option value="10:45-11:30">10:45-11:30</option>
                                    <option value="11:30-12:15">11:30-12:15</option>
                                    <option value="12:15-13:00">12:15-13:00</option>
                                    <option value="13:00-13:45">13:00-13:45</option>
                                    <option value="13:45-14:30">13:45-14:30</option>
                                    <option value="14:30-15:15">14:30-15:15</option>
                                    <option value="15:15-16:00">15:15-16:00</option>
                                    <option value="16:00-16:45">16:00-16:45</option>
                                    <option value="16:45-17:30">16:45-17:30</option>
                                    <option value="17:30-18:15">17:30-18:15</option>
                                </select></p>									
                            <p id="reservinput"><b>Group name: </b>
                                <select name="group_name">										
                                    <option value="IT_INF_1A">IT_INF_1A</option>
                                    <option value="IT_INF_1B">IT_INF_1B</option>
                                    <option value="IT_INF_1C">IT_INF_1C</option>
                                    <option value="IT_INF_1D">IT_INF_1D</option>
                                    <option value="IT_INF_1E">IT_INF_1E</option>
                                    <option value="IT_INF_2A">IT_INF_2A</option>
                                </select></p>																		
                            <input type="submit" name="reserv" value="Reserve" id="submit">
                            </br>
                            <?php
                            include 'reservations_insert.php';
                            ?>
                        </form>							
                    </div>
                </div>
                <div id="faq_box">

                    <h1 class="faq">
                        Actions
                    </h1>

                    <ul>
                        <li><a class="signupbutton2" href="#">Reserve a room</a></li>
                    </ul>
                </div>									
        </div>				



        <footer>
                <p>University of Alnuvo&copy; If you need furthur help contact us&nbsp;<a href="mailto:alnuvo@support.com">here</a></p>
            </footer>

    </body>
</html>