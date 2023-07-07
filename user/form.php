<?php
include 'header.php';
?>
  <script src="script.js"></script>

<div class="container" style="margin-top:10%">
<section class="card-section " >

<div class="card col-md-11 card-div fade-in">
 
 <div class="card-body">
 <h6 class="mt-5 mb-4">Insert necessary details</h6>

<?php

$level =  $_GET['level'];
$id =  $_GET['cat_id'];

?>

<form action="" method="POST">

<div class="form-group ">
<textarea class="form-control col-md-6 mytext" name="anytext" id="anytext"></textarea>
</div>
<br/>
<input class="btn btn-success" type="submit" val="submit"/>

</form>

</div>
 </div>

</section>

<footer style="height:100px;">
</footer>
</div>

<?php
// if request is post insert in db and redirect to final to display files
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require_once '../config.php';
    $text = $_POST['anytext'];
    $sql = "INSERT INTO final (text,cat_id,level) VALUES (?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $text,$id,$level);
    $stmt->execute();
    echo 'Processing ......... ';

    header("Location: final.php?level=".$level."&cat_id=".$id);
    
    

    
}
?>