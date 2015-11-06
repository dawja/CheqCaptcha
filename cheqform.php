<?php

######################## Start a Session ###########################
session_start();
session_name('validate');
ini_set('session.use_cookies', 0);// Don't use cookies.




####################### Begin HTML Documant #########################

echo '<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
<title>::: Cheq :::</title>

<style>
body {
	background-color: #333333;
	color: #fff;
	}

	fieldset {
		   display: block;
		   margin-left: 2px;
		   margin-right: 2px;
		   padding-top: 0.35em;
		   padding-bottom: 0.625em;
		padding-left: 0.75em;
		padding-right: 0.75em;
		border: 2px groove (internal value);
		width: 275px;
		align: center;
		}
</style>
<script type="text/javascript">
function formatText(tag) {
var Field = document.getElementById(\'mytextarea\');
var val = Field.value;
var selected_txt = val.substring(Field.selectionStart, Field.selectionEnd);
var before_txt = val.substring(0, Field.selectionStart);
var after_txt = val.substring(Field.selectionEnd, val.length);
Field.value += tag;
}

</script>



</head>
<body>';




########################## Make the Form variable ###############################


$form='
<fieldset class="field"><form action="' .  $_SERVER['PHP_SELF'] . '" method="post" >
<table>
  <tr>
    <td>Security code:

       
    </td>
    <td>
    </td>
  </tr>
  <tr>
  <td>
	<!-- <textarea id="mytextarea" name="input" rows="1"></textarea> -->
		<input type="text" id="mytextarea" name="input" />
		</td>
		<td>
		<input class="formButton" type="submit" name="submitBtn" value="Send" />
		</td>
          </tr>
        </table>
      </form></fieldset></fieldset>';




########################## Make the image links  variable ###############################
$pieces=array('<a href="#" onclick="formatText(\'0\');"><img src="./img/cheq/king.png" /></a>','<a href="#" onclick="formatText(\'1\');"><img src="./img/cheq/queen.png" /></a>','<a href="#" onclick="formatText(\'2\');"><img src="./img/cheq/rook.png" /></a>','<a href="#" onclick="formatText(\'3\');"><img src="./img/cheq/bishop.png" /></a>','<a href="#" onclick="formatText(\'4\');"><img src="./img/cheq/Knight.png" /></a>','<a href="#" onclick="formatText(\'5\');"><img src="./img/cheq/pawn.png" /></a>'); // an array with the images as onclick events that input into the text area




if (!isset($_POST["submitBtn"]))  { //check to see if form has not been submitted then make the images array
                

	for ($n=0; $n<5; $n++){
		$Numb_Rand=rand(0, count($pieces)-1);
		if(!isset($pics))	{
			$pics=$pieces[$Numb_Rand];
			$picNumb=$Numb_Rand;
		} else {
			$pics.=$pieces[$Numb_Rand];
			$picNumb.=$Numb_Rand;
		}
		
	} // loop thru 5 times to randomize the images and create a numb code corosponding to the images

	// create a session value corosponding with the numbers generated in the loop
	$_SESSION["validate"]=$picNumb;
		echo '<div align="center"><fieldset class="field">';
		echo $pics;
		echo $form;
	} elseif (isset($_POST['submitBtn']) && empty($_POST['input'])) {//check if field is empty
		echo '<font class="err">1:Sorry the security code is empty! Please fill it in</font>';
		echo 'two;';
	//print the dynamic pics and the form
		echo '<div align="center"><fieldset class="field">';
		echo $pics;
		echo $form;
		$result = false;	//	$_SESSION["validate"]=$_POST['input'];        

	} elseif (isset($_POST['submitBtn']) && isset($_POST['input']) && $_POST['input'] == $_SESSION['validate']) {//check if form submitted, input set and equal to session created
		echo 'cheq mate friend!';
		//end the session
		session_unset();
		session_destroy();
	} elseif ($_SESSION["validate"] !== $_POST['input']) {// if session does not equal input
			//Its bad.
		echo '<div align="center"><font class="err">2:Sorry the security code is invalid! Please try it again!</font>';
		echo 'Session:';
			
			for ($n=0; $n<5; $n++){
				$Numb_Rand=rand(0, count($pieces)-1);
				if(!isset($pics))	{
					$pics=$pieces[$Numb_Rand];
					$picNumb=$Numb_Rand;
				} else {
					$pics.=$pieces[$Numb_Rand];
					$picNumb.=$Numb_Rand;
				}
			} // loop thru 5 times to randomize the images and create a numb code corosponding to the images
			$_SESSION["validate"]=$picNumb;
		//print the dynamic pics and the form
			echo '<div align="center"><fieldset class="field">';
			echo $pics;
			echo $form;

	} else {
	
			for ($n=0; $n<5; $n++){
				$Numb_Rand=rand(0, count($pieces)-1);
				if(!isset($pics))	{
					$pics=$pieces[$Numb_Rand];
					$picNumb=$Numb_Rand;
				} else {
					$pics.=$pieces[$Numb_Rand];
					$picNumb.=$Numb_Rand;
				}
			} // loop thru 5 times to randomize the images and create a numb code corosponding to the images
			$_SESSION["validate"]=$picNumb;
			
			//print the dynamic pics and the form
			echo '<div align="center"><fieldset>';
			echo $pics;
			echo $form;
	}
	
 

########################### Finish the HTML ################################
 echo '</div></body>
</html>';
?>
