<?php 
include('../config/constants.php');
if(isset($_GET['id']) && isset($_GET['image_name']))
{
    //echo "process to delete";

    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    if($image_name != "")
    {
        $path = "../images/food/".$image_name;

        $remove = unlink($path);

        if($remove==false)
        {
            $_SESSION['upload'] = "<div class='error>Failde to Remove Image File.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
            die();
        }
    }

    $sql = "DELETE FROM tbl_food WHERE id=$id";

    $res = mysqli_query($conn, $sql);

    if($res==true)
    {
        $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
    else
    {
        $_SESSION['delete'] = "<div class='error'>Failed to delete Food.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
}
else
{
    //echo "redirect";
    $_SESSION['unauthorize'] = "<div class='error'>Unauthorised Access.</div>";
    header('location:'.SITEURL.'admin/manage-food.php');
}

?>