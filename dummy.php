<!DOCTYPE html>
<html>
	<head>
		<title>Insert, Update, Delete and View</title>
		<style>
			table
			{
				border-collapse: collapse;
				text-align:center;
				width:50%;
				border:2px solid black;
			}
			
			th,tr,td
			{
				border:2px solid black;;
			}
			
			th
			{
				font-size:20px;
			}
			
			td
			{
				font-size:18px;
			}
		</style>
	</head>
	<body>
		<form method="POST">
		<br><br>
			<input type="text" name="sid" placeholder="Student ID">
			<br><br>
			
			<input type="text" name="sname" placeholder="Student Full Name">
			<br><br>
			
			<input type="password" name="pass" placeholder="Enter Password">
			<br><br>
			
			<input type="email" name="email" placeholder="E-mail Address">
			<br><br>
			
			<textarea rows="5" cols="40" name="address" placeholder="Insert Address Here"></textarea>
			<br><br>
			
			Date Of Birth :-<input type="date" name="dating">
			<br><br>
			
			Profile Pic :- <input type="file" name="files">
			<br><br>
			
			<input type="submit" name="submit" value="Insert">
			<input type="submit" name="update" value="Update">
			<input type="submit" name="delete" value="Delete">
			<input type="submit" name="view" value="View">
			<input type="submit" name="search" value="Search">
			<input type="submit" name="sort" value="Sort">
		</form>
		<?php
			error_reporting(E_PARSE);
			$rollno = $_REQUEST['sid'];
			$sname = $_REQUEST['sname'];
			$pass = $_REQUEST['pass'];
			$email = $_REQUEST['email'];
			$address = $_REQUEST['address'];
			$dating = $_REQUEST['dating'];
			$files = $_REQUEST['files'];

			if(isset($_REQUEST['submit']))
			{
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "dummydb";
				$conn = mysqli_connect($servername, $username, $password, $dbname);
	
				if (!$conn) 
				{
					die("Connection failed: " . mysqli_error());
				}

				$sql = "INSERT INTO dummy (rollno,sname,pass,email,address,dating,files) values($rollno,'$sname','$pass','$email','$address','$dating','$files')";

				if (mysqli_query($conn, $sql))
				{
					echo "<br> New Record Inserted successfully.....!";
				}
				
				else
				{
					echo "Failed To Insert";
				}
			}
			
			if(isset($_REQUEST['update']))
			{
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "dummydb";

				$conn = mysqli_connect($servername, $username, $password, $dbname);
				if (!$conn) 
				{
					die("Connection failed : " . mysqli_error());
				}

				$sql = "UPDATE dummy SET sname='$sname', pass='$pass', email='$email', address='$address', dating='$dating', files='$files' WHERE rollno=$rollno";
				if (mysqli_query($conn, $sql)) 
				{
					echo "<br>Record Updated Successfully....!";
				} 
				else
				{
					echo "Error updating Record";
				}
			}
			
			
			if(isset($_REQUEST['delete']))
			{	
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "dummydb";

				$conn = mysqli_connect($servername, $username, $password, $dbname);
				if (!$conn) 
				{
					die("Connection failed" . mysqli_error());
				}
				$sql = "DELETE FROM dummy WHERE rollno=$rollno";

				if (mysqli_query($conn, $sql)) 
				{
					echo "<br>Record Deleted Successfully....!";
				}
				else
				{
					echo "Error Deleting record";
				}
			}
			//header ("refresh:2.5; url=database.php");
			
			if(isset($_REQUEST['view']))
			{
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "dummydb";
				
				$conn = mysqli_connect($servername, $username, $password, $dbname);
				if (!$conn) 
				{
					die("Connection Failed" . mysqli_error());
				}

				$sql = "SELECT * FROM dummy";
				$result = mysqli_query($conn, $sql);

				if (mysqli_num_rows($result) > 0) 
				{
					echo "<table border='1'>";
					echo "<tr>
						<th><h4>Roll No</h4></th> 
						<th><h4>Student Name's</h4></th>
						<th><h4>Password</h4></th>
						<th><h4>Email Address</h4></th>
						<th><h4>Full Address</h4></th>
						<th><h4>Date Of Birth</h4></th>
						<th><h4>Files Name</h4></th>
					</tr>
					<br><br><br>";

					while($row = mysqli_fetch_assoc($result)) 
					{
						echo "<tr>
						<td>{$row['rollno']}</td>
						<td>{$row['sname']}</td>
						<td>{$row['pass']}</td>
						<td>{$row['email']}</td>
						<td>{$row['address']}</td>
						<td>{$row['dating']}</td>
						<td>{$row['files']}</td>
						</tr>";
					}
					echo "</table>";
				} 
				else
				{
					echo "0 results";								
				}
			}
			
			if(isset($_REQUEST['search']))
			{
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "dummydb";
				
				$conn = mysqli_connect($servername, $username, $password, $dbname);
				if (!$conn) 
				{
					die("Connection Failed" . mysqli_error());
				}
				
				$sql =  "SELECT * FROM dummy WHERE rollno LIKE '%{$rollno}%'";
				$result = mysqli_query($conn, $sql);

				if (mysqli_num_rows($result) > 0) 
				{
					echo "<table border='1'>";
					echo "<tr>
						<th><h4>Roll No</h4></th> 
						<th><h4>Student Name's</h4></th>
						<th><h4>Password</h4></th>
						<th><h4>Email Address</h4></th>
						<th><h4>Full Address</h4></th>
						<th><h4>Date Of Birth</h4></th>
						<th><h4>Files Name</h4></th>
					</tr>
					<br><br><br>";
					
					while ($row = mysqli_fetch_assoc($result))
					{
						echo "<tr>
						<td>{$row['rollno']}</td>
						<td>{$row['sname']}</td>
						<td>{$row['pass']}</td>
						<td>{$row['email']}</td>
						<td>{$row['address']}</td>
						<td>{$row['dating']}</td>
						<td>{$row['files']}</td>
						</tr>";
					}
					echo "</table>";
				}
				
				else
				{
					echo "0 results";								
				}
			}
			
			if(isset($_REQUEST['sort']))
			{
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "dummydb";
				$conn = mysqli_connect($servername, $username, $password, $dbname);
	
				if (!$conn) 
				{
					die("Connection failed: " . mysqli_error());
				}
				
				$sql = "SELECT * FROM dummy order by sname";
				$result = mysqli_query($conn, $sql);

				if (mysqli_num_rows($result) > 0) 
				{
					echo "<table border='1'>";
					echo "<tr>
						<th><h4>Roll No</h4></th> 
						<th><h4>Student Name's</h4></th>
						<th><h4>Password</h4></th>
						<th><h4>Email Address</h4></th>
						<th><h4>Full Address</h4></th>
						<th><h4>Date Of Birth</h4></th>
						<th><h4>Files Name</h4></th>
					</tr>
					<br><br><br>";

					while($row = mysqli_fetch_assoc($result)) 
					{
						echo "<tr>
						<td>{$row['rollno']}</td>
						<td>{$row['sname']}</td>
						<td>{$row['pass']}</td>
						<td>{$row['email']}</td>
						<td>{$row['address']}</td>
						<td>{$row['dating']}</td>
						<td>{$row['files']}</td>
						</tr>";
					}
					echo "</table>";
				} 
				else
				{
					echo "0 results";								
				}
			}
		?>
		
	</body>
</html>