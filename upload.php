<?php 
// Include the database configuration file 
include_once 'database.php'; 

$statusMsg = ''; 

// File upload directory 
$targetDir = "uploads/"; 

if(isset($_POST["submit"])){ 
    $svname = $conn->real_escape_string($_POST['svname']);
    $svprice = $conn->real_escape_string($_POST['svprice']);
    $svdesc = $conn->real_escape_string($_POST['svdesc']);

    if(!empty($_FILES["file"]["name"])){ 
        $fileName = basename($_FILES["file"]["name"]); 
        $targetFilePath = $targetDir . $fileName; 
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);     
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif'); 

        if(in_array($fileType, $allowTypes)){ 
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){ 
                $stmt = $conn->prepare("INSERT INTO images (file_name, uploaded_on, Product, Price, Description) VALUES (?, NOW(), ?, ?, ?)");
                $stmt->bind_param("ssss", $fileName, $svname, $svprice, $svdesc);

                if($stmt->execute()){ 
                    $statusMsg = "The file ".$fileName. " has been uploaded successfully."; 
                }else{ 
                    $statusMsg = "File upload failed, please try again."; 
                }  
                $stmt->close();
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
