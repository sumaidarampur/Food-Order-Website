<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            } 
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name">
                    </td>
                </tr>
              
                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Enter Your Username">
                    </td>
                </tr>
               
                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Enter Your Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php')?>


<?php 

//process the value from form and save it in database
//check whether the submit button is clicked or not 

    if(isset($_POST['submit']))
    {
        //button clicked 
        //echo "Button Clicked";
        //get the data from form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //password encryption with md5

        //sql query to save the database
        $sql = "INSERT INTO tbl_admin SET
            full_name= '$full_name',
            username= '$username',
            password='$password'
        ";
       
        //executing query and saving data into db
       $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

       //check whether the (query is executed) data is inserted or not and display message
       if($res==TRUE)
       {
        //data inserted
        //echo "data inserted";
        //create session variable
        $_SESSION['add']="Admin Added Successfully";
        //redirect page
        header("location:".SITEURL.'admin/manage-admin.php');
       }
       else
       {
        //failed to insert data
        //echo "failed";
        $_SESSION['add']="Failed to add";
        //redirect page
        header("location:".SITEURL.'admin/add-admin.php');
       }

       
    }
    
?>