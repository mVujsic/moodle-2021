<!DOCTYPE html>
<html>
<body>

<h1>Show Checkboxes</h1>

<form action="vehicle.php" method="POST">
  <input type="checkbox" id="vehicle1" name="vehicle[]" value="Bike">
  <label> I have a bike</label><br>
  <input type="checkbox" id="vehicle2" name="vehicle[]" value="Car">
  <label> I have a car</label><br>
  <input type="checkbox" id="vehicle3" name="vehicle[]" value="Boat">
  <label> I have a boat</label><br><br>
  <input type="submit" value="Submit">
</form>

<?php
var_dump("HI");
if(isset($_POST["vehicle"])){
	var_dump($_POST["vehicle"]);
}

?>
</body>
</html>
