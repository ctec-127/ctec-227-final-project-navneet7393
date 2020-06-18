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
                $id = $row['post_id'];
                $author = $row['post_author']; 
                $title = $row['post_title'];
                $cat_id = $row['post_cat_id'];
                $status = $row['post_status'];
                $img = $row['post_img'];
                $tags = $row['post_tags'];
                $content = $row['post_content'];
            }
        }


        // update Record
        if (isset($_POST['btn_edit_post'])) {
            $title = $_POST['post_title'];
            $cat_id = $_POST['cat_name'];
            $author = $_POST['post_author'];
            $status = $_POST['post_status'];
    
            $image = $_FILES['image']['name'];
            // temporary file location
            $temp = $_FILES['image']['tmp_name'];
    
            $tags = $_POST['post_tags'];
            $content = $_POST['post_content'];

            // if image is empty than do the following query or sql
            if (empty($image)) {
                $query = "SELECT * FROM posts WHERE post_id='$post_id'";
                $result = mysqli_query($con, $query);


                while ($row = mysqli_fetch_assoc($result)) {
                    $image = $row ['post_img'];

                }
            }

            // update the sql in the database for the edit post
            $sql = "UPDATE posts SET post_cat_id = '$cat_id', post_title = '$title', post_author = '$author', post_date = now(), post_img = '$image', post_content = '$content', post_status = '$status' WHERE post_id = '$post_id'";

            $result = mysqli_query($con, $sql);

            // if it was successfully updated 
            if ($result) {
                header("location: ./posts.php");
                move_uploaded_file($temp, "../images/$image");
            }
        }

        
    ?>

     <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg">

                        <!-- Add new post table to add post -->
                        <form action="" method="POST" enctype="multipart/form-data">
                        <label for="post">Post Title</label>
                            <input type="text" name="post_title" placeholder="Post Title" class="form-control mb-2" id="post" value="<?php echo $title; ?>"><br>
                        
                        <!-- <label for="post_cat_id">Post Category ID</label>
                            <input type="text" name="post_cat_id" placeholder="Post Category ID" class="form-control mb-2" id="post_cat_id" value="<?php echo $cat_id; ?>"><br> -->

                            <select name="cat_name" id="" class="form-control">
                                <?php 
                                    // get everything the data from the categories table
                                    $query = "SELECT * FROM categories";
                                    $data = mysqli_query($con, $query);

                                    while ($row = mysqli_fetch_assoc($data)) {
                                        $cat_id = $row['cat_id']
                                ?>
                                    <option value="<?php echo $row['cat_id']?>"><?php echo $row['cat_title'];?></option>
                                <?php
                                    }
                                ?>
                            </select>

                        <label for="post_author">Post Author</label>
                            <input type="text" name="post_author" placeholder="Post Author" class="form-control mb-2" id="post_author" value="<?php echo $author; ?>"><br>

                        <label for="post_status">Post Status</label>
                            <input type="text" name="post_status" placeholder="Post Status" class="form-control mb-2" id="post_status" value="<?php echo $status; ?>"><br>

                        <label for="image">Image</label>
                        <img class="img-responsive" width="150" height="120" src="../images/<?php echo $img;?>">
                            <input type="file" name="image" placeholder="Post Status" class="form-control mb-2" id="image" value="<?php echo $img; ?>"><br>

                        <label for="post_tags">Post Tags</label>
                            <input type="text" name="post_tags" placeholder="Post Tags" class="form-control mb-2" id="post_tags" value="<?php echo $tags; ?>"><br>

                        <label for="post_content">Post Content</label>
                            <textarea name="post_content" id="post_content" cols="30" rows="10" class="form-control" id="post_content" value=""><?php echo $content; ?></textarea>
                            <br>
                            <button class="btn btn-success" type="submit" name="btn_edit_post">Edit Post</button>
                        </form>
                        <br>

                    </div>

                   </div>
                <!-- /.row -->



          <?php require_once './admin_includes/footer.php';?>
