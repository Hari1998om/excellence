<?php
include 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>crud operation in php</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
	   	 <form id="myform">
	   	 	<div style="background-color: #dae0e5; padding: 1px;"><center><u><h2><i>Insert/Update Record</i></h2></u></center></div>
	   	 <div class="row">

			<div class="col-md-3">
			 <div class="form-group">
			 	<input type="text"  id="edit_id" style="display:none;">
				<label for="name">Name</label>
				<input type="text" name="name" id="name" class="form-control" required>
			 </div>
			</div>
			<div class="col-md-3">
			 <div class="form-group">
				<label for="email">Email</label>
				<input type="email" name="email" id="email" class="form-control" required>
				</div>	
			</div>
			<div class="col-md-3">
			 <div class="form-group">
				<label for="designation">Designation</label>
				<input type="text" name="designation" id="designation" class="form-control" required>
				</div>
			</div>
			<div class="col-md-3">
			 <div class="form-group">
			<label for="salary">Salary</label>
			<input type="text" name="salary" id="salary" class="form-control" required>
			</div>
			</div>
		</div>
		<div class="row">
		<div class="col-md-3">
			<div class="form-group">
			<label for="date">Date</label>
			<input type="date" name="date" id="date" class="form-control" required>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
			<label for="captcha">Captcha</label>
			<input type="text" name="captcha" id="captcha" class="form-control" required>
			</div>
		</div>
		<div class="col-md-2" style="margin-top:25px;">
		 <img src="captcha.php">
		</div>
		<div class="col-md-2" style="margin-top: 25px;">
		<div class="form-group">
		<a href="#"><button class="btn btn-success" id="submitData" name="submitData">Submit</button></a>
		</div>
		</div>
		</div>
		<div id="msg" style="text-align:center; background-color:#0a0733; color:#f8f9fa;"></div>
	  </form>
	   
	   	<div style="background-color: #dae0e5; padding: 1px;"><center><h2><u><i>Display Record</i></u></h2></center></div>
	   	<table class="table">
	   	  <thead>
	   	  	<tr>
	   	  	  <td>S.No</td>
	   	  	  <td>Name</td>
	   	  	  <td>Email</td>
	   	  	  <td>Designation</td>
	   	  	  <td>Salary</td>
	   	  	  <td>Date</td>
	   	  	  <td>Action</td>
	   	  	</tr>
	   	  </thead>
	   	  <tbody id=tbody></tbody>
	   	</table>
	 </div>
</body>

<script type="text/javascript">
	// 
		$(document).ready(function(){
		// Retrieve Data
			function showdata(){
			output ="";
			 $.ajax({
			 	url:"retrieve.php",
			 	method:"GET",
			 	dataType:"json",
			 	success:function(data){
			 		//console.log(data);
			 		if (data) {
			 			x=data;
			 		}else{
			 			x="";
			 		}

			 		$srno=1;
			 		for(i=0; i<x.length; i++){
			 			output += "<tr><td>" + $srno + "</td><td>" + x[i].name + "</td><td>"+x[i].email + "</td><td>" + x[i].designation + "</td><td>" + x[i].salary + "</td><td>" + x[i].date + "</td><td> <span><button class='btn btn-warning btn-sm btn-edit' data-sid=" + x[i].id +" style='margin-right:5px;'> Edit</button></span><span><button class='btn btn-danger btn-sm btn-del' data-sid=" + x[i].id +">Delete</button></span></td></tr>";
			 			$srno++;
			 		}
			 		$('#tbody').html(output);
			 	},
			 });
			}
			showdata();

	// Ajax Request for Insert Data
		$('#submitData').click(function(e){
		  e.preventDefault();
		var eid = $('#edit_id').val();
		var name = $('#name').val();
		var email = $('#email').val();
		var designation = $('#designation').val();
		var salary = $('#salary').val();
		var date = $('#date').val();
		var captcha = $('#captcha').val();
		mydata = {id:eid,name:name,email:email,designation:designation,salary:salary,date:date,captcha:captcha};

		jQuery.ajax({
			url:'insertData.php',
			method:'POST',
			data:JSON.stringify(mydata),
			success:function(data){
			msg="<div>"+ data +"</div>";
			$('#msg').html(msg);
			$('#myform')[0].reset();
			showdata();
			},
		});
	   });

// Delete Data
	$('#tbody').on('click','.btn-del',function(){
		if (confirm('Are you confirm')) {
		  var id =$(this).attr('data-sid');
		  mydata = { sid:id };
		  mythis=this;
		  $.ajax({
		  	url:'delete.php',
		  	method:'POST',
		  	data:JSON.stringify(mydata),
		  	success:function(data){
		  	msg="<div>"+ data +"</div>";
			$('#msg').html(msg);
			//showdata();
			$(mythis).closest('tr').fadeOut();
		  	},
		  });
		}
	});


	//====Edit Data
	$('#tbody').on('click','.btn-edit',function(){
		  var id =$(this).attr('data-sid');
		  mydata = { sid:id };

		$.ajax({
			url:'edit.php',
			method:'POST',
			dataType:'json',
			data:JSON.stringify(mydata),
			success:function(data){
			$('#edit_id').val(data.id);
			$('#name').val(data.name);
			$('#email').val(data.email);
			$('#designation').val(data.designation);
			$('#salary').val(data.salary);
			$('#date').val(data.date);

			},
		});
	});
	});
</script>
<script type="text/javascript">
	jQuery(document).ready(function(){
	jQuery(document).on('click','.update_data',function(){
  	var edit_id=jQuery(this).data('editid');
  	var edit_element=this;
  	jQuery.ajax({
  		url:'insex.php',
  		type:'POST',
  		data:{id:edit_id},
  		success:function(responce){
  		jQuery('#model_form').html(responce);
  		}
  	});
  });
	});
</script>
</html>