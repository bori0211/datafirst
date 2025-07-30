const mysql = require('../mysqlPool');

class User {
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

class UserProvider {
  static selectPassword(login_id) {
    return mysql.query(`SELECT password FROM usr WHERE login_id = '${login_id}'`);
  }

  static insertToken(access_ip, login_id, result, message) {
    let query = `INSERT INTO usr_token (access_date, access_ip, login_id, result, message) VALUES `;
    query += `(SYSDATE(), `;
    query += `'${access_ip}', `;
    query += `'${login_id}', `;
    query += `${result}, `;
    query += `'${message}')`;

    return mysql.query(query);
  }

  /*
  {"message":"ResultSetHeader {\n  fieldCount: 0,\n  affectedRows: 1,\n  insertId: 32,\n  info: '',\n                                          serverStatus: 2,\n  warningStatus: 0                    }\n","timestamp":"2019-01-24 15:41:06","type":"out","process_id":0,"app_name":"home"}
  {"message":"ResultSetHeader {\n  fieldCount: 0,\n  affectedRows: 1,\n  insertId: 0, \n  info: 'Rows matched: 1  Changed: 1  Warnings: 0',\n  serverStatus: 2,\n  warningStatus: 0,\n  changedRows: 1 }\n","timestamp":"2019-01-24 15:44:00","type":"out","process_id":0,"app_name":"home"}
  {"message":"ResultSetHeader {\n  fieldCount: 0,\n  affectedRows: 1,\n  insertId: 0, \n  info: '',\n                                          serverStatus: 2,\n  warningStatus: 0                    }\n","timestamp":"2019-01-24 15:44:54","type":"out","process_id":0,"app_name":"home"}
  {"message":"ResultSetHeader {\n  fieldCount: 0,\n  affectedRows: 0,\n  insertId: 0,\n   info: '',\n                                          serverStatus: 2,\n  warningStatus: 0                    }\n","timestamp":"2019-01-24 15:48:39","type":"out","process_id":0,"app_name":"home"}
  */
}

module.exports = UserProvider;
