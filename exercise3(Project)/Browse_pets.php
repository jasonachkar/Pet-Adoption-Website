<?php session_start(); 
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
$match=false;
$nopetfound=false;
if(file_exists('availablepetinformation.json'))
{
	$filename = 'availablepetinformation.json';
	$data = file_get_contents($filename); //data read from json file
	//print_r($data);
	$users = json_decode($data);  //decode a data

	//print_r($users); //array format data printing
	 $message = "<h3 class='text-success'>JSON file data</h3>";
}else{
	 $message = "<h3 class='text-danger'>JSON file Not found</h3>";
}
?>
<?php include 'header.php';
include 'navigation.php';?>
<!DOCTYPE html>
 <html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
  <title>Read a JSON File</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

      </head>
	  <body>
	   <div id="containerrr" style="height:auto;">
	   <div class="table-container">
	   <?php
			 if(isset($message))
			 {
				  //echo $message;

			 ?>
		<table id="tbstyle" style="height:90%;">
			<tbody>
				<?php foreach ($users as $user) { 
$match=($_SESSION['typeofpet1']==$user->typeofpet)&&($_SESSION['breedofpet1']==$user->breedofpet)&&($_SESSION['ageofpet1']==$user->ageofpet)&&($_SESSION['Gender1']==$user->gender)&&($_SESSION['friendly1']==$user->dog_friendly);
if($match){
$nopetfound=true;
?><table style="border:3px solid orange;display:inline-block;border-collapse:collapse;border-radius:10px;float:left;padding:10px;margin:10px;">
				<tr>
					<td><img src='<?= $user ->img_url;?>' alt='No Photo Was Provided' max-width="220px" height="auto"><br><br>
                    <b>Type: <?= $user->typeofpet; ?><br><br>
					Breed: <?= $user->breedofpet; ?><br><br>
					Age: <?= $user->ageofpet; ?> <br><br>
					Gender: <?= $user->gender; ?> <br><br>
					Friendly: <?= $user->dog_friendly; ?> </b><Br><br>
                <button value="Intrested" class="btn btn-warning">Interested</button>
                    </td>
				</tr>
            </table>
				<?php }
                }
			 }else{
				echo $message;
             }
if(!$nopetfound){
echo '<h3 class="text-danger" style="text-align:center;font-style:italic;"> <br><br><br><Br> No Pet Was Found. We are sorry for the inconvenience.<br> Please Check Back Later.<br></h3> ';
}			

			 ?>
    </tbody>
</table>
</div>
</div>
<?php include 'footer.php' ?>
</body>
</html>