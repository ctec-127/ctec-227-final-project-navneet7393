<?php require_once './admin_includes/header.php';?>
<body>
        <?php require_once './admin_includes/nav.php';?>

        <?php
            //if user clicks on the add post button. 
            if (isset($_POST['btn_add_post'])) {
                $post_title = $_POST['post_title'];
                $post_cat_id = $_POST['cat_name'];
                $post_author = $_POST['post_author'];
                $post_status = $_POST['post_status'];

                $post_image = $_FILES['image']['name'];
                // temporary file location
                $post_temp = $_FILES['image']['tmp_name'];

                $post_tags = $_POST['post_tags'];
                $post_content = $_POST['post_content'];
                // date and format
                $post_date = date('d-m-y');
                $post_comment = 4;

                // echo "Hello";

                //insert the data from the form into the database
                // now() function is to get the current time
                $sql = "INSERT INTO posts (post_cat_id, post_title, post_author, post_date, post_img, post_content, post_tags, post_comment_count, post_status) VALUES ('$post_cat_id', '$post_title', '$post_author', now(), '$post_image','$post_content', '$post_tags', '$post_comment', '$post_status')";

                $result = mysqli_query($con, $sql);
                // echo $sql;

                // if it is sql entry was successful
                if ($result) {
                    echo "Record has been saved";
                    //upload file passing(temporary location, where you want to store)
                    move_uploaded_file($post_temp, "../imgs/$post_image");
                } else{
                    echo "Query Failed";
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
                            <input type="text" name="post_title" required placeholder="Post Title" class="form-control mb-2" id="post"><br>

                        <select name="cat_name" id="" class="form-control">

                        <?php
                            $sql = "SELECT * FROM categories";
                            $value = mysqli_query($con,$sql);

                            while($row = mysqli_fetch_assoc($value)){
                                $cat_id = $row['cat_id'];
                                $cat_title = $row['cat_title'];
                        ?>
                            <option value="<?php echo $cat_id; ?>"><?php echo $cat_title;?></option>
                        <?php
                            }
                        ?>
                        </select>
                        <label for="post_author">Post Author</label>
                            <input type="text" name="post_author" required placeholder="Post Author" class="form-control mb-2" id="post_author"><br>

                        <label for="post_status">Post Status</label>
                            <input type="text" name="post_status" required placeholder="Post Status" class="form-control mb-2" id="post_status"><br>

                        <label for="image">Image</label>
                            <input type="file" name="image" placeholder="Post Status" class="form-control mb-2" id="image"><br>

                        <label for="post_tags">Post Tags</label>
                            <input type="text" name="post_tags" required placeholder="Post Tags" class="form-control mb-2" id="post_tags"><br>

                        <label for="post_content">Post Content</label>
                            <textarea name="post_content" placeholder="Comments" required id="post_content" cols="30" rows="10" class="form-control" id="post_content"></textarea>
                            <br>
                            <button class="btn btn-success" type="submit" name="btn_add_post">Add Post</button>
                        </form>

                        </div>

                    </div>
                    <!-- /.row -->
                </div>
            <!-- /.container-fluid -->

          <?php require_once './admin_includes/footer.php';?>
