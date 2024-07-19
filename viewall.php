					<table border=1>
                      <thead>
                        <tr>
						<th>CREDIT ID</th>
                        <th>DESCRIPTION</th>
						<th>FORCED SALE VALUE</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php	
						include 'connection.php';
						$query="SELECT top(100) creditID,Description,ForcedSaleValue FROM CreditSecurities";
						$result=  sqlsrv_query($conn,$query);
						while /*($row= mysqli_fetch_array($result)&&*/
						($row = sqlsrv_fetch_array($result)){  
						?>
						<tr bgcolor="">
							<td><?php echo $row["creditID"];?></td>			
							<td><?php echo $row["Description"];?></td>
							
							<td><?php echo $row["ForcedSaleValue"];?></td>
							
						</tr>
						 <?php 
						}
						 ?>
                      </tbody>
                    </table>