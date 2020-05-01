const fs = require('fs')
const solc = require('solc');
const path = require('path');
const express = require('express');
const busboy = require('connect-busboy');
const app = express();
app.use(busboy());

app.post('/compile', function (req, res) {
    req.pipe(req.busboy);
    req.busboy.on('file', function (_, file, filename) {
        var dir = 'uploads/';
        if (!fs.existsSync('./' + dir)) {
            fs.mkdirSync('./' + dir);
        }
        var filepath = path.join(__dirname, 'uploads/' + filename);
        file.pipe(fs.createWriteStream(filepath));
        // Maybe this can be simplified..
        fs.readFile(filepath, "utf8", function (err, data) {
            if (err) {
                throw(err);
            }
            var input = {
                language: 'Solidity',
                sources: {
                    [filename]: {
                        content: data
                    }
                },
                settings: {
                    outputSelection: {
                        '*': {
                            '*': ['*']
                        }
                    }
                }
            };
            var output = JSON.parse(solc.compile(JSON.stringify(input)));
            res.set({
                "Content-Type": "application/json",
                "Access-Control-Allow-Origin": "*"
            });
            res.send(output);
        });
    });
});

app.listen(3000);