
<?php 
include 'header.php';



?>
<div class="container">

<div class="card">
 <div class="card-body"> 
	<h5>Insert Category</h5>
<form action="" method = "POST">
		<label for="file">Category</label>
<div class="form-group">

		<input class="form-control col-md-6" type="text" id="name" name="name" required >
</div>
		<input class="btn btn-primary" type="submit" value="Add New Category">

</form>
</div>
</div>

</div>


<?php


require '../config.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
$name = $_POST['name'];
$sql = "INSERT INTO category (name) VALUES (?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $name);
$stmt->execute();
echo '
<script>

alert("Category added successfully")
</script>

';

}

?>