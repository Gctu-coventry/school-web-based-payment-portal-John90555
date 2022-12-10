<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!isset($_SESSION['sess_id'])){
	header('Location: index.php');
}
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='" . $_GET["code"] . "'");
			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["code"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
}
//var_dump($_SESSION['cart_item']);
?>
<HTML>
<HEAD>
<TITLE>Shopping Cart</TITLE>
<link href="style.css" type="text/css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" rel="stylesheet">
<link href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" rel="stylesheet">
</HEAD>
<BODY >
	<div class= "overall-container">
<div class="product-grid">
<div class="txt-heading" style="size:'12'; color:'black'">	
<div class="mypay">SHOP LITE</div><b>products</b>
</div>
<div><i><a href="logout.php" style="color: black; text-decoration:none; font-size:medium; background-color: black; padding:10px; color:white">Logout</a></i>
	<i><a href="history.php" style="color: black; text-decoration:none; font-size:medium; background-color: black; padding:10px; color: white;">History</a></i></div><br><br>

<button id="showCart" onclick="showCheckout();" style="color: black; text-decoration:none; font-size:medium; background-color: black; padding:10px; color: white; float: right;"><i class="fas fa-shopping-cart"></i></button>
<script>
	function showCheckout(){
	$('html,body').animate({
                scrollTop: $("#shopping-cart").offset().top
            });
}
</script>	
<div class="container d-flex justify-content-center">
	<?php
	$product_array = $db_handle->runQuery("SELECT * FROM tblproduct ORDER BY id ASC");
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>
<div class="container">
<form method="post" action="products.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">

  <div class="product-card card">
    <div class="product-header">
      <!-- <img class='product-picture' src='https://i.imgur.com/BzIoXyY.png' /> -->
	  <a href="#" class="product-picture" data-abc="true"><img src="<?php echo $product_array[$key]["image"]; ?>"></a>
    </div>
    <div class="card-details">
      <h3 class="product-name"><a href="#" class="title" data-abc="true"><?php echo $product_array[$key]["name"]; ?></a></h3>
      <p class="stars">
        <!-- <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i> (154) -->
		<input type="text" class="product-quantity" name="quantity" value="1" size="2" />
	</p>
      <div class="bottom-row">
        <p class="price"><?php echo "&#8373 ".$product_array[$key]["price"]; ?></p>
        <!-- <button class="add-cart"><i class="fas fa-plus"></i></button> -->
		<button type="submit" class="add-cart" ><i class="fas fa-cart-plus"></i></button>
      </div>
    </div>
  </div>
</form>
</div>


<?php
		}
	}
	?>
	</div>

</div>


<div style=" position: relative; top: 5%;">
<div id="shopping-cart">
    <div class="txt-heading" style="size : '12'; color :'white'">Shopping Cart</div>
	
<a id="btnEmpty" href="products.php?action=empty">Empty Cart</a>
<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>	
<table class="tbl-cart" cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th style="">Name</th>
<th style="">Code</th>
<th style="" width="5%">Quantity</th>
<th style="" width="10%">Unit Price</th>
<th style="" width="10%">Price</th>
<th style="text-allign:center;" width="5%">Remove</th>
</tr>	
<?php		
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["quantity"]*$item["price"];
		?>
				<tr>
				<td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
				<td><?php echo $item["code"]; ?></td>
				<td style="text-allign:right;"><?php echo $item["quantity"]; ?></td>
				<td  style="text-allign:right;"><?php echo "&#8373 ".$item["price"]; ?></td>
				<td  style="text-allign:right;"><?php echo "&#8373 ". number_format($item_price,2); ?></td>
				<td style="text-allign:center;"><a href="index.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
				</tr>
				<?php
				$total_quantity += $item["quantity"];
				$total_price += ($item["price"]*$item["quantity"]);
				
		}
		?>

<tr>
<td colspan="2" allign="right">Total:</td>
<td allign="right"><?php echo $total_quantity; $_SESSION['total_price']= $total_price;?></td>
<td allign="right" colspan="2"><strong><?php echo "&#8373 ".number_format($total_price, 2); ?></strong></td>
<td></td>
</tr>
	

</tbody>
</table>

    <fieldset>
										<section class="mypay"><button onclick="checkout();">Check Out</button></section>
    </form>	</fieldset>
  <?php
} else {
?>
    <div class="no-records" style="size:'12'; color:'black'">Your Cart is Empty</div>
<?php 
}
?>
<br/>	

<!--<a id="btnEmpty" href="index.php?action=empty">Empty Cart</a>-->

</div>
</div>

</div>

</body>
</html>

<script>
function checkout(){
	var total = <?= $total_price?>;
	var api_key = "d6464b-0abad4-dbf8bd-9b38a6-61b618";
	formData = {total:total,api_key:api_key}
$.ajax({url: "includes/out.php", type:'POST',data: formData, dataType: "text",success: function(response){
					console.log(response);
					switch (response){
    					case "true":
							$(".add-cart").replaceWith
							("<div><i class='fa fa-ban'></i></div>")
							$("#shopping-cart").replaceWith
							("<div class='mypay'><h2>Please complete transaction<h2></div><div class='mypay'><img src='infinity_load.gif'></div>")
							
							// setTimeout(function(){window.location.reload();}, 15000);
							setTimeout(function() { window.location='products.php?action=empty'},30000);  
							window.open('http://localhost/TransitPayGateway/views/middle.php','blank').focus()
							break;
						case "false":
							break;
						}	
					}
					}).done(closeLoading())
					}
function closeLoading(){
	$(".infinity_load").replaceWith
	("<div>We are back<div>")
	 
}
</script>