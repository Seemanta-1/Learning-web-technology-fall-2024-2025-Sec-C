<?php 
    $name= $_POST['name'];
    $email= $_POST['email'];
    $password= $_POST['password'];
    $confirmPassword= $_POST['confirmPassword'];
    $phone= $_POST['phone'];

    $conn =new mysqli('localhost:3307','root','','test1');
    if ($conn->connect_error) {
        die("Connection failed:" .$conn->connect_error);
    } else {
        $sql = $conn->prepare("insert into registration(name,email,password,confirmPassword,phone) values(?,?,?,?,?)");
        $sql->bind_param("ssssi",$name,$email,$password,$confirmPassword,$phone);
        $sql->execute();
        echo "registration successful";
        $sql->close();
        $conn->close();
    }
 ?>