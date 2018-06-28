<?php
//輸入=======================================================
//如果要檢查取用方式是否符合....
//if( strcasecmp($_SERVER['REQUEST_METHOD'], 'DELETE') !=0 ){
//	http_response_code(405);
//	echo 'wrong way';
//	exit;	
//}

//預期收到的資料格式  { id:值 }
$data = json_decode(file_get_contents('php://input'));

//檢查你的資料. 暫時省略

//資料庫操作===================================================
try {
	$db = new PDO('mysql:host=localhost;dbname=test0329;charset=utf8'
		,'mememe','123456', array( 
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		) );
}catch(PDOException $err) {
	http_response_code(500);
	echo 'failed';
	//echo $err->getMessage(); //測試的時候用
	exit;
}

$stmt = $db->prepare('delete from forum where f_id=?');
$stmt->execute( [ $data->{"id"} ] );

//輸出=======================================================
http_response_code(200);
header("Content-Type: application/json;charset=UTF-8");
echo json_encode($data);              //把insert的資料再回傳給用戶端