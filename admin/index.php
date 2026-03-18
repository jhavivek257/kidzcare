<?php
require('top.inc.php');
isAdmin();
?>
<div class="content pb-0">
	<div class="container-fluid">

		<!-- Greeting -->
		<div class="row mb-4">
			<div class="col-md-12">
				<div class="welcome-box">
					<h3 style="text-transform: capitalize;">👋 Welcome Back, <?php echo $_SESSION['ADMIN_USERNAME']; ?></h3>
					<p>Manage your KidzCare store easily and track performance.</p>
				</div>
			</div>
		</div>

		<!-- /Widgets -->
		<div class="row">
			<div class="col-sm-6 col-lg-3">
				<div class="card text-white bg-flat-color-1">
					<div class="card-body">
						<div class="card-left pt-1 float-left">
							<h3 class="mb-0 fw-r">
								<span class="currency float-left mr-1">$</span>
								<span class="count">23569</span>
							</h3>
							<p class="text-light mt-1 m-0">Total Orders</p>
						</div><!-- /.card-left -->

						<div class="card-right float-right text-right">
							<i class="icon fade-5 icon-lg pe-7s-cart"></i>
						</div><!-- /.card-right -->

					</div>

				</div>
			</div>
			<!--/.col-->

			<div class="col-sm-6 col-lg-3">
				<div class="card text-white bg-flat-color-6">
					<div class="card-body">
						<div class="card-left pt-1 float-left">
							<h3 class="mb-0 fw-r">
								<span class="count float-left">85</span>
								<span>%</span>
							</h3>
							<p class="text-light mt-1 m-0">Total Products</p>
						</div><!-- /.card-left -->

						<div class="card-right float-right text-right">
							<div id="flotBar1" class="flotBar1"></div>
						</div><!-- /.card-right -->

					</div>

				</div>
			</div>
			<!--/.col-->

			<div class="col-sm-6 col-lg-3">
				<div class="card text-white bg-flat-color-3">
					<div class="card-body">
						<div class="card-left pt-1 float-left">
							<h3 class="mb-0 fw-r">
								<span class="count">6569</span>
							</h3>
							<p class="text-light mt-1 m-0">Total Users</p>
						</div><!-- /.card-left -->

						<div class="card-right float-right text-right">
							<i class="icon fade-5 icon-lg pe-7s-users"></i>
						</div><!-- /.card-right -->

					</div>

				</div>
			</div>
			<!--/.col-->

			<div class="col-sm-6 col-lg-3">
				<div class="card text-white bg-flat-color-2">
					<div class="card-body">
						<div class="card-left pt-1 float-left">
							<h3 class="mb-0 fw-r">
								<span class="count">1490</span>
							</h3>
							<p class="text-light mt-1 m-0">Total Revenue</p>
						</div><!-- /.card-left -->

						<div class="card-right float-right text-right">
							<div id="flotLine1" class="flotLine1"></div>
						</div><!-- /.card-right -->

					</div>

				</div>
			</div>
			<!--/.col-->
		</div><!-- .row -->

		<!-- Recent Orders Table -->
		<div class="row mt-4">
			<div class="col-md-12">
				<div class="card shadow-sm">

					<div class="card-header d-flex justify-content-between">
						<h5 class="mb-0">Recent Orders</h5>
						<a href="order_master.php" class="btn btn-sm btn-primary">View All</a>
					</div>

					<div class="card-body">

						<div class="table-responsive">
							<table class="table table-hover">

								<thead>
									<tr>
										<th>Order ID</th>
										<th>User</th>
										<th>Amount</th>
										<th>Status</th>
									</tr>
								</thead>

								<tbody>
									<tr>
										<td>#101</td>
										<td>Vivek</td>
										<td>₹500</td>
										<td><span class="badge badge-success">Completed</span></td>
									</tr>
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