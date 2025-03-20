<?php
   include "connection.php";
   if(isset($_REQUEST["submit"])){
    //   echo "<pre>";
    //   print_r($_FILES["imageUpload"]);
    //   echo "</pre>";
        $image_upload1=$_FILES["imageUpload1"];
        $image_upload2=$_FILES["imageUpload2"];
        $image_upload3=$_FILES["imageUpload3"];
        $image_upload4=$_FILES["imageUpload4"];
        $image_upload5=$_FILES["imageUpload5"];


        $imgname1 = $image_upload1["name"];
        $imgname2 = $image_upload2["name"];
        $imgname3 = $image_upload3["name"];
        $imgname4 = $image_upload4["name"];
        $imgname5 = $image_upload5["name"];

        $tmpName1 = $image_upload1["tmp_name"];
        $tmpName2 = $image_upload2["tmp_name"];
        $tmpName3 = $image_upload3["tmp_name"];
        $tmpName4 = $image_upload4["tmp_name"];
        $tmpName5 = $image_upload5["tmp_name"];

        $path1 = $image_upload1["full_path"];
        $path2 = $image_upload2["full_path"];
        $path3 = $image_upload3["full_path"];
        $path4 = $image_upload4["full_path"];
        $path5 = $image_upload5["full_path"];


        $fullPath1="images/".$path1;
        $fullPath2="images/".$path2;
        $fullPath3="images/".$path3;
        $fullPath4="images/".$path4;
        $fullPath5="images/".$path5;

        move_uploaded_file($tmpName1 ,$fullPath1);
        move_uploaded_file($tmpName2 ,$fullPath2);
        move_uploaded_file($tmpName3 ,$fullPath3);
        move_uploaded_file($tmpName4 ,$fullPath4);
        move_uploaded_file($tmpName5 ,$fullPath5);

        $sortname=$_REQUEST["sortname"];
        $fullname=$_REQUEST["fullname"];
        $price=$_REQUEST["price"];
        $prodetail=$_REQUEST["prodetail"];

        $sql ="insert into product values('null','$fullname','$fullPath1','$price')";
            if($connection->query($sql)){
                echo 'data inserted successfully';
            }
   }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>data insert with image</title>
    <style>
    td{
        border:1px black solid}</style>
</head>
<body>
    <h3>Note:- first top 10 product will be show in "FRONT PAGE" and all products are showing in "ELECTRONICS PAGE"</h3>
    <h4>Front image & Back image, fullname & price only show in front page & fullname </h4>
    <form action="addproduct.php" method="post" enctype="multipart/form-data">
        <table>
            <tr><td>Front image:</td><td><input type="file" name="imageUpload1"></td></tr>
            <tr><td>Back image:</td><td><input type="file" name="imageUpload2"></td></tr>
            <tr><td>image3:</td><td><input type="file" name="imageUpload3"></td></tr>
            <tr><td>image4:</td><td><input type="file" name="imageUpload4"></td></tr>
            <tr><td>image5:</td><td><input type="file" name="imageUpload5"></td></tr>

            <tr><td>sort_Name:</td><td><input type="text" name="sortname"></td></tr>
            <tr><td>full_name:</td><td><input type="text" name="fullname"></td></tr>
            <tr><td>product details:</td><td><input type="text" name="prodetail" placeholder="enter product details minimum 50 words"></td></tr>
            <tr><td>Price:</td><td><input type="text" name="price"></td></tr>
            <tr><td><input type="submit" value="Submit" name="submit"></td></tr>
        </table>

    </form><br><br>

    
    <table style="text-align:center;">
        <tr>
        <td width="150px">id</td>
        <td width="150px">image1</td>
        <td width="150px">image2</td>
        <td width="150px">image3</td>
        <td width="150px">image4</td>
        <td width="150px">image5</td>
        <td width="100px">Price</td>
        <td width="100px">sortName</td>
        <td width="100px">fullName</td>
        <td width="100px">product_detail</td>
        <td width="150px">operation</td>
    </tr>
    <?php
       $select="select *from product";
       $selected=$connection->query($select);
       while($pro_image=$selected->fetch_assoc()){
        $id=$pro_image['pro_id'];   
        $imagepath1=$pro_image['image1'];   
        $imagepath2=$pro_image['image2'];   
        $imagepath3=$pro_image['image3'];   
        $imagepath4=$pro_image['image4'];   
        $imagepath5=$pro_image['image5'];   
        $sortname=$pro_image['sortname'];
        $fullname=$pro_image['fullname'];
        $price=$pro_image['price'];
        $prodeatail=$pro_image['product_details'];

        echo "<tr>
        <td>$id</td>
        <td><img src='$imagepath1' width='200px'></td>
        <td><img src='$imagepath2' width='200px'></td>
        <td><img src='$imagepath3' width='200px'></td>
        <td><img src='$imagepath4' width='200px'></td>
        <td><img src='$imagepath5' width='200px'></td>
        <td>$price</td>
        <td>$sortname</td>
        <td>$fullname</td>
        <td>$prodeatail</td>";
    }  
    ?>
    </table>
</body>
</html>