const express = require('express');
const jwt = require('jsonwebtoken');

const config = require('../config');
const UserProvider = require('../models/user');
const ProductProvider = require('../models/product');
const checkAuth = require('../middleware/check_auth');

const router = express.Router();

/* 토큰 */
router.post('/getToken', async (req, res, next) => {
  const loginId = req.body.login_id;
  const password = req.body.password;

  let accessIp = req.headers['x-forwarded-for'].split(',')[0];

  try {
    const [rows] = await UserProvider.selectPassword(loginId);
    if (password == rows[0].password) {
      const token = jwt.sign({ userId: loginId }, config.JWT_KEY, { expiresIn: '1h' });
      // DB 입력
      await UserProvider.insertToken(accessIp, loginId, 1, 'Successed');
      res.status(200).json({ 'result': true, 'token': token });
      res.end();
    } else {
      // DB 입력
      await UserProvider.insertToken(accessIp, loginId, 0, 'Wrong password');
      res.status(401).json({ 'result': false, 'message': 'Auth fail.' });
      res.end();
    }
  } catch (error) {
    // DB 입력
    await UserProvider.insertToken(accessIp, loginId, 0, 'Failed');
    res.status(500).json({ error });
    res.end();
  }
});

/* 목록 */
router.get('/products', async (req, res, next) => {
  const status = req.query.status;

  try {
    const [rows] = await ProductProvider.select(status);
    res.status(200).json(rows);
    res.end();
  } catch (error) {
    res.status(500).json({ error });
    res.end();
  }
});

/* 보기 */
router.get('/products/:id', checkAuth, async (req, res, next) => {
  const id = req.params.id;
  console.log(req.userData);

  try {
    const [rows] = await ProductProvider.selectOne(id);
    res.status(200).json(rows[0]);
    res.end();
  } catch (error) {
    res.status(500).json({ error });
    res.end();
  }
});

/* INSERT */
router.post('/products', async (req, res, next) => {
  const status = req.body.status;
  const title = req.body.title;
  const description = req.body.description;
  const cover_img = req.body.cover_img;
  const price = req.body.price;

  try {
    const [row] = await ProductProvider.insert(status, title, description, cover_img, price);
    //console.log(row); (row.insertId, row.affectedRows)
    //res.redirect('/mysql2/');
    res.status(200).json({
      result: true
    });
    res.end();
  } catch (error) {
    res.status(500).json({ error });
    res.end();
  }
});

/* UPDATE */
router.put('/products/:id', async (req, res, next) => {
  const id = req.params.id;
  const status = req.body.status;
  const title = req.body.title;
  const description = req.body.description;
  const cover_img = req.body.cover_img;
  const price = req.body.price;

  try {
    const [row] = await ProductProvider.update(id, status, title, description, cover_img, price);
    //console.log(row); (row.changedRows, row.affectedRows)
    //res.redirect('/mysql2/');
    res.status(200).json({
      result: true
    });
    res.end();
  } catch (error) {
    res.status(500).json({ error });
    res.end();
  }
});

/* UPDATE (ONE) */
router.patch('/products/:id', async (req, res, next) => {
  const id = req.params.id;
  const which = req.body.which;
  const status = req.body.status;

  try {
    const [row] = await ProductProvider.updateOne(id, which, status);
    //console.log(row); (row.changedRows, row.affectedRows)
    //res.redirect('/mysql2/');
    res.status(200).json({
      result: true
    });
    res.end();
  } catch (error) {
    res.status(500).json({ error });
    res.end();
  }
});

/* DELETE */
router.delete('/products/:id', async (req, res, next) => {
  const id = req.params.id;

  try {
    const [row] = await ProductProvider.delete(id);
    //console.log(row); (row.affectedRows)
    //res.redirect('/mysql2/');
    res.status(200).json({
      result: true
    });
    res.end();
  } catch (error) {
    res.status(500).json({ error });
    res.end();
  }
});

module.exports = router;
