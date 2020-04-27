var solc = require('solc');

function parseContract() {
    const contract = document.getElementById("contract");
    if (contract) {
        fileReader = new FileReader();
        fileReader.readAsText(contract.files[0]);
        fileReader.onload = function() {
            console.log(read.result);
        }
    }   
}