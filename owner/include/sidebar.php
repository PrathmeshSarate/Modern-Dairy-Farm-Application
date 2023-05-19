	
    
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
			<span class="text">Owner</span>
		</a>
		<ul class="side-menu top ps-0">
			<li class="<?php if(TITLE=="Dashboard"){echo "active";} ?>">
				<a href="dashboard.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li class=" <?php if(TITLE=="Member"){echo "active";} ?>">
				<a href="supervisor.php">
					<i class='bx bxs-user' ></i>
					<span class="text">Supervisor</span>
				</a>
			</li>
			<li class=" <?php if(TITLE=="Fat-Rate"){echo "active";} ?>">
				<a href="fat_rate.php">
					<i class='bx bx-money'></i>
					<span class="text">Fat-Rate</span>
				</a>
			</li>
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