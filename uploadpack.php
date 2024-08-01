<?php 
// Include the database configuration file 
include_once 'database.php'; 
 
$statusMsg = ''; 
 
// File upload directory 
$targetDir = "uploadpack/"; 
 
if(isset($_POST["submit"])){ 
    $svname = $_POST['svname'];
    $svprice = $_POST['svprice'];

    if(!empty($_FILES["file"]["name"])){ 
        $fileName = basename($_FILES["file"]["name"]); 
        $targetFilePath = $targetDir . $fileName; 
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);     
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){ 
                $insert = $conn->query("INSERT INTO imagespack (file_name, uploaded_on, Product, Price) VALUES ('".$fileName."', NOW(), '".$svname."','".$svprice. "')"); 
                if($insert){ 
                    $status = "success";
                    $statusMsg = "The file ".$fileName. " has been uploaded successfully."; 
                }else{ 
                    $statusMsg = "File upload failed, please try again."; 
                }  
            }else{ 
                $statusMsg = "Sorry, there was an error uploading your file."; 
            } 
        }else{ 
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
        } 
    }else{ 
        $statusMsg = 'Please select a file to upload.'; 
    } 
} 
?>