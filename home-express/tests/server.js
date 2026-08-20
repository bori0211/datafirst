const http = require('http');

const server = http.createServer((req, res) => {
  if (req.url == '/' && req.method == 'GET') {
    res.statusCode = 200;
    res.setHeader('Content-Type', 'text/html');
    res.write('<h1>Hello World</h1>');
    res.end();
  } else if (req.url == '/post' && req.method == 'POST') {
    let body = '';
    req.on('data', (chunk) => {
      body += chunk.toString();
    });
    req.on('end', () => {
      console.log(body);
    });
    res.end();
  } else {
    res.writeHead(404, 'Content-Type', 'application/json');
    res.end(JSON.stringify({ message: 'Route Not Found'}));
  }
});

const PORT = process.env.PORT || 3000;

console.log(process.env.PORT);
console.log(PORT);

server.listen(PORT, () => {
  console.log(`Server running on port ${PORT}`);
});
