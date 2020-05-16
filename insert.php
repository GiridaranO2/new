<?php
$un = $_POST['un'];
$pwd = $_POST['pwd'];

if (!empty($un) || !empty($pwd)){
    $host = "sql12.freemysqlhosting.net";
    $dbUsername = "sql12341068";
    $dbPassword = "VWkjQ7s2gz";
    $dbname = "sql12341068";

    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

    if (mysqli_connect_error()){
        die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());

    }else{
        $SELECT = "SELECT un from test Where un = ? Limit 1";
        $INSERT = "INSERT Into test (un, pwd) values(?, ?)";

        //pepare statement 
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $un);
        $stmt->execute();
        $stmt->bind_result($un);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if($rnum==0){
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("ss", $un, $pwd);
            $stmt->execute();
            echo "new data inserted successfully";
        }else {
            echo "already email registered";
        }
        $stmt->close();
        $conn->close();

    }
}else{
    echo "all fields are required";
    die();
}
?>
