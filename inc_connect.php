<?php
    $db_name = "ticket_system";
    //assign the connection and selected database to a variable
    $DBConnect = mysqli_connect("localhost", "root", "");
    if ($DBConnect === FALSE)
    {
        echo "<p>Unable to connect to the database server.</p>"
        . "<p>Error code " . mysqli_errno($DBConnect) . ": "
        . mysqli_error($DBConnect) . "</p>";
    } else {
        //select the database
        $db = mysqli_select_db($DBConnect, $db_name);
        if ($db === FALSE)
        {
            echo "<p>Unable to connect to the database server.</p>"
            . "<p>Error code " . mysqli_errno($DBConnect) . ": "
            . mysqli_error($DBConnect) . "</p>";
            mysqli_close($DBConnect);
            $DBConnect = FALSE;
        }
    }
?>