<?php
require('connection.inc.php');
require('functions.inc.php');
require('add_to_cart.inc.php');

$pid=get_safe_value($con,$_POST['pid']);
$qty=get_safe_value($con,$_POST['qty']);
$type=get_safe_value($con,$_POST['type']);

$productSoldQtyByProductId=productSoldQtyByProductId($con,$pid);
$productQty=productQty($con,$pid);

$pending_qty=$productQty-$productSoldQtyByProductId;

if($type!='remove'){
	if($qty>$pending_qty){
		echo "not_avaliable";
		die();
	}
}

$obj=new add_to_cart();

if($type=='add'){
	$obj->addProduct($pid,$qty);
	if(isset($_SESSION['USER_LOGIN'])){
		$uid=$_SESSION['USER_ID'];
		mysqli_query($con,"delete from wishlist where user_id='$uid' and product_id='$pid'");
		set_flash('msg', 'Product added to cart and removed from wishlist ✅');
	}
}

if($type=='remove'){
	$obj->removeProduct($pid);
	set_flash('msg', 'Product removed from cart successfully ✅');
}

if($type=='update'){
	$obj->updateProduct($pid,$qty);
	set_flash('msg', 'Cart updated successfully ✅');
}

echo $obj->totalProduct();
?>