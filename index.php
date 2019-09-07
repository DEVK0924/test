<!DOCTYPE html>
<html>
<head>
	<title></title>

	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  
</head>
<body>
<div class="container">

	<h1 class="text-primary text-uppercase text-center"> welcome to  home page</h1>

	<div class="d-flex justify-content-end">
		<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal">Open modal</button>

	</div>
<h2 class="text-danger"> All Records</h2>
<div class="records_contant">
	

</div>
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Ajax crud operation</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">

        <div class="form-group">
            <lable> first name</lable>
        	<input type="text" name="" id="firstname"  class="form-control" placeholder="first name">
        </div>

        <div class="form-group">
            <lable> last name</lable>
        	<input type="text" name="" id="lastname" class="form-control" placeholder="last name">
        </div>

        <div class="form-group">
            <lable> email</lable>
        	<input type="email" name="" id="email" class="form-control" placeholder="email">
        </div>

        <div class="form-group">
            <lable> mobile number</lable>
        	<input type="text" name="" id="mobilenumber" class="form-control" placeholder="mobile number">
        </div>

      </div>

      Modal footer
      <div class="modal-footer">
      	<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="addrecord()">save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
	
<!-- //udate ke liye design///////////////////////////////////////////////////// --> 


	<div class="modal" id="update_user_model">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Ajax crud operation</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">

        <div class="form-group">
            <lable>  updat first name</lable>
        	<input type="text" name="" id="update_firstname" class="form-control" placeholder=" update first name">
        </div>

        <div class="form-group">
            <lable> update last name</lable>
        	<input type="text" name="" id="update_lastname" class="form-control" placeholder=" update last name">
        </div>

        <div class="form-group">
            <lable> update email</lable>
        	<input type="email" name="" id="update_email" class="form-control" placeholder="update email">
        </div>

        <div class="form-group">
            <lable> update mobile number</lable>
        	<input type="text" name="" id="update_mobilenumber" class="form-control" placeholder="update mobile number">
        </div>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      	<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="updateuser()">update</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <input type="hidden" name="" id="hidden_user_id">
      </div>

    </div>
  </div>
</div

</div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>






  <script>


  	$(document).ready(function(){

  		readrecords();


  	});
  	
function readrecords(){


var readrecords='readrecords';
$.ajax({

url:'bakend.php',
type:'POST',
data:{readrecords:readrecords},
success:function(data,status){
$('.records_contant').html(data);

}


});

}
  



  	function addrecord(){

  	var firstname=$('#firstname').val();
  	var lastname=$('#lastname').val();
  	var email=$('#email').val();
  	var mobilenumber=$('#mobilenumber').val();

  	$.ajax({


       url:'bakend.php',
       type:'POST',
       data:{

             firstname:firstname,
             lastname:lastname,
             email:email,
             mobilenumber:mobilenumber   	
       },

       success:function(data,status){

             readrecords();

       }


  	});
  		
  	}
  	//delete user call and defination

  	    function delete_user(deleteid){

         var cnfrm= confirm("Are you sure delete");

          if(cnfrm == true)
          {

          	$.ajax({
             
             url:'bakend.php',
             type:'POST',
             data:{deleteid:deleteid},
             success:function(data,status){
             	readrecords();


             }
          
          	});
          }

  	}

// user details on form


function user_detail(userid){
	//var request = new XMLHttpRequest();

	$('#hidden_user_id').val(userid);

	$.post('bakend.php',{user_detail:'yes', userid:userid},

		function(data,status){
			console.log(status);
			console.log(data);
            //var responce=request.responceText;
			var user= JSON.parse(data);
			$('#update_firstname').val(user.first_name);
			$('#update_lastname').val(user.last_name);
			$('#update_email').val(user.email);
			$('#update_mobilenumber').val(user.mobile);

		}

       );
        
        $('#update_user_model').modal("show");

}





//update code here

function updateuser(){

	var firstname = $('#update_firstname').val();
	var lastname = $('#update_lastname').val();
	var email = $('#update_email').val();
	var mobilenumber = $('#update_mobilenumber').val();
	var userid = $('#hidden_user_id').val();

	$.post('bakend.php',{

		firstname:firstname,
		lastname:lastname,
		email:email,
		mobilenumber:mobilenumber,
		userid:userid,
		update:"update"


	},
        function(data){
           $('#update_user_model').modal("hide");
           readrecords();
            }

);



} 

  </script>
</body>
</html>