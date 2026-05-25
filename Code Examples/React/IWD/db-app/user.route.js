const mysql = require("mysql");

const connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: 'Database1!',
    database: 'andiadopt_db'
});

module.exports = function(app) {
    app.get('/', function(req, res) {
        connection.query('SELECT * FROM pets', function(err, data) {
            (err)?res.send(err):res.json(data);
        })
    });
};