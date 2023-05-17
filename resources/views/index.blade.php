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
  					<span id="addheader">add new student</span>
  					<span id="editheader">update new student</span>
  					
  						<div class="mb-3">
						  <label for="first_name" class="form-label">First Name</label>
						  <input type="text" class="form-control" id="first_name" placeholder="first name">
						</div>
  						<div class="mb-3">
						  <label for="last_name" class="form-label">Last Name</label>
						  <input type="text" class="form-control" id="last_name" placeholder="last name">
						</div>
  						<div class="mb-3">
						  <label for="age" class="form-label">Age</label>
						  <input type="number" class="form-control" id="age" placeholder="age">
						</div>
						<div class="mb-3">
						  <label for="classroom" class="form-label">Classroom</label>
						  <input type="text" class="form-control" id="classroom" placeholder="classroom">
						</div>
						
						<button id="addbtn" onclick="addstudent()" class="btn btn-primary btn-sm">add student</button>

						<button id="editbtn" class="btn btn-primary btn-sm">edit student</button>

  					
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

	function allData(){
		$.ajax({
			type : "GET",
			dataType : 'json',
			url : "/student_data",
			success:function(data){
				var result = "";
				$.each(data,function(key,value){
					result = result + "<tr>";
				  result = result + "<th scope='row'>"+ value.id + "</th>";
				  result = result + "<td>"+ value.fName + "</td>";
				  result = result + "<td>"+ value.lName + "</td>";
				  result = result + "<td>"+ value.age + "</td>";
				  result = result + "<td>"+ value.class + "</td>";
				  result = result + "<td>";
				  result = result + "<a href='' class='btn btn-sm btn-primary'>edit</a>";
				  result = result + "<a href='' class='btn btn-sm btn-danger'>delete</a>";
					result = result + "</td>";
				  result = result + "</tr>";
				})
				$('tbody').html(result);
			}
		})
	}


	allData();


	function clearform(){
		$('#first_name').val("");
		$('#last_name').val("");
		$('#age').val("");
		$('#classroom').val("");
	}

	
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
			}
		})
		clearform();
		allData();



	}




</script>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>