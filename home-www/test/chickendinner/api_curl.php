<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>API AJAX TEST</title>
    <script src="/bower/jquery/dist/jquery.min.js"></script>
  </head>
  
  <body>
    <h1>TEST</h1>
    <h2><?= date("n") ?> / <?= date("j") ?></h2>
    
<?
	// KEY
	$api_key = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJqdGkiOiIwZjI0OGY5MC0xZjRlLTAxMzYtZDM4ZC0xNzMzY2RiZDdjNGYiLCJpc3MiOiJnYW1lbG9ja2VyIiwiaWF0IjoxNTIzNDA2ODg2LCJwdWIiOiJibHVlaG9sZSIsInRpdGxlIjoicHViZyIsImFwcCI6ImJvcmkwMjExIn0.ELGg5QcA1ksdpXwwu4IAjOd-H4TeaabNM_yvUvtDl9E";
	
	$ch = curl_init();
	
	curl_setopt($ch, CURLOPT_URL, "https://api.pubg.com/status");
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $api_key, "Accept: application/vnd.api+json"));
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
	$response = curl_exec($ch);
	
	var_dump($response);
	
	
	curl_setopt($ch, CURLOPT_URL, "https://api.playbattlegrounds.com/shards/pc-krjp/players?filter[playerNames]=Ashek");
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $api_key, "Accept: application/vnd.api+json"));
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
	$response = curl_exec($ch);
	
	var_dump($response);
	
	curl_close($ch);
?>
    
  </body>
</html>
