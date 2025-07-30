const express = require('express');

const productsController = require('../controllers/products');
const ProductProvider = require('../models/product');

const router = express.Router();

/* 목록 */
router.get('/', productsController.indexProducts);

/* 보기 */
router.get('/view/:id', productsController.viewProducts);

/* 등록 */
router.get('/new', productsController.newProducts);

/* INSERT */
router.post('/insert', productsController.insertProducts);

/* 수정 */
router.get('/modify/:id', productsController.modifyProducts);

/* UPDATE */
router.post('/update', productsController.updateProducts);

/* DELETE */
router.post('/delete', productsController.deleteProducts);

module.exports = router;
