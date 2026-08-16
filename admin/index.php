<?php
require('top.inc.php');
isAdmin();

// Dynamic Dashboard Data
$total_order_res = mysqli_query($con, "select count(*) as total from `order`");
$total_order_row = mysqli_fetch_assoc($total_order_res);
$total_orders = $total_order_row['total'] ?? 0;

$total_product_res = mysqli_query($con, "select count(*) as total from product");
$total_product_row = mysqli_fetch_assoc($total_product_res);
$total_products = $total_product_row['total'] ?? 0;

$total_user_res = mysqli_query($con, "select count(*) as total from users");
$total_user_row = mysqli_fetch_assoc($total_user_res);
$total_users = $total_user_row['total'] ?? 0;

$total_revenue_res = mysqli_query($con, "select sum(total_price) as total from `order` where order_status!=4");
$total_revenue_row = mysqli_fetch_assoc($total_revenue_res);
$total_revenue = $total_revenue_row['total'] ?? 0;

// Recent Orders
$recent_orders_res = mysqli_query($con, "select `order`.*, users.name as user_name, order_status.name as order_status_str from `order` left join users on `order`.user_id=users.id left join order_status on `order`.order_status=order_status.id order by `order`.id desc limit 5");
?>
<div class="content">
	<div class="container-fluid">

		<!-- Welcome Section -->
		<div class="row mb-4">
			<div class="col-12">
				<div class="greeting__dash">
					<h4 class="mb-1">👋 Welcome Back, <?php echo $_SESSION['ADMIN_USERNAME']; ?></h4>
					<p class="text-muted mb-0">Manage your KidzCare store easily.</p>
				</div>
			</div>
		</div>

		<!-- Dashboard Cards -->
		<div class="row g-4 kidz__dash">

			<!-- Orders -->
			<div class="col-md-3">
				<div class="card dashboard-card bg-gradient-primary">
					<div class="card-body d-flex justify-content-between align-items-center">
						<div>
							<p class="card-title">Total Orders</p>
							<h3 class="card-value"><?php echo number_format($total_orders); ?></h3>
							<span class="card-growth">All time orders</span>
						</div>
						<div class="icon-box">
							<i class="fa fa-shopping-cart"></i>
						</div>
					</div>
				</div>
			</div>

			<!-- Products -->
			<div class="col-md-3">
				<div class="card dashboard-card bg-gradient-success">
					<div class="card-body d-flex justify-content-between align-items-center">
						<div>
							<p class="card-title">Total Products</p>
							<h3 class="card-value"><?php echo number_format($total_products); ?></h3>
							<span class="card-growth">Active catalog</span>
						</div>
						<div class="icon-box">
							<i class="fa fa-cube"></i>
						</div>
					</div>
				</div>
			</div>

			<!-- Users -->
			<div class="col-md-3">
				<div class="card dashboard-card bg-gradient-info">
					<div class="card-body d-flex justify-content-between align-items-center">
						<div>
							<p class="card-title">Total Users</p>
							<h3 class="card-value"><?php echo number_format($total_users); ?></h3>
							<span class="card-growth">Total Users</span>
						</div>
						<div class="icon-box">
							<i class="fa fa-users"></i>
						</div>
					</div>
				</div>
			</div>

			<!-- Revenue -->
			<div class="col-md-3">
				<div class="card dashboard-card bg-gradient-warning">
					<div class="card-body d-flex justify-content-between align-items-center">
						<div>
							<p class="card-title">Total Revenue</p>
							<h3 class="card-value"><?php echo number_format($total_revenue, 2); ?></h3>
							<span class="card-growth">Net sales value</span>
						</div>
						<div class="icon-box">
							<i class="fa fa-inr"></i>
						</div>
					</div>
				</div>
			</div>

		</div>

		<!-- Recent Orders -->
		<div class="row mt-4">
			<div class="col-12">
				<div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">

					<div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
						<h6 class="mb-0 font-weight-bold"><i class="fa fa-list-alt text-primary mr-2"></i> Recent Orders</h6>
						<a href="order_master.php" class="btn btn-sm btn-outline-primary" style="border-radius: 6px;">View All Orders</a>
					</div>

					<div class="card-body p-0">

						<div class="table-stats order-table ov-h">
							<table class="table align-middle">

								<thead class="table-light">
									<tr>
										<th>Order ID</th>
										<th>Customer</th>
										<th>Amount</th>
										<th>Order Date</th>
										<th>Status</th>
									</tr>
								</thead>

								<tbody>
									<?php
									if (mysqli_num_rows($recent_orders_res) > 0) {
										while ($row = mysqli_fetch_assoc($recent_orders_res)) {
									?>
											<tr>
												<td>
													<a href="order_master_detail.php?id=<?php echo $row['id']; ?>" class="font-weight-bold text-primary">
														#ORDER<?php echo $row['id']; ?>
													</a>
												</td>
												<td><?php echo !empty($row['user_name']) ? $row['user_name'] : 'Guest Customer'; ?></td>
												<td>₹<?php echo number_format($row['total_price'], 2); ?></td>
												<td><?php echo date('d M Y', strtotime($row['added_on'])); ?></td>
												<td>
													<?php
													$status_str = $row['order_status_str'] ?? 'Pending';
													$status = strtolower($status_str);

													if ($status == 'pending') {
														echo "<span class='badge badge-pill badge-primary'>Pending</span>";
													} elseif ($status == 'processing') {
														echo "<span class='badge badge-pill badge-info'>Processing</span>";
													} elseif ($status == 'shipped') {
														echo "<span class='badge badge-pill badge-secondary'>Shipped</span>";
													} elseif ($status == 'complete') {
														echo "<span class='badge badge-pill badge-success'>Complete</span>";
													} else {
														echo "<span class='badge badge-pill badge-danger'>" . $status_str . "</span>";
													}
													?>
												</td>
											</tr>
										<?php
										}
									} else {
										?>
										<tr>
											<td colspan="5" class="text-center py-4 text-muted">No recent orders found</td>
										</tr>
									<?php } ?>
								</tbody>

							</table>
						</div>

					</div>

				</div>
			</div>
		</div>

	</div>
</div>
<?php
require('footer.inc.php');
?>
