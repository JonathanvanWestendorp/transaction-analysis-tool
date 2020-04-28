// const solc = require('solc');
const bodyParser = require('body-parser');
const express = require('express');
const app = express();
// app.use(express.json());
// app.use(express.urlencoded());
// app.use(express.multipart());

app.post('/compile', function (req, res) {
    console.log(req);
    // compile with solidity
    res.status(200).send({ontvangen: true});
});

app.listen(3000);