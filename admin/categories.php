
        <!-- Header -->
        <?php require_once "./admin_includes/header.php"; ?>
<body>

    <div id="wrapper">


        <div id="page-wrapper">

        <?php require_once "./admin_includes/nav.php"; ?>

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <small>Author</small>
                        </h1>
                    </div>


                    <!-- Add new category -->
                        <div class="col-lg-6">
                            <?php
                                    // Add New Category button clicked
                                    if (isset($_POST['btn_category'])) {
                                        if ($_POST['category'] == "") {
                                            echo "<p class='alert alert-danger'>Please Enter Category</p>";
                                        } else{
                                            $addCategory = $_POST['category'];
                                            $query = "INSERT INTO categories (cat_title) VALUES ('$addCategory')";
                                            mysqli_query($con, $query);
                                        }
                                    }
                            ?>
                            <form action="" method="POST">
                            <div class="form-group">
                                <label for="category">Add New Category</label>
                                <input type="text" name="category" placeholder="Category" class="form-control mb-2">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" type="submit" name="btn_category">Add Category</button>
                            </div>
                            </form>
                            
                            <!-- Editing the categories -->
                            <?php

                            //get the data to edit the id
                            if (isset($_GET['edit'])) {

                                $edit_id = $_GET['edit'];
                                $sql = "SELECT * FROM categories WHERE cat_id = '$edit_id'";
                                $result = mysqli_query($con,$sql);
                                $data = mysqli_fetch_assoc($result);
                            ?>
                            <form action="update.php" method="POST">
                            <div class="form-group">
                                <label for="category">Edit Category</label>
                                <input type="text" name="edit_category" value="<?php echo $data['cat_title'];?>" placeholder="Category" class="form-control mb-2">
                                <input type="hidden"  name="edit_id" value="<?php echo $data['cat_id'];?>">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" type="submit" name="btn_edit_category">Edit Category</button>
                            </div>
                            </form>
                            
                            <?php
                                   }                         
                            ?>





                        </div>

                        <div class="col-lg-6">
                            <!-- Building the table in the category section -->
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 20%">Category ID</th>
                                    <th style="width: 50%">Category Name</th>
                                    <th style="width: 30%" colspan="2">Operations</th>
                                </tr>
                                <tr>
                                <?php
                                    $sql = "SELECT * FROM categories";
                                    $result = mysqli_query($con,$sql);

                                    while ($row = mysqli_fetch_assoc($result)) {
                                        
                                ?>
                                    <td><?php echo $row['cat_id']; ?></td>
                                    <td><?php echo $row['cat_title']; ?></td>
                                    <!-- Delete -->
                                    <td><a href="categories.php?del=<?php echo $row['cat_id']; ?>" class="btn btn-danger"><span class="fa fa-trash"></span></a></td>
                                    <!-- Update -->
                                    <td><a href="categories.php?edit=<?php echo $row['cat_id']; ?>" class="btn btn-success"><span class="fa fa-edit"></span></a></td>

                                    <td></td>

                                </tr>
                                <?php
                            }
                                // Deleting the Category record
                                if (isset($_GET['del'])) {
                                    $del= $_GET['del'];
                                    $sql = "DELETE FROM categories WHERE cat_id='$del'";
                                    $result = mysqli_query($con,$sql);

                                    if ($result) {
                                        header("location: categories.php");
                                    }
                            }

                                ?>
                            </table>
                        </div>
                    </div>
                <!-- /.row -->
                </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

        <?php require_once "./admin_includes/footer.php"; ?>
