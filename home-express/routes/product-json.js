const express = require('express');

const mysql = require('../mysqlPool');

const router = express.Router();

// GET
router.get('/', async (req, res, next) => {
  res.status(200).json({ message: 'Hello world' });
});

// POST
router.post('/json-array-insert', async (req, res, next) => {
  //console.log(res);
  
  let result = [];
  
  //
  // Node Express의 Body Parser이 Java에도 있는지???  (  Json Data를 req에 객체로 넣어주는 기능 app.use(bodyParser.json())  )
  //
  for (const data of req.body.data) {
    console.log(data);
    console.log(data.title);
    
    let query = `INSERT INTO pdt (status, title, price, regi_date, last_modi_date) VALUES `;
    query += `('대기중', `;
    query += `'${data.title}', `;
    query += `${data.price}, `;
    query += `SYSDATE(), `;
    query += `SYSDATE())`;
    
    //console.log(query);
    
    const [row] = await mysql.query(query);
    //console.log(row);
    
    result.push({'insertId': row.insertId, 'title': `${data.title}`});
  }
  
  //console.log(result);
  
  res.status(200).json({ 'result': result });
});

module.exports = router;
