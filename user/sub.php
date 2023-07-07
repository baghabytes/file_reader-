
<?php
include 'header.php';
?>
  <script src="script.js"></script>

<div class="container" style="margin-top:10%">
<section class="card-section " >

<div class="card col-md-11 card-div fade-in">
 
 <div class="card-body">
 <h5 class="mt-3">Select Subcategory</h5>

<?php

if (isset($_GET['cat_id']))
{
    require_once '../config.php';
    $id = $_GET['cat_id'];

    $sql = "SELECT * FROM sub_category WHERE cat_id =".$id;

    $result = mysqli_query($conn, $sql);

    if (!mysqli_num_rows($result) > 0) {
        header("Location: form.php?level=level1&cat_id=".$id);
    }

    else {
        echo "<div class='row mt-5' style='text-align:center;align-items:center'>";
        while ($row = $result->fetch_assoc()) {
            echo '<a  class="col-md-2 selectlinks " href="child.php?cat_id='.$row['id'].'">' . $row['name'] . '</a>';

        }
        echo "</div>";
    }

}

?>
 </div>
 </div>

</section>

<footer style="height:100px;">
</footer>
</div>