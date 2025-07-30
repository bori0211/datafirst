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
    
<script>
$(document).ready(function() {
  
  var steam_key = "13E8267D1902531BCC4381E2E6EC5B49";
  
  $.ajax({
    url: 'http://api.steampowered.com/ISteamUserStats/GetSchemaForGame/v2/?key=' + steam_key + '&appid=218620',
    type: 'GET',
    /*
    beforeSend: function(xhr) {
      xhr.setRequestHeader('Accept', 'application/vnd.api+json');
      xhr.setRequestHeader('Authorization', 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJqdGkiOiIwZjI0OGY5MC0xZjRlLTAxMzYtZDM4ZC0xNzMzY2RiZDdjNGYiLCJpc3MiOiJnYW1lbG9ja2VyIiwiaWF0IjoxNTIzNDA2ODg2LCJwdWIiOiJibHVlaG9sZSIsInRpdGxlIjoicHViZyIsImFwcCI6ImJvcmkwMjExIn0.ELGg5QcA1ksdpXwwu4IAjOd-H4TeaabNM_yvUvtDl9E');
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    }, */
    data: {},
    success: function(response) {
      console.log(response);
    },
    error: function(response) {
      console.log(response);
    }
  });
  
  
});

</script>
    
  </body>
</html>
