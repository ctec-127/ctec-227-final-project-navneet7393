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
                    <!-- Adding new Category -->
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
                        <form action="" method="POST">
                        <label for="category">Add New Category</label>
                            <input type="text" name="category" placeholder="Category" class="form-control mb-2">
                            <br>
                            <button class="btn btn-success" type="submit" name="btn_category">Add Category</button>
                        </form>
                    </div>
                    <div class="col-lg-6">
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
                                <td> <a href="categories.php?delete=<?php echo $row['cat_id'];?>" class="btn btn-danger"><span class="fa fa-trash"></span></a> </td>
                                <td> <a href="categories.php?update=<?php echo $row['cat_id'];?>" class="btn btn-edit"><span class="fa fa-edit"></span></a> </td>
                            </tr>
                            <?php
                            }

                            // Deleting the Category record
                            if (isset($_GET['delete'])) {
                                $delete = $_GET['delete'];
                                $sql = "DELETE FROM categories WHERE cat_id='delete'";
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
