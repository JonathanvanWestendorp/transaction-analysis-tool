// var solc = require('solc');
const express = require('express');
const app = express();
app.use(express.json());
app.use(express.urlencoded());
app.use(express.multipart());

app.post('/compile', function (req, res) {
    var body = req.body;
    // compile with solidity
    res.send(body);
});

app.listen(3000, function () {
    console.log('Example app listening at http://localhost:3000');
});