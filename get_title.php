<?php

$id = $_GET['id'];


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


$stmt = $db->prepare('select * from kanban where k_id=?');
$stmt->execute([$id]);

$data = NULL;

if($row = $stmt->fetch()){  //只要一筆
	$data = (object)[
			'title' => $row['k_name'],
			'content' => $row['k_content'],
			'id' => $row['k_id']
		];
}else{
	http_response_code(404);
	echo 'no data';
	exit;
}

http_response_code(200);
header("Content-Type: application/json;charset=UTF-8");
echo json_encode($data); 