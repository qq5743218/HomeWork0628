<?php
//輸入=======================================================


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

//查詢
$stmt = $db->prepare('select * from kanban');
$stmt->execute();

//輸出=======================================================
$data = array();

while($row = $stmt->fetch()){  //小心,此處的=號是把右邊的值存往左側
	$data[] = (object)[
			'prod' => $row['k_name'],
			'id' => $row['k_id']
		];
}

http_response_code(200);
header("Content-Type: application/json;charset=UTF-8");
echo json_encode($data);              //把查詢資料回傳給用戶端