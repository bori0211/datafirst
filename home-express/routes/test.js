const express = require('express');

const router = express.Router();

router.get('/', async (req, res, next) => {
  // 1. GET
  console.log('test get call');

  res.status(200).json({ 'result': true });
  res.end();
});

router.post('/', async (req, res, next) => {
  // 1. POST
  console.log('test post call');

  res.status(400).json({ 'error': 'abc' });
  res.end();
});

module.exports = router;
