<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classess/Product.php'; ?>
<?php include_once '../helpers/Format.php'; ?>
<?php
	$product = new Product();
	$fm = new Format();
?>
<?php
	if (isset($_GET['delPdt'])) {
		$id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delPdt']);
		$delPdt = $product->delPdtById($id);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">  
        <?php
        	if (isset($delPdt)) {
        		echo $delPdt;
        	}
        ?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>SL</th>
					<th>Product Name</th>
					<th>Category Name</th>
					<th>Brand Name</th>
					<th>Body</th>
					<th>Price</th>
					<th>type</th>
					<th>Image</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$getProduct = $product->getAllProduct();
				if ($getProduct) {
					$i =0;
					while ($result = $getProduct->fetch_assoc()) {
						$i++;
			?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['productName']; ?></td>
					<td><?php echo $result['catName']; ?></td>
					<td><?php echo $result['brandName']; ?></td>
					<td><?php echo $fm->textShorten($result['body'], 50); ?></td>
					<td><?php echo $result['price']; ?></td>
					<td>
						<?php
							if ($result['type'] == 1 ) {
								echo "Featured";
							}else{
								echo "General";
							}
						?>
					</td>
					<td><img src="<?php echo $result['image'] ?>" height="40px" width="60px"></td>
					<td>
						<a href="pdtEdit.php?pdtId=<?php echo $result['productId']; ?>">Edit</a> || 
						<a onclick="return confirm('Are you sure to delete!')" 
							href="?delPdt=<?php echo $result['productId']; ?>">Delete</a>
					</td>
				</tr>
			<?php
					}
				}
			?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
