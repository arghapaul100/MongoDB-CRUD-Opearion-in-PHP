<?php
include 'connect.php';
$douments =  $con->find();

foreach ($douments as $docs){
	echo "<tr class='text-center align-items-center'>";
	echo "<td class='align-middle'><img src='UserAvtar/".$docs['avtar']."' class='rounded-circle' width='35' height='35'></td>";
	// echo "<td class='align-middle'>".$docs['_id']."</td>";
	echo "<td class='align-middle'>".$docs['name']."</td>";
	echo "<td class='align-middle'>".$docs['address']."</td>";
	echo "<td class='align-middle'>".$docs['roll']."</td>";
	echo "<td class='align-middle'>".$docs['passingYear']."</td>";
	echo "<td class='align-middle'>".$docs['passingGrade']."</td>";
	echo "<td class='align-middle'>";
	?>
	<button class='btn btn-sm btn-primary' id="btn_edit" onclick="location.href='index.php?id='+<?php echo $docs['_id'];?>;">Edit</button>
	<?php
	echo "</td>";
	echo "<td class='align-middle'>";
	?>
	<button class="btn btn-sm btn-danger" onclick="location.href = 'delete.php?id='+<?php echo $docs['_id'];?>;">Delete</button>
	<?php
	echo "</td>";
	echo "</tr>";
}
?>
