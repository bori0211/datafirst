// https://nodejs.org/api/https.html (참고)

const https = require("https");

const postData = JSON.stringify({
  todo: "Buy the milk"
});

const options = {
  hostname: "express.datafirst.co.kr",
  port: 443,
  path: "/lambda",
  method: "POST",
  headers: {
    "Content-Type": "application/json"
  }
};

const req = https.request(options, (res) => {
  console.log("statusCode: ", res.statusCode);
  //console.log("headers: ", res.headers);
  
  res.on("data", (responseData) => {
    //process.stdout.write(responseData);
    var obj = JSON.parse(responseData);
    console.log(obj);
  });
});

req.on("error", (error) => {
  console.error(error);
})

req.write(postData); // Post Data (보내는 데이터)
req.end();
