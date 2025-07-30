// https://nodejs.org/api/https.html (����)
// https://medium.com/better-programming/aws-tutorial-about-node-js-lambda-external-https-requests-logging-and-analyzing-data-e73137fd534c (����)

const https = require("https");

exports.handler = async (event) => {
  console.log("Hello, Lambda!");
  console.log(event);
  console.log("Goodbye, Lambda!");
  
  let responseData = "";

  const response = await new Promise((resolve, reject) => {
    const options = {
      hostname: "express.datafirst.co.kr",
      port: 443,
      path: "/lambda",
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      }
    };

    //const postData = JSON.stringify({
    //  todo: "Buy the milk"
    //});
    
    const postData = JSON.stringify(event);

    const req = https.request(options, (res) => {
      res.on("data", chunk => {
        responseData += chunk;
      });

      // ���� ����
      res.on("end", () => {
        resolve({
          statusCode: 200,
          body: JSON.stringify(JSON.parse(responseData), null, 4)
        });
      });
    });

    // ���� ����
    req.on("error", (e) => {
      reject({
        statusCode: 500,
        body: "Something went wrong!"
      });
    });

    req.write(postData); // Post Data (������ ������)
    req.end();
  });

  return response;
};