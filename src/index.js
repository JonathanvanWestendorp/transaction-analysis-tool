// const solc = require('solc');
const bodyParser = require('body-parser');
const express = require('express');
const app = express();
app.use(bodyParser())

app.post('/compile', function (req, res) {
    console.log(req.body);
    // compile with solidity
    res.status(200).send({ontvangen: true});
});

app.listen(3000);