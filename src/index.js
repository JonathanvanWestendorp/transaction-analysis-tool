const solc = require('solc');
const fs = require('fs')
const express = require('express');
const app = express();
const busboy = require('connect-busboy');
app.use(busboy());

app.post('/compile', function (req, res) {
    req.pipe(req.busboy);
    req.busboy.on('file', function (_, file, filename) {
        var saveTo = path.join(__dirname, 'uploads/' + filename);
        file.pipe(fs.createWriteStream(saveTo));


        // var input = {
        //     language: 'Solidity',
        //     sources: {
        //         [filename]: {
        //             content: data
        //         }
        //     },
        //     settings: {
        //         outputSelection: {
        //             '*': {
        //                 '*': ['*']
        //             }
        //         }
        //     }
        // };
        // var output = JSON.parse(solc.compile(JSON.stringify(input)));
        // console.log(output);
    });
    res.status(200).send({ontvangen: true});
});

app.listen(3000);