// const solc = require('solc');
var busboy = require('connect-busboy');
const express = require('express');
const app = express();
app.use(busboy());

app.post('/compile', function (req, res) {
    req.pipe(req.busboy);
    req.busboy.on('file', function (fieldname, file, filename) {
        console.log(fieldname + file + filename);
    });
    res.status(200).send({ontvangen: true});
});

app.listen(3000);