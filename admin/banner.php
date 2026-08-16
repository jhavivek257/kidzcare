<?php
ob_start();
require('top.inc.php');
isAdmin();
if (isset($_GET['type']) && $_GET['type'] != '') {
	$type = get_safe_value($con, $_GET['type']);
	if ($type == 'status') {
		$operation = get_safe_value($con, $_GET['operation']);
		$id = get_safe_value($con, $_GET['id']);
		if ($operation == 'active') {
			$status = '1';
		} else {
			$status = '0';
		}
		$update_status_sql = "update banner set status='$status' where id='$id'";
		mysqli_query($con, $update_status_sql);
		set_flash('msg', 'Banner status updated successfully ✅');
	}

	if ($type == 'delete') {
		$id = get_safe_value($con, $_GET['id']);
		$res = mysqli_query($con, "select image from banner where id='$id'");
		if (mysqli_num_rows($res) > 0) {
			$row = mysqli_fetch_assoc($res);
			$image = $row['image'];
			if ($image != '' && file_exists(BANNER_SERVER_PATH . $image)) {
				unlink(BANNER_SERVER_PATH . $image);
			}
		}
		$delete_sql = "delete from banner where id='$id'";
		mysqli_query($con, $delete_sql);
		set_flash('msg', 'Banner deleted successfully ✅');
	}
}

$sql = "select * from banner order by id asc";
$res = mysqli_query($con, $sql);
?>
<div class="content pb-0">
	<div class="orders">
		<div class="row">
			<div class="col-xl-12">
				<div class="card">
					<div class="card-body d-flex justify-content-between align-items-center">
						<h4 class="box-title mb-0">Banner</h4>
						<a href="manage_banner.php" class="btn btn-info btn-sm">
							<i class="fa fa-plus"></i> Add Banner
						</a>
					</div>
					<div class="card-body--">
						<div class="table-stats order-table ov-h">
							<table class="table ">
								<thead>
									<tr>
										<th class="serial">#</th>
										<th>Heading1</th>
										<th>Heading2</th>
										<th>Btn Txt</th>
										<th>Btn Link</th>
										<th>Image</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									while ($row = mysqli_fetch_assoc($res)) { ?>
										<tr>
											<td class="serial"><?php echo $i++ ?></td>
											</td>
											<td><?php echo $row['heading1'] ?></td>
											<td><?php echo $row['heading2'] ?></td>
											<td><?php echo $row['btn_txt'] ?></td>
											<td><?php echo $row['btn_link'] ?></td>
											<td>
												<?php

												echo "<a target='_blank' href='" . BANNER_SITE_PATH . $row['image'] . "'><img width='150px' src='" . BANNER_SITE_PATH . $row['image'] . "'/></a>";
												?>
											</td>
											<td>
												<?php
												if ($row['status'] == 1) {
													echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=" . $row['id'] . "'>Active</a></span>&nbsp;";
												} else {
													echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=" . $row['id'] . "'>Deactive</a></span>&nbsp;";
												}
												echo "<span class='badge badge-edit'><a href='manage_banner.php?id=" . $row['id'] . "'>Edit</a></span>&nbsp;";

												echo "<span class='badge badge-delete'><a href='?type=delete&id=" . $row['id'] . "'onclick=\"return confirm('Are you sure you want to delete this banner?')\">Delete</a></span>";

												?>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
						<?php if ($msg = get_flash('msg')) { ?>
							<div id="myToast" class="myToast__msg">
								<?php echo $msg; ?>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
require('footer.inc.php');
?>