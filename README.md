# AJAX 模式

## 設定 php.ini

因為使用了 POST 發送 JSON 資料, 會觸發 ```$HTTP_RAW_POST_DATA``` 停用提示訊息

    Deprecated: Automatically populating $HTTP_RAW_POST_DATA is deprecated 
	and will be removed in a future version. To avoid this warning set 
	'always_populate_raw_post_data' to '-1' in php.ini and use the 
	php://input stream instead.

可修改 ```php.ini``` 中 702 行的

```ini
always_populate_raw_post_data = -1
```

可以關掉 $HTTP_RAW_POST_DATA 停用訊息，***記得要關掉重開php或網頁伺服器***。

## 建立資料表與使用者 (同0329)

開啟命令提示字元 ```D:\xampp\mysql\bin\mysql -uroot```

```sql
CREATE DATABASE test0329 DEFAULT CHARACTER SET 'utf8' DEFAULT COLLATE 'utf8_general_ci';
CREATE USER 'mememe'@'localhost' IDENTIFIED BY '123456';
GRANT ALL PRIVILEGES ON test0329.* TO 'mememe'@'localhost';
FLUSH PRIVILEGES;

USE test0329;

CREATE TABLE moneybook (
  m_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(200),
  cost INT
) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';
```
"# HomeWork0628" 
