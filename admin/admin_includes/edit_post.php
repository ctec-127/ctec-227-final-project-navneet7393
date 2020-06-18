        <?php require_once './admin_includes/header.php';?>
        <?php require_once './admin_includes/nav.php';?>

        <?php
        // if it is set to post id in the url 
        if (isset($_GET['p_id'])) {
            $post_id = $_GET['p_id'];
            // do the sql for post id
            $sql = "SELECT * FROM posts WHERE post_id = '$post_id'";
            // execute the query 
            $result = mysqli_query($con,$sql);

            // if the sql is successful than get data from database and assign to php variables
            while($row = mysqli_fetch_assoc($result)) {
                $post_id = $row['post_id'];
                $post_author = $row['post_author']; 
                $post_title = $row['post_title'];
                $post_cat_id = $row['post_cat_id'];
                $post_status = $row['post_status'];
                $post_img = $row['post_img'];
                $post_tags = $row['post_tags'];
                $post_content = $row['post_content'];
            }
        }

                // update Record
                if (isset($_POST['btn_edit_post'])) {
                    $post_title = $_POST['post_title'];
                    $post_cat_id = $_POST['cat_name'];
                    $post_author = $_POST['post_author'];
                    $post_status = $_POST['post_status'];
            
                    $post_image = $_FILES['image']['name'];
                    // temporary file location
                    $post_temp = $_FILES['image']['tmp_name'];
            
                    $post_tags = $_POST['post_tags'];
                    $post_content = $_POST['post_content'];
        
                    // if image is empty than do the following query or sql
                    if (empty($post_image)) {
                        $query = "SELECT * FROM posts WHERE post_id='$post_id'";
                        $result = mysqli_query($con, $query);
        
        
                        while ($row = mysqli_fetch_assoc($result)) {
                            $post_image = $row ['post_img'];
        
                        }
                    }
        
                    // update the sql in the database for the edit post
                    $sql = "UPDATE posts SET post_cat_id='$post_cat_id', post_title='$post_title', post_author='$post_author', post_date=now(), post_img='$post_image', post_content='$post_content', post_status='$post_status' WHERE post_id='$post_id'";
        
                    $result = mysqli_query($con, $sql);
        
                    // if it was successfully updated 
                    if ($result) {
                        header("location: ./posts.php");
                        move_uploaded_file($post_temp, "../imgs/$post_image");
                    }
                }

        ?>

            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                    <!-- Add new post table to add post -->
                        <form action="" method="POST" enctype="multipart/form-data">
                        <label for="post">Post Title</label>
                            <input type="text" name="post_title" required placeholder="Post Title" class="form-control mb-2" id="post" value="<?php echo $post_title ;?>"><br>

                            <select name="cat_name" id="" class="form-control">
                                <?php 
                                    // get everything the data from the categories table
                                    $query = "SELECT * FROM categories";
                                    $data = mysqli_query($con, $query);

                                    while ($row = mysqli_fetch_assoc($data)) {
                                        $cat_id = $row['cat_id']
                                ?>
                                    <option value="<?php echo $row['cat_id'];?>"><?php echo $row['cat_title'];?></option>
                                <?php
                                    }
                                ?>
                            </select>


                        <label for="post_author">Post Author</label>
                            <input type="text" name="post_author" required placeholder="Post Author" class="form-control mb-2" id="post_author" value="<?php echo $post_author ;?>"><br>

                        <label for="post_status">Post Status</label>
                            <input type="text" name="post_status" required placeholder="Post Status" class="form-control mb-2" id="post_status" value="<?php echo $post_status ;?>"><br>

                        <label for="image">Image</label>
                        <img class="img-responsive" width="150" height="120" src="../imgs/<?php echo $post_img;?>">
                            <input type="file" name="image" placeholder="Post Status" class="form-control mb-2" id="image"><br>

                        <label for="post_tags">Post Tags</label>
                            <input type="text" name="post_tags" required placeholder="Post Tags" class="form-control mb-2" id="post_tags" value="<?php echo $post_tags ;?>"><br>

                        <label for="post_content">Post Content</label>
                            <textarea name="post_content" placeholder="Comments" required id="post_content" cols="30" rows="10" class="form-control" id="post_content" value=""><?php echo $post_content ;?></textarea>
                            <br>
                            <button class="btn btn-success" type="submit" name="btn_edit_post">Edit Post</button>
                        </form>

                        </div>

                    </div>
                    <!-- /.row -->
                </div>
            <!-- /.container-fluid -->

          <?php require_once './admin_includes/footer.php';?>
