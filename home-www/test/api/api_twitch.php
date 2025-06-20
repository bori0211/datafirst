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
    <h2><?= substr("2018-01-01", 0, 7) ?></h2>
    
<script>
$(document).ready(function() {
  
  /*
  $.ajax({
    url: 'https://api.twitch.tv/helix/games?id=493057',
    type: 'GET',
    beforeSend: function(xhr) {
      xhr.setRequestHeader('Accept', 'application/vnd.api+json');
      xhr.setRequestHeader('Client-ID', 'alf8fm22te2pmtvdbs2rzjltbfryc4');
    },
    data: {},
    success: function(response) {
      console.log(response);
    },
    error: function(response) {
      console.log(response);
    }
  });
  */
  
  
  $.ajax({
    url: 'https://api.twitch.tv/helix/streams?game_id=493057&after=eyJiIjpudWxsLCJhIjp7Ik9mZnNldCI6MjB9fQ',
    type: 'GET',
    beforeSend: function(xhr) {
      //xhr.setRequestHeader('Accept', 'application/vnd.api+json');
      xhr.setRequestHeader('Client-ID', 'alf8fm22te2pmtvdbs2rzjltbfryc4');
    },
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
