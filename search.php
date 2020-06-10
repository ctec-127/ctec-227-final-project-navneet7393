<!-- Header -->
<?php require_once "includes/header.php"; ?>

<?php require_once "includes/db.php"; ?>

    <!-- Navigation -->
<?php require_once "includes/nav.php"; ?>

<?php $con = mysqli_connect("localhost", "root", "" , "cms"); ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            
            <!-- Blog Entries Column -->
            <div class="col-md-8">
            <?php

                if (isset($_POST['btn_search'])) {
                    $search = $_POST['search'];
                    $sql = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
                    $result = mysqli_query($con, $sql);
                    
                
                if (mysqli_num_rows($result)) {
                    // assign variables from the database to display
                        while ($row = mysqli_fetch_assoc($result)) {
                            $post_title = $row['post_title'];
                            $post_author = $row['post_author'];
                            $post_date = $row['post_date'];
                            $post_image = $row['post_img'];
                            $post_content = $row['post_content'];
                            $post_tags = $row['post_tags'];
                            
            ?>
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author;?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src= "images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

            
            <?php
             }
            }
            else
            {
                echo "<h2>Record Not Found Pleas try Again</h2>";
            }
        }
             ?>

                </div>
            <?php require_once "includes/side_bar.php"; ?>
            <!-- Blog Sidebar Widgets Column -->

                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>

            </div>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php require_once "includes/footer.php"; ?>
    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
