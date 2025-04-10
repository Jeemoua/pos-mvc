<?php include("./mvc/views/partials/theme.php"); ?> 
<div class="container-fluid p-0">
	<div class="row m-0">
		<div class="p-2 bg2" style="height: 100vh;width: 320px;">
			<p class="ml-1 font-weight-bold cl" style="font-size: 130%">ຈັດການຂໍ້ມູນ</p>


			<div class="row m-0">
				<?php include("./mvc/views/partials/home-menu-account.php"); ?> 
				<?php include("./mvc/views/partials/home-menu-item.php"); ?>		
			</div>
		</div>

		<div class="p-0 bg1" style="height: 100vh;width: calc(100% - 320px)">
			<div class="p-3">
				<p class="float-left cl font-weight-bold mb-0" style="font-size: 130%">ຈັດການສີນຄ້າ</p>
				<a href="../Home" style="text-decoration: none;color:black;">
					<div id="back-button" class="btn bg-white float-right">ກັບຄືນ</div>
				</a>
				<div style="clear: both;"></div>
			</div>
			<a href="../Product/GetAddProduct" style="color: black;text-decoration: none;">
				<div class="text-center"><div class="btn mb-2 bg-white">ເພີ່ມສິນຄ້າ</div></div>
			</a>

			<div style="height: calc(100vh - 120px);overflow-y: auto;">

				<div class="px-2" style="width: 850px;margin: auto">
					<table class="table bg2 cl">
						<thead>
							<tr>
								<th scope="col">ຮູບພາບ</th>
								<th scope="col">ຊື່</th>
								<th scope="col">ລາຄາ</th>
								<th scope="col">ປະເພດ</th>
								<th scope="col">ຂັ້ນຕອນ</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$type;
							while($row = mysqli_fetch_array($data["ProductsManage"])){
								if($row["type"] == 1){
									$type = "ອາຫານ";
								}else if($row["type"] == 2){
									$type = "ເຄື່ອງດື່ມ";
								}
								echo '<tr>
								<th><img src="../public/images/product/'.$row["image"].'" width="80px" height="50px;" style="object-fit: cover;"> </th>
								<td style="width: 350px">'.$row["name"].' </td>
								<td>'.$row["price"].'Kip</td>
								<td>'.$type.'</td>
								<td>
								<a href="../Product/GetEditProduct/'.$row["id"].'" style="text-decoration: none;color:black;">
								<div class="btn bg-white text-dark float-left mr-2">ເເກ້ໄຂ</div>
								</a>
								<a href="../Product/DeleteProduct/'.$row["id"].'" 
								style="text-decoration: none;color:black;">
								<div class="btn bg-white text-dark">ລືບ</div>
								</a>
								</td>
								</tr>';
							}
							?>
							
						</tbody>


					</table>
				</div>



			</div>

		</div>
	</div>
</div>