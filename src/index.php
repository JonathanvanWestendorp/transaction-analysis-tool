<!DOCTYPE html>

<html style="--theme:dark;">
  <head>
    <title>
      Transaction Analysis
    </title>
  </head>
  <body>
    <div class="fileInput">
      <form class="form" id="contractForm">
          <div>
            <input type="file" id="contract">
            <input type="text" id="contractAddress" placeholder="Contract Address">
          </div>
          <div>
            <input type="submit" value="Submit">
          </div>
      </form>
    </div>
    <div id="contractList"></div>
    <script>
      const contract = document.getElementById("contract");
      const contractForm = document.getElementById("contractForm");
      const contractList = document.getElementById("contractList");
      const address = document.getElementById("contractAddress").value;

      contractForm.addEventListener("submit", e => {
        e.preventDefault();

        const endpoint = window.location.href.replace(/\/$/, "") + ":3000/compile";
        const formData = new FormData();

        formData.append("contract", contract.files[0]);

        fetch(endpoint, {
          method: 'POST',
          body: formData
        })
        .then(function(response) {
          return response.json();
        })
        .then(function(data) {
          for (const file of Object.keys(data.contracts)) {
            for(const contract of Object.keys(data.contracts[file])) {
              var contractDiv = document.createElement("div");
              var contractTitle = document.createElement("H1");
              var contractTitleText = document.createTextNode(contract);
              contractTitle.appendChild(contractTitleText);
              contractDiv.appendChild(contractTitle);
              for (const func of data.contracts[file][contract]["abi"]) {
                if (func.type == "function") {
                  var placeholder = []
                  for (const input of func.inputs) {
                    placeholder.push([input.internalType, input.name].join(' '));
                  }
                  var functionCall = document.createElement('form');
                  functionCall.setAttribute('ID', func.name);
                  functionCall.setAttribute('action', "execute.php");
                  functionCall.setAttribute('method', "post");
                  var params = document.createElement('input');
                  params.setAttribute('type', 'text');
                  params.setAttribute('name', 'params');
                  params.setAttribute('placeholder', placeholder.join(', '));
                  var contractAddress = document.createElement('input');
                  contractAddress.setAttribute('type', 'hidden');
                  contractAddress.setAttribute('name', 'contractAddress');
                  contractAddress.setAttribute('value', address);
                  var button = document.createElement('input');
                  button.setAttribute('type', 'submit');
                  button.setAttribute('name', 'functionName')
                  button.setAttribute('value', func.name);
                  functionCall.appendChild(params);
                  functionCall.appendChild(contractAddress);
                  functionCall.appendChild(button);
                  contractDiv.appendChild(functionCall);
                }
              }
              contractList.appendChild(contractDiv);
            }
          }
        })
        .catch(function(error) {
          console.log('Request failed', error);
        });
      });
    </script>
  </body>
</html>