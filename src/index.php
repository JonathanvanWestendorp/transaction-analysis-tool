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
          </div>
          <div>
            <input type="submit" value="Submit">
          </div>
      </form>
    </div>
    <div id="contractList"></div>
    <script>
      const contractForm = document.getElementById("contractForm");
      const contract = document.getElementById("contract");
      const contractList = document.getElementById("contractList"); 

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
                if (func.type == "function"){
                  var placeholder = []
                  for (const input of func.inputs) {
                    placeholder.push([input.internalType, input.name].join(' '));
                  }
                  var functionCall = document.createElement('form');
                  functionCall.setAttribute('ID', func.name);
                  var params = document.createElement('input');
                  params.setAttribute('type', 'text');
                  params.setAttribute('placeholder', placeholder.join(', '))
                  var button = document.createElement('input');
                  button.setAttribute('type', 'submit');
                  button.setAttribute('value', func.name);
                  functionCall.appendChild(button);
                  functionCall.appendChild(params);
                  contractDiv.appendChild(functionCall);
                }
              }
              contractList.appendChild(contractDiv)
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