const fs = require('fs')
const solc = require('solc');
const path = require('path');
const axios = require('axios');
const express = require('express');
const abi = require('web3-eth-abi');
const busboy = require('connect-busboy');
const app = express();
app.use(busboy());
app.use(express.urlencoded());

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

app.post('/execute', function (req, res) {
    const params = req.body.params.replace(/\s/g, '').split(",");
    const paramTypes = req.body.paramTypes;
    const functionName = req.body.functionName;
    const contractAddress = req.body.contractAddress;

    const FunctionSignature = functionName + "(" + paramTypes + ")";
    const encFunctionSignature = abi.encodeFunctionSignature(FunctionSignature);

    var encParameters
    if (params.length > 1) {
        encParameters = abi.encodeParameters(paramTypes.replace(/\s/g, '').split(","), params);
    } else {
        encParameters = abi.encodeParameter(paramTypes, params[0]);
    }
    
    const encodedCall = encFunctionSignature + encParameters;

    var rpcCall = {
        jsonrpc: "2.0",
        method: "eth_sendTransaction",
        id: 1,
        params: {
            to: contractAddress,
            data: encodedCall
        }
    };

    axios.post('localhost:5000', rpcCall).then(function (evmRes) {
        console.log(evmRes);
    })
    .catch(function (error) {
        console.error(error)
    });

});

app.listen(3000);