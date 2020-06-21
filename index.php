<?php
include_once('dbconfig.php');
if(isset($_POST['add'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $age=$_POST['age'];
    $query="insert into tbl_users (name,email,age) values ('$name','$email','$age')";
    $sql=mysqli_query($con,$query);
    if($sql){
        echo "Data Inserted Success!";
    }else{
        echo "Failed ".mysqli_error($con);
    }
}
if(isset($_GET['del'])){
    $del=$_GET['del'];
    $query="delete from tbl_users where id=$del";
    $sql=mysqli_query($con,$query);
    if($sql){
        echo "Data Deleted Success!";
    }else{
        echo "Failed ".mysqli_error($con);
    }
}
if(isset($_GET['udt'])){
    $udt=$_GET['udt'];
    $query="select * from tbl_users where id=$udt";
    $sql=mysqli_query($con,$query);
    $res=mysqli_fetch_array($sql);
}
if(isset($_POST['ref'])){
    header('Location:index.php');
}
if(isset($_POST['udt'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $age=$_POST['age'];
    $id=$_POST['id'];
    $query="update tbl_users set name='$name',email='$email',age='$age' where id='$id'";
    $sql=mysqli_query($con,$query);
    if($sql){
        echo "Data Updated Success!";
    }else{
        echo "Failed ".mysqli_error($con);
    }
}
if(isset($_POST['fnd'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $age=$_POST['age'];
    if($name=="" && $email=="" && $age==""){
        echo "Please Enter atleats one field";
    }else if(!empty($name)){
        $query="select * from tbl_users where name like '%$name%'";
        echo $query;
    }else if(!empty($email)){
        $query="select * from tbl_users where email like  '%$email%'";
    
    }else if(!empty($age)){
        $query="select * from tbl_users where age='$age'";
    
    }else{
        echo "Invalid input or no data found";
    }
    

}else{
    $query="select * from tbl_users";
}
?>
<html>
<head></head>
<body>
<form action="index.php" method="post">

<table style="margin-left:auto;margin-right:auto;">
<tr>
<td colspan="2">Simple CRUD Operation in PHP and MySqli by Clever Geeks</td>
</tr>
<tr>
<td>name</td>
<td><input type="text" name="name" value="<?php echo isset($res)?$res['name']:'';?>"></td>
</tr>
<tr>
<td>email</td>
<td><input type="email" name="email" value="<?php echo isset($res)?$res['email']:'';?>"></td>

</tr>
<tr>
<td>age</td>
<td><input type="text" name="age" value="<?php echo isset($res)?$res['age']:'';?>"></td>

</tr>
<tr>
<td colspan="2">
<?php
if(isset($_GET['udt'])){
?>
<input type="hidden" name="id" value="<?php echo isset($res)?$res['id']:'';?>">
<input type="submit" name="udt" value="Update">
<?php
}else{
?>

<input type="submit" name="add" value="Add">

<input type="submit" name="fnd" value="Find">
<?php
}
?>
<input type="submit" name="ref" value="Refresh">

</td>
</tr>

</table>
</form>
<table style="margin-left:auto;margin-right:auto;" border="2" >
<tr>
<td>
ID
</td>
<td>
Name
</td>
<td>
Email
</td>
<td>
Age
</td>
<td>
Action
</td>

</tr>

<?php

$sql=mysqli_query($con,$query);
while($result=mysqli_fetch_array($sql)){
    
?>
<tr>
<?php
echo "<td>".$result['id']."</td>";
echo "<td>".$result['name']."</td>";
echo "<td>".$result['email']."</td>";
echo "<td>".$result['age']."</td>";
echo "<td><a href='?del=".$result['id']."'>Delete</a><a href='?udt=".$result['id']."'>Update</a></td>";

?>
</tr>

<?php
}
?>
</table>
</body>
</html>