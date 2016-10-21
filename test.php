<?php include 'inc/header.php'; ?>
<div class="main">
<h1>Welcome to Online Exam</h1>
	<div class="test">
		<form method="post" action="">
		<table> 
			<tr>
				<td colspan="2">
				 <h3>Que 1: What is the first event that will be triggered in the from?</h3>
				</td>
			</tr>

			<tr>
				<td>
				 <input type="radio" name="ans1"/>Load
				</td>
			</tr>
			<tr>
				<td> 
				<input type="radio" name="ans2"/>GotFocus
				</td>
			</tr>
			<tr>
				<td>
					<input type="radio" name="ans3"/>Instance
				</td>
			</tr>
			<tr>
				<td>
					<input type="radio" name="ans4"/>Initialize
				</td>
			</tr>

			<tr>
			  <td>
				<input type="submit" name="submit" value="Next Question"/>
				<input type="hidden" name="number"/>
			</td>
			</tr>
			
		</table>
</div>
 </div>
<?php include 'inc/footer.php'; ?>