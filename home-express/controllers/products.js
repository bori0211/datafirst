const ProductProvider = require('../models/product');

/* 목록 */
exports.indexProducts = async (req, res, next) => {
  console.log('products controlls index');
  try {
    const [rows] = await ProductProvider.select();
    //console.log(rows);
    res.render('product/index', {
      selectedContent: 'Product',
      rows
    });
  } catch (error) {
    res.status(500).json({ error });
  }
};

/* 보기 */
exports.viewProducts = async (req, res, next) => {
  const id = req.params.id;

  try {
    const [rows] = await ProductProvider.selectOne(id);
    //console.log(rows);
    res.render('product/view', {
      selectedContent: 'Product',
      row: rows[0]
    });
  } catch (error) {
    res.status(500).json({ error });
  }
};

/* 등록 */
exports.newProducts = async (req, res, next) => {
  var initData = {
    status: '대기중',
    title: '',
    description: '',
    imageUrl: '',
    price: 0.0
  };

  res.render('product/form', {
    act: 'new',
    selectedContent: 'Product',
    row: initData
  });
};

/* INSERT */
exports.insertProducts = async (req, res, next) => {
  const status = req.body.status;
  const title = req.body.title;
  const description = req.body.description;
  const imageUrl = req.body.imageUrl;
  const price = req.body.price;

  try {
    const [row] = await ProductProvider.insert(status, title, description, imageUrl, price);
    //console.log(row); (row.insertId, row.affectedRows)
    //res.redirect('/mysql2/');
    res.status(200).json({
      result: true
    });
  } catch (error) {
    res.status(500).json({ error });
  }
};

/* 수정 */
exports.modifyProducts = async (req, res, next) => {
  const id = req.params.id;

  try {
    const [rows] = await ProductProvider.selectOne(id);
    //console.log(rows);
    res.render('product/form', {
      act: 'modify',
      selectedContent: 'Product',
      row: rows[0]
    });
  } catch (error) {
    res.status(500).json({ error });
  }
};

/* UPDATE */
exports.updateProducts = async (req, res, next) => {
  const id = req.body.id;
  const status = req.body.status;
  const title = req.body.title;
  const description = req.body.description;
  const imageUrl = req.body.imageUrl;
  const price = req.body.price;

  try {
    const [row] = await ProductProvider.update(id, status, title, description, imageUrl, price);
    //console.log(row); (row.changedRows, row.affectedRows)
    //res.redirect('/mysql2/');
    res.status(200).json({
      result: true
    });
  } catch (error) {
    res.status(500).json({ error });
  }
};

/* DELETE */
exports.deleteProducts = async (req, res, next) => {
  const id = req.body.id;

  try {
    const [row] = await ProductProvider.delete(id);
    //console.log(row); (row.affectedRows)
    //res.redirect('/mysql2/');
    res.status(200).json({
      result: true
    });
  } catch (error) {
    res.status(500).json({ error });
  }
};
