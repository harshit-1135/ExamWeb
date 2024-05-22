<?php 
session_start();
$servername = "localhost";
    $username = "root";
    $password = "Harshit2053@";
    $dbname = "examweb";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    
    $sql = "SELECT * FROM students where exam_id ='$_SESSION[exam_id]'";
    $result = $conn->query($sql);?>
<table width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th><span class="las la-sort"></span> Student Video</th>
                                    <th><span class="las la-sort"></span> Student Photo</th>
                                    <th><span class="las la-sort"></span> ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {    
	?>		
                                <tr>
                                    <td><?php echo $row["student_id"]?></td>
                                    <td>
                                        <div class="Exam-title">
                                
                                            <div class="Exam-title-info">
                                            <video autoplay="true" controls muted width="600" height="400" src="<?php echo $row["video"]; ?>" ></video>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                    <img src="<?php echo $row["photo"]; ?>"  alt="#">
                                    </td>
                                   
                                    <td>
                                        <div class="actions">
                                          <a href="warn.php?student_id=<?php echo $row['student_id'];?>"><span class="fa-solid fa-triangle-exclamation"></span></a> 
                                         <a href="cancel.php?student_id=<?php echo $row['student_id'];?>"><span class="fa-solid fa-trash"></span></a> 
                                        </div>
                                    </td>
                                </tr>
                                <?php	
		} 
	?>
    
                                
                                
                            </tbody>
                        </table>
                        <?php	
	} else {
			echo "0 results";
	}

	
$conn->close();
?>