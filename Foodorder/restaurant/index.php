<?php

	include "../include/connection.php";
	include "../include/nav.php";

	if (!isset($_SESSION['restaurantid']) && !isset($_COOKIE['restaurantcookie']) && !isset($_GET['restaurantid'])){
        header("location: login.php");
    }


    //setting the value of restaurantid
    if (isset($_GET['restaurantid'])) {
    	$restaurantid=$_GET['restaurantid'];
    }elseif (isset($_COOKIE['restaurantcookie'])) {
    	$restaurantid=$_COOKIE['restaurantcookie'];
    }elseif (isset($_SESSION['restaurantid'])) {
    	$restaurantid=$_SESSION['restaurantid'];
    }
    $query="SELECT * from restaurants where id=$restaurantid;";
    if ($conn->query($query)) {
    	$result=$conn->query($query);
    	$row=$result->fetch_assoc();
    	$pic=$row['pic'];
    	$restaurantname=$row['name'];
    }
    $query="SELECT * from food where restaurantId=$restaurantid;";

?>


		<div class="restaurantpic">
			<img src="img/<?php echo $pic ?>">
			<?php
				if (isset($_SESSION['restaurantid']) || isset($_COOKIE['restaurantcookie'])) {
					echo "<a href='upload.php'>Change Restaurant Picture</a>";
				}
			?>
			
		</div>
	
	<div class="signup">
		
			
		
			<?php echo "<h2 class='restaurants'>$restaurantname</h1>
		<a href='../user/mycart.php?restaurantid=$restaurantid' class='cart'><h1>My Cart</a> </h1>"; ?>
		
		
			
		<div class="item">
			<?php

				
				if ($conn->query($query)) {
					$result=$conn->query($query);
					$i = 0;
					while ($row=$result->fetch_assoc()) {
						$foodid=$row['id'];
						$name=$row['name'];
						$price=$row['price'];
						$ingredients=$row['ingredients'];
						// $foodno=$row['foodno'];
						$i++;
						?>

					<div class="singleitem">
						<?php echo 
						"<div class='name-price'>
							<p class='foodname'>$i. $name</p>
							<p class='price'>$price Tk</p>
						</div>";
						echo 
						"<div class='ingredients'>
							<p>$ingredients</p>";
						if (!isset($_SESSION['restaurantid']) && !isset($_COOKIE['restaurantcookie'])) {
								echo 
							"<form action='../user/cart.php?foodid=$foodid&restaurantid=$restaurantid' method='post'>
								Quantity
								<input type='text' name='quantity' value='1'><br>
								<button type='submit' name='add'>Add</button>
							</form>
						";
						}
						echo "</div>"?>
					</div>		
			<?php	echo "<hr>";	
					}
				}
			?>
			
		</div>
	</div>
</body>
</html>