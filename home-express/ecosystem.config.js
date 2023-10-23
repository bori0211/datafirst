module.exports = {
  apps: [
    {
      name: "express",
      script: "bin/www",
      watch: true,
      env: {
        PORT: 3001,
        NODE_ENV: "development"
      },
      env_production: {
        PORT: 3001,
        NODE_ENV: "production"
      },
      /*ignore_watch: ['node_modules', 'public'],*/
      /*out_file: '/var/log/express-stdout.log',*/
      /*error_file: '/var/log/express-stderr.log',*/
      log_type: "json",
      log_date_format: "YYYY-MM-DD HH:mm:ss"
    }
  ]
};
