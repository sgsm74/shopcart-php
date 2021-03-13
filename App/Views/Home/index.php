
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>تست</title>
</head>
<body>
	
<div id="shopping-cart">
<div class="txt-heading"></div>

<a id="btnEmpty" href="empty">خالی کردن سبد خرید</a>
<?php

if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>	
<table class="tbl-cart" cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th>عنوان</th>
<th>کد</th>
<th>تعداد</th>
<th >قیمت واحد</th>
<th>قیمت کل</th>
<th>حذف</th>
</tr>	
<?php		
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["quantity"]*$item["price"];
		?>
				<tr>
				<td><?php echo $item["name"]; ?></td>
				<td><?php echo $item["code"]; ?></td>
				<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
				<td style="text-align:right;"><?php echo "تومان ".number_format($item["price"],0); ?></td>
				<td style="text-align:right;"><?php echo "تومان ". number_format($item_price,0); ?></td>
				<td style="text-align:center;">
				<form method="post" action="remove">
					<input type="text" name="code" id="" hidden value="<?php echo $item["code"];?>">
					<input type="submit" href="#" value="حذف"/>
				</form>
				</td>
				</tr>
				<?php
				$total_quantity += $item["quantity"];
				$total_price += ($item["price"]*$item["quantity"]);
		}
		?>

<tr>
<td colspan="2" align="right">نهایی:</td>
<td align="right"><?php echo $total_quantity; ?></td>
<td align="right" colspan="2"><strong><?php echo "تومان ".number_format($total_price, 0); ?></strong></td>

<td></td>
</tr>
</tbody>
</table>		
  <?php
} else {
?>
<div س>سبد خرید شما خالی است</div>
<?php 
}
?>
</div>
<?php
$cars=Array
(
	(0) => Array
		(
			'name' => 'Volvo',
			'price' => 22000,
			'code' => 1000,
			'balance'=> 7
		),

	(1) => Array
	(
		'name' => 'BMW',
		'price' => 15000,
		'code' => 1001,
		'balance' => 8
	),

	(2) => Array
		(
		'name' => 'Saab',
		'price' => 5000,
		'code' => 1002,
		'balance' => 9
		)
);
?>
<?php
	
	if (!empty($cars)) { 
		for($row = 0; $row < 3; $row++){
	?>
		<div>
			<form method="post" action="add2cart">
			<div>
			<div> <?php echo $cars[$row]['name']; ?></div>
			<div>قیمت <?php echo "تومان".$cars[$row]['price']; ?></div>
			<div><input type="text" class="car-quantity" name="quantity" value="1" size="2" /><input type="submit" value="خرید" /></div>
			<div>موجودی <?php echo $cars[$row]['balance']; ?></div>
			<input type="text" name="code" id="" hidden value="<?php echo $cars[$row]['code'];?>">
			</div>
			</form>
		</div>
		<br>
	<?php
		
	}
}
	?>
</body>
</html>