const zlib = require('zlib');

const express = require('express');
const nodemailer = require('nodemailer');

const mysql = require('../mysqlPool');

const router = express.Router();

router.get('/', async (req, res, next) => {

  // 1. lambda
  console.log('lambda call');

  res.status(200).json({ 'result': true });
});

router.post('/', async (req, res, next) => {

  // 0. original save
  try {
    const req_data = JSON.stringify(req.body);
    const req_data2 = req_data.replace(/\\"/g, '\\\\"'); // \�� ������ ��� ��

    //console.log(req_data);

    let query = `INSERT INTO lambda_data (req_body, regi_date) VALUES `;
    query += `('${req_data2}', `;
    query += `SYSDATE())`;

    //console.log(query);

    const [row] = await mysql.query(query);

    //console.log(row);

    res.status(200).json({ 'result': true });

  } catch (error) {

    res.status(500).json({ error });
  }
});

router.post('/catch-slow-query', async (req, res, next) => {

  /*
  let transporter = nodemailer.createTransport({
    service: 'gmail',
    prot: 587,
    host: ''smtp.gmlail.com',
    secure: false,
    requireTLS: true,
    auth: {
      user: 'chickendinner.me@gmail.com',
      pass: 'Dlqka2380!'
    }
  });
  */

  let transporter = nodemailer.createTransport({
    service: 'gmail',
    auth: {
      user: 'chickendinner.me@gmail.com',
      pass: 'Dlqka2380!'
    }
  });
  
  //console.log(buffer.toString('utf8'));
  const body_text = '123';
  
  let mailOptions = {
    from: 'chickendinner.me@gmail.com',
    to: 'bori0211@gmail.com',
    subject: 'Sending Email using Node.js',
    text: body_text
  };
  
  transporter.sendMail(mailOptions, function (error, info) {
    if (error) {
      console.log(error);
      res.status(500).json({ 'error': 'transporter sendMail error' });
    } else {
      console.log('Email sent');
      res.status(200).json({ 'result': true });
    }
  });
  


  //const req_data = JSON.stringify(req.body);
  //const req_data2 = req_data.replace(/\\"/g, '\\\\"'); // \�� ������ ��� ��
  
  /*
  var buffer = new Buffer.from(JSON.stringify(req.body), 'base64');
  
  // Calling unzip method
  zlib.unzip(buffer, (err, buffer) => {
    if (err) {
      res.status(500).json({ 'error': 'zlib unzip error' });
    } else {
      //console.log(buffer.toString('utf8'));
      const body_text = buffer.toString('utf8');
      
      let mailOptions = {
        from: 'chickendinner.me@gmail.com',
        to: 'bori0211@gmail.com',
        subject: 'Sending Email using Node.js',
        text: body_text
      };
      
      transporter.sendMail(mailOptions, function (error, info) {
        if (error) {
          console.log(error);
          res.status(500).json({ 'error': 'transporter sendMail error' });
        } else {
          console.log('Email sent');
          res.status(200).json({ 'result': true });
        }
      });
    }
  });*/
});

module.exports = router;
