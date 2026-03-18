<?php
require('top.inc.php');
isAdmin();
$sql = "select * from users order by id desc";
$res = mysqli_query($con, $sql);
?>
<div class="content pb-0">
	<div class="orders">
		<div class="row">
			<div class="col-xl-12">
				<div class="card">
					<div class="card-body">
						<h4 class="box-title">Order Master </h4>
					</div>
					<div class="card-body--">
						<div class="table-stats order-table ov-h">
							<table class="table">
								<thead>
									<tr>
										<th class="product-thumbnail">Order ID</th>
										<th class="product-name"><span class="nobr">Order Date</span></th>
										<th class="product-price"><span class="nobr"> Address </span></th>
										<th class="product-stock-stauts"><span class="nobr"> Payment Type </span></th>
										<th class="product-stock-stauts"><span class="nobr"> Payment Status </span></th>
										<th class="product-stock-stauts"><span class="nobr"> Order Status </span></th>
									</tr>
								</thead>
								<tbody>
									<?php
									$res = mysqli_query($con, "select `order`.*,order_status.name as order_status_str from `order`,order_status where order_status.id=`order`.order_status");
									while ($row = mysqli_fetch_assoc($res)) {
									?>
										<tr>
											<td class="product-add-to-cart"><a href="order_master_detail.php?id=<?php echo $row['id'] ?>">ORDER#<?php echo $row['id'] ?></a><br />
												<a href="../order_pdf.php?id=<?php echo $row['id'] ?>">PDF</a>
											</td>
											<td class="product-name"><?php echo $row['added_on'] ?></td>
											<td class="product-name">
												<?php echo $row['address'] ?><br />
												<?php echo $row['city'] ?><br />
												<?php echo $row['pincode'] ?>
											</td>
											<td class="product-name"><?php echo $row['payment_type'] ?></td>
											<td class="product-name">
												<?php
												$status = strtolower($row['payment_status']);
												if ($status == 'pending') {
													echo "<span class='badge badge-pill badge-dark'>" . $row['payment_status'] . "</span>";
												} elseif ($status == 'success') {
													echo "<span class='badge badge-pill badge-success'>" . $row['payment_status'] . "</span>";
												} else {
													echo "<span class='badge badge-pill badge-danger'>" . $row['payment_status'] . "</span>";
												}
												?>
											</td>
											<td class="product-name">
												<?php
												$status = strtolower($row['order_status_str']);

												if ($status == 'pending') {
													echo "<span class='badge badge-pill badge-primary'>" . $row['order_status_str'] . "</span>";
												} elseif ($status == 'processing') {
													echo "<span class='badge badge-pill badge-info'>" . $row['order_status_str'] . "</span>";
												} elseif ($status == 'shipped') {
													echo "<span class='badge badge-pill badge-secondary'>" . $row['order_status_str'] . "</span>";
												} elseif ($status == 'complete') {
													echo "<span class='badge badge-pill badge-success'>" . $row['order_status_str'] . "</span>";
												} else {
													echo "<span class='badge badge-pill badge-danger'>" . $row['order_status_str'] . "</span>";
												}
												?>
											</td>

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