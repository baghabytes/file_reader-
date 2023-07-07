

<?php
include 'header.php';
?>

<div class="container">
<section class="mainContent">

<h1 class="mainheading">File uploader that <span 
>cares</span><br/> for your users</h1>
<a id="start-typing" href="index.php#card-section"  class="btn btn-large btn-success">Get Started</a>

</section>

<section class="card-section " id="card-section" >

<div class="card col-md-11 card-div fade-in">
 
 <div class="card-body">
 <h5 class="mt-3">Select Category</h5>


 <?php

require_once '../config.php';

$sql = "SELECT * FROM category";
$result = mysqli_query($conn, $sql);

if (!mysqli_num_rows($result) > 0) {

    echo 'No Records found';
}
else{

    echo "<div class='row mt-5' style='text-align:center;align-items:center'>";
    while ($row = $result->fetch_assoc()) {
        echo '<a class="col-md-2 selectlinks " href="sub.php?cat_id='.$row['id'].'">' . $row['name'] . '</a>';

    }
    echo "</div>";
}
?>
 </div>
 </div>

</section>
  <script src="main.js"></script>

<footer style="height:100px;">
</footer>
</div>

