//var solc = require('solc');

document.getElementById("contract").addEventListener("change", parseContract, false);

function parseContract() {
    console.log("File has arrived successfully");
    console.log(this.files[0]);
}