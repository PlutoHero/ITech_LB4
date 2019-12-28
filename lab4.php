<head>
	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
	<style>
		textarea#idtext {
    		width: 1500px;
    		height: 750px;
			background-color: rgb(74, 74, 74);
			color: white;
		}
	</style>
</head>

<html>
	<body>
		<form action = "lab4.php" method="get">
			Input filename: <input id="test" type="text", name="filename" value="file1.txt"><br>
			<input type="radio", name="act" value="open"> Open <br>
			<input type="radio", name="act" value="save"> Save/Create <br>
			<input type="radio", name="act" value="close"> Close <br>
			<input type="submit">	<br><br>
			<textarea id="idtext" name="textb"></textarea>		
		</form>
	</body>
</html>

<?php

function changeText( $data ){
  echo '<script>';
  echo "$('#idtext').val(". json_encode( $data ) .")";
  echo '</script>';
}

$filename = @$_GET["filename"];
$act = @$_GET["act"];
$textb = @$_GET["textb"];

if($act !== null)
{	
	if(!strcmp($act, "open"))
	{	
		$file_h = @fopen($filename, "r");
		if(!$file_h)
			echo("file not exist");
		else
		{
			$text = file_get_contents($filename);
			changeText($text);
		}
	}
	
	if(!strcmp($act, "save"))
	{	
		$file_h = @fopen($filename, "w+");	
		fwrite($file_h, $textb);
	}
	
	if(!strcmp($act, "close"))
	{
		$file_h = @fopen($filename, "r");
		if($file_h)
			fclose($file_h);		
		else
			echo("file is already closed");
	}
}
?>