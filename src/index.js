// var solc = require('solc');
const express = require('express');
const app = express();
// app.use(express.json());
// app.use(express.urlencoded());
// app.use(express.multipart());

app.post('/compile', function (req, res) {
    console.log("Incoming request:");
    var body = req.body;
    console.log(body);
    // compile with solidity
    res.send("Hij is binnen hoor");
});

var server = app.listen(3000, function () {
    var host = server.address().address;
    var port = server.address().port;
    console.log('running at http://' + host + ':' + port);
});