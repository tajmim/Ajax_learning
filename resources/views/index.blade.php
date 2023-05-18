<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script
  src="https://code.jquery.com/jquery-3.7.0.min.js"
  integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
  crossorigin="anonymous"></script>
  </head>
  <body>
  	<div class="container">
  		<h1>table data</h1>

  		<div class="row">
  			<div class="col-7">
  				<table class="table">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">First</th>
				      <th scope="col">Last</th>
				      <th scope="col">Age</th>
				      <th scope="col">Classroom</th>
				      <th scope="col">Action</th>
				    </tr>
				  </thead>
				  <tbody>


				    <!-- <tr>
				      <th scope="row">1</th>
				      <td>Mark</td>
				      <td>Otto</td>
				      <td>18</td>
				      <td>
				      	<a href="" class="btn btn-sm btn-primary">edit</a>
				      	<a href="" class="btn btn-sm btn-danger">delete</a>


				      </td>
				    </tr> -->
				  </tbody>
				</table>
  			</div>
  			<div class="col-5">
  				<div class="mb-3">
  					<span id="addheader" class="text-center text-primary">add new student</span>
  					<span id="editheader" class="text-center text-primary">update new student</span>
  					
  						<div class="mb-3">
						  <label for="first_name" class="form-label">First Name</label>
						  <input type="text" class="form-control" id="first_name" placeholder="first name">
						  <span class="text-danger" id="fnameError"></span>
						</div>
  						<div class="mb-3">
						  <label for="last_name" class="form-label">Last Name</label>
						  <input type="text" class="form-control" id="last_name" placeholder="last name">
						  <span class="text-danger" id="lnameError"></span>
						</div>
  						<div class="mb-3">
						  <label for="age" class="form-label">Age</label>
						  <input type="number" class="form-control" id="age" placeholder="age">
						  <span class="text-danger" id="ageError"></span>
						</div>
						<div class="mb-3">
						  <label for="classroom" class="form-label">Classroom</label>
						  <input type="text" class="form-control" id="classroom" placeholder="classroom">
						  <span class="text-danger" id="classError"></span>
						</div>

						<!-- for id -->
						<input type="hidden" id="id">
						
						<button id="addbtn" onclick="addstudent()" class="btn btn-primary btn-sm">add student</button>

						<button id="editbtn" onclick="editSubmission()" class="btn btn-primary btn-sm">edit student</button>

  					
	  			</div>
	  		</div>
  		
  	</div>


  	






<script>
	$('#addheader').show();
	$('#editheader').hide();
	$('#addbtn').show();
	$('#editbtn').hide();

	$.ajaxSetup({
		headers:{
			'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
		}
	})
	// get all data from database

	function allData(){
		$.ajax({
			type : "GET",
			dataType : 'json',
			url : "/student_data",
			success:function(data){
				var result = "";
				var sirial = 0;
				$.each(data,function(key,value){
					sirial = sirial + 1;
					result = result + "<tr>";
				  result = result + "<th scope='row'>"+ sirial + "</th>";
				  result = result + "<td>"+ value.fName + "</td>";
				  result = result + "<td>"+ value.lName + "</td>";
				  result = result + "<td>"+ value.age + "</td>";
				  result = result + "<td>"+ value.class + "</td>";
				  result = result + "<td>";
				  result = result + "<button class='btn btn-sm btn-primary' onclick='editData("+value.id+")'>edit</button>";
				  result = result + "<button class='btn btn-sm btn-danger' onclick='deleteData("+value.id+")'>delete</button>";
					result = result + "</td>";
				  result = result + "</tr>";
				})
				$('tbody').html(result);
			}
		})
	}


	allData();
	// end get data from database

// data clear
	function clearform(){
		$('#first_name').val("");
		$('#last_name').val("");
		$('#age').val("");
		$('#classroom').val("");
		$('#fnameError').html("");
		$('#lnameError').html("");
		$('#ageError').html("");
		$('#classError').html("");
	}
// end data clear 
//  store data
	
	function addstudent(){
		var fn = $('#first_name').val();
		var ln = $('#last_name').val();
		var age = $('#age').val();
		var classroom = $('#classroom').val();
		console.log(fn);
		console.log(ln);
		console.log(age);
		console.log(classroom);
		$.ajax({
			type : "Post",
			dataType : 'json',
			data : {fName : fn,lName : ln,age : age,class : classroom},
			url : "/addstudent",
			success:function(data){
				console.log("successfully added");
				Swal.fire(
				  'successfully added',
				  "",
				  'success'
					)
			},
			error:function(error){
				console.log(error.responseJSON.errors.fName);
				console.log(error.responseJSON.errors.lName);
				console.log(error.responseJSON.errors.age);
				console.log(error.responseJSON.errors.class);
				$('#fnameError').html(error.responseJSON.errors.fName);
				$('#lnameError').html(error.responseJSON.errors.lName);
				$('#ageError').html(error.responseJSON.errors.age);
				$('#classError').html(error.responseJSON.errors.class);
			}
		})
		clearform();
		allData();

	}
// end store data

	// edit data show start
 
 	function editData(id){
 		$.ajax({
			type : "GET",
			dataType : 'json',
			url : "/edit_data/"+id,
			success:function(data){
					$('#first_name').val(data.fName);
					$('#last_name').val(data.lName);
					$('#age').val(data.age);
					$('#classroom').val(data.class);
					$('#id').val(data.id);


					$('#addheader').hide();
					$('#editheader').show();
					$('#addbtn').hide();
					$('#editbtn').show();
			}
		})
 	}


	// edit data show end


	// edit submission start
 	function editSubmission(){
 		var id = $('#id').val();
 		var fn = $('#first_name').val();
		var ln = $('#last_name').val();
		var age = $('#age').val();
		var classroom = $('#classroom').val();
		console.log(fn);
		console.log(ln);
		console.log(age);
		console.log(classroom);
		$.ajax({
			type : "Post",
			dataType : 'json',
			data : {id : id , fName : fn,lName : ln,age : age,class : classroom},
			url : "/editsubmit",
			success:function(data){
				console.log("successfully added");
				$('#addheader').show();
				$('#editheader').hide();
				$('#addbtn').show();
				$('#editbtn').hide();
			},
			error:function(error){
				console.log(error.responseJSON.errors.fName);
				console.log(error.responseJSON.errors.lName);
				console.log(error.responseJSON.errors.age);
				console.log(error.responseJSON.errors.class);
				$('#fnameError').html(error.responseJSON.errors.fName);
				$('#lnameError').html(error.responseJSON.errors.lName);
				$('#ageError').html(error.responseJSON.errors.age);
				$('#classError').html(error.responseJSON.errors.class);
			}
		})
		clearform();
		allData();

 	}// edit submission end

	// delete data start
	function deleteData(id){
		$.ajax({
			type : "GET",
			dataType : 'json',
			url : "/delete_data/"+id,
			success:function(data){
					
			}
		})
		Swal.fire({
		  icon: 'error',
		  title: 'Deleted',
		  text: ''
		  
		})
		allData();
	}

	// delete data end





</script>



<!-- sweet alert 2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>