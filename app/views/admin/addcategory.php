
	<h2>Add New Category</h2>
	<?php 
if (isset($msg)) {
    echo "<span style='color:green; font-weight:bold;'>".$msg."</span>";
}
 ?>
<form action="http://localhost/mvc/Category/insertCategory" method="post">
	<table>
		<tr>
			<td>Category Name</td>
			<td><input type="text" name="catName" required="1"></td>
		</tr>
		<tr>
			<td>Category Title</td>
			<td><input type="text" name="catTitle" required="1"></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="submit" value="Save"></td>
		</tr>
	</table>
</form>



