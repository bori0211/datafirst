const util = require('util');

const express = require('express');
const { google } = require('googleapis');
const moment = require('moment-timezone');

const mysql = require('../mysqlPool');
const keys = require('../google_keys.json');

const router = express.Router();

router.get('/', async (req, res, next) => {
  res.render('telegraf', {
    pageTitle: 'DataFirst',
    selectedContent: 'Telegraf'
  });
});


// 2개로 나눠서 처리 하는 게??? (middle ware)
router.post('/', async (req, res, next) => {

  // 0. original save
  try {
    //const req_data = util.format('%j', req.body);

    //console.log(req.body);
    //console.log(req.body.metrics);

    /*
    for (const metric of req.body.metrics) {
      //console.log(metric);
      
      const metric_json = util.format('%j', metric);
      
      let query = `INSERT INTO telegraf_data (metric, regi_date) VALUES `;
      query += `('${metric_json}', `;
      query += `SYSDATE())`;
      
      //console.log(query);
      
      const [row] = await mysql.query(query);
    }
    */

    //await가 먹지 않음 (forEach 는 내부 함수로 처리되는 것 같음)
    //req.body.metrics.forEach(element => {
    //  let query = `INSERT INTO telegraf_data_2 (metric, regi_date) VALUES `;
    //  query += `('${element}', `;
    //  query += `SYSDATE())`;
    //  
    //  let [row] = await mysql.query(query);
    //});

    //let query = `INSERT INTO telegraf_data (req_body, regi_date) VALUES `;
    //query += `('${req_data}', `;
    //query += `SYSDATE())`;
    //
    //let [row] = await mysql.query(query);

    //console.log(row);

  } catch (error) {

    res.status(500).json({ message: 'The MySQL returned an error: ' + error });
  }


  // 1. telegraf
  const metrics = req.body.metrics;
  //console.log(req.body.metrics);
  //console.log(req.body);
  //console.log('%j', req.body);
  //const data = JSON.stringify(req.body);

  let _register = moment(new Date()).tz('Asia/Seoul').format();
  let timestamp = 0;
  let cpu_cnt = 0;
  let cpu_usage_idle = 0;
  let cpu_usage_system = 0;
  let cpu_usage_user = 0;
  let mem_cnt = 0;
  let mem_total = 0;
  let mem_used = 0;

  for (var i = 0; i < metrics.length; i++) {
    timestamp = metrics[i].timestamp;

    if (metrics[i].name == 'cpu') {
      cpu_cnt++;
      cpu_usage_idle = metrics[i].fields.usage_idle;
      cpu_usage_system = metrics[i].fields.usage_system;
      cpu_usage_user = metrics[i].fields.usage_user;
    }

    if (metrics[i].name == 'mem') {
      mem_cnt++;
      mem_total = metrics[i].fields.total;
      mem_used = metrics[i].fields.used;
    }
  }

  // 2. google sheet
  const client = new google.auth.JWT(
    keys.client_email,
    null,
    keys.private_key,
    ['https://www.googleapis.com/auth/spreadsheets']
  );

  client.authorize(function (err, tokens) {
    if (err) {
      console.log(err);
      res.status(500).json({ message: 'client authorize error: ' + err });
    }
  });

  const sheets = google.sheets({ version: 'v4', auth: client });

  var oneRow = {
    'majorDimension': 'ROWS',
    'values': [[_register, timestamp, cpu_cnt, cpu_usage_idle, cpu_usage_system, cpu_usage_user, mem_cnt, mem_total, mem_used]]
  }

  sheets.spreadsheets.values.append({
    spreadsheetId: '16FYvoHyHUoSepP2m-ss0X7tX0e0S03-o087FgoCwYdQ',
    range: 'gb-telegraf-metrics',
    valueInputOption: 'RAW',
    resource: oneRow
  }, (err, result) => {
    if (err) {
      console.log(err);
      res.status(500).json({ message: 'The API returned an error: ' + err });
    } else {
      //console.log(result);
      res.status(200).json({ result: true });
    }
  });

  //return res.status(200).json({ result: true });

});

module.exports = router;
