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
                    echo "<title>User Orders Data</title>";
                } else {
                    "<title>Admin not logged in</title>";
                }
            }
            $id = htmlentities($_GET['orderID']);
            $table = "orders";
            $query = "DELETE FROM " . $table_admin . " WHERE idOrders=?";
            if ($stmt = mysqli_prepare($DBConnect, $query)) {
                mysqli_stmt_bind_param($stmt, 'i', $id);
                if (mysqli_stmt_execute($stmt_admin)){                
                    header("Location: orders_data.php");
                }
                else {
                    echo "Sorry the order cannot be deleted";
                }
            }
            
        } else {
            echo "<title>heading to homepage because of no one logged in</title>";
        }
        ?>