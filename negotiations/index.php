<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Переговорные</title>
</head>
<body>
<?php 
$people = $_POST['people'] ? $_POST['people']:"0";
$projector = $_POST['projector'] ? $_POST['projector']:"No";
$board = $_POST['board'] ? $_POST['board']:"No";
?>
<?php include 'choice.php' ?>
	<form action="index.php" method="post">
	<label>Люди</label>
	<input type="number" name="people" value= <?php echo "\"".$people."\""; ?>>
	<br>
	<label>Проектор</label>
	<select name="projector">
		<option  value="No" <?php if ('No' == $projector) { ?> selected <?php } ?> >No</option>
		<option  value="Yes" <?php if ('Yes' == $projector) { ?> selected <?php } ?> >Yes</option>
	</select>
	<br>
	<label>Маркерная доска</label>
	<select name="board">
		<option  value="No" <?php if ('No' == $board) { ?> selected <?php } ?> >No</option>
		<option  value="Yes" <?php if ('Yes' == $board) { ?> selected <?php } ?> >Yes</option>
	</select>
	<br>

	<input type="submit" name="" value="Подобрать">
	<input type="text" name="result" value=<?php echo "\"".choice($people, $projector, $board)."\""; ?>>
</form>
</body>
</html>

