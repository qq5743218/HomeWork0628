<?php
//輸入=======================================================
//預期收到的資料格式  { prod:"商品的名稱", price:"值 }
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

$stmt = $db->prepare('update kanban set k_name=? where k_id=?');
$stmt->execute( [ $data->{"prod"}, $data->{"id"} ] );

//輸出=======================================================
//不需要$data->{"id"} = $db->lastInsertId();  //取得前一次 insert 的 id

http_response_code(200); 
header("Content-Type: application/json;charset=UTF-8");
echo json_encode($data);              //把insert的資料再回傳給用戶端