<!DOCTYPE html>

<html style="--theme:dark;">
  <title>
    Transaction Analysis
  </title>
  <head>
    <script type="text/javascript" src="contract.js"></script>
  </head>
  <body>
    <div class="fileInput">
      <form>
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
  </body>
</html>