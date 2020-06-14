                         <!-- Create table &  show all posts from the database to the table-->
                         <table class="table table-stripped">
                        <tr>
                            <td>ID</td>
                            <td>Author</td>
                            <td>Title</td>
                            <td>Category</td>
                            <td>Status</td>
                            <td>Img</td>
                            <td>Comment</td>
                            <td>Date</td>
                            <td colspan="2">Operations</td>
                        </tr>
                        <tr>

                        <?php
                            $query = "SELECT * FROM posts";
                            $result = mysqli_query($con, $query);

                            while($row = mysqli_fetch_assoc($result)) {

                                $old = $row['post_img'];
                        ?>
                            <td><?php echo $row['post_id']; ?></td>
                            <td><?php echo $row['post_author']; ?></td>
                            <td><?php echo $row['post_title']; ?></td>
                            <td><?php echo $row['post_cat_id']; ?></td>
                            <td><?php echo $row['post_status']; ?></td>
                            <td><img class="img-responsive" width="50" height="50" src="../images/<?php echo $row['post_img'];?>"></td>
                            <td><?php echo $row['post_comment_count']?></td>
                            <td><?php echo $row['post_date']?></td>
                            <!-- Delete Button -->
                            <td><a href="posts.php?del=<?php echo $row['post_id']; ?>"><span class="btn btn-danger fa fa-trash"></span></a></td>
                            <!-- Edit button -->
                            <td><a href="posts.php?edit=<?php echo $row['post_id']; ?>"><span class="btn btn-success fa fa-edit"></span></a></td>

                        </tr>
                        <?php
                            }
                        ?>
                        </table>

                        <?php
                        // delete post logic
                            if (isset($_GET['del'])) {
                                $delete_id = $_GET['del'];
                                $sql = "DELETE FROM posts WHERE post_id='$delete_id'";
                                $result = mysqli_query($con, $sql);

                                if($result){
                                    unlink("../images/$old");
                                    header("location: posts.php");
                                }
                            }                        
                        ?>