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
    <h1>TEST123 345 567 445 555</h1>
    <h2><?= date("n") ?> / <?= date("j") ?></h2>
    <h2><?= substr("2018-01-01", 0, 7) ?></h2>
    
<script>
$(document).ready(function() {
  
  /*
  $.ajax({
    url: 'https://api.pubg.com/status',
    type: 'GET',
    beforeSend: function(xhr) {
      xhr.setRequestHeader('Accept', 'application/vnd.api+json');
      xhr.setRequestHeader('Authorization', 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJqdGkiOiIwZjI0OGY5MC0xZjRlLTAxMzYtZDM4ZC0xNzMzY2RiZDdjNGYiLCJpc3MiOiJnYW1lbG9ja2VyIiwiaWF0IjoxNTIzNDA2ODg2LCJwdWIiOiJibHVlaG9sZSIsInRpdGxlIjoicHViZyIsImFwcCI6ImJvcmkwMjExIn0.ELGg5QcA1ksdpXwwu4IAjOd-H4TeaabNM_yvUvtDl9E');
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
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
  
  /*
  $.ajax({
    url: 'https://api.pubg.com/shards/steam/leaderboards/solo',
    type: 'GET',
    beforeSend: function(xhr) {
      xhr.setRequestHeader('Accept', 'application/vnd.api+json');
      xhr.setRequestHeader('Authorization', 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJqdGkiOiIwZjI0OGY5MC0xZjRlLTAxMzYtZDM4ZC0xNzMzY2RiZDdjNGYiLCJpc3MiOiJnYW1lbG9ja2VyIiwiaWF0IjoxNTIzNDA2ODg2LCJwdWIiOiJibHVlaG9sZSIsInRpdGxlIjoicHViZyIsImFwcCI6ImJvcmkwMjExIn0.ELGg5QcA1ksdpXwwu4IAjOd-H4TeaabNM_yvUvtDl9E');
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
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
    url: 'https://api.playbattlegrounds.com/shards/steam/players?filter[playerNames]=Ashek',
    type: 'GET',
    beforeSend: function(xhr) {
      xhr.setRequestHeader('Accept', 'application/vnd.api+json');
      xhr.setRequestHeader('Authorization', 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJqdGkiOiIwZjI0OGY5MC0xZjRlLTAxMzYtZDM4ZC0xNzMzY2RiZDdjNGYiLCJpc3MiOiJnYW1lbG9ja2VyIiwiaWF0IjoxNTIzNDA2ODg2LCJwdWIiOiJibHVlaG9sZSIsInRpdGxlIjoicHViZyIsImFwcCI6ImJvcmkwMjExIn0.ELGg5QcA1ksdpXwwu4IAjOd-H4TeaabNM_yvUvtDl9E');
    },
    data: {},
    success: function(response) {
      console.log(response);
    },
    error: function(response) {
      console.log(response);
    }
  });
  
  /*
  $.ajax({
    url: 'https://api.pubg.com/shards/pc-tournament/matches/8683de8b-a787-403d-a126-9a3625648ba7',
    type: 'GET',
    beforeSend: function(xhr) {
      xhr.setRequestHeader('Accept', 'application/vnd.api+json');
      xhr.setRequestHeader('Authorization', 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJqdGkiOiIwZjI0OGY5MC0xZjRlLTAxMzYtZDM4ZC0xNzMzY2RiZDdjNGYiLCJpc3MiOiJnYW1lbG9ja2VyIiwiaWF0IjoxNTIzNDA2ODg2LCJwdWIiOiJibHVlaG9sZSIsInRpdGxlIjoicHViZyIsImFwcCI6ImJvcmkwMjExIn0.ELGg5QcA1ksdpXwwu4IAjOd-H4TeaabNM_yvUvtDl9E');
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    },
    data: {},
    success: function(response) {
      console.log(response);
      //console.log(response.data.attributes);
      //console.log(response.included);
      //console.log(response.included[0]);
    },
    error: function(response) {
      console.log(response);
    }
  });
  */
  
  /*
  $.ajax({
    url: 'https://api.pubg.com/shards/steam/seasons',
    type: 'GET',
    beforeSend: function(xhr) {
      xhr.setRequestHeader('Accept', 'application/vnd.api+json');
      xhr.setRequestHeader('Authorization', 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJqdGkiOiIwZjI0OGY5MC0xZjRlLTAxMzYtZDM4ZC0xNzMzY2RiZDdjNGYiLCJpc3MiOiJnYW1lbG9ja2VyIiwiaWF0IjoxNTIzNDA2ODg2LCJwdWIiOiJibHVlaG9sZSIsInRpdGxlIjoicHViZyIsImFwcCI6ImJvcmkwMjExIn0.ELGg5QcA1ksdpXwwu4IAjOd-H4TeaabNM_yvUvtDl9E');
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
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
  
  /*
  $.ajax({
    url: 'https://api.pubg.com/shards/steam/players/account.29d10b55c9ce41b48785015e23faac32/seasons/division.bro.official.pc-2018-01',
    type: 'GET',
    beforeSend: function(xhr) {
      xhr.setRequestHeader('Accept', 'application/vnd.api+json');
      xhr.setRequestHeader('Authorization', 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJqdGkiOiIwZjI0OGY5MC0xZjRlLTAxMzYtZDM4ZC0xNzMzY2RiZDdjNGYiLCJpc3MiOiJnYW1lbG9ja2VyIiwiaWF0IjoxNTIzNDA2ODg2LCJwdWIiOiJibHVlaG9sZSIsInRpdGxlIjoicHViZyIsImFwcCI6ImJvcmkwMjExIn0.ELGg5QcA1ksdpXwwu4IAjOd-H4TeaabNM_yvUvtDl9E');
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
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
  
  
  
});

</script>
    
  </body>
</html>
