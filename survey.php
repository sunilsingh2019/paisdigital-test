<?php 

require("config.php");
//check for isset and post data here and create a selection array
$question_1 = (isset($_POST['question_1']) && ($_POST['question_1'] != "NULL")) ? $_POST['question_1'] : "";
$question_2 = (isset($_POST['question_2']) && ($_POST['question_2'] != "NULL")) ? $_POST['question_2'] : "";
$question_3 = (isset($_POST['question_3']) && ($_POST['question_3'] != "NULL")) ? $_POST['question_3'] : "";
$question_4 = (isset($_POST['question_4']) && ($_POST['question_4'] != "NULL")) ? $_POST['question_4'] : "";
$question_5 = (isset($_POST['question_5']) && ($_POST['question_5'] != "NULL")) ? $_POST['question_5'] : "";
$question_6 = (isset($_POST['question_6']) && ($_POST['question_6'] != "NULL")) ? $_POST['question_6'] : "";
$question_7 = (isset($_POST['question_7']) && ($_POST['question_7'] != "NULL")) ? $_POST['question_7'] : "";
$question_8 = (isset($_POST['question_8']) && ($_POST['question_8'] != "NULL")) ? $_POST['question_8'] : "";
$question_9 = (isset($_POST['question_9']) && ($_POST['question_9'] != "NULL")) ? $_POST['question_9'] : "";
$question_10 = (isset($_POST['question_10']) && ($_POST['question_10'] != "NULL")) ? $_POST['question_10'] : "";
$firstname = (isset($_POST['firstname']) && ($_POST['firstname'] != "NULL")) ? $_POST['firstname'] : "";
$lastname = (isset($_POST['lastname']) && ($_POST['lastname'] != "NULL")) ? $_POST['lastname'] : "";
$jobtitle = (isset($_POST['jobtitle']) && ($_POST['jobtitle'] != "NULL")) ? $_POST['jobtitle'] : "";
$email = (isset($_POST['email']) && ($_POST['email'] != "NULL")) ? $_POST['email'] : "";
$phone = (isset($_POST['phone']) && ($_POST['phone'] != "NULL")) ? $_POST['phone'] : "";
$company = (isset($_POST['company']) && ($_POST['company'] != "NULL")) ? $_POST['company'] : "";
//insert date
$insert_date = date("Y-m-d H:i:s");

$survey_form_check = $_POST['survey_form_check'];



if(isset($survey_form_check) && $survey_form_check == 1) {

    // execute the query to write to database
    $query2 = "INSERT INTO survey (question_1, question_2, question_3, question_4, question_5, question_6, question_7, question_8, question_9, question_10, firstname, lastname, jobtitle, email, phone, company,insert_date) VALUES ('".$question_1."','".$question_2."','".$question_3."','".$question_4."','".$question_5."','".$question_6."','".$question_7."','".$question_8."','".$question_9."','".$question_10."','".$firstname."','".$lastname."','".$jobtitle."','".$email."', '".$phone."', '".$company."','".$insert_date."')";
    //echo $query;die();
    $res= $conn->query($query2);
    //var_dump($query2);die();
    if($res){
        echo json_encode(array(
            'status' => 'success',
            'message'=> 'Successful'
        ));
    }
    else{
        echo json_encode(array(
            'status' => 'failed',
            'message'=> 'Unsuccessful'
        ));
    }
}
else{
    print_r("You can't access this page directly, please go <a href=".$siteURL.">back</a>");
}

?>

