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
    <script>
      const contractForm = document.getElementById("contractForm");
      const contract = document.getElementById("contract");

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
          console.log(data);
          Object.entries(data)[0].forEach(function(file) {
            console.log(file);	
            Object.entries(file).forEach(function(contract) {
              console.log(contract);	    
              contract.abi.forEach(function(func) {
                var btn = document.createElement("BUTTON");
                btn.innerHTML = func.name;
                document.body.appendChild(btn);

              })
            })
          })
        })
        .catch(function(error) {
          log('Request failed', error);
        });
      });
    </script>
  </body>
</html>