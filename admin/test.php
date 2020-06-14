                        <!-- Add new category table -->
                        <form action="update.php" method="POST">
                            <label for="category">Edit Category</label>
                                <!-- The value php will change on click -->
                                <input type="text" name="edit_category" value="<?php echo $data['cat_title'];?>" placeholder="Category" class="form-control mb-2">
                                
                                <input type="hidden"  name="edit_id"  name="edit_id" value="<?php echo $data['cat_id'];?>">
                                <br>
                                <button class="btn btn-success" type="submit" name="btn_edit_category">Edit Category</button>
                        </form>



<?php

                require_once "../includes/db.php"; 


                //if user clicks on the edit category button 
                if (isset($_POST['btn_edit_category'])) {
                    // get data from the name attribute and assign it to a php variable
                    $up_id = $_POST['edit_id'];
                    $up_cat = $_POST['edit_category'];

                    echo "This is ID ".$up_id. "This is category ".$up_cat;


                    // Update sql
                    $sql = "UPDATE categories SET cat_title='$up_cat' WHERE cat_id='$up_cat'";
                    $result = mysqli_query($con, $sql);

                    if ($result) {
                        echo "<p class='alert alert-success'>Category Updated</p>";
                        header('location:categories.php');
                    } else {
                        echo "Query Failed";
                    }
                    
                }

?>
