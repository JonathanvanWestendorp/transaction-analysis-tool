<!DOCTYPE html>

<html style="--theme:dark;">
  <head>
    <title>
      Transaction Analysis
    </title>
  </head>
  <body>
    <div class="fileInput">
      <form action="http://34.68.150.1:3000/compile" method="post">
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