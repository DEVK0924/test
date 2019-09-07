<?php

$conn=mysqli_connect('localhost','root','','youtube');


extract($_POST);
/*print_r($_POST);
	die;*/


if(isset($_POST['readrecords'])){

$data='<table class="table table-bordered table-striped">
                   <tr>

                        <th> no.</h>
                        <th> first name</h>
                        <th> last name</h>
                        <th> email</h>
                        <th> mobile </h>
                        <th> edit</h>
                        <th> delete</h>

                    
                       </tr>';

  $display="select * from crud";
  $result=mysqli_query($conn,$display);

  if(mysqli_num_rows($result)>0)
  {
$number=1;
//comment
while($row=mysqli_fetch_assoc($result))
{
	$a = "30";
	$$a = $a; 
	// $$a = 320;
	echo 5**2;
	die;
$data.='<tr>

            <td>'.$number.'</td>
            <td>'.$row['first_name'].'</td>
            <td>'.$row['last_name'].'</td>
            <td>'.$row['email'].'</td>
            <td>'.$row['mobile'].'</td>
            <td>
            <button onclick="user_detail('.$row['id'].')" class="btn btn-danger">Edit</button>
            </td>

            <td>
             <button onclick="delete_user('.$row['id'].')" class="btn btn-danger">Delete</button>
             </td>
        
        </tr>';
        $number++;

}


  }

$data.='</table>';
echo $data;

}



if(isset($_POST['firstname'])  && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['mobilenumber']))
{
	/*print_r($_POST);
	die;*/

$q="INSERT INTO `crud`(`first_name`, `last_name`, `email`, `mobile`) VALUES ('$firstname','$lastname','$email','$mobilenumber')";

$result=mysqli_query($conn,$q);

} 





//delete ka code yaha se hai

if(isset($_POST['deleteid']))
{

$user_id= $_POST['deleteid'];
 
 $del="delete  from crud where id='$user_id'";
 $result=mysqli_query($conn,$del);

}


// udate code here 

if(isset($_POST['user_detail']) && $_POST['user_detail'] == "yes")
{

	// print_r($_POST);
	$userid=$_POST['userid'];

	$qry="select * from crud where id='$userid'";
	
	if(!$result = mysqli_query($conn,$qry)){

		exit(mysqli_error());
	}

	$responce=array();

	if(mysqli_num_rows($result) > 0){


		// while ($row=mysqli_fetch_assoc($result)) {
             $responce= mysqli_fetch_assoc($result);

			
		// }
	}
	else{

		$responce['status']=200;
		$responce['message']="data not found";
	}

	echo json_encode($responce);


}


//update data

if(isset($_POST['update']) && $_POST['update'] == 'update'){

	 
    $id=$_POST['userid'];
    $firstname = $_POST['firstname'];
	 $lastname = $_POST['lastname'];
	 $email = $_POST['email'];
	 $mobilenumber = $_POST['mobilenumber'];

	$qury="UPDATE crud SET first_name='$firstname',last_name='$lastname',email='$email',mobile='$mobilenumber' WHERE id='$id'";

	$res=mysqli_query($conn,$qury);

	if(mysqli_affected_rows($conn))
		echo 'true';
	else
		echo 'false';
	/*return 1s;*/

}

?>