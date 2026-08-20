const express = require('express');
const sha2 = require('sha2');

const router = express.Router();

router.get('/', (req, res, next) => {
  res.render('index', {
    pageTitle: 'DataFirst',
    password: sha2['SHA-256']('1111').toString('hex'),
    selectedContent: 'Index'
  });
});

module.exports = router;
