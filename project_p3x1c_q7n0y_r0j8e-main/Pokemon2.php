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

    <h1> Data Tools (Basic) </h1>
	

	<h2>Reset</h2>
	<p>If you wish to reset the Pokemon Database press on the reset button. If this is the first time you're running this page, you MUST use reset</p>

	<form method="POST" action="Pokemon2.php">
		<!-- "action" specifies the file or page that will receive the form data for processing. As with this example, it can be this same file. -->
		<input type="hidden" id="resetTablesRequest" name="resetTablesRequest">
		<p><input type="submit" value="Reset" name="reset"></p>
	</form>

	<hr />

	<h2>General Table Display</h2>
	<form method="GET" action="Pokemon2.php">
		<input type="hidden" id="GeneralDisplayRequest" name="GeneralDisplayRequest">
		Table you want:
		<select name="GeneralTable">
			<option value="CanLearn">CanLearn</option>
			<option value="Game_Region">Game_Region</option>
			<option value="Trainer_Origin">Trainer_Origin</option>
			<option value="Categorised">Categorised</option>
			<option value="Uses">Uses</option>
			<option value="Gym_Leader">Gym_Leader</option>
			<option value="Champion">Champion</option>
			<option value="Trainer_Info">Trainer_Info</option>
			<option value="Title_Type">Title_Type</option>
			<option value="Pokemon_Colour">Pokemon_Colour</option>
			<option value="Pokemon_Basic_Info">Pokemon_Basic_Info</option>
			<option value="Move">Move</option>
			<option value="TypeStrength">TypeStrength</option>
			<option value="Game">Game</option>
			<option value="Generation">Generation</option>
			<option value="Habitat">Habitat</option>
			<option value="Type">Type</option>
		</select> <br /><br />
		<input type="submit" name="GeneralDisplayTables"></p>
	</form>

	<hr />

	<h2>Join the Pokemon Info and Generation Tables</h2>
	<form method="GET" action="Pokemon2.php">
		<input type="hidden" id="joinTablesRequest" name="joinTablesRequest">
		Join On Generation Number:
		<select name="joingen">
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
		<input type="submit" name="joinTables"></p>
	</form>

	<hr />

	<h2> Projection for Trainer Info, Uses, and Trainer Origin </h2>
	<form method="GET" action="Pokemon2.php">
		<input type="hidden" id="displayTuplesRequest" name="displayTuplesRequest">
		<label for="table"> Choose which Table to Project Information from: </label>
		<select name="table" onchange="showCheckboxes()">
			<option value="emptyTable">--Select Table--</option>
			<option value="Trainer_Info">Trainer_Info</option>
			<option value="Uses">Uses</option>
			<option value="Trainer_Origin">Trainer_Origin</option>
		</select> <br /><br />


	<h3> Project Columns </h3>
	<div data-table="Trainer_Info" class="checkbox-group">
		<h4> Trainer Info Columns </h4>
        <input type="checkbox" id="trainer_name" name="columns[]" value="trainer_name">
        <label for="trainer_name">Trainer Name</label><br>

        <input type="checkbox" id="title" name="columns[]" value="title">
        <label for="title">Title</label><br>

        <input type="checkbox" id="signature_pokemon_name" name="columns[]" value="signature_pokemon_name">
        <label for="signature_pokemon_name">Signature Pokemon Name</label><br>

        <input type="checkbox" id="signature_pokemon_shiny_status" name="columns[]" value="signature_pokemon_shiny_status">
        <label for="signature_pokemon_shiny_status">Signature Pokemon Shiny Status</label><br>
    </div>

	<div data-table="Uses" class="checkbox-group">
		<h4> Uses Columns </h4>
        <input type="checkbox" id="title" name="columns[]" value="title">
        <label for="title">Title</label><br>

        <input type="checkbox" id="trainer_name" name="columns[]" value="trainer_name">
        <label for="trainer_name">Trainer Name</label><br>

        <input type="checkbox" id="pokemon_name" name="columns[]" value="pokemon_name">
        <label for="pokemon_name">Pokemon Name</label><br>

        <input type="checkbox" id="shiny_status" name="columns[]" value="shiny_status">
        <label for="shiny_status">Shiny Status</label><br>
    </div>

	<div data-table="Trainer_Origin" class="checkbox-group">
		<h4> Trainer Origin Columns </h4>
        <input type="checkbox" id="title" name="columns[]" value="title">
        <label for="title">Title</label><br>

        <input type="checkbox" id="trainer_name" name="columns[]" value="trainer_name">
        <label for="trainer_name">Trainer Name</label><br>

        <input type="checkbox" id="game_name" name="columns[]" value="game_name">
        <label for="game_name">Game Name</label><br>
    </div>

	<br><br>
    <input type="submit" name="displayTuples" value="Display Tuples">
	</form>
	
	<hr />

	<h2>Selection for Trainer Info</h2>
	<form method="GET" action="Pokemon2.php">
	<input type="hidden" id="filterTuplesRequest" name="filterTuplesRequest">

	<h3>Select Columns</h3>
	<div>
        <input type="checkbox" id="trainer_name" name="columns[]" value="trainer_name">
        <label for="trainer_name">Trainer Name</label><br>

        <input type="checkbox" id="title" name="columns[]" value="title">
        <label for="title">Title</label><br>

        <input type="checkbox" id="signature_pokemon_name" name="columns[]" value="signature_pokemon_name">
        <label for="signature_pokemon_name">Signature Pokemon Name</label><br>

        <input type="checkbox" id="signature_pokemon_shiny_status" name="columns[]" value="signature_pokemon_shiny_status">
        <label for="signature_pokemon_shiny_status">Signature Pokemon Shiny Status</label><br>
    </div>


	
	<script>
        function addFilter() {
            const filterDiv = document.createElement('div');
            filterDiv.className = 'filter';
            filterDiv.innerHTML = `
                Attributes:
                <select name="filter_columns[]">
                    <option value="trainer_name">Trainer Name</option>
                    <option value="title">Title</option>
                    <option value="signature_pokemon_name">Signature Pokemon Name</option>
                    <option value="signature_pokemon_shiny_status">Signature Pokemon Shiny Status</option>
                </select>
                Operator:
                <select name="operators[]">
                    <option value="=">=</option>
                    <option value="<>"><> (not equal)</option>
                </select>
                Value: <input type="text" name="values[]">
                <button type="button" onclick="removeFilter(this)">Remove</button>
				Combine Conditions: 
				 <select name="combine">
        		<option value="AND">AND</option>
        		<option value="OR">OR</option>
   				</select>
            `;
            document.getElementById('filterConditions').appendChild(filterDiv);
        }

        function removeFilter(button) {
            button.parentElement.remove();
        }
    </script>
        
	<h3>Selection Conditions</h3>
    <div id="filterConditions">
        <div class="filter">
            Attributes:
            <select name="filter_columns[]">
                <option value="trainer_name">Trainer Name</option>
                <option value="title">Title</option>
                <option value="signature_pokemon_name">Signature Pokemon Name</option>
                <option value="signature_pokemon_shiny_status">Signature Pokemon Shiny Status</option>
            </select>
            Operator:
            <select name="operators[]">
                <option value="=">=</option>
                <option value="<>"><> (not equal)</option>
            </select>
            Value: <input type="text" name="values[]">
            <button type="button" onclick="addFilter()">Add Another Condition</button>
        </div>
    </div>

    <br><br>
    <input type="submit" name="filterTuples" value="Filter Tuples">
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
				echo "<td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : htmlentities("NA", ENT_QUOTES)) . "</td>";
			}
			echo "</tr>";


			while ($row = OCI_Fetch_Array($result, OCI_ASSOC)) {
				foreach ($row as $item) {
					echo "<td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : htmlentities("NA", ENT_QUOTES)) . "</td>";
				}
				echo "</tr>";
			}
			echo "</table>";
		}

		
	}

	function printMoves($result)
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
				echo "<td>" . ($item != 0 ? htmlentities($item, ENT_QUOTES) : htmlentities("NA", ENT_QUOTES)) . "</td>";
			}
			echo "</tr>";


			while ($row = OCI_Fetch_Array($result, OCI_ASSOC)) {
				foreach ($row as $item) {
					echo "<td>" . ($item != 0 ? htmlentities($item, ENT_QUOTES) : htmlentities("NA", ENT_QUOTES)) . "</td>";
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

		// you need the wrap the old name and new name values with single 
		$sql = "UPDATE Move SET move_name ='" . $UpdateMove . "', damage='" . $UpdateDamage . "', accuracy='" . $UpdateAccuracy . "', type_name='" . $UpdateType . "' WHERE move_name='" . $UpdateMove . "'";
		executePlainSQL($sql);
		oci_commit($db_conn);
		echo "Update Complete!";
	}

function handleResetRequest()
	{
		global $db_conn;
		/*// Drop old table
		executePlainSQL("DROP TABLE Database");
		// Create new table
		echo "<br> creating new table <br>";
		executePlainSQL("CREATE TABLE Database (shiny_status varchar(30), name varchar(30), PRIMARY KEY(shiny_status, name))");*/

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
		//echo $sql ;


		if ($table === "emptyTable") {
			echo '<p style="color: red; font-weight: bold;">No Table Chosen!</p>';;
		} else {
			$result = executePlainSQL($sql);
			printResult($result);
		}		
	}

	function handleSelectionRequest() {
		global $db_conn;

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
			//echo $sql ;

		
		if ($value == NULL) {
			// echo "error";
			$result = executePlainSQL("SELECT $columns FROM Trainer_Info");
			printResult($result);
		} else if ($_GET['filter_columns'][0] === "signature_pokemon_shiny_status" && filter_var($_GET['values'][0], FILTER_VALIDATE_INT) === false) {
			echo '<p style="color: red; font-weight: bold;">Filter value for shiny status is not an integer</p>';
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

		$gennum = $_GET['joingen'];

        $query = "SELECT Pokemon_Basic_Info.pokemon_name, Generation.generation_number, Generation.start_year, Generation.end_year
				  FROM Generation
				  RIGHT JOIN Pokemon_Basic_Info ON Generation.generation_number=Pokemon_Basic_Info.generation_number
				  WHERE Generation.generation_number ='" . $gennum . "' ";
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

	function handleGeneralDisplayRequest() {
		global $db_conn;

		$TableWanted = $_GET['GeneralTable'];

		$TableQuery = "select * from " . $TableWanted;

		$result = executePlainSQL($TableQuery);
		
		if ($TableWanted === "Move") {
			printMoves($result);
		} else {
			printResult($result);
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
			} elseif (array_key_exists('GeneralDisplayTables', $_GET)) {
				handleGeneralDisplayRequest();
			} elseif (array_key_exists('joinTablesRequest', $_GET)) {
				joinTableRequest();
			} 

			disconnectFromDB();
		}
	}

	if (isset($_POST['reset']) || isset($_POST['updateSubmit']) || isset($_POST['insertSubmit']) || isset($_POST['updateGroupBy']) || isset($_POST['division']) || isset($_POST['updateNestedAggregation']) || isset($_POST['updateHaving'])) {
		handlePOSTRequest();
	} else if (isset($_GET['countTupleRequest']) || isset($_GET['joinTablesRequest']) || isset($_GET['filterTuplesRequest']) || isset($_GET['GeneralDisplayRequest'])) {
		handleGETRequest();
	}



	

	// End PHP parsing and send the rest of the HTML content
	?>
</body>


</html>