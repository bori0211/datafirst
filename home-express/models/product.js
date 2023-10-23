const mysql = require('../mysqlPool');

class Product {
  /*constructor(id, title, description, imageUrl, price, createdAt, updatedAt) {
    this.id = id;
    this.title = title;
    this.description = description;
    this.imageUrl = imageUrl;
    this.price = price;
    this.createdAt = createdAt;
    this.updatedAt = updatedAt;
  }*/
}

class ProductProvider {
  static select(status = '') {
    let where = ` WHERE TRUE`;
    let order = ` ORDER BY id DESC`;

    if (status != '') where += ` AND status = '${status}'`;

    let query = `SELECT id, status, title, description, cover_img, price, DATE_FORMAT(regi_date, '%Y-%m-%d') AS createdAt FROM pdt`;
    query += where + order;

    return mysql.query(query);
  }

  static selectOne(id) {
    return mysql.query(`SELECT id, status, title, description, cover_img, price, DATE_FORMAT(regi_date, '%Y-%m-%d') AS createdAt FROM pdt WHERE id = ${id}`);
  }

  static insert(status, title, description, cover_img, price) {
    // async / await 처리가 되어야 함
    /*var newId = 0;
    mysql
      .query('SELECT IFNULL(MAX(id), 0) + 1 AS newId FROM products')
      .then(([rows]) => (newId = rows[0].newId))
      .catch();
    //(id = rows[0].newId)*/
    let query = `INSERT INTO pdt (status, title, description, cover_img, price, regi_date, last_modi_date) VALUES `;
    query += `('${status}', `;
    query += `'${title}', `;
    description == '' ? (query += `NULL, `) : (query += `'${description}', `);
    cover_img == '' ? (query += `NULL, `) : (query += `'${cover_img}', `);
    query += `${price}, `;
    query += `SYSDATE(), `;
    query += `SYSDATE())`;

    return mysql.query(query);
  }

  static update(id, status, title, description, cover_img, price) {
    let query = `UPDATE pdt SET `;
    query += `status = '${status}', `;
    query += `title = '${title}', `;
    description == '' ? (query += `description = NULL, `) : (query += `description = '${description}', `);
    cover_img == '' ? (query += `cover_img = NULL, `) : (query += `cover_img = '${cover_img}', `);
    query += `price = ${price}, `;
    query += `last_modi_date = SYSDATE() `;
    query += `WHERE id = ${id}`;

    return mysql.query(query);
  }

  static updateOne(id, which, status) {
    let query = `UPDATE pdt SET `;
    if (which == 'status') {
      query += `status = '${status}', `;
    }
    query += `last_modi_date = SYSDATE() `;
    query += `WHERE id = ${id}`;

    return mysql.query(query);
  }

  static delete(id) {
    return mysql.query(`DELETE FROM pdt WHERE id = ${id}`);
  }

  /*
  {"message":"ResultSetHeader {\n  fieldCount: 0,\n  affectedRows: 1,\n  insertId: 32,\n  info: '',\n                                          serverStatus: 2,\n  warningStatus: 0                    }\n","timestamp":"2019-01-24 15:41:06","type":"out","process_id":0,"app_name":"home"}
  {"message":"ResultSetHeader {\n  fieldCount: 0,\n  affectedRows: 1,\n  insertId: 0, \n  info: 'Rows matched: 1  Changed: 1  Warnings: 0',\n  serverStatus: 2,\n  warningStatus: 0,\n  changedRows: 1 }\n","timestamp":"2019-01-24 15:44:00","type":"out","process_id":0,"app_name":"home"}
  {"message":"ResultSetHeader {\n  fieldCount: 0,\n  affectedRows: 1,\n  insertId: 0, \n  info: '',\n                                          serverStatus: 2,\n  warningStatus: 0                    }\n","timestamp":"2019-01-24 15:44:54","type":"out","process_id":0,"app_name":"home"}
  {"message":"ResultSetHeader {\n  fieldCount: 0,\n  affectedRows: 0,\n  insertId: 0,\n   info: '',\n                                          serverStatus: 2,\n  warningStatus: 0                    }\n","timestamp":"2019-01-24 15:48:39","type":"out","process_id":0,"app_name":"home"}
  */
}

module.exports = ProductProvider;
