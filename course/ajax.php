<?php 
require_once "../config/PDOconfig.php" ;
function deleteItem($id){
	global $pdo;
	$current = 'DELETE FROM item
  WHERE itemId = ' . $id;

  if(isset($pdo)) $current.='\npdo is set';
  else $current.='\npdo is not set';

  $file = 'C:\wamp\www\moodle-2021\course\debug.txt';

	file_put_contents($file, $current);
	

  $stmt = $pdo->prepare('DELETE FROM item
  WHERE itemId = ' . $id);
  $stmt->execute();


}

if($_POST['action'] == 'deleteItem') {
	deleteItem($_POST['itemId']);
}

?>