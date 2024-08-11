
<?php 
include "header.php";
?>
<body>
<div id="wrapper">
<?php 
    include "navigation.php";
    include "sidebar.php"; 
?>
 <!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="panel-body">
                    <form role="form" action="salesperson-validate.php" method="post" id="add-salesperson-form">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" required placeholder="Username/Email" name="username" type="email" autofocus data-rule-required="true" data-msg-required="Please enter  E-mail/Username" data-msg-email="Please enter a valid email address">
                            </div>
                            <div class="form-group">
                                <input class="form-control" required placeholder="Password" name="password" type="password" value="" data-rule-required="true" data-msg-required="Please enter your Password">
                            </div>
                            <div class="form-group">
                                <input class="form-control" required placeholder="First Name" name="firstname" type="text" value="" data-rule-required="true" data-msg-required="Please enter your first name">
                            </div>
                            <div class="form-group">
                                <input class="form-control" required  placeholder="Last Name" name="lastname" type="text" value="" data-rule-required="true" data-msg-required="Please enter your last name">
                            </div>
                            <div class="form-group">
                                <input class="form-control" required  placeholder="Mobile Phone Number" name="mobile" type="text" value="" data-rule-required="true" data-msg-required="Please enter your Mobile Phone Number">
                            </div>
                            <div class="form-group">
                                <input class="form-control" required  placeholder="Business / Somfy Expert / Who they work for ?" name="employer" type="text" value="" data-rule-required="true" data-msg-required="Please enter Business / Somfy Expert/ Who they work for ?">
                            </div>
                            <?php
                            if(isset($_REQUEST['invalid'])){
                                if($_REQUEST['invalid']==1) {
                            ?> 

                            <div class="form-group has-error">
                            <label class="control-label" for="inputError">Username OR Password is invalid</label>
                            </div>

                            <?php
                                }
                            }
                            if(isset($_SESSION['msg']) && $_SESSION['msg']!=""){ ?>
                                    <div class="form-group has-error">
                            <label class="control-label" for="inputError"><?php echo $_SESSION['msg']; ?></label>
                            </div>
                            <?php 
                            $_SESSION['msg']="";
                        }
                           
                               
                            ?> 

                            

                            
                                
                            <!-- Change this to a button or input when using this as a form -->
                            <button class="btn btn-lg btn-success btn-block background-yellow">Add Salesperson</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table id="report-data" class="display report" cellspacing="0" width="100%">
                    <thead class="report__header">
                        <tr>
                            <th class="report__first-cell">ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Employer</th>
                            <th>Last Login</th>
                            <th>Distribution Link</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot class="report__footer">
                        <tr>
                            <th class="report__first-cell">ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email/Username</th>
                            <th>Mobile number</th>
                            <th>Employer</th>
                            <th>Last Login</th>
                            <th>Unique Distribution Link</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php
                    if($_SESSION['user_level']!=1){
                        die('Invalid access');
                    }
                    $toaddsql=" where user_level!=1 ";
                    $sql = "SELECT * FROM users ".$toaddsql. " ORDER BY user_id DESC";
                    //var_dump($sql);
                    $result = mysqli_query($conn,$sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "
                            <tr>
                                <td class=\"report__first-cell\">" . $row["user_id"]. "</td>
                                <td>" . $row["firstname"]. "</td>
                                <td>" . $row["lastname"]. "</td>
                                <td>" . $row["username"]. "</td>
                                <td>" . $row["mobile"]. "</td>
                                <td>" . $row["employer"]. "</td>
                                <td>" . $row["user_last_login"]. "</td>
                                <td><a target='_blank' href=" . $row["salesperson_distribution_link"]. ">Link</td>";
                                if($row['user_status']=='1'){
                                echo "<td><a  class='confirm' href='deletesalesperson.php?user_id=".$row["user_id"]."'> Make Inactive</a></td>";
                                }
                                else{
                                    echo "<td></td>";
                                }
                            echo "</tr>"; 
                        }
                    } else {
                        echo "
                            <tr>
                                <td colspan=\"7\">No results at the moment.</td>
                            </tr>";
                    }
                    ?>
                        </tbody>
                    </table>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php 
	include "js-include.php";
?>