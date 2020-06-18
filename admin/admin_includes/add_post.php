<?php require_once './admin_includes/header.php';?>
<?php require_once './admin_includes/nav.php';?>


<?php
    //if user clicks on the add post button. 
    if (isset($_POST['btn_add_post'])) {
        $title = $_POST['cat_name'];
        $cat_id = $_POST['post_cat_id'];
        $author = $_POST['post_author'];
        $status = $_POST['post_status'];

        $image = $_FILES['image']['name'];
        // temporary file location
        $temp = $_FILES['image']['tmp_name'];

        $tags = $_POST['post_tags'];
        $content = $_POST['post_content'];
        // date and format
        $date = date('d-m-y');
        $comment = 4;

        //insert the data from the form into the database
        // now() function is to get the current time
        $sql = "INSERT INTO posts (post_cat_id, post_title, post_author, post_date, post_img, post_content, post_tags,post_comment_count, post_status) VALUES ('$cat_id', '$title', '$author', now(), '$image','$content', '$tags', '$comment', '$status')";

        $result = mysqli_query($con, $sql);
        // echo $sql;

        // if it is sql entry was successful
        if ($result) {
            echo "Record has been saved";
            //upload file passing(temporary location, where you want to store)
            move_uploaded_file($temp,"../images/$image");
        } else{
            echo "Query Failed";
        }

        echo $sql;
    }
?>
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg">

                        <!-- Add new post table to add post -->
                        <form action="" method="POST" enctype="multipart/form-data">
                        <label for="post">Post Title</label>
                            <input type="text" name="post_title" placeholder="Post Title" class="form-control mb-2" id="post"><br>

                            <select name="cat_name" id="" class="form-control">
                            <?php
                                $sql = "SELECT * FROM categories";
                                $value = mysqli_query($con, $sql);

                                while($row = mysqli_fetch_assoc($value)){
                                    $cat_id = $row['cat_id'];
                                    $cat_title = $row['cat_title'];
                            ?>
                                <option value="<?php echo $cat_id;?>"><?php echo $cat_title;?></option>
                            <?php
                                }

                            ?>
                            </select><br>

                        <label for="post_author">Post Author</label>
                            <input type="text" name="post_author" placeholder="Post Author" class="form-control mb-2" id="post_author"><br>

                        <label for="post_status">Post Status</label>
                            <input type="text" name="post_status" placeholder="Post Status" class="form-control mb-2" id="post_status"><br>

                        <label for="image">Image</label>
                            <input type="file" name="image" placeholder="Post Status" class="form-control mb-2" id="image"><br>

                        <label for="post_tags">Post Tags</label>
                            <input type="text" name="post_tags" placeholder="Post Tags" class="form-control mb-2" id="post_tags"><br>

                        <label for="post_content">Post Content</label>
                            <textarea name="post_content" id="post_content" cols="30" rows="10" class="form-control" id="post_content"></textarea>
                            <br>
                            <button class="btn btn-success" type="submit" name="btn_add_post">Add Post</button>
                        </form>
                        <br>

                    </div>

                   </div>
                <!-- /.row -->



          <?php require_once './admin_includes/footer.php';?>
