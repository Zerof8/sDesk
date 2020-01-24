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
        $dt = new DateTime();
        $date = $dt->format('Y-m-d');
        if (isset($_POST["reserv"])) {
            $room_number = $_POST["room_number"];
            $time = $_POST["time"];
            $group_name = $_POST["group_name"];
            require ("inc_connect.php");
            $Query = "SELECT availability FROM rooms WHERE room_number = ?";
            if ($stmt1 = mysqli_prepare($DBConnect, $Query)) {
                mysqli_stmt_bind_param($stmt1, 'i', $room_number);
                $result = mysqli_stmt_execute($stmt1);
                if ($result === FALSE) {
                    echo "<p>Unable to execute the query.</p>"
                    . "<p>Error code "
                    . mysqli_errno($DBConnect)
                    . ": "
                    . mysqli_error($DBConnect)
                    . "</p>";
                } else {
                    mysqli_stmt_bind_result($stmt1, $availability);
                    mysqli_stmt_store_result($stmt1);
                    mysqli_stmt_fetch($stmt1);
                    if ($availability == "N") {
                        echo "Room is not available.";
                    } else {
                        $SQLquery = "INSERT INTO `reservations`  VALUES (NULL,?,?,?,?,?);";
                        if ($stmt = mysqli_prepare($DBConnect, $SQLquery)) {
                            mysqli_stmt_bind_param($stmt, "iisss", $student_number, $room_number, $date, $time, $group_name);
                            if (mysqli_execute($stmt)) {
                                echo "You booked the room";
                            } else {
                                echo "Could not excute";
                                echo mysqli_stmt_error($stmt);
                            }
                            mysqli_stmt_close($stmt);
                        }
                    }
                }
            }

            mysqli_close($DBConnect);
        }
        ?>
    </body>
</html>
