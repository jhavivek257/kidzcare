<?php
require('top.php');
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
?>
	<script>
		window.location.href = 'index.php';
	</script>
	<?php
}

$cart_total = 0;

if (isset($_POST['submit'])) {
	$address = get_safe_value($con, $_POST['address']);
	$city = get_safe_value($con, $_POST['city']);
	$pincode = get_safe_value($con, $_POST['pincode']);
	$payment_type = get_safe_value($con, $_POST['payment_type']);
	$user_id = $_SESSION['USER_ID'];
	foreach ($_SESSION['cart'] as $key => $val) {
		$productArr = get_product($con, '', '', $key);
		$price = $productArr[0]['price'];
		$qty = $val['qty'];
		$cart_total = $cart_total + ($price * $qty);
	}
	$total_price = $cart_total;
	$payment_status = 'pending';
	if ($payment_type == 'cod') {
		$payment_status = 'success';
	}
	$order_status = '1';
	$added_on = date('Y-m-d h:i:s');

	$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);


	mysqli_query($con, "insert into `order`(user_id,address,city,pincode,payment_type,payment_status,order_status,added_on,total_price,txnid) values('$user_id','$address','$city','$pincode','$payment_type','$payment_status','$order_status','$added_on','$total_price','$txnid')");

	$order_id = mysqli_insert_id($con);

	foreach ($_SESSION['cart'] as $key => $val) {
		$productArr = get_product($con, '', '', $key);
		$price = $productArr[0]['price'];
		$qty = $val['qty'];

		mysqli_query($con, "insert into `order_detail`(order_id,product_id,qty,price) values('$order_id','$key','$qty','$price')");
	}

	unset($_SESSION['cart']);

	if ($payment_type == 'payu') {
		$hash_string = '';
		//$PAYU_BASE_URL = "https://secure.payu.in";
		$PAYU_BASE_URL = "https://test.payu.in";
		$action = '';
		$posted = array();
		if (!empty($_POST)) {
			foreach ($_POST as $key => $value) {
				$posted[$key] = $value;
			}
		}

		$userArr = mysqli_fetch_assoc(mysqli_query($con, "select * from users where id='$user_id'"));

		$formError = 0;
		$posted['txnid'] = $txnid;
		$posted['amount'] = $total_price;
		$posted['firstname'] = $userArr['name'];
		$posted['email'] = $userArr['email'];
		$posted['phone'] = $userArr['mobile'];
		$posted['productinfo'] = "productinfo";
		$posted['key'] = MERCHANT_KEY;
		$hash = '';
		$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
		if (empty($posted['hash']) && sizeof($posted) > 0) {
			if (
				empty($posted['key'])
				|| empty($posted['txnid'])
				|| empty($posted['amount'])
				|| empty($posted['firstname'])
				|| empty($posted['email'])
				|| empty($posted['phone'])
				|| empty($posted['productinfo'])

			) {
				$formError = 1;
			} else {
				$hashVarsSeq = explode('|', $hashSequence);
				foreach ($hashVarsSeq as $hash_var) {
					$hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
					$hash_string .= '|';
				}
				$hash_string .= SALT_KEY;
				$hash = strtolower(hash('sha512', $hash_string));
				$action = $PAYU_BASE_URL . '/_payment';
			}
		} elseif (!empty($posted['hash'])) {
			$hash = $posted['hash'];
			$action = $PAYU_BASE_URL . '/_payment';
		}


		$formHtml = '<form method="post" name="payuForm" id="payuForm" action="' . $action . '"><input type="hidden" name="key" value="' . MERCHANT_KEY . '" /><input type="hidden" name="hash" value="' . $hash . '"/><input type="hidden" name="txnid" value="' . $posted['txnid'] . '" /><input name="amount" type="hidden" value="' . $posted['amount'] . '" /><input type="hidden" name="firstname" id="firstname" value="' . $posted['firstname'] . '" /><input type="hidden" name="email" id="email" value="' . $posted['email'] . '" /><input type="hidden" name="phone" value="' . $posted['phone'] . '" /><textarea name="productinfo" style="display:none;">' . $posted['productinfo'] . '</textarea><input type="hidden" name="surl" value="' . SITE_PATH . 'payment_complete.php" /><input type="hidden" name="furl" value="' . SITE_PATH . 'payment_fail.php"/><input type="submit" style="display:none;"/></form>';
		echo $formHtml;
		echo '<script>document.getElementById("payuForm").submit();</script>';
	} else {

	?>
		<script>
			window.location.href = 'thank_you.php';
		</script>
<?php
	}
}
?>

<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/4.jpg) no-repeat scroll center center / cover ;">
	<div class="ht__bradcaump__wrap">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="bradcaump__inner">
						<nav class="bradcaump-inner">
							<a class="breadcrumb-item" href="index.php">Home</a>
							<span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
							<span class="breadcrumb-item active">checkout</span>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Bradcaump area -->
<style>
.accordion__title {
	cursor: pointer;
	background: #f8fafc;
	border: 1px solid #cbd5e1;
	padding: 14px 20px;
	border-radius: 8px;
	font-weight: 600;
	font-size: 15px;
	color: #1e293b;
	margin-top: 12px;
	margin-bottom: 0;
	transition: all 0.2s ease;
	display: flex;
	align-items: center;
	justify-content: space-between;
}
.accordion__title:hover, .accordion__title.active {
	background: #2563eb;
	color: #ffffff;
	border-color: #2563eb;
}
.accordion__title:hover small, .accordion__title.active small {
	color: #e2e8f0;
}
.accordion__hide {
	background: #f1f5f9;
	border: 1px solid #e2e8f0;
	padding: 14px 20px;
	border-radius: 8px;
	font-weight: 600;
	font-size: 15px;
	color: #94a3b8;
	margin-top: 12px;
	margin-bottom: 0;
	cursor: not-allowed;
	display: flex;
	align-items: center;
	justify-content: space-between;
}
.accordion__body {
	background: #ffffff;
	border: 1px solid #e2e8f0;
	border-top: none;
	padding: 20px;
	border-bottom-left-radius: 8px;
	border-bottom-right-radius: 8px;
}
.checkout-payment-box {
	display: flex;
	gap: 15px;
	margin-top: 10px;
}
.checkout-payment-option {
	border: 2px solid #cbd5e1;
	border-radius: 8px;
	padding: 10px 18px;
	cursor: pointer;
	transition: all 0.2s ease;
	display: flex;
	align-items: center;
	gap: 10px;
	font-weight: 600;
	color: #334155;
	background: #ffffff;
}
.checkout-payment-option:hover {
	border-color: #2563eb;
}
</style>

<div class="checkout-wrap ptb--50">
	<div class="container">
		<?php if ($msg = get_flash('msg')) { ?>
			<div id="myToast" class="alert alert-success" style="color: #155724; background-color: #d4edda; border-color: #c3e6cb; padding: 12px 20px; border-radius: 6px; margin-bottom: 20px; font-weight: 500;">
				<?php echo $msg; ?>
			</div>
			<script>
				setTimeout(() => {
					var toast = document.getElementById('myToast');
					if (toast) toast.style.display = 'none';
				}, 4000);
			</script>
		<?php } ?>
		<div class="row">
			<div class="col-md-8">
				<div class="checkout__inner">
					<div class="accordion-list">
						<div class="accordion">

							<?php
							$accordion_class = 'accordion__title';
							if (!isset($_SESSION['USER_LOGIN'])) {
								$accordion_class = 'accordion__hide';
							?>
								<div class="accordion__title active">
									<span><i class="fa fa-user mr-2"></i> 1. Checkout Method</span>
									<i class="fa fa-chevron-down"></i>
								</div>
								<div class="accordion__body">
									<div class="accordion__body__form">
										<div class="row">
											<div class="col-md-6">
												<div class="checkout-method__login">
													<form id="login-form" method="post">
														<h5 class="checkout-method__title font-weight-bold mb-3">Login to Account</h5>
														<div class="single-input mb-3">
															<input type="text" name="login_email" id="login_email" placeholder="Your Email*" class="form-control" style="width:100%">
															<span class="field_error" id="login_email_error"></span>
														</div>

														<div class="single-input mb-3">
															<input type="password" name="login_password" id="login_password" placeholder="Your Password*" class="form-control" style="width:100%">
															<span class="field_error" id="login_password_error"></span>
														</div>

														<p class="require text-muted small">* Required fields</p>
														<div class="dark-btn mt-3">
															<button type="button" class="fv-btn btn btn-primary" onclick="user_login()">Login</button>
														</div>
														<div class="form-output login_msg mt-2">
															<p class="form-messege field_error"></p>
														</div>
													</form>
												</div>
											</div>
											<div class="col-md-6">
												<div class="checkout-method__login">
													<form action="#">
														<h5 class="checkout-method__title font-weight-bold mb-3">Register New Account</h5>
														<div class="single-input mb-3">
															<input type="text" name="name" id="name" placeholder="Your Name*" class="form-control" style="width:100%">
															<span class="field_error" id="name_error"></span>
														</div>
														<div class="single-input mb-3">
															<input type="text" name="email" id="email" placeholder="Your Email*" class="form-control" style="width:100%">
															<span class="field_error" id="email_error"></span>
														</div>

														<div class="single-input mb-3">
															<input type="text" name="mobile" id="mobile" placeholder="Your Mobile*" class="form-control" style="width:100%">
															<span class="field_error" id="mobile_error"></span>
														</div>
														<div class="single-input mb-3">
															<input type="password" name="password" id="password" placeholder="Your Password*" class="form-control" style="width:100%">
															<span class="field_error" id="password_error"></span>
														</div>
														<div class="dark-btn mt-3">
															<button type="button" class="fv-btn btn btn-primary" onclick="user_register()">Register</button>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php } ?>

							<form method="post">
								<div class="<?php echo $accordion_class ?>">
									<span><i class="fa fa-map-marker mr-2"></i> <?php echo isset($_SESSION['USER_LOGIN']) ? '1.' : '2.'; ?> Address Information</span>
									<?php if (!isset($_SESSION['USER_LOGIN'])) { ?>
										<small><i class="fa fa-lock mr-1"></i> Please login to continue</small>
									<?php } else { ?>
										<i class="fa fa-chevron-down"></i>
									<?php } ?>
								</div>
								<div class="accordion__body">
									<div class="bilinfo">
										<div class="row">
											<div class="col-md-12 mb-3">
												<div class="single-input">
													<input type="text" name="address" placeholder="Street Address*" class="form-control" required>
												</div>
											</div>
											<div class="col-md-6 mb-3">
												<div class="single-input">
													<input type="text" name="city" placeholder="City / State*" class="form-control" required>
												</div>
											</div>
											<div class="col-md-6 mb-3">
												<div class="single-input">
													<input type="text" name="pincode" placeholder="Postcode / ZIP*" class="form-control" required>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="<?php echo $accordion_class ?>">
									<span><i class="fa fa-credit-card mr-2"></i> <?php echo isset($_SESSION['USER_LOGIN']) ? '2.' : '3.'; ?> Payment Information</span>
									<?php if (!isset($_SESSION['USER_LOGIN'])) { ?>
										<small><i class="fa fa-lock mr-1"></i> Please login to continue</small>
									<?php } else { ?>
										<i class="fa fa-chevron-down"></i>
									<?php } ?>
								</div>
								<div class="accordion__body">
									<div class="paymentinfo">
										<div class="checkout-payment-box mb-4">
											<label class="checkout-payment-option">
												<input type="radio" name="payment_type" value="COD" required />
												<span>Cash On Delivery (COD)</span>
											</label>
											<label class="checkout-payment-option">
												<input type="radio" name="payment_type" value="payu" required />
												<span>PayU Money (Online Payment)</span>
											</label>
										</div>
									</div>
									<div class="dark-btn mt-3">
										<button class="fv-btn btn btn-success px-4 py-2 font-weight-bold" type="submit" name="submit" style="border-radius: 8px;">
											<i class="fa fa-check-circle mr-1"></i> Place Order
										</button>
									</div>
								</div>
							</form>

						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="order-details">
					<h5 class="order-details__title">Your Order</h5>
					<div class="order-details__item">
						<?php
						$cart_total = 0;
						foreach ($_SESSION['cart'] as $key => $val) {
							$productArr = get_product($con, '', '', $key);
							$pname = $productArr[0]['name'];
							$mrp = $productArr[0]['mrp'];
							$price = $productArr[0]['price'];
							$image = $productArr[0]['image'];
							$qty = $val['qty'];
							$cart_total = $cart_total + ($price * $qty);
							$mrp_total = $cart_total + ($mrp * $qty);
						?>
							<div class="single-item">
								<div class="single-item__thumb">
									<img src="<?php echo PRODUCT_IMAGE_SITE_PATH . $image ?>" height="50px" width="50px" />
								</div>
								<div class="single-item__content">
									<a href="#"><?php echo $pname ?></a>
									<ul class="pro__prize">
										<li class="old__prize">₹<?php echo $mrp * $qty ?></li>
										<li>₹<?php echo $price * $qty ?></li>
									</ul>
								</div>
								<div class="single-item__remove">
									<a href="javascript:void(0)" onclick="manage_cart('<?php echo $key ?>','remove')"><i class="icon-trash icons"></i></a>
								</div>
							</div>
						<?php } ?>
					</div>
					<div class="ordre-details__total">
						<h5>Order total</h5>
						<span class="price">₹<?php echo $cart_total ?></span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require('footer.php') ?>