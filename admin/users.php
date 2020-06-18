<?php require_once './admin_includes/header.php';?>
<body>
    <div id="wrapper">
<?php require_once './admin_includes/nav.php';?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <small>Author</small>
                        </h1>


                        <?php 
                        // Get variable for the URL to add,view, delete posts
                            if (isset($_GET['opt'])) {
                                $opt = $_GET['opt'];
                            } else {
                                $opt = "";
                            } switch($opt){
                                case 'add_post':
                                    require_once "admin_includes/add_user_post.php";
                                break;
                                case 'edit_post':
                                    require_once "admin_includes/edit_users.php";
                                break;
                                default:
                                require_once "admin_includes/view_all_users.php";
                            break;
                            }
                        ?>
                    </div>

                   </div>
                <!-- /.row -->
                </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

          <?php require_once './admin_includes/footer.php';?>
