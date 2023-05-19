
<?php include('check.php');define("TITLE", "Dashboard"); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="style.css">

	<title>Owner | <?php if (TITLE !== "") {
							echo TITLE;
						} ?>
	</title>
</head>

<body style="top: 0px;">
	<?php require 'include/sidebar.php'; ?>
	<!-- CONTENT -->
	<section id="content">
	<?php require 'include/topbar.php'; ?>
	<div class="loader"></div>
		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1><?php if (TITLE !== "") {
                        echo TITLE;
                    } ?></h1>
				</div>
				<ul class="breadcrumb">
					<a href="#">Owner</a>
					<span class="text-primary ps-2 pe-2">></span>
					<a class="active" href="#"><?php if (TITLE !== "") {echo TITLE;} ?></a>					
				</ul>
				<!-- <a href="#" class="btn-download">
					<i class='bx bxs-cloud-download'></i>
					<span class="text">Download REPORT</span>
				</a> -->
			</div>
<?php 
	$firstDate = date('Y-m-01');

	// Get the last date of the current month
	$lastDate = date('Y-m-t');

	$sql_q_for_total_member = "SELECT COUNT(member_id) as count_m FROM member";
	$sql_q_for_liter_month = "SELECT SUM(`liter` * 1) as liter_month FROM milk_collection WHERE created_date BETWEEN '$firstDate 00:00:01' AND '$lastDate 21:59:59'";
	$sql_q_for_total_month = "SELECT SUM(`total` * 1) as total_month FROM milk_collection WHERE created_date BETWEEN '$firstDate 00:00:01' AND '$lastDate 21:59:59'";
	$sql_q_for_direct_sell_month = "SELECT SUM(`total` * 1) as direct_sell_month FROM direct_sell WHERE created_at BETWEEN '$firstDate 00:00:01' AND '$lastDate 21:59:59'";

	$result_member = mysqli_query($conn, $sql_q_for_total_member);
	$row_member = mysqli_fetch_assoc($result_member);
	$member_count= $row_member['count_m'];

	$result_total_month = mysqli_query($conn, $sql_q_for_total_month);
	$row_total_month = mysqli_fetch_assoc($result_total_month);
	$total_month= $row_total_month['total_month'];
	$total_month= round($total_month,2);	

	$result_liter_month = mysqli_query($conn, $sql_q_for_liter_month);
	$row_liter_month = mysqli_fetch_assoc($result_liter_month);
	$liter_month= $row_liter_month['liter_month'];

	$result_direct_sell_month = mysqli_query($conn, $sql_q_for_direct_sell_month);
	$row_direct_sell_month = mysqli_fetch_assoc($result_direct_sell_month);
	$direct_sell_month= $row_direct_sell_month['direct_sell_month'];




?>
			<ul class="box-info">
				<li>
					<i class='bx bxs-group'></i>
					<span class="text">
						<h3><?php echo $member_count; ?></h3>
						<p>Registered <br> Member</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-collection'></i>
					<span class="text">
						<h3><?php echo $liter_month; ?> Liter's</h3>
						<p>Milk Collection</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-dollar-circle'></i>
					<span class="text">
						<h3>₹ <?php echo $total_month; ?></h3>
						<p>Profit</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-dollar-circle'></i>
					<span class="text">
						<h3>₹ <?php echo $direct_sell_month; ?></h3>
						<p>Direct Sale</p>
					</span>
				</li>
			</ul>


			<div style="width: 100%;" class="table-data">
			<!-- CHARTS STARTS HERE -->
				<div class="charts mb-5">
					<div class="charts__left">
						<div class="charts__left__title">
							<div>
								<h1>Yearly stats report</h1>
							</div>
							<i class="fa fa-usd" aria-hidden="true"></i>
						</div>
						<div id="apex1"></div>
					</div>
				</div>
			<!-- CHARTS ENDS HERE -->


				

				
			</div>

			<div style="width: 100%;" class="table-data">
				<?php

				$sql_member_fetch = "SELECT m.name, m.member_id, mc.liter, mc.animal_category AS animal_type,mc.created_date as time  FROM member AS m LEFT JOIN milk_collection AS mc ON m.member_id = mc.member_id AND DATE(mc.created_date) = CURDATE() WHERE m.is_active = 1 ORDER BY mc.created_date DESC";

				$result_member_fetch = mysqli_query($conn, $sql_member_fetch);
				$count_of_done = 0;
				$count_of_notdone = 0;
				while ($row_member_fetch = mysqli_fetch_assoc($result_member_fetch) ) {
					if($row_member_fetch['liter']!=''){
					$count_of_done++;
					}else{
						$count_of_notdone++;
					}
				}
				?>


			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->

	<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
	<script src="script.js"></script>
	<?php
			
		$sql_chart="SELECT MONTHNAME(created_date) AS month, YEAR(created_date) AS year,animal_category,SUM(liter) AS total_liter FROM milk_collection WHERE animal_category IN ('cow', 'buffalo') GROUP BY MONTH(created_date), YEAR(created_date), animal_category ORDER BY YEAR(created_date), MONTH(created_date)";

		// Loop through the query results and populate the arrays
		$result = $conn->query($sql_chart);

		// Initialize arrays to store data for cow and buffalo
		$cowData = array_fill(0, 12, 0);
		$buffaloData = array_fill(0, 12, 0);

		// Loop through the query results and populate the arrays
		while ($row = $result->fetch_assoc()) {
			$month = (int)date('m', strtotime($row["month"]));
			$category = $row["animal_category"];
			$totalLiter = (float)$row["total_liter"];

			if ($category == "cow") {
				$cowData[$month - 1] = $totalLiter;
			} elseif ($category == "buffalo") {
				$buffaloData[$month - 1] = $totalLiter;
			}
		}
		// echo '<pre>';
		// echo $cowDataJson = json_encode($cowData);
		// echo $buffaloDataJson = json_encode($buffaloData);
			echo '<script>
				var options = {
					series: [
					{
						name: "Cow",
						data: ' . json_encode($cowData) . ',
					},
					{
						name: "Buffalo",
						data: ' . json_encode($buffaloData) . ',
					},
					//   {
					// 	name: "Direct Sell",
					// 	data: [60,35, 41, 36, 26, 45, 48, 52, 53, 41,76,90],
					//   },
					],
					chart: {
					type: "bar",
					height: 250, // make this 250
					//   sparkline: {
					// 	enabled: true, // make this true
					//   },
						stacked: true,
					},
					plotOptions: {
					bar: {
						horizontal: false,
						columnWidth: "55%",
						endingShape: "rounded",
					},
					dataLabels: {
							total: {
								enabled: true,
								offsetX: 0,
								style: {
								fontSize: "13px",
								fontWeight: 900
								}
							}
							}
					},
					// dataLabels: {
					//   enabled: true,
					// },
					stroke: {
					show: true,
					width: 2,
					colors: ["transparent"],
					},
					xaxis: {
					categories: ["Jan","Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct","Nov","Dec"],
					},
					yaxis: {
					title: {
						text: "Collection in Liter`s",
					},
					},
					fill: {
					opacity: 1,
					},
					tooltip: {
					y: {
						formatter: function (val) {
						return val + " Liters";
						},
					},
					},
				};
				
				var chart = new ApexCharts(document.querySelector("#apex1"), options);
				chart.render();

		

			</script>';
	?>
	<!-- START CODE FOR CHART -->
	<!-- END CODE FOR CHART -->

</body>

</html>