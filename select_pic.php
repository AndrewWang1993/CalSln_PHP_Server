<?php
header("Content-Type:text/html;charset=UTF-8");   
/*
 * Following code will get single product details
 * A product is identified by product id (pid)
 */

// array for JSON response
$response = array();


// include db connect class
require_once __DIR__ . '/db_connect.php';
// connecting to db
$db = new DB_CONNECT();

// check for post data
if (isset($_GET["pale"]) && isset($_GET["intime"])) {
    $pale = $_GET['pale'];
	$intime=$_GET['intime'];
	
//	$pale = iconv("gbk","utf-8",$pale);  

    $result = mysql_query("SELECT *FROM record WHERE pale = $pale AND time = $intime");
	

    if (!empty($result)) {

        if (mysql_num_rows($result) > 0) {
            $result = mysql_fetch_array($result);

            $product = array();
            $product["pic"] = $result["pic"];

            // success
            $response["success"] = 1;

            // user node
            $response["record"] = array();

            array_push($response["record"], $product);

            // echoing JSON response
            echo json_encode($response);
        } else {
            // no product found
            $response["success"] = 0;
            $response["message"] = "No product found1";

            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no product found
        $response["success"] = 0;
        $response["message"] = "No product found2";

        // echo no users JSON
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}
?>