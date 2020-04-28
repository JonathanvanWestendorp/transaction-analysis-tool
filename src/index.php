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
    <div class="callableFunctions">
      <?php
        for ($x = 0; $x <= 10; $x++) {
          echo "
          <div>
            <button class='command 1'>
              register
            </button>
            <input placeholder='parameters 1'>
          </div>
          ";
        }
      ?>
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
          mode: 'no-cors',
          body: formData
        }).then(function(response) {
          return response.text();
        }).then(function(text) {
          console.log('Request successful', text);
        }).catch(function(error) {
          log('Request failed', error)
        });
      });
    </script>
  </body>
</html>