<?php
    $email = $_POST['email'];
    $password = $_POST['password'];

    $conn = new mysqli('localhost:3307','root','','test1');
    if ($conn->connect_error) {
        die("Connection failed:".$conn->connect_error);
    } else {
        $sql=$conn->prepare("select * from registration where email=?");
        $sql->bind_param("s",$email);
        $sql->execute();
        $result = $sql->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if($row['password'] === $password){
                echo "Login Successfull";
            } else {
                echo " Invalid Email or Password";
            }
        } else {
            echo " Invalid Email or Password";
        }

    }

?>