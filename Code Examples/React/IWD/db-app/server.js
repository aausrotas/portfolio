const express = require('express');
var cors = require("cors");
var bodyParser = require("body-parser");
const mysql = require('mysql');
const PORT = process.env.PORT || 8000;

const app = express();

app.use(bodyParser.json());
app.use(cors());
app.use(bodyParser.urlencoded({extended:false}));

const connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: 'Database1!',
    database: 'andiadopt_db'
});

connection.connect(function(err) {
    (err)? console.log(err): console.log(connection);
    
});

require('./user.route.js')(app);
app.listen(PORT, () => {
    console.log("App running on port 8000");
})