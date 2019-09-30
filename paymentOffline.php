<?php include 'inc/header.php'; ?>
<?php
	$login = Session::get("cmrLogin");
	if ($login == false) {
		header("Location:login.php");
	}
?>
<?php
   if (isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
      $cmrId = Session::get("cmrId");
      $insertOrder = $ct->orderProduct($cmrId);
      $delData = $ct->delCustomerCart();
      header("Location:success.php");
   }
?>
<style type="text/css">
.division{width: 50%; float: left;}
.tblone{width: 550px;margin: 0 auto; border: 2px solid #ddd;}
.tblone tr td{text-align: justify;}
.tblTwo{float:right;text-align:left;width:50%;border:2px solid #ddd;margin-right:14px;margin-top: 12px;}
.tblTwo tr td{text-align: justify;padding-bottom:5px 10px;}
.orderNow{padding-bottom:30px;}
.orderNow a{width:200px;margin:20px auto 0; padding:5px;text-align:center;display:block;background:#ff0000;color:#fff; border-radius:3px;font-size:30px;}
</style>
<div class="main">
    <div class="content">
   		<div class="section group">
   			<div class="division">
               <table class="tblone">
                     <tr>
                        <th>NO</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                     </tr>
                  <?php
                     $getCtPdt = $ct->getCartProduct();
                     if ($getCtPdt) {
                        $i = 0;
                        $sum = 0;
                        $qty = 0;
                        while ($result = $getCtPdt->fetch_assoc()) {
                           $i++;
                  ?>
                     <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $result['productName']; ?></td>
                        <td>$ <?php echo $result['price']; ?></td>
                        <td><?php echo $result['quantity']; ?></td>
                        <td>$ 
                           <?php
                              $total = $result['price'] * $result['quantity'];
                              echo $total; 
                           ?>
                        </td>
                     </tr>
                  <?php
                     $qty = $qty + $result['quantity'];
                     $sum = $sum + $total;
                        }
                     }
                  ?>
                     
                  </table>

                  <table class="tblTwo">
                     <tr>
                        <td>Sub Total</td>
                        <td>:</td>
                        <td>$ <?php echo $sum; ?></td>
                     </tr>
                     <tr>
                        <td>VAT (10%)</td>
                        <td>:</td>
                        <td>
                           <?php
                              $vat = $sum * 0.1;
                              echo $vat;
                           ?>
                        </td>
                     </tr>
                     <tr>
                        <td>Grand Total</td>
                        <td>:</td>
                        <td>
                           <?php
                              echo $gndTotal = $vat + $sum;
                           ?>
                        </td>
                     </tr>
                  </table>
            </div>
            <div class="division">
               <?php
                  $id = Session::get("cmrId");
                  $getData = $cmr->getCustomerData($id);
                  if ($getData) {
                     while ($result = $getData->fetch_assoc()) {
               ?>
               <table class="tblone">
                  <tr>
                     <td colspan="3"><h2>User Profile Details</h2></td>
                  </tr>
                  <tr>
                     <td width="20%">Name</td>
                     <td width="5%">:</td>
                     <td><?php echo $result['name']; ?></td>
                  </tr>
                  <tr>
                     <td>Phone</td>
                     <td>:</td>
                     <td><?php echo $result['phone']; ?></td>
                  </tr>
                  <tr>
                     <td>Email</td>
                     <td>:</td>
                     <td><?php echo $result['email']; ?></td>
                  </tr>
                  <tr>
                     <td>Address</td>
                     <td>:</td>
                     <td><?php echo $result['address']; ?></td>
                  </tr>
                  <tr>
                     <td>City</td>
                     <td>:</td>
                     <td><?php echo $result['city']; ?></td>
                  </tr>
                  <tr>
                     <td>Zipcode</td>
                     <td>:</td>
                     <td><?php echo $result['zip']; ?></td>
                  </tr>
                  <tr>
                     <td>Country</td>
                     <td>:</td>
                     <td><?php echo $result['country']; ?></td>
                  </tr>
                  <tr>
                     <td></td>
                     <td></td>
                     <td><a href="editProfile.php">Update Details</a></td>
                  </tr>
               </table>
            <?php
                  }
                  }
            ?>
            </div>
            
   		</div>
 	</div>
   <div class="orderNow">
      <a href="?orderid=order">Order</a>
   </div>
</div>

<?php include 'inc/footer.php'; ?>