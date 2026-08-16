<?php
ob_start();
require('top.inc.php');
isAdmin();
$categories_id = '';
$name = '';
$mrp = '';
$price = '';
$qty = '';
$image = '';
$short_desc	= '';
$description	= '';
$meta_title	= '';
$meta_desc	= '';
$meta_keyword = '';
$best_seller = '';
$sub_categories_id = '';

$msg = '';
$image_required = 'required';
if (isset($_GET['id']) && $_GET['id'] != '') {
	$image_required = '';
	$id = get_safe_value($con, $_GET['id']);
	$res = mysqli_query($con, "select * from product where id='$id'");
	$check = mysqli_num_rows($res);
	if ($check > 0) {
		$row = mysqli_fetch_assoc($res);
		$categories_id = $row['categories_id'];
		$sub_categories_id = $row['sub_categories_id'];
		$name = $row['name'];
		$mrp = $row['mrp'];
		$price = $row['price'];
		$qty = $row['qty'];
		$short_desc = $row['short_desc'];
		$description = $row['description'];
		$meta_title = $row['meta_title'];
		$meta_desc = $row['meta_desc'];
		$meta_keyword = $row['meta_keyword'];
		$best_seller = $row['best_seller'];
	} else {
		header('location:product.php');
		die();
	}
}

if (isset($_POST['submit'])) {
	$categories_id = get_safe_value($con, $_POST['categories_id']);
	$sub_categories_id = get_safe_value($con, $_POST['sub_categories_id']);
	$name = get_safe_value($con, $_POST['name']);
	$mrp = get_safe_value($con, $_POST['mrp']);
	$price = get_safe_value($con, $_POST['price']);
	$qty = get_safe_value($con, $_POST['qty']);
	$short_desc = get_safe_value($con, $_POST['short_desc']);
	$description = get_safe_value($con, $_POST['description']);
	$meta_title = get_safe_value($con, $_POST['meta_title']);
	$meta_desc = get_safe_value($con, $_POST['meta_desc']);
	$meta_keyword = get_safe_value($con, $_POST['meta_keyword']);
	$best_seller = get_safe_value($con, $_POST['best_seller']);

	$res = mysqli_query($con, "select * from product where name='$name'");
	$check = mysqli_num_rows($res);
	if ($check > 0) {
		if (isset($_GET['id']) && $_GET['id'] != '') {
			$getData = mysqli_fetch_assoc($res);
			if ($id == $getData['id']) {
			} else {
				$msg = "Product already exist";
			}
		} else {
			$msg = "Product already exist";
		}
	}

	if (isset($_GET['id']) && $_GET['id'] == 0) {
		if ($_FILES['image']['type'] != 'image/png' && $_FILES['image']['type'] != 'image/jpg' && $_FILES['image']['type'] != 'image/jpeg') {
			$msg = "Please select only png,jpg and jpeg image formate";
		}
	} else {
		if ($_FILES['image']['type'] != '') {
			if ($_FILES['image']['type'] != 'image/png' && $_FILES['image']['type'] != 'image/jpg' && $_FILES['image']['type'] != 'image/jpeg') {
				$msg = "Please select only png,jpg and jpeg image formate";
			}
		}
	}

	if ($msg == '') {
		if (isset($_GET['id']) && $_GET['id'] != '') {
			if ($_FILES['image']['name'] != '') {
				$old_res = mysqli_query($con, "select image from product where id='$id'");
				if (mysqli_num_rows($old_res) > 0) {
					$old_row = mysqli_fetch_assoc($old_res);
					$old_image = $old_row['image'];
					if ($old_image != '' && file_exists(PRODUCT_IMAGE_SERVER_PATH . $old_image)) {
						unlink(PRODUCT_IMAGE_SERVER_PATH . $old_image);
					}
				}
				$image = rand(111111111, 999999999) . '_' . $_FILES['image']['name'];
				move_uploaded_file($_FILES['image']['tmp_name'], PRODUCT_IMAGE_SERVER_PATH . $image);
				$update_sql = "update product set categories_id='$categories_id',name='$name',mrp='$mrp',price='$price',qty='$qty',short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword',image='$image',best_seller='$best_seller',sub_categories_id='$sub_categories_id' where id='$id'";
			} else {
				$update_sql = "update product set categories_id='$categories_id',name='$name',mrp='$mrp',price='$price',qty='$qty',short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword',best_seller='$best_seller',sub_categories_id='$sub_categories_id' where id='$id'";
			}
			mysqli_query($con, $update_sql);
			set_flash('msg', 'Product updated successfully ✅');
		} else {
			$image = rand(111111111, 999999999) . '_' . $_FILES['image']['name'];
			move_uploaded_file($_FILES['image']['tmp_name'], PRODUCT_IMAGE_SERVER_PATH . $image);
			mysqli_query($con, "insert into product(categories_id,name,mrp,price,qty,short_desc,description,meta_title,meta_desc,meta_keyword,status,image,best_seller,sub_categories_id) values('$categories_id','$name','$mrp','$price','$qty','$short_desc','$description','$meta_title','$meta_desc','$meta_keyword',1,'$image','$best_seller','$sub_categories_id')");
			set_flash('msg', 'Product added successfully ✅');
		}
		header('location:product.php');
		die();
	}
}
?>
<style>
.cms-product-editor {
    font-family: 'Open Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}
.cms-card {
    background: #ffffff;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
    overflow: hidden;
    transition: all 0.2s ease-in-out;
}
.cms-card:hover {
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.05);
}
.cms-card-header {
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
    padding: 14px 20px;
    font-weight: 700;
    font-size: 15px;
    color: #1e293b;
    display: flex;
    align-items: center;
}
.cms-card-body {
    padding: 20px;
}
.cms-label {
    font-weight: 600;
    font-size: 12px;
    color: #475569;
    margin-bottom: 6px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.cms-input {
    border: 1.5px solid #cbd5e1;
    border-radius: 8px;
    padding: 10px 14px;
    font-size: 14px;
    color: #0f172a;
    transition: border-color 0.2s, box-shadow 0.2s;
}
.cms-input:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
    outline: none;
}
.input-group-text {
    background: #f1f5f9;
    border: 1.5px solid #cbd5e1;
    border-right: none;
    border-top-left-radius: 8px;
    border-bottom-left-radius: 8px;
    color: #64748b;
    font-weight: 600;
}
.input-group .cms-input {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}
</style>

<div class="content pb-4 cms-product-editor">
	<div class="animated fadeIn">
		<form method="post" enctype="multipart/form-data">
			<!-- Header Action Bar -->
			<div class="d-flex justify-content-between align-items-center mb-4 p-3 bg-white rounded-3 shadow-sm border" style="border-radius: 12px;">
				<div>
					<h4 class="mb-0 fw-bold text-dark">
						<i class="fa fa-cube text-primary mr-2"></i>
						<?php echo (isset($_GET['id']) && $_GET['id']!='') ? 'Edit Product' : 'Add New Product'; ?>
					</h4>
					<small class="text-muted">Manage product details, pricing, categorization and SEO metadata</small>
				</div>
				<div>
					<a href="product.php" class="btn btn-outline-secondary btn-sm mr-2" style="border-radius: 8px; padding: 6px 16px; font-weight: 600;">
						<i class="fa fa-arrow-left mr-1"></i> Back to Products
					</a>
					<button name="submit" type="submit" class="btn btn-primary btn-sm px-4" style="border-radius: 8px; background: linear-gradient(135deg, #0284c7 0%, #2563eb 100%); border: none; font-weight: 600; padding: 6px 20px;">
						<i class="fa fa-check mr-1"></i> Save Product
					</button>
				</div>
			</div>

			<?php if($msg != '') { ?>
				<div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4" role="alert" style="border-radius: 10px;">
					<i class="fa fa-exclamation-triangle mr-2"></i> <?php echo $msg; ?>
				</div>
			<?php } ?>

			<div class="row">
				<!-- Main Left Column (8 Columns) -->
				<div class="col-lg-8">
					<!-- General Product Info Card -->
					<div class="cms-card mb-4">
						<div class="cms-card-header">
							<i class="fa fa-file-text-o text-primary mr-2"></i> Product Information
						</div>
						<div class="cms-card-body">
							<div class="form-group mb-3">
								<label class="cms-label">Product Name <span class="text-danger">*</span></label>
								<input type="text" name="name" placeholder="Enter product title e.g. Premium Cotton Onesie" class="form-control cms-input" required value="<?php echo $name ?>">
							</div>

							<div class="form-group mb-3">
								<label class="cms-label">Short Description <span class="text-danger">*</span></label>
								<textarea name="short_desc" rows="3" placeholder="Brief summary displayed on product cards and listings..." class="form-control cms-input" required><?php echo $short_desc ?></textarea>
							</div>

							<div class="form-group mb-0">
								<label class="cms-label">Full Description <span class="text-danger">*</span></label>
								<textarea name="description" rows="6" placeholder="Detailed product specifications, materials, sizing, and features..." class="form-control cms-input" required><?php echo $description ?></textarea>
							</div>
						</div>
					</div>

					<!-- Pricing & Inventory Card -->
					<div class="cms-card mb-4">
						<div class="cms-card-header">
							<i class="fa fa-tag text-success mr-2"></i> Pricing & Inventory
						</div>
						<div class="cms-card-body">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group mb-3 mb-md-0">
										<label class="cms-label">MRP (Original Price) <span class="text-danger">*</span></label>
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text">₹</span></div>
											<input type="text" name="mrp" placeholder="0.00" class="form-control cms-input" required value="<?php echo $mrp ?>">
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group mb-3 mb-md-0">
										<label class="cms-label">Selling Price <span class="text-danger">*</span></label>
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text">₹</span></div>
											<input type="text" name="price" placeholder="0.00" class="form-control cms-input" required value="<?php echo $price ?>">
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group mb-0">
										<label class="cms-label">Stock Quantity <span class="text-danger">*</span></label>
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-cubes"></i></span></div>
											<input type="text" name="qty" placeholder="0" class="form-control cms-input" required value="<?php echo $qty ?>">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- SEO Metadata Card -->
					<div class="cms-card mb-4">
						<div class="cms-card-header">
							<i class="fa fa-globe text-info mr-2"></i> Search Engine Optimization (SEO)
						</div>
						<div class="cms-card-body">
							<div class="form-group mb-3">
								<label class="cms-label">Meta Title</label>
								<input type="text" name="meta_title" placeholder="SEO title for search engine result pages" class="form-control cms-input" value="<?php echo $meta_title ?>">
							</div>
							<div class="form-group mb-3">
								<label class="cms-label">Meta Description</label>
								<textarea name="meta_desc" rows="2" placeholder="SEO description snippet..." class="form-control cms-input"><?php echo $meta_desc ?></textarea>
							</div>
							<div class="form-group mb-0">
								<label class="cms-label">Meta Keywords</label>
								<textarea name="meta_keyword" rows="2" placeholder="Keywords separated by comma e.g. baby, onesie, organic" class="form-control cms-input"><?php echo $meta_keyword ?></textarea>
							</div>
						</div>
					</div>
				</div>

				<!-- Right Sidebar Column (4 Columns) -->
				<div class="col-lg-4">
					<!-- Categorization Card -->
					<div class="cms-card mb-4">
						<div class="cms-card-header">
							<i class="fa fa-sitemap text-warning mr-2"></i> Categorization
						</div>
						<div class="cms-card-body">
							<div class="form-group mb-3">
								<label class="cms-label">Category <span class="text-danger">*</span></label>
								<select class="form-control cms-input" name="categories_id" id="categories_id" onchange="get_sub_cat('')" required>
									<option value="">Select Category</option>
									<?php
									$res = mysqli_query($con, "select id,categories from categories order by categories asc");
									while ($row = mysqli_fetch_assoc($res)) {
										if ($row['id'] == $categories_id) {
											echo "<option selected value=" . $row['id'] . ">" . $row['categories'] . "</option>";
										} else {
											echo "<option value=" . $row['id'] . ">" . $row['categories'] . "</option>";
										}
									}
									?>
								</select>
							</div>

							<div class="form-group mb-3">
								<label class="cms-label">Sub Category</label>
								<select class="form-control cms-input" name="sub_categories_id" id="sub_categories_id">
									<option value="">Select Sub Category</option>
								</select>
							</div>

							<div class="form-group mb-0">
								<label class="cms-label">Best Seller <span class="text-danger">*</span></label>
								<select class="form-control cms-input" name="best_seller" required>
									<option value=''>Select</option>
									<?php
									if ($best_seller == 1) {
										echo '<option value="1" selected>Yes ⭐</option>
												<option value="0">No</option>';
									} elseif ($best_seller == 0) {
										echo '<option value="1">Yes ⭐</option>
												<option value="0" selected>No</option>';
									} else {
										echo '<option value="1">Yes ⭐</option>
												<option value="0">No</option>';
									}
									?>
								</select>
							</div>
						</div>
					</div>

					<!-- Product Image Card -->
					<div class="cms-card mb-4">
						<div class="cms-card-header">
							<i class="fa fa-picture-o text-purple mr-2"></i> Product Media
						</div>
						<div class="cms-card-body text-center">
							<div class="image-preview-wrapper mb-3" style="border: 2px dashed #cbd5e1; border-radius: 12px; padding: 15px; background: #f8fafc; position: relative; min-height: 140px; display: flex; align-items: center; justify-content: center;">
								<?php if($image != '') { ?>
									<img id="img_preview" src="<?php echo PRODUCT_IMAGE_SITE_PATH . $image; ?>" style="max-height: 180px; max-width: 100%; border-radius: 8px; object-fit: contain;" />
									<div id="upload_placeholder" style="display: none;"></div>
								<?php } else { ?>
									<img id="img_preview" src="" style="max-height: 180px; max-width: 100%; border-radius: 8px; object-fit: contain; display: none;" />
									<div id="upload_placeholder" class="py-3 text-muted">
										<i class="fa fa-cloud-upload fa-3x text-secondary mb-2"></i>
										<p class="small mb-0">Selected image will preview here</p>
									</div>
								<?php } ?>
							</div>
							<div class="form-group mb-0 text-left">
								<label class="cms-label">Main Image <span class="text-danger">*</span></label>
								<input type="file" name="image" id="product_image_input" class="form-control cms-input" <?php echo $image_required ?> onchange="previewImage(this)">
								<small class="text-muted mt-1 d-block">Allowed formats: PNG, JPG, JPEG</small>
							</div>
						</div>
					</div>

					<!-- Submit Action Card -->
					<div class="cms-card mb-4">
						<div class="cms-card-body p-3">
							<button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-primary btn-block py-2 fw-bold" style="background: linear-gradient(135deg, #0284c7 0%, #2563eb 100%); border: none; border-radius: 10px; font-size: 16px;">
								<i class="fa fa-save mr-1"></i> Save Changes
							</button>
							<div class="field_error mt-2 text-center text-danger"><?php echo $msg ?></div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<script>
	function previewImage(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				var img = document.getElementById('img_preview');
				var placeholder = document.getElementById('upload_placeholder');
				img.src = e.target.result;
				img.style.display = 'block';
				if (placeholder) placeholder.style.display = 'none';
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

	function get_sub_cat(sub_cat_id) {
		var categories_id = jQuery('#categories_id').val();
		jQuery.ajax({
			url: 'get_sub_cat.php',
			type: 'post',
			data: 'categories_id=' + categories_id + '&sub_cat_id=' + sub_cat_id,
			success: function(result) {
				jQuery('#sub_categories_id').html(result);
			}
		});
	}
</script>

<?php
require('footer.inc.php');
?>
<script>
	<?php
	if (isset($_GET['id'])) {
	?>
		get_sub_cat('<?php echo $sub_categories_id ?>');
	<?php } ?>
</script>