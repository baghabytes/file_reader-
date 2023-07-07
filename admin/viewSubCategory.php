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
    $row = $result->fetch_assoc();


    $catname = $row['name'];

    echo '
    <div style="text-align:right;">
    <a class="btn-primary" href="insertchildcategory.php?cat_id='.$id.'" style="padding:4px 7px;text-align:right !important;border-radius:3px;">Insert child category</a>
    </div>
    <br/>
    ';
    $sql = "SELECT * FROM sub_sub_category WHERE sub_cat_id =".$id;
    
    $result = mysqli_query($conn, $sql);

    if (!mysqli_num_rows($result) > 0) {
    
        echo '

        <div class="card">
 
        <div class="card-body"> 
        <h5 >'.$catname.'</h5>


        
        <form method="post" action="handlefile.php" enctype="multipart/form-data">
    <input type="hidden" value="level2" name="level"/>
<input type="hidden" value="'.$id.'" name="id"/>
<div class="form-group">
<label for="folder">Select a folder  **.zip:</label>
    <input class="form-control col-md-6" type="file" id="folder" name="folder" >
</div>
<button  class="btn btn-primary" type="submit">Submit</button>
</form>
</div>
</div>
        ';
    
    }

    else {


        echo '
    
        <div class="card">
     
      <div class="card-body">
      <h5>'.$catname.'\'s child categories</h5>
        <table class="table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
        ';




    while ($row = $result->fetch_assoc()) {
        echo '<tr>
        <td>
        ' . $row['name'] . '
        </td>

        <td> 
        
        <a class="btn btn-primary" href="viewChildCategory.php?cat_id='.$row['id'].'">View</a>
        </td>
        </tr>';


    }

    echo '
    </tbody>
    </table>
  </div>
</div>
';
      
    }

}

?>
</div>