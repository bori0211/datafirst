<!DOCTYPE html>
<html>
  <head>
  </head>
  <body>
  
  
    <h3>JS Fetch</h3>

<script>
console.log("abc");


var url = "https://express.datafirst.co.kr/lambda";
var data = {"data": "abc"};

fetch(url, {
  method: "POST",
  body: JSON.stringify(data),
  headers: {
    "Content-Type": "application/json"
  }
})
  .then(res => res.json())
  .then(response => console.log("Success: ", JSON.stringify(response)))
  .catch(error => console.error("Error: ", error));

</script>

  </body>
</html>



