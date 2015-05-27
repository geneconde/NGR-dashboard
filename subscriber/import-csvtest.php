<?php  
ini_set('display_errors', 1);
    require_once '../session.php';
    require_once 'locale.php';
    include_once '../controller/DiagnosticTest.Controller.php';
    include_once '../controller/TeacherModule.Controller.php';
    include_once '../controller/Module.Controller.php';
    include_once('../controller/Subscriber.Controller.php');
    include_once 'php/auto-generate.php';
    
    $sc = new SubscriberController();
    $sub = $sc->loadSubscriber($user->getSubscriber());

    $userid             = $user->getUserid();
    $usertype           = 0;
    $subid              = $user->getSubscriber();

//connect to the database 
$connect = mysql_connect("localhost","jigzenco","_1234aA_"); 
mysql_select_db("jigzenco_dashboard_live",$connect); //select the table 

define ("DB_HOST", "localhost"); // set database host
define ("DB_USER", "jigzenco"); // set database user
define ("DB_PASS","_1234aA_"); // set database password
define ("DB_NAME","jigzenco_dashboard_live"); // set database name

$link = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Couldn't make connection.");
$db = mysql_select_db(DB_NAME, $link) or die("Couldn't select database");

$databasetable = "users";

set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
include 'PHPExcel/IOFactory.php';

$uploadedStatus = 0;

// echo $user->getSubscriber();

if ( isset($_POST["submit"]) ) {

    //if there was an error uploading the file

        if ($_FILES["file"]["error"] > 0) {

            echo "Return Code: " . $_FILES["file"]["error"] . "<br />";

        } else {

            if (file_exists($_FILES["file"]["name"])) {

                unlink($_FILES["file"]["name"]);

            }

            else {

                $inputFileName = $_FILES["file"]['tmp_name'];
                // echo '<pre>';
                $file001 = $_FILES["file"]["name"];
                // echo '</pre>';
                // echo '<pre>';
                // print_r($_FILES["file"]);
                // echo '</pre>';

                if (strpos($file001, 'csv') !== FALSE){
                    $row = 1;

                    if (($handle = fopen($inputFileName, "r")) !== FALSE) {
                        // echo $handle;
                        while (($data = fgetcsv($handle, 1000, ",","'")) !== FALSE) {
                            $num = count($data);
                            $username = trim($data[0]);
                            $username = str_replace('"','',$username);

                            $password = trim($data[1]);
                            $password = str_replace('"','',$password);

                            $fname = trim($data[2]);
                            $fname = str_replace('"','',$fname);

                            $lname = trim($data[3]);
                            $lname = str_replace('"','',$lname);

                            $gender = trim($data[4]);
                            $gender = str_replace('"','',$gender);

                            //  echo '<pre>';
                            // print_r($data);
                            // echo '</pre>';
                            // echo $username . ' ' . $password. ' ' . $fname . ' ' . $lname . ' ' . $gender . ' ';

                            $type = 0;
                            $subid = $user->getSubscriber();
                            if($row > 1){
                                // echo ($username . ' ' . $password . ' ' . $fname . ' ' . $lname . ' ' . $gender . '<br/>');
                                $query = "SELECT username FROM users WHERE username = '".$username."'";
                            
                                $sql = mysql_query($query);
                                
                                $recResult = mysql_fetch_array($sql);
                                
                                $existName = $recResult["username"];
                                
                                if($existName=="") {
                                    if($username !== ""){
                                        $insertTable= mysql_query("insert into users (username, password, type, first_name, last_name, gender, subscriber_id) values('".$username."', '".$password."', '".$type."', '".$fname."', '".$lname."', '".$gender."', '".$subid."');");
                                        $msg = 'Record has been added.';
                                    }

                                //     // echo '<script>';
                                //     // echo 'alert("Record has been added.");';
                                //     // echo '</script>';
                                
                                } else {

                                    $msg = 'Record already exist.';
                                //     // echo '<script>';
                                //     // echo 'alert("Record already exist.");';
                                //     // echo '</script>';
                                
                                }
                                //end
                            } else {
                                $row++;
                            }
                        }
                        fclose($handle);
                    }


                } else {

                    try {

                        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);

                    } catch(Exception $e) {

                        die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());

                    }


                    $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

                    $arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet

                    // echo '<pre>';
                    // print_r($allDataInSheet);
                    // echo '</pre>';

                    for($i=2;$i<=$arrayCount;$i++) {

                        // echo $allDataInSheet[$i]["A"].'asd'.'</br>';
                        $userName = trim($allDataInSheet[$i]["A"]);
                        
                        $password = trim($allDataInSheet[$i]["B"]);

                        $fname = trim($allDataInSheet[$i]["C"]);

                        $lname = trim($allDataInSheet[$i]["D"]);

                        $gender = trim($allDataInSheet[$i]["E"]);

                        $type = 0;
                        $subid = $user->getSubscriber();

                        if(trim($allDataInSheet[$i]["A"])){ 

                             // echo $userName.'a'.'</br>';

                            $query = "SELECT username FROM users WHERE username = '".$userName."'";
                            
                            $sql = mysql_query($query);
                            
                            $recResult = mysql_fetch_array($sql);
                            
                            $existName = $recResult["username"];
                            
                            if($existName=="") {
                            
                                // $insertTable= mysql_query("insert into users (username, password, type, first_name, last_name, gender, subscriber_id) values('".$userName."', '".$password."', '".$type."', '".$fname."', '".$lname."', '".$gender."', '".$subid."');");
                            
                                $msg = 'Record has been added.';
                            //     // echo '<script>';
                            //     // echo 'alert("Record has been added.");';
                            //     // echo '</script>';
                            
                            } else {

                                $msg = 'Record already exist.';
                            //     // echo '<script>';
                            //     // echo 'alert("Record already exist.");';
                            //     // echo '</script>';
                            
                            }

                        }
                    }   
                }
                ?>
                <script>
                    alert("<?php echo $msg; ?>");
                </script>
        
        <?php    }
        }   
        
} //else {

//         echo "No file selected <br />";
// }

?> 
<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>

<head>
    <title>NexGenReady</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <link rel="stylesheet" type="text/css" media="screen" href="../phpgrid/lib/js/themes/redmond/jquery-ui.custom.css"></link>  
    <link rel="stylesheet" type="text/css" media="screen" href="../phpgrid/lib/js/jqgrid/css/ui.jqgrid.css"></link> 
    
    <link rel="stylesheet" type="text/css" href="../style.css" />

    <script src="../phpgrid/lib/js/jquery.min.js" type="text/javascript"></script>
    <script src="../phpgrid/lib/js/jqgrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
    <script src="../phpgrid/lib/js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script> 
    <script src="../phpgrid/lib/js/themes/jquery-ui.custom.min.js" type="text/javascript"></script>
</head>

<body>
    <div id="header">

        <a href="<?php echo $link; ?>"><img src="../images/logo2.png"></a>

    </div>

    <div id="content">
    <br>
    <?php if (isset($user)) { ?>
    <div class="fright" id="logged-in">
        <?php echo _("You are currently logged in as"); ?> <span class="upper bold"><?php echo $user->getUsername(); ?></span>. <a class="link" href="../logout.php"><?php echo _("Logout?"); ?></a>
    </div>
    <?php } ?>
    <div class="clear"></div>

    <div class="fright m-top10" id="accounts">
        <a class="link fright" href="edit-account.php?user_id=<?php echo $userid; ?>&f=0"><?php echo _("My Account"); ?></a>
    </div>
    <div class="clear"></div>

    <a class="link" href="index.php">&laquo; <?php echo _("Go Back to Dashboard"); ?></a>
    <br>
    <div class="wrap-container">
        <div id="wrap">
            <?php if (!empty($_GET['success'])) { echo "<b>Your file has been imported.</b><br><br>"; } //generic success notice ?> 
            <div class="sub-headers">
                <h1>Import Teachers</h1>
                <!-- <p><?php echo _("Download a csv form"); ?><a href="#" class="link"> <?php echo _("here"); ?></a></p> -->
                 <!-- <p><?php echo _("You are only allowed to import " . $sub->getTeachers() . " teachers"); ?> -->
            </div>      
            <div class="clear"></div>
            <div style="margin:10px 0">
                <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
                  Choose your file: <br /> 
                  <input name="file" type="file" id="file" accept="text/csv" /> 
                  <input type="submit" name="submit" value="Submit" /> 
                </form>  
            </div>
        </div>
    </div>  

    </div>
    <!-- start footer -->
    <div id="footer" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>
        <div class="copyright">
            <p>© 2014 NexGenReady. <?php echo _("All Rights Reserved."); ?>
            <a class="link f-link" href="../../marketing/privacy-policy.php"><?php echo _("Privacy Policy"); ?></a> | 
            <a class="link f-link" href="../../marketing/terms-of-service.php"><?php echo _("Terms of Service"); ?></a>
    
            <a class="link fright f-link" href="../../marketing/contact.php"><?php echo _("Need help? Contact our support team"); ?></a>
            <span class="fright l-separator">|</span>
            <a class="link fright f-link" href="../../marketing/bug.php"><?php echo _("File Bug Report"); ?></a>
            </p>
        </div>
    </div>
</body>
</html>