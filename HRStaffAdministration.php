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
            $query_staff_administration = "SELECT * FROM " . $table_staff . " WHERE email=? AND departments = 'Administration'";
            if ($stmt_staff_administration = mysqli_prepare($DBConnect, $query_staff_administration)) {
                mysqli_stmt_bind_param($stmt_staff_administration, 's', $email);
                mysqli_stmt_execute($stmt_staff_administration);
                mysqli_stmt_bind_result($stmt_staff_administration, $staff_id, $staff_first_name, $staff_last_name, $department, $staff_email, $staff_pass_hash);
                mysqli_stmt_store_result($stmt_staff_administration);

                if (mysqli_stmt_num_rows($stmt_staff_administration) == 0) {
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

                    $sql1 = "SELECT * FROM problems";
                    if ($stmt = mysqli_prepare($DBConnect, $sql1)) {
                        $execute = mysqli_stmt_execute($stmt);
                        if (!$execute) {
                            echo "<p>Error code "
                            . mysqli_errno($DBConnect)
                            . ": " . mysqli_error($DBConnect)
                            . "</p>";
                        } else {
                            mysqli_stmt_bind_result($stmt, $id, $idstaff, $student_number, $department, $date, $description);
                            mysqli_stmt_store_result($stmt);
                            if (mysqli_stmt_num_rows($stmt) == 0) {
                                echo "<p>There are no problems!</p>";
                            } else {

                                echo "<table width=100%>
                <tr>
                <th>ProblemID</th>
                <th>Student</th>
                <th>Department</th>
                <th>date</th>
                <th>Description</th>               
                </tr>";
                                while (mysqli_stmt_fetch($stmt)) {
                                    echo "<tr>";
                                    echo "<td>" . $id . "</td>";
                                    echo "<td>" . $student_number . "</td>";
                                    echo "<td>" . $department . "</td>";
                                    echo "<td>" . $date . "</td>";
                                    echo "<td>" . $description . "</td>";

                                    echo "</tr>";
                                }
                                echo "</table>";
                            }
                        }
                        mysqli_stmt_close($stmt);
                    }
                    echo "<br>";


                    $sql2 = "SELECT students.student_number, students.first_name ,students.last_name,orderrow.OrderId, orderrow.ProductId, products.product_name, products.unitPrice, orders.date,orders.payment_method,orders.address,orders.post_code,orders.city,orderrow.amount FROM orderrow JOIN orders ON orders.idOrders=orderrow.OrderId JOIN products ON products.productId JOIN students ON orders.idOrders=students.student_number";
                    if ($stmt = mysqli_prepare($DBConnect, $sql2)) {
                        $execute = mysqli_stmt_execute($stmt);
                        if (!$execute) {
                            echo "<p>Error code "
                            . mysqli_errno($DBConnect)
                            . ": " . mysqli_error($DBConnect)
                            . "</p>";
                        } else {
                            mysqli_stmt_bind_result($stmt, $studentNr, $firstname, $lastname, $orderid, $productid, $productname, $unitprice, $date, $paymentmethod, $adress, $postcode, $city, $amount);
                            mysqli_stmt_store_result($stmt);
                            if (mysqli_stmt_num_rows($stmt) == 0) {
                                echo "<p>There are no orders!</p>";
                            } else {

                                echo "<table width=100%>
                <tr>
                <th>Student number</th>
                <th>Student Name</th>
                <th>Order id</th>
                <th>Product name</th>
                <th>Unit price</th>
                <th>Date</th>
                <th>Payment method</th>
                <th>Address</th>
                <th>Post code</th>
                <th>City</th>
                <th>Amount</th>
                <th>date</th>
                </tr>";
                                while (mysqli_stmt_fetch($stmt)) {
                                    echo "<tr>";
                                    echo "<td>" . $studentNr . "</td>";
                                    echo "<td>" . $firstname . " " . $lastname . "</td>";
                                    echo "<td>" . $orderid . "</td>";
                                    echo "<td>" . $productid . "</td>";
                                    echo "<td>" . $productname . "</td>";
                                    echo "<td>" . $unitprice . "</td>";
                                    echo "<td>" . $date . "</td>";
                                    echo "<td>" . $paymentmethod . "</td>";
                                    echo "<td>" . $adress . "</td>";
                                    echo "<td>" . $postcode . "</td>";
                                    echo "<td>" . $city . "</td>";
                                    echo "<td>" . $amount . "</td>";

                                    echo "</tr>";
                                }
                                echo "</table>";
                            }
                        }
                        mysqli_stmt_close($stmt);
                    }
                    echo "</br>";

                    $sql3 = "SELECT * FROM RESERVATIONS";
                    if ($stmt = mysqli_prepare($DBConnect, $sql3)) {
                        $execute = mysqli_stmt_execute($stmt);
                        if (!$execute) {
                            echo "<p>Error code "
                            . mysqli_errno($DBConnect)
                            . ": " . mysqli_error($DBConnect)
                            . "</p>";
                        } else {
                            mysqli_stmt_bind_result($stmt, $idreservation, $studentNr, $roomNr, $date, $time, $groupName);
                            mysqli_stmt_store_result($stmt);
                            if (mysqli_stmt_num_rows($stmt) == 0) {
                                echo "<p>There are no reservations!</p>";
                            } else {

                                echo "<table width=100%>
                <tr>
                <th>ReservationID</th>
                <th>Reserved to</th>
                <th>Room</th>
                <th>Group</th>
                <th>Date</th>
                </tr>";
                                while (mysqli_stmt_fetch($stmt)) {
                                    echo "<tr>";
                                    echo "<td>" . $idreservation . "</td>";
                                    echo "<td>" . $studentNr . " " . $lastname . "</td>";
                                    echo "<td>" . $roomNr . "</td>";
                                    echo "<td>" . $groupName . "</td>";
                                    echo "<td>" . $date . "</td>";

                                    echo "</tr>";
                                }
                                echo "</table>";
                            }
                        }
                        mysqli_stmt_close($stmt);
                    }
                    mysqli_close($DBConnect)
                    ?>
                </div>

                <div id="faq_box">

                    <h1 class="faq">
                        Actions
                    </h1>

                    <ul>
                        <li><a class="signupbutton2" href="HRStaffAdministration.php">Administration</a></li>
                    </ul>

                </div>

            </main>

            <footer>
                <p>University of Alnuvo&copy; If you need furthur help contact us&nbsp;<a href="mailto:alnuvo@support.com">here</a></p>
            </footer>
        </div>

    </body>
</html>
