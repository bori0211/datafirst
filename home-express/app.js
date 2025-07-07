const path = require('path');

const express = require('express');
const favicon = require('serve-favicon');
const logger = require('morgan');

const indexRouter = require('./routes/index');
const productsRouter = require('./routes/products');
const productJsonRouter = require('./routes/product-json');
const restfulRouter = require('./routes/restful');
const telegrafRouter = require('./routes/telegraf');
const lambdaRouter = require('./routes/lambda');
const testRouter = require('./routes/test');

const app = express();

// VIEW ENGINE SETUP
app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'ejs');
app.set('view options', { delimiter: '?', outputFunctionName: 'echo' });

// Uncomment after placing your favicon in /public
app.use(favicon(path.join(__dirname, 'public', 'assets', 'favicon.png')));
app.use(express.static(path.join(__dirname, 'public')));
app.use(express.json());
app.use(express.urlencoded({ extended: false }));
app.use(logger('dev'));

// Handling CORS
app.use((req, res, next) => {
  res.header('Access-Control-Allow-Origin', '*');
  //res.header('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE');
  res.header('Access-Control-Allow-Methods', '*');
  //res.header('Access-Control-Allow-Headers', 'Origin, Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers, Authorization');
  res.header('Access-Control-Allow-Headers', '*');
  next();
});

// Routes
app.use('/', indexRouter);
app.use('/products', productsRouter);
app.use('/product-json', productJsonRouter);
app.use('/restful', restfulRouter);
app.use('/telegraf', telegrafRouter);
app.use('/lambda', lambdaRouter);
app.use('/test', testRouter);

app.get('/tmp', (req, res) => {
  //res.statusCode = 200;
  //res.setHeader('Content-Type', 'text/html');
  //res.write('<h1>Hello World</h1>');

  let body = '';
  req.on('data', (chunk) => {
    body += chunk.toString();
  });

  req.on('end', (chunk) => {
    const { title, description, price } = JSON.parse(body);
    const product = { title: title, description, price };
    res.send('result:' + req.query.id);
  });

  res.send('result:' + req.query.id);
});

// catch 404 and forward to error handler
app.use((req, res, next) => {
  var err = new Error('Not Found');
  err.status = 404;
  next(err);
});

// error handler
app.use((err, req, res, next) => {
  // set locals, only providing error in development
  res.locals.message = err.message;
  res.locals.error = req.app.get('env') === 'development' ? err : {};

  // render the error page
  res.status(err.status || 500);
  res.render('error');
});

module.exports = app;
