<?php 

require("config.php");
//check for isset and post data here and create a selection array
$enquiry = (isset($_POST['enquiry']) && ($_POST['enquiry'] != "NULL")) ? $_POST['enquiry'] : "";
$firstname = (isset($_POST['firstname']) && ($_POST['firstname'] != "NULL")) ? $_POST['firstname'] : "";
$lastname = (isset($_POST['lastname']) && ($_POST['lastname'] != "NULL")) ? $_POST['lastname'] : "";
$jobtitle = (isset($_POST['jobtitle']) && ($_POST['jobtitle'] != "NULL")) ? $_POST['jobtitle'] : "";
$email = (isset($_POST['email']) && ($_POST['email'] != "NULL")) ? $_POST['email'] : "";
$phone = (isset($_POST['phone']) && ($_POST['phone'] != "NULL")) ? $_POST['phone'] : "";
$company = (isset($_POST['company']) && ($_POST['company'] != "NULL")) ? $_POST['company'] : "";
//insert date
$insert_date = date("Y-m-d H:i:s");

$form_check = $_POST['form_check'];

global $headers;


if(isset($form_check) && $form_check == 1) {

    // execute the query to write to database
    $query = "INSERT INTO contact (enquiry, firstname,lastname, jobtitle, email, phone, company,insert_date) VALUES ('".$enquiry."','".$firstname."','".$lastname."','".$jobtitle."','".$email."', '".$phone."', '".$company."','".$insert_date."')";
    //echo $query;die();
    $res= $conn->query($query);
    //var_dump($last_id);die();
    if($res){
        
        //sending email here
        // format the data to be sent
        $all_data_html = '<strong>The following person has just submitted the form on:  https://www.sunilsingh.com.au/</strong><br/><br/>'.
        '<table border=1>
        <tr><td>Enquiry type</td><td>'.$enquiry.'</td></tr>
        <tr><td>First Name</td><td>'.$firstname.'</td></tr>
        <tr><td>Last Name</td><td>'.$lastname.'</td></tr>
        <tr><td>Job Title</td><td>'.$jobtitle.'</td></tr>
        <tr><td>Phone</td><td>'.$phone.'</td></tr>
        <tr><td>Company</td><td>'.$company.'</td></tr>
        <tr><td>Email</td><td>'.$email.'</td></tr>
        <tr><td>Form Fill Date</td><td>'.$insert_date.'</td></tr>
        </table>';

        $headers .= "Reply-To: No Reply <sunilsingh2019@gmail.com>\r\n";
        $headers .= "Return-Path: No Reply <sunilsingh2019@gmail.com>\r\n";
        $headers .= "From: No Reply <sunilsingh2019@gmail.com>\r\n";
        $headers .= "Organization: Qbit\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= "X-Priority: 3\r\n";
        $headers .= "X-Mailer: PHP". phpversion() ."\r\n";
        $to = 'sunilsingh2019@gmail.com';
        $subject = 'Form Submit : Check Point';
        $subjectSender = "";
        $headers .= "X-Mailer: PHP". phpversion() ."\r\n"; 

        if (mail($to, $subject, $all_data_html, $headers)) {
         
            if($enquiry === "demo"){
                echo json_encode(array(
                    'status' => 'success',
                    'message'=> 'demo'
                ));
            }
            else{
                echo json_encode(array(
                    'status' => 'success',
                    'message'=> 'contact'
                ));
            }
        }
    }
    else{
        echo json_encode(array(
            'status' => 'failed',
            'message'=> ''
        ));
    }
}
else{
    print_r("You can't access this page directly, please go <a href=".$siteURL.">back</a>");
}

?>

