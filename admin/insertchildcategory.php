
<?php 
include 'header.php';



?>
<div class="container">

<?php

if (isset($_GET['cat_id']))
{
    require_once '../config.php';
    $id = $_GET['cat_id'];
    $sql = "SELECT * FROM sub_category WHERE id =".$id;
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $category_name = $row['name'];

        echo '
        <div class="container">

        <div class="card">
         <div class="card-body">  
         
         <h5>Insert Child category for '.$category_name.'</h5>
<form action="" method = "POST">
<div class="form-group"><label for="file">2nd level Sub Category</label>
<input  class="form-control col-md-6" type="text" id="name" name="name" required></div>
<input class="btn btn-primary" type="submit" value="Add New child Category">

</form>

</div>
</div>
        ';


    }

    else{
        echo 'Invalid Action';
        
    }



    
}
else{
    echo 'You are not allowed';
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'];
    $sql = "INSERT INTO sub_sub_category (name,sub_cat_id) VALUES (?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $name,$id);
    $stmt->execute();
    echo '<script>

    alert("Child category added successfully")
    </script>
    
    ';

}


?>
</div>