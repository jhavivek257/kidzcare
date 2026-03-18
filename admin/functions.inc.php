<?php
function pr($arr)
{
	echo '<pre>';
	print_r($arr);
}

function prx($arr)
{
	echo '<pre>';
	print_r($arr);
	die();
}

function get_safe_value($con, $str)
{
	if ($str != '') {
		$str = trim($str);
		return mysqli_real_escape_string($con, $str);
	}
}

function isAdmin()
{
	if (!isset($_SESSION['ADMIN_LOGIN'])) {
?>
		<script>
			window.location.href = 'login.php';
		</script>
	<?php
	}
	if ($_SESSION['ADMIN_ROLE'] == 1) {
	?>
		<script>
			window.location.href = 'product.php';
		</script>
<?php
	}
}

function imageCompress($source, $path, $quality = 60)
{
	$info = getimagesize($source);

	if ($info === false) {
		die("Invalid image file");
	}

	$mime = $info['mime'];

	switch ($mime) {
		case 'image/jpeg':
			$image = imagecreatefromjpeg($source);
			break;

		case 'image/png':
			$image = imagecreatefrompng($source);
			$bg = imagecreatetruecolor(imagesx($image), imagesy($image));
			$white = imagecolorallocate($bg, 255, 255, 255);
			imagefill($bg, 0, 0, $white);
			imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
			$image = $bg;
			break;

		case 'image/webp':
			$image = imagecreatefromwebp($source);
			break;

		default:
			die("Unsupported image type");
	}

	imagejpeg($image, $path, $quality);
	imagedestroy($image);
}

function productSoldQtyByProductId($con, $pid)
{
	$sql = "select sum(order_detail.qty) as qty from order_detail,`order` where `order`.id=order_detail.order_id and order_detail.product_id=$pid and `order`.order_status!=4";
	$res = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($res);
	return $row['qty'];
}
?>