<?php

$response = array();

if (isset($_POST['pale']) && isset($_POST['name']) && isset($_POST['regtime']) && isset($_POST['statue'])) {
    
    $pale = $_POST['pale'];
    $name = $_POST['name'];
    $regtime = $_POST['regtime'];
    $statue = $_POST['statue'];
	
    require_once __DIR__ . '/db_connect.php';

    $db = new DB_CONNECT();
	

	
	$sql="INSERT INTO car_pale(pale,regtime, name, statue) VALUES('$pale', '$regtime', '$name','$statue')";
	
    $result = mysql_query("$sql");

    if ($result) {
	
        $response["success"] = 1;

        $response["message"] = "Product successfully created.";

        echo json_encode($response);

    } else {
	
        $response["success"] = 0;
	 
        $response["message"] = "Oops! An error occurred.";
        
        echo json_encode($response);
    }
} else {

    $response["success"] = 0;
	
    $response["message"] = "Required field(s) is missing";

    echo json_encode($response);
}

?>








