<?php

$data = json_decode(file_get_contents('php://input'));

//資料庫操作===========================================================

try{
	
	$db = new PDO('mysql:host=localhost;dbname=test0329;charset=utf8'
		,'mememe','123456', array( 
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		) );
}catch(PDOException $err){
	http_response_code(500);
	echo 'failed';
	//echo $err->getMessage(); //測試的時候用
	exit;
}

$stmt = $db->prepare('insert into forum (k_id,f_content) values (?,?)');
$stmt->execute( [ $data->{"k_id"},$data->{"content"} ] );


//輸出=======================================================
$data->{"id"} = $db->lastInsertId();  //取得前一次 insert 的 id

http_response_code(201);
header("Content-Type: application/json;charset=UTF-8");
echo json_encode($data);              //把insert的資料再回傳給用戶端