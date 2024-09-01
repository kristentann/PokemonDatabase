<html>

<head>
    <title>Pokemon Database</title>
    <style>
        .checkbox-group {
            display: none;
        }
    </style>
    <script>
        function showCheckboxes() {
            const selectedTable = document.querySelector('select[name="table"]').value;
            const groups = document.querySelectorAll('.checkbox-group');
			
			
			groups.forEach(group => {
                if (group.getAttribute('data-table') === selectedTable) {
                    group.style.display = 'block';
                } else {
                    group.style.display = 'none';
                }
            });
        }
    </script>
</head>


<body>
	<div class="menu">
		<nav class="nav">
			<img src="pokemon1.png" class="logo">
			<ul>
				<li><a href="Pokemon.php"> Data Management</a></li>
				<li><a href="Pokemon2.php"> Data Tools (Basics) </a></li>
				<li><a href="Pokemon3.php"> Data Tools (Advance) </a></li>
			</ul>
		</nav>

		<style>
			.nav {
				padding: 10px 0;
				display: flex;
				align-items: center;
				justify-content: space-between;
			}

			.logo {
				width: 140px;
				cursor: pointer;
			}

			.nav ul li {
				display: inline-block;
				list-style: none;
				margin: 10px 15px;
			}

			.nav ul li a {
				text-decoration: none;
				color: #ff0000;
				font-weight: 400;
				position: relative;
				padding: 10px;
			}

			.nav ul li a::before {
				content: '';
				width: 100%;
				height: 0px;
				background: #ffde00;
				position: absolute;
				z-index: -1;
				left: 0;
				bottom: -5px;
				border-bottom-left-radius: 8px;
				border-bottom-right-radius: 8px;
				transition: height 0.5s;
			}

			.nav ul li a:hover::before {
				height: 50px;
			}

		</style>
	</div>

	<h1> Data Management </h1>



	<h2>Reset</h2>
	<p>If you wish to reset the Pokemon Database press on the reset button. If this is the first time you're running this page, you MUST use reset</p>

	<form method="POST" action="Pokemon.php">
		<!-- "action" specifies the file or page that will receive the form data for processing. As with this example, it can be this same file. -->
		<input type="hidden" id="resetTablesRequest" name="resetTablesRequest">
		<p><input type="submit" value="Reset" name="reset"></p>
	</form>

	<hr />

	

	<h2>Insert New Pokemon Move</h2>
	<form method="POST" action="Pokemon.php">
		<input type="hidden" id="insertQueryRequest" name="insertQueryRequest">
		Move Name: <input type="text" name="insMoveName"> <br /><br />
		Damage: <input type="text" name="insDamage"> <br /><br />

		Accuracy: <input type="range" min="0" max="100" value="50" class="slider" id="dAcc" name= "insAcc"> <span id="acc"></span> <br /><br />
		<script>
		var slider = document.getElementById("dAcc");
		var output = document.getElementById("acc");
		output.innerHTML = slider.value;

		slider.oninput = function() {
  			output.innerHTML = this.value;
		}
		</script>

		Move Type:
		<select name="insMoveType">
			<option value="Bug">Bug</option>
			<option value="Dragon">Dragon</option>
			<option value="Electric">Electric</option>
			<option value="Fighting">Fighing</option>
			<option value="Fire">Fire</option>
			<option value="Flying">Flying</option>
			<option value="Grass">Grass</option>
			<option value="Ground">Ground</option>
			<option value="Normal">Normal</option>
			<option value="Poison">Poison</option>
			<option value="Psychic">Psychic</option>
			<option value="Rock">Rock</option>
			<option value="Steel">Steel</option>
			<option value="Water">Water</option>
		</select> <br /><br />


		Pokemon who can learn:
		<select name="insPokemon">
			<option value="Alakazam">Alakazam</option>
			<option value="Dragonite">Dragonite</option>
			<option value="Garchomp">Garchomp</option>
			<option value="Metagross">Metagross</option>
			<option value="Onix">Onix</option>
			<option value="Pidgey">Pidgey</option>
			<option value="Raichu">Raichu</option>
			<option value="Rattata">Rattata</option>
			<option value="Staryu">Staryu</option>
			<option value="Victreebel">Victreebel</option>
			<option value="Volcarona">Volcarona</option>
		</select> <br /><br />

		<input type="submit" value="Insert" name="insertSubmit"></p>
	</form>

	<hr />

	<h2>Update Moves</h2>
	<form method="POST" action="Pokemon.php">
	<input type="hidden" id="UpdateMove" name="UpdateMove">
		Move:
		<select name="UpdateMove">
			<?php
			global $db_conn;
			$db_conn = oci_connect("ora_hayden27", "a49928377", "dbhost.students.cs.ubc.ca:1522/stu");
			$MoveDynamicFetch = 'SELECT move_name FROM Move';
			$MoveDynamicResults = oci_parse($db_conn, $MoveDynamicFetch);
			oci_execute($MoveDynamicResults);
			
            while ($row = oci_fetch_assoc($MoveDynamicResults)) {
				echo '<option value="' . htmlspecialchars($row['MOVE_NAME'], ENT_QUOTES) . '">' . htmlspecialchars($row['MOVE_NAME'], ENT_QUOTES) . '</option>';
			}
			
            oci_free_statement($MoveDynamicResults);
            ?>
		</select><br /><br />

		Damage: <input type="text" name="UpdateDamage"> <br /><br />
		<input type="hidden" id="updateQueryRequest" name="updateQueryRequest">
		Move Name: <input type="text" name="oldMoveName"> <br /><br />
		Damage: <input type="text" name="newDamage"> <br /><br />

		Accuracy: <input type="range" min="0" max="100" value="50" class="slider" id="upAcc" name= "UpdateAcc"> <span id="uppacc"></span> <br /><br />
		
		<script>
		var slider2 = document.getElementById("upAcc");
		var output2 = document.getElementById("uppacc");
		output2.innerHTML = slider2.value;

		slider2.oninput = function() {
  			output2.innerHTML = this.value;
		}
		</script>

		Type:
		<select name="UpdateType">
			<?php
			global $db_conn;
			$db_conn = oci_connect("ora_hayden27", "a49928377", "dbhost.students.cs.ubc.ca:1522/stu");
			$TypeDynamicFetch = 'SELECT type_name FROM Move';
			$TypeDynamicResults = oci_parse($db_conn, $TypeDynamicFetch);
			oci_execute($TypeDynamicResults);
			
            while ($row = oci_fetch_assoc($TypeDynamicResults)) {
				echo '<option value="' . htmlspecialchars($row['TYPE_NAME'], ENT_QUOTES) . '">' . htmlspecialchars($row['TYPE_NAME'], ENT_QUOTES) . '</option>';
			}
			
            oci_free_statement($TypeDynamicResults);
            ?>
		</select><br /><br />

		<input type="submit" value="Update" name="updateUpdate"></p>
	</form>


	
	<hr />

	<h2>Delete Trainer</h2>
	<form method="POST" action="Pokemon.php">
	<input type="hidden" id="DeleteRequest" name="DeleteRequest">
Choose Trainer:
<select name="DeleteTrainer">
	<?php
	global $db_conn;
	$db_conn = oci_connect("ora_hayden27", "a49928377", "dbhost.students.cs.ubc.ca:1522/stu");
	$MoveDynamicFetch = 'SELECT title, trainer_name FROM Trainer_Info';
	$MoveDynamicResults = oci_parse($db_conn, $MoveDynamicFetch);
	oci_execute($MoveDynamicResults);
	
    while ($row = oci_fetch_assoc($MoveDynamicResults)) {
		echo '<option value="' . htmlspecialchars($row['TRAINER_NAME'], ENT_QUOTES) . '">' . htmlspecialchars($row['TITLE'], ENT_QUOTES) . ' - ' . htmlspecialchars($row['TRAINER_NAME'], ENT_QUOTES) . '</option>';
	}
	
    oci_free_statement($MoveDynamicResults);
    ?>
</select> <br /><br />

		<input type="submit" value="Delete" name="DeleteSubmit"></p>
	</form>

	<hr />

	<h2>Count the Tuples in the Move table!</h2>
	<form method="GET" action="Pokemon.php">
		<input type="hidden" id="countTupleRequest" name="countTupleRequest">
		<input type="submit" name="countTuples"></p>
	</form>

	<hr />

	<?php
	// The following code will be parsed as PHP

	function debugAlertMessage($message)
	{
		global $show_debug_alert_messages;

		if ($show_debug_alert_messages) {
			echo "<script type='text/javascript'>alert('" . $message . "');</script>";
		}
	}

	function executePlainSQL($cmdstr)
	{ //takes a plain (no bound variables) SQL command and executes it
		//echo "<br>running ".$cmdstr."<br>";
		global $db_conn, $success;

		$statement = oci_parse($db_conn, $cmdstr);
		//There are a set of comments at the end of the file that describe some of the OCI specific functions and how they work

		if (!$statement) {
			echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
			$e = OCI_Error($db_conn); // For oci_parse errors pass the connection handle
			echo htmlentities($e['message']);
			$success = False;
		}

		$r = oci_execute($statement, OCI_DEFAULT);
		if (!$r) {
			echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
			$e = oci_error($statement); // For oci_execute errors pass the statementhandle
			echo htmlentities($e['message']);
			$success = False;
		}

		return $statement;
	}

	function executeBoundSQL($cmdstr, $list)
	{
		/* Sometimes the same statement will be executed several times with different values for the variables involved in the query.
		In this case you don't need to create the statement several times. Bound variables cause a statement to only be
		parsed once and you can reuse the statement. This is also very useful in protecting against SQL injection.
		See the sample code below for how this function is used */

		global $db_conn, $success;
		$statement = oci_parse($db_conn, $cmdstr);

		if (!$statement) {
			echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
			$e = OCI_Error($db_conn);
			echo htmlentities($e['message']);
			$success = False;
		}

		foreach ($list as $tuple) {
			foreach ($tuple as $bind => $val) {
				//echo $val;
				//echo "<br>".$bind."<br>";
				oci_bind_by_name($statement, $bind, $val);
				unset($val); //make sure you do not remove this. Otherwise $val will remain in an array object wrapper which will not be recognized by Oracle as a proper datatype
			}

			$r = oci_execute($statement, OCI_DEFAULT);
			if (!$r) {
				echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
				$e = OCI_Error($statement); // For oci_execute errors, pass the statementhandle
				echo htmlentities($e['message']);
				echo "<br>";
				$success = False;
			}
		}
	}

	function printResult($result)
	{ //prints results from a select statement
		echo "<br>Retrieved data from table:<br>";
		echo "<table border='1'>";

		$firstRow = OCI_Fetch_Array($result, OCI_ASSOC);
		if ($firstRow === false) {
			echo '<p style="color: red; font-weight: bold;">No rows returned!</p>';
		} else {
			// Print the column headers dynamically
			$ncols = oci_num_fields($result);
			for ($i = 1; $i <= $ncols; $i++) {
				$colname = oci_field_name($result, $i);
				echo "<th>" . htmlentities($colname, ENT_QUOTES) . "</th>";
			}
			echo "</tr>";

			// Print the data rows dynamically
			// print first row to account for the no row check

			foreach ($firstRow as $item) {
				echo "<td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>";
			}
			echo "</tr>";


			while ($row = OCI_Fetch_Array($result, OCI_ASSOC)) {
				foreach ($row as $item) {
					echo "<td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>";
				}
				echo "</tr>";
			}
			echo "</table>";
		}

		
	}

	function connectToDB()
	{
		global $db_conn;
		global $config;

		// Your username is ora_(CWL_ID) and the password is a(student number). For example,
		// ora_platypus is the username and a12345678 is the password.
		// $db_conn = oci_connect("ora_cwl", "a12345678", "dbhost.students.cs.ubc.ca:1522/stu");
		$db_conn = oci_connect("ora_hayden27", "a49928377", "dbhost.students.cs.ubc.ca:1522/stu");

		if ($db_conn) {
			debugAlertMessage("Database is Connected");
			return true;
		} else {
			debugAlertMessage("Cannot connect to Database");
			$e = OCI_Error(); // For oci_connect errors pass no handle
			echo htmlentities($e['message']);
			return false;
		}
	}

	function disconnectFromDB()
	{
		global $db_conn;

		debugAlertMessage("Disconnect from Database");
		oci_close($db_conn);
	}

	function handleUpdateRequest()
	{
		global $db_conn;
		
		$UpdateMove = $_POST['UpdateMove'];
		$UpdateDamage = $_POST['UpdateDamage'];
		$UpdateAccuracy = $_POST['UpdateAcc'];
		$UpdateType = $_POST['UpdateType'];

		if (filter_var($_POST['UpdateDamage'], FILTER_VALIDATE_INT) === false) {
			echo '<p style="color: red; font-weight: bold;">The damage must be an integer!</p>';
		} else {
			// you need the wrap the old name and new name values with single 
			$sql = "UPDATE Move SET move_name ='" . $UpdateMove . "', damage='" . $UpdateDamage . "', accuracy='" . $UpdateAccuracy . "', type_name='" . $UpdateType . "' WHERE move_name='" . $UpdateMove . "'";
			executePlainSQL($sql);
			oci_commit($db_conn);
			echo "Update Complete!";
		}


	}

function handleResetRequest()
	{
		global $db_conn;

		$PokemonSQL = 'PokemonDatabase.sql';
		$SQLContents = file_get_contents($PokemonSQL);
		$SQLCommands = explode(';',$SQLContents);

		foreach($SQLCommands as $command) {
			if (trim($command)) {
				executePlainSQL($command);
			}
		}

		oci_commit($db_conn);
	}

	function handleInsertRequest()
	{
		global $db_conn;

		if (filter_var($_POST['insDamage'], FILTER_VALIDATE_INT) === false) {
			echo '<p style="color: red; font-weight: bold;">The damage must be an integer!</p>';
		} else if (empty($_POST['insMoveName'])) {
			echo '<p style="color: red; font-weight: bold;">Move Name can not be null!</p>';
		} else {
			//Getting the values from user and insert data into the table
			$moveinfo = array(
				":bind1" => $_POST['insMoveName'],
				":bind2" => $_POST['insAcc'],
				":bind3" => $_POST['insDamage'],
				":bind4" => $_POST['insMoveType']
			);

			$canlearn = array(
				":bind5" => $_POST['insMoveName'],
				":bind6" => $_POST['insPokemon']
			);

			$movetable = array(
				$moveinfo
			);

			$canlearntable = array(
				$canlearn
			);

			executeBoundSQL("INSERT INTO Move (move_name, accuracy, damage, type_name) VALUES (:bind1, :bind2, :bind3, :bind4)", $movetable);
			executeBoundSQL("INSERT INTO CanLearn (pokemon_name, move_name) VALUES (:bind6, :bind5)", $canlearntable);

			oci_commit($db_conn);

			echo "Insert Complete!";
		}

		
	}

	function handleDeleteRequest()
	{
		global $db_conn;
		
		$deltrainer = $_POST['DeleteTrainer'];
			$sql = "DELETE FROM Trainer_Info WHERE trainer_name ='" . $deltrainer . "'";
			echo $sql;
			executePlainSQL($sql);
			oci_commit($db_conn);
			echo "Update Complete!";
	

		
	}
	

	function handleCountRequest()
	{
		global $db_conn;

		$result = executePlainSQL("SELECT Count(*) FROM Move");

		if (($row = oci_fetch_row($result)) != false) {
			echo "<br> The number of tuples in Move: " . $row[0] . "<br>";
		}
	}

	function handleProjectionRequest() {
		global $db_conn;

		$table = $_GET['table'];

		$columns = isset($_GET['columns']) ? implode(", ", $_GET['columns']) : "*";
		
		$conditions = [];
		if (isset($_GET['filter_columns'])) {
			foreach ($_GET['filter_columns'] as $index => $column) {
			}
		}
		
		$sql = "SELECT $columns FROM $table";
		echo $sql ;

		$result = executePlainSQL($sql);
		printResult($result);
		
	}

	function handleSelectionRequest() {
		global $db_conn;

		// if ($GET['columns'] == NULL && $GET['filter_columns'] == NULL) {
		// 	echo "No columns or conditions selected. Please select at least one column or condition.";
		// 	return;
		// }


		$columns = isset($_GET['columns']) ? implode(", ", $_GET['columns']) : "*";
		
		$conditions = [];
		if (isset($_GET['filter_columns']) && isset($_GET['operators']) && isset($_GET['values'])) {
			foreach ($_GET['filter_columns'] as $index => $column) {
				$operator = $_GET['operators'][$index];
				$value = $_GET['values'][$index];
				$conditions[] = "$column $operator '$value'";
			}
		}
		
		if ($_GET['combine'] == "AND") {
			$filterClause = !empty($conditions) ? " WHERE " . implode(" AND ", $conditions) : "";
		} else {
			$filterClause = !empty($conditions) ? " WHERE " . implode(" OR ", $conditions) : "";
		}
		
		
		
			$sql = "SELECT $columns FROM Trainer_Info" . $filterClause;
			echo $sql ;

		
		if ($value == NULL) {
			// echo "error";
			$result = executePlainSQL("SELECT $columns FROM Trainer_Info");
			printResult($result);
		} else {
			$result = executePlainSQL($sql);
			printResult($result);
		}
		
	}

	
	function handleDivisionRequest() {
		global $db_conn;
	
		// Adjust the SQL query based on your schema
		$sql = "SELECT T.trainer_name
				FROM Trainer_Info T
				WHERE NOT EXISTS (
					SELECT G.game_name
					FROM Game G
					WHERE G.game_name = 'Pokemon Red' AND NOT EXISTS (
						SELECT C.trainer_name
						FROM Trainer_Origin C
						WHERE C.trainer_name = T.trainer_name
						  AND C.game_name = G.game_name
					)
				)";
	
		// Execute the query
		$result = executePlainSQL($sql);
		// Print the result
		printResult($result);
	}


	function joinTableRequest()
	{
		global $db_conn;

        $query = "SELECT Pokemon_Basic_Info.pokemon_name, Generation.generation_number, Generation.start_year, Generation.end_year
				  FROM Generation
				  RIGHT JOIN Pokemon_Basic_Info ON Generation.generation_number=Pokemon_Basic_Info.generation_number";

		$result = executePlainSQL($query);
		printResult($result);
	}
	

	function handleAggregationWithGroupByRequest() {
		global $db_conn;
		$GroupByOptions = $_POST['GroupByOptions'];

		switch ($GroupByOptions) {
			case 'Minimum':
				$result = executePlainSQL("Select Move.type_name as Type, min (damage) as Minimum_Damage
											From Move, Type
											Where damage IS NOT NULL
											Group by Move.type_name
											Order by min (damage) desc");
				printResult($result);
				break;
			
			case 'Maximum':
				$result = executePlainSQL("Select Move.type_name as Type, max (damage) as Maximum_Damage
										From Move, Type
										Where damage IS NOT NULL
										Group by Move.type_name
										Order by max (damage) desc");
				printResult($result);
				break;

			case 'Average':
				$result = executePlainSQL("Select Move.type_name as Type, avg (damage) as Average_Damage
											From Move, Type
											Where damage IS NOT NULL
											Group by Move.type_name
											Order by avg (damage) desc");
				printResult($result);
				break;

			case 'Amount of Moves':
				$result = executePlainSQL("Select Move.type_name as Type, count (distinct move_name) as Number_Of_Moves
											From Move, Type
											Group by Move.type_name
											Order by count (distinct move_name) desc");
				printResult($result);
				break;
		}


	}

	function handleAggregationWithHaving() {
		global $db_conn;
		$HavingAmount = $_POST['HavingAmount'];

		$query = "Select Move.type_name as Type, count(distinct move_name) as Amount_Of_Moves
					From Move, Type
					Group by Move.type_name
					Having count(distinct move_name) > " . $HavingAmount . " order by count(distinct move_name) desc";

		if (filter_var($HavingAmount, FILTER_VALIDATE_INT) === false) {
			echo '<p style="color: red; font-weight: bold;">This value is not an integer</p>';
		} else {
			$result = executePlainSQL($query);
			printResult($result);
		}
		
	}

	function handleNestedAggregation() {
		global $db_conn;
		$NestedOptions = $_POST['NestedOptions'];

		switch ($NestedOptions) {
			case 'Minimum':
				$result = executePlainSQL("Select Move.type_name, avg(Move.damage)
											From Move, Type
											Group by Move.type_name
											Having avg(Move.damage) >= (SELECT min(AVG(damage)) AS average_damage
																		FROM Move, Type
																		group by Move.type_name)
											order by avg(Move.damage) desc");
				printResult($result);
				break;
			
			case 'Maximum':
				$result = executePlainSQL("Select Move.type_name, avg(Move.damage)
											From Move, Type
											Group by Move.type_name
											Having avg(Move.damage) >= (SELECT max(AVG(damage)) AS average_damage
																		FROM Move, Type
																		group by Move.type_name)
											order by avg(Move.damage) desc");
				printResult($result);
				break;

			case 'Average':
				$result = executePlainSQL("Select Move.type_name, avg(Move.damage)
											From Move, Type
											Group by Move.type_name
											Having avg(Move.damage) >= (SELECT avg(AVG(damage)) AS average_damage
																		FROM Move, Type
																		group by Move.type_name)
											order by avg(Move.damage) desc");
				printResult($result);
				break;
		}
	}

	// HANDLE ALL POST ROUTES
	// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
	function handlePOSTRequest()
	{
		if (connectToDB()) {
			if (array_key_exists('resetTablesRequest', $_POST)) {
				handleResetRequest();
			} else if (array_key_exists('updateQueryRequest', $_POST)) {
				handleUpdateRequest();
			} else if (array_key_exists('insertQueryRequest', $_POST)) {
				handleInsertRequest();
			} else if (array_key_exists('AggregationWithGroupByRequest',$_POST)) {
				handleAggregationWithGroupByRequest();
			} else if (array_key_exists('AggregationWithHavingRequest',$_POST)) {
				handleAggregationWithHaving();
			} else if (array_key_exists('NestedAggregationRequest',$_POST)) {
				handleNestedAggregation();
			} else if (array_key_exists('division', $_POST)) {
				handleDivisionRequest();
			} else if (array_key_exists('', $_POST)) {
				handleUpdateRequest();
			} else if (array_key_exists('DeleteRequest',$_POST)) {
				handleDeleteRequest();
			}

			disconnectFromDB();
		}
	}

	// HANDLE ALL GET ROUTES
	// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
	function handleGETRequest()
	{
		if (connectToDB()) {
			if (array_key_exists('countTuples', $_GET)) {
				handleCountRequest();
			} elseif (array_key_exists('filterTuples', $_GET)) {
				handleSelectionRequest();
			} elseif (array_key_exists('displayTuples', $_GET)) {
				handleProjectionRequest();
			} 

			disconnectFromDB();
		}
	}

	if (isset($_POST['reset']) || isset($_POST['DeleteSubmit']) || isset($_POST['updateSubmit']) || isset($_POST['insertSubmit']) || isset($_POST['updateGroupBy']) || isset($_POST['division']) || isset($_POST['updateNestedAggregation']) || isset($_POST['updateHaving']) || isset($_POST['updateUpdate'])) {
		handlePOSTRequest();
	} else if (isset($_GET['countTupleRequest']) || isset($_GET['displayTuplesRequest']) || isset($_GET['filterTuplesRequest'])) {
		handleGETRequest();
	}

	// End PHP parsing and send the rest of the HTML content
	?>
</body>


</html>