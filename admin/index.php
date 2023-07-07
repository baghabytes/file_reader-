<?php 
include 'header.php';

?>
<div class="container">
<?php

    require_once '../config.php';

    $sql = "SELECT * FROM category";

    $result = mysqli_query($conn, $sql);

    if (!mysqli_num_rows($result) > 0) {
    
        echo '
        No records found
        ';
    
    }

    else {


    echo '
    
    <div class="card">
 
  <div class="card-body">
  <h5>Categories</h5>
    <table class="table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Date</th>
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

        <td>' . $row['date'] . '</td>
        <td> 
        
        <a class="btn btn-primary" href="viewCategory.php?cat_id='.$row['id'].'">View</a>
        </td></tr>';

    }


    echo '
    </tbody>
    </table>
  </div>
</div>
';
      
    }


?>

</div>



      
    