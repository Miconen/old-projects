<body>
  <?php
  require ('../scripts/afterLoad.php');
  loadButtons();
  session_start();
  ?>
  <div class="navbar">
    <div class="content">
      <ul>
        <a href="scripts/logout.php">
          <li>Logout</li>
        </a>
          <a>
            <li onclick="saveData()">Save</li>
          </a>
        <a>
          <li onclick="loadData()">Load</li>
        </a>
      </ul>
    </div>
  </div>
  <div class="content">
	<p id="currencyValue">0</p>
	<div id="clickObject" onclick="incrementClick()">
		<button class="button-style">Click me!</button>
	</div>
	<div class="upgrades">
		<ul>
      <!-- Passive Upgrades -->
      <div class="width-50" id="upgrades-passive">
			<p>Passive upgrades</p>
      <?php
      for ($i=0; $i <= 9; $i++) {
        $upgrade_id = $i + 1;
        $upgrade_call = $upgrades[$i];
        echo
          '<li class="button-style" onclick=\'buyUpgrade("' . $upgrade_id . '", "passive")\' id="upgrade-passive-' . $upgrade_id . '">
    				<p class="cost" id="cost-passive-' . $upgrade_id . '">' . $upgrade_call['cost'] . '</p>
    				<p class="profit" id="profit-passive-' . $upgrade_id . '">' . $upgrade_call['profit'] . '</p>
    				<p class="amount" id="amount-passive-' . $upgrade_id . '">0</p>
  			  </li>';
      }
      ?>
      </div>
      <div class="width-50" id="upgrades-active">
      <!-- Active Upgrades -->
			<p>Active upgrades</p>
      <?php
      $ii = 10;
      for ($i=0; $i <= 9; $i++) {
        $upgrade_id = $i + 1;
        $upgrade_call = $upgrades[$ii];
        $ii ++;
        echo
          '<li class="button-style" onclick=\'buyUpgrade("' . $upgrade_id . '", "active")\' id="upgrade-active-' . $upgrade_id . '">
            <p class="cost" id="cost-active-' . $upgrade_id . '">'. $upgrade_call['cost'] .'</p>
    				<p class="profit" id="profit-active-' . $upgrade_id . '">'. $upgrade_call['profit'] .'</p>
    				<p class="amount" id="amount-active-' . $upgrade_id . '">0</p>
  			  </li>';
      }
      ?>
      </div>
      <div class="clear-both"></div>
		</ul>
	</div>
</div>
  <script src="scripts/app.js" charset="utf-8"></script>
  <script>
    window.onload = passiveTimer();
    <?php
    if (!isset($_SESSION['loginLoad'])) {
        echo "loadData();";
        $_SESSION['loginLoad'] = true;
    };
    ?>
  </script>
</body>
