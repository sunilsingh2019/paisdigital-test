
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
                <div class="col-lg-12">
                    <table id="report-data" class="display report" cellspacing="0" width="100%">
                        <thead class="report__header">
                            <tr>
                                <th class="report__first-cell">ID</th>
                                <th>Question 1</th>
                                <th>Question 2</th>
                                <th>Question 3</th>
                                <th>Question 4</th>
                                <th>Question 5</th>
                                <th>Question 6</th>
                                <th>Question 7</th>
                                <th>Question 8</th>
                                <th>Question 9</th>
                                <th>Question 10</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>jobTitle</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Company</th>
                                <th>Date / Time</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        
                        $toaddsql="";
                        
                        $sql = "SELECT * FROM survey ".$toaddsql. " ORDER BY id DESC";
                        $result = mysqli_query($conn,$sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "
                                <tr>
                                    <td class=\"report__first-cell\">" . $row["id"]. "</td>
                                    <td>" . $row["question_1"]. "</td>
                                    <td>" . $row["question_2"]. "</td>
                                    <td>" . $row["question_3"]. "</td>
                                    <td>" . $row["question_4"]. "</td>
                                    <td>" . $row["question_5"]. "</td>
                                    <td>" . $row["question_6"]. "</td>
                                    <td>" . $row["question_7"]. "</td>
                                    <td>" . $row["question_8"]. "</td>
                                    <td>" . $row["question_9"]. "</td>
                                    <td>" . $row["question_10"]. "</td>
                                    <td>" . $row["firstname"]. "</td>
                                    <td>" . $row["lastname"]. "</td>
                                    <td>" . $row["jobtitle"]. "</td>
                                    <td>" . $row["email"]. "</td>
                                    <td>" . $row["phone"]. "</td>
                                    <td>" . $row["company"]. "</td>
                                    <td>" . $row["insert_date"]. "</td>
                                </tr>"; 
                            }
                        } else {
                            echo "
                                <tr>
                                    <td colspan=\"7\">No results at the moment.</td>
                                </tr>";
                        }
                        ?>
                        </tbody>
                        <tfoot class="report__footer">
                            <tr>
                                <th class="report__first-cell">ID</th>
                                <th>Question 1</th>
                                <th>Question 2</th>
                                <th>Question 3</th>
                                <th>Question 4</th>
                                <th>Question 5</th>
                                <th>Question 6</th>
                                <th>Question 7</th>
                                <th>Question 8</th>
                                <th>Question 9</th>
                                <th>Question 10</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>jobTitle</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Company</th>
                                <th>Date / Time</th>
                            </tr>
                        </tfoot>
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