const zlib = require('zlib');

const express = require('express');
const nodemailer = require('nodemailer');

const mysql = require('../mysqlPool');

const router = express.Router();


router.get('/', async (req, res, next) => {

  // 1. lambda
  console.log('lambda call');

  //res.status(200).json({ 'result': true });
  
  res.render('lambda', {
    pageTitle: 'DataFirst',
    selectedContent: 'Lambda'
  });
  
});


router.post('/', async (req, res, next) => {

  // 0. original save
  try {
    const req_data = JSON.stringify(req.body);
    const req_data2 = req_data.replace(/\\"/g, '\\\\"'); // \를 포함해 줘야 함

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


router.post('/sendmail', async (req, res, next) => {
  // https://accounts.google.com/DisplayUnlockCaptcha (인증 필요 - 허용된 IP에서만)
  let transporter = nodemailer.createTransport({
    service: 'gmail',
    prot: 587,
    host: 'smtp.gmail.com', // 111
    secure: false, // 222
    requireTLS: true, // 333
    auth: {
      user: 'chickendinner.me@gmail.com',
      pass: 'orrwujsdcuvaixie'
    }
  });
  
  if (req.body.awslogs?.data) {
    
    //console.log(req.body.awslogs.data);
    var orgBuffer = new Buffer.from(req.body.awslogs.data, 'base64');
    
    // Calling unzip method
    zlib.unzip(orgBuffer, (err, unzipBuffer) => {
      if (err) {
        res.status(500).json({ 'error': 'zlib unzip error' });
      } else {
        //console.log(buffer.toString('utf8'));
        const body_text = unzipBuffer.toString('utf8');
        
        let mailOptions = {
          from: 'chickendinner.me@gmail.com',
          to: 'bori0211@gmail.com',
          subject: 'Sending Email using Node.js',
          text: '1. CloudWatch Logs\n2. 구독 필터\n3. Lambda (callAxiosSendmail)\n4. DataFirst (express / lambda / sendmail POST)\n\n' + body_text
        };
        
        transporter.sendMail(mailOptions, (error, info) => {
          if (error) {
            console.log(error);
            res.status(500).json({ 'error': 'transporter sendMail error' });
          } else {
            console.log('Email sent');
            res.status(200).json({ 'result': true });
          }
        });
      }
    });
    
  } else {
    //console.log(req.body);
    const body_text = JSON.stringify(req.body);
    
    let mailOptions = {
      from: 'chickendinner.me@gmail.com',
      to: 'bori0211@gmail.com',
      subject: 'Sending Email using Node.js',
      text: body_text
    };
    
    transporter.sendMail(mailOptions, (error, info) => {
      if (error) {
        console.log(error);
        res.status(500).json({ 'result': false, 'error': 'transporter sendMail error' });
      } else {
        console.log('Email sent');
        res.status(200).json({ 'result': true });
      }
    });
  }
  
});

module.exports = router;
