<?php

function order() {
    $conn = mysqli_connect("127.0.0.1", "root", "", "ticket_system")
            OR DIE("Connection failed");
    $query = "INSERT INTO orders(student_number,productId,date,payment_method,address,post_code,city) VALUES (?,?,?,?,?,?,?,?)";
    if ($stmt = mysqli_prepare($conn, $query)) {
        $student = $_SESSION["ID"];
        $productId = $_SESSION["Product"];
        $date = date("Y-m-d");
        $paymentMethod = $_POST["Payment"];
        $address = $_POST["address"];
        $postCode = $_POST["zip"];
        $city = $_POST["city"];
        mysqli_stmt_bind_param($stmt, "iisssss", $student, $productId, $date, $paymentMethod, $address, $postCode, $city);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        } else {
            echo "Statement could not be executed";
            echo mysqli_stmt_error($stmt);
        }
    } else {
        echo "Statement could not be prepared ";
        echo mysqli_stmt_error($stmt);
    }
}

order();

function Amount() {
    $query = 2;
}
