

<?php

$response = array();

if (isset($_POST["pale"])) {
    
    $pale = $_POST['pale'];
	
    require_once __DIR__ . '/db_connect.php';

    $db = new DB_CONNECT();
	
	$sql="DELETE FROM car_pale WHERE pale = \"$pale\"";
	
	print "$sql";
	
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








