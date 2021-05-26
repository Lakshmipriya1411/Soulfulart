<?php ob_start(); ?>
<?php
 function createGUID()
 {
   if (function_exists('com_create_guid'))
   {
     return com_create_guid();
   }
   else
   {
     mt_srand((double)microtime()*10000);
     //optional for php 4.2.0 and up.
     $set_charid = strtoupper(md5(uniqid(rand(), true)));
     $set_hyphen = chr(45);
     $set_uuid="";
     // "-"
     $set_uuid = $set_uuid
     .substr($set_charid, 0, 8).$set_hyphen
     .substr($set_charid, 8, 4).$set_hyphen
     .substr($set_charid,12, 4).$set_hyphen
     .substr($set_charid,16, 4).$set_hyphen
     .substr($set_charid,20,12);
     //.chr(125);
     // "}"
     return $set_uuid;
   }
 }
echo "in status page";
                         $userid=$_SESSION["uid"];
                         $uname=$_SESSION["uname"];
                          //echo $userid;
                          $guid=createGUID();
                          //echo $guid;
                          $sqlusstatus="SELECT * FROM marketplace.userstatus where userid=$userid;";
                          $sqluserstatusres=$conn->query($sqlusstatus);  
                          // print_r($res);     
                            //$conn->close();
                          //print($msg);
                          date_default_timezone_set('Asia/Kolkata');
                          $date = date('d-m-y h:i:s');
                          if($sqluserstatusres->num_rows>0)
                          {
                            $sqlustatus="UPDATE marketplace.userstatus set status='active',logintime='$date',sessionid='$guid' where userid=$userid;";                          
                          }
                          else{
                            $sqlustatus = "INSERT INTO marketplace.userstatus VALUES  ($userid,'$uname','$date','$date','active','$guid')";
                            
                          }
                          //echo "wats this";
                          $sres=$conn->query($sqlustatus);
                          print_r($sres);       
                          header("location: markethomepage.php");
                          exit();                  
                      
?>