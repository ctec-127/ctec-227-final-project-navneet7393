<?php require_once './includes/header.php';?>
<body>
    <div id="wrapper">
<?php require_once './includes/nav.php';?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <small>Author</small>
                        </h1>
                    </div>
                    <!-- Adding new Category.-->
                    <div class="col-lg-6">
                        <?php
                        // Add New Category button
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
                        <!-- Add new category table -->
                        <form action="" method="POST">
                        <label for="category">Add New Category</label>
                            <input type="text" name="category" placeholder="Category" class="form-control mb-2">
                            <br>
                            <button class="btn btn-success" type="submit" name="btn_category">Add Category</button>
                        </form>
                        <br>
                        <!-- Editing the categories -->
                        <?php
                            if (isset($_GET['edit'])) {
                                $edit_id = $_GET['edit'];
                                // get record and assign to sql variable
                                $sql = "SELECT * FROM categories WHERE cat_id = '$edit_id'";
                                $result = mysqli_query($con, $sql);
                                $data = mysqli_fetch_assoc($result);
                        ?>
                        <!-- Add new category table -->
                        <form action="" method="POST">
                            <label for="category">Edit Category</label>
                                <!-- The value php will change on click -->
                                <input type="text" name="edit_category" value="<?php echo $data['cat_title'];?>" placeholder="Category" class="form-control mb-2">
                                <br>
                                <button class="btn btn-success" type="submit" name="btn_edit_category">Edit Category</button>
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
                                $result = mysqli_query($con, $sql);

                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>


                                <td> <?php echo $row['cat_id']; ?> </td>
                                <td> <?php echo $row['cat_title']; ?> </td>
                                <!-- Delete -->
                                <td> <a href="categories.php?delete=<?php echo $row['cat_id'];?>" class="btn btn-danger"><span class="fa fa-trash"></span></a> </td>
                                <!-- Update -->
                                <td> <a href="categories.php?edit=<?php echo $row['cat_id'];?>" class="btn btn-success"><span class="fa fa-edit"></span></a> </td>
                            </tr>
                            <?php
                            }

                            // Deleting the Category record
                            if (isset($_GET['delete'])) {
                                $delete = $_GET['delete'];
                                $sql = "DELETE FROM categories WHERE cat_id='$delete'";
                                $result = mysqli_query($con,$sql);

                                if ($result) {
                                    header('location:categories.php');
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

          <?php require_once './includes/footer.php';?>
