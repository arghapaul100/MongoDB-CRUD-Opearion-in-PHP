<?php
	
	include 'connect.php';
	if(isset($_REQUEST['id'])){
		$id = (int)$_REQUEST['id'];
		$docs = $con->findOne(['_id'=>$id]);
		$name = $docs['name'];
		$addr = $docs['address'];
		$roll = $docs['roll'];
		$passy = $docs['passingYear'];
		$passg = $docs['passingGrade'];
		$avtar = (string)$docs['avtar'];
		echo "<script>var id=".$id."</script>";
	}
	function createYear(){
		for ($i=2001; $i <= 2021; $i++) {
			echo "<option value='$i'>".$i."</option>";
		}
	}
	function createGrade(){
		$grade = array("E","A","B","C","F");
		for ($i=0; $i < count($grade); $i++) {
			echo "<option value='$grade[$i]'>".$grade[$i]."</option>";
		}
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>CRUD | MongoDB</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container-fluid bg-light pt-2 pb-2">
			<h3 class="text-center">PHP - MongoDB CRUD Operation</h3>
	</div>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-6">
				<form method="post" name = "myForm" id="formId_insert">
				<div class="row p-5">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Enter Your Name</label>
								<input type="text" name="txt_name" placeholder="Enter Your Name" class="form-control" required="">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Enter Your Roll</label>
								<input type="text" name="txt_roll" placeholder="Enter Your Roll" class="form-control" required="">
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<label>Enter Your Address</label>
								<input type="text" name="txt_address" placeholder="Enter Your Address" class="form-control" required="">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Enter Your Passing Year</label>
								<select class="form-control" id="select_year" name="txt_year" required="">
									<option value="">Select Year</option>
									<?php createYear();?>
								</select>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Enter Your Grade</label>
								<select class="form-control" id="select_grade" name="txt_grade" required="">
									<option value="">Select Grade</option>
									<?php createGrade()?>
								</select>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="custom-file">
							    <input type="file" class="custom-file-input" id="customFile" oninvalid="this.setCustomValidity('Please Select a File For Security Reason')" title="Please Select a File For Security Reason" name='image' required="">
							    <label class="custom-file-label" id="customLabel">Choose File</label>
							</div>
						</div>
						<div class="col-lg-12 mt-3 mb-2">
							<div class="row">
								<div class="col-lg-6">
									<button type="submit" class="btn btn-primary btn-block" id="btn_insert">
									Insert
								</button>
								</div>
								<div class=" col-lg-6">
									<button type="submit" class="btn btn-primary btn-block" id="btn_update" disabled="" style="cursor: not-allowed;">
									Update
								</button>
								</div>
							</div>
						</div>
					
					</div>
				</form>
			</div>
		</div>
	</div>


	<div class="container-fluid">

	<table class="table table-hover">
		<thead>
			<tr class="text-center">
				<th>Avtar</th>
				<th>Name</th>
				<th>Address</th>
				<th>Roll</th>
				<th>Passing Year</th>
				<th>Passing Grade</th>
				<th>Edit Data</th>
				<th>Delete Data</th>
			</tr>
		</thead>
		<tbody>
			
		</tbody>
	</table>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$(".custom-file-input").on("change", function() {
		  var fileName = $(this).val().split("\\").pop();
		  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
		});
	})
</script>
<script>
	$(document).ready(function(){
		var id = "<?php echo $id;?>";
		if(id == null){

		}else{

			$('#formId_insert').attr('id','formId_update');

			$('#btn_update').removeAttr('disabled style');
			$('#btn_insert').attr('disabled',"");
			$('#btn_insert').css("cursor","not-allowed");

			$('input[name=txt_name]').val("<?php echo $name;?>");
			$('input[name=txt_roll]').val("<?php echo $roll;?>");
			$('input[name=txt_address]').val("<?php echo $addr;?>");
			$('#select_year').val("<?php echo $passy;?>");
			$('#select_grade').val("<?php echo $passg;?>");
			$('#customLabel').html("Choose New File");

			$('#formId_update').on('submit',function(e){
				e.preventDefault();
				var formData = new FormData(this);
				formData.append('id',id);

				$.ajax({
					url:'update.php',
					type:'post',
					data:formData,
					contentType:false,
					processData:false,
					success:function(data){
						$('input[name=txt_name]').val("");
						$('input[name=txt_roll]').val("");
						$('input[name=txt_address]').val("");
						$('input[name=image]').val("");
						$('#select_year').val("");
						$('#select_grade').val("");

						$('#customLabel').html("Choose File");
						$('tbody').load('display.php');

						location.href='index.php';
					}

				})
			})


		}

	})
		
</script>
<script src="js/main.js"></script>

</body>
</html>
<!-- 
 -->