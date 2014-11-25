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
if (isset($_GET["name"])) {

    $name = $_GET['name'];
	
//	$name = iconv("gbk","utf-8",$name);  

	$statue=iconv("gbk","utf-8","\"已入场\"");
	
	$direction=iconv("gbk","utf-8","\"%入%\"");
	
	$sql="SELECT pale,regtime,time as intime FROM record WHERE pale in (SELECT pale FROM car_pale WHERE name = $name AND statue= $statue) AND direction like $direction";
	
	
    $result = mysql_query($sql);
	

    if (!empty($result)) {

        if (mysql_num_rows($result) > 0) {
		
		            $response["record"] = array();
					
		
            while($row=mysql_fetch_array($result)){

            $product = array();
            $product["pale"] = $row["pale"];
            $product["regtime"] = $row["regtime"];
			$product["intime"] = $row["intime"];
            array_push($response["record"], $product);
			}
            $response["success"] = 1;



          

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