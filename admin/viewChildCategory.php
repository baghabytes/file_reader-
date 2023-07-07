<?php 
include 'header.php';

?>
<div class="container">
<?php
require_once '../config.php';

$id = $_GET['cat_id'];

$sql = "SELECT * FROM sub_sub_category WHERE id =".$id;
 $result = mysqli_query($conn, $sql);
 $row = $result->fetch_assoc();
 $catname = $row['name'];

echo '

<div class="card">
 
<div class="card-body"> 
<h5 >'.$catname.'</h5>


<form method="post" action="handlefile.php"  enctype="multipart/form-data">
    
<input type="hidden" value="'.$id.'" name="id"/>
<input type="hidden" value="level3" name="level"/>
<div class="form-group">
<label for="folder">Select a folder  **.zip:</label>
    <input class="form-control col-md-6" type="file" id="folder" name="folder" >
    </div><button  class="btn btn-primary"  type="submit">Submit</button>
</form>

</div>
</div>
       ';

?>

</div>