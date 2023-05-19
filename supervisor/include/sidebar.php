	
    
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">


    <style>
        a{
            text-decoration: none;
        }
    </style>

    <!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-check-shield'></i>
			<span class="text">Supervisor</span>
		</a>
		<ul class="side-menu top ps-0">
			<li class="<?php if(TITLE=="Dashboard"){echo "active";} ?>">
				<a href="dashboard.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li class=" <?php if(TITLE=="Milk Collection"){echo "active";} ?>">
				<a href="milk_collection.php">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">Milk collection</span>
				</a>
			</li>
			<li class=" <?php if(TITLE=="Member"){echo "active";} ?>">
				<a href="member.php">
					<i class='bx bxs-user' ></i>
					<span class="text">Member</span>
				</a>
			</li>
			<li class=" <?php if(TITLE=="Message"){echo "active";} ?>">
				<a href="message.php">
					<i class='bx bxs-message-dots' ></i>
					<span class="text">Message</span>
				</a>
			</li>
			<li class=" <?php if(TITLE=="Direct Sell"){echo "active";} ?>">
				<a href="direct_sell.php">
					<i class='bx bxl-paypal' ></i>
					<span class="text">Direct Sell</span>
				</a>
			</li>
			<li class=" <?php if(TITLE=="Fat-Rate"){echo "active";} ?>">
				<a href="fat_rate.php">
					<i class='bx bx-money'></i>
					<span class="text">Fat-Rate</span>
				</a>
			</li>
			<li class=" <?php if(TITLE=="Receipt"){echo "active";} ?>">
				<a href="receipt.php">
					<i class='bx bx-receipt'></i>
					<span class="text">Receipt</span>
				</a>
			</li>
			<li class=" <?php if(TITLE=="Animal Health info"){echo "active";} ?>">
				<a href="animal_health_info.php">
					<i class='bx bx-health' ></i>
					<span class="text">Animal's health info</span>
				</a>
			</li>
			<!-- <li class=" <?php 
			// if(TITLE=="Setting"){echo "active";} 
			?>">
				<a href="setting.php">
				<i class='bx bx-cog'></i>
					<span class="text">Settings</span>
				</a>
			</li> -->
            <li>
                <a href="logout.php" class="logout">
                    <i class='bx bx-log-out' ></i>
                    <span class="text">Logout</span>
                </a>
            </li>
            <li>
				<!-- <div id="google_translate_element"></div> -->
            </li>
		</ul>
		
		
	</section>
	<!-- SIDEBAR -->

	<script>
		// document.getElementsByClassName('VIpgJd-ZVi9od-l4eHX-hSRGPd').style.visibility = 'hidden';
	</script>