<?php
$targetDir = "uploads/";
$targetFile = $targetDir . basename($_FILES["pdfFile"]["name"]);
$uploadOk = 1;
$pdfFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
if(isset($_POST["submit"])) 
{
    $check = getimagesize($_FILES["pdfFile"]["tmp_name"]);
    if($check != false) 
    {
        echo "File is a PDF - " . $check["mime"] . ".";
        $uploadOk = 1;
    } 
    else 
    {
        echo "File is not a PDF.";
        $uploadOk = 0;
    }
}
if (file_exists($targetFile)) 
{
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
if ($_FILES["pdfFile"]["size"] > 500000) 
{
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
if($pdfFileType != "pdf") 
{
    echo "Sorry, only PDF files are allowed.";
    $uploadOk = 0;
}
if ($uploadOk == 0) 
{
    echo "Sorry, your file was not uploaded.";
} 
else 
{
    if (move_uploaded_file($_FILES["pdfFile"]["tmp_name"], $targetFile)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["pdfFile"]["name"])). " has been uploaded.";
        $filePath = $targetFile;
    } 
    else 
    {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
