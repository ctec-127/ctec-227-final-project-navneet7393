<?php

require_once "./admin_includes/header.php";

// target the edit button in the category 
 if (isset($_POST['btn_edit_category'])) {
     // get the name value and assign it to a variable
     $up_id = $_POST['edit_id'];
     $up_cat = $_POST['edit_category'];

     echo "This is ID " . $up_id . "This Category " . $up_cat;

    // UPDATE sql and set title to whatever user enters
     $sql = "UPDATE categories SET cat_title='$up_cat' WHERE cat_id='$up_id'";
     // mysqli_query: This function is used to execute SQL command
     $result = mysqli_query($con, $sql);


     if($result){
         echo "<p class='alert alert-success'>Category Updated</p>";
         header ("location: categories.php");
     } else{
         echo "Query Failed";
     }


 }

?>
