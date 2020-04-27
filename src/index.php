<!DOCTYPE html>
  <html style="--theme:dark;">
    <title>
      Transaction Analysis
    </title>
    <body>
      <div>
        <div>
          Deployed Contract
        </div>
        <div>
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
      </div>
    </body>
  </html>