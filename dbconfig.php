<?php
$con=mysqli_connect("localhost","root","","clever");
if($con){

}else{
    echo "Connection Failed".mysqli_error($con);
}
?>