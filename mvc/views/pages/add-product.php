<?php include("./mvc/views/partials/theme.php"); ?> 
<div class="container-fluid p-0">
	<div class="row m-0">
		<div class="p-2 bg2" style="height: 100vh;width: 320px;">
			<p class="ml-1 font-weight-bold text-white" style="font-size: 130%">ຈັດການຂໍ້ມູນ</p>

			<div class="row m-0">
				<?php include("./mvc/views/partials/home-menu-account.php"); ?> 
				<?php include("./mvc/views/partials/home-menu-item.php"); ?>
			</div>
		</div>

		<div class="p-0 bg1" style="height: 100vh;width: calc(100% - 320px)">
			<div class="p-3">
				<p class="float-left text-white font-weight-bold mb-0" style="font-size: 130%"></p>
				<a href="../Home" style="text-decoration: none;color:black;">
					<div id="back-button" class="btn bg-white float-right">ກັບຄືນ</div>
				</a>
				<div style="clear: both;"></div>
			</div>

			<div style="height: calc(100vh - 120px);overflow-y: auto;">
				<div class="py-2 px-4 text-white bg2" style="width: 500px;margin: auto">
					<form action="../Product/SetAddProduct" method="post" enctype='multipart/form-data'>
						<p class="text-center" style="font-size: 130%">ເພີ່ມສິນຄ້າ</p>
						
						<label>ຊື່</label>
						<input type="text" class="form-control" style="background: none;color: white" name="name">

						<label class="mt-2">ລາຄາ (ກີບ)</label>
						<input type="number" class="form-control" style="background: none;color: white" name="price">

						<label class="mt-2">ປະເພດ</label>
						<select class="form-control" id="exampleFormControlSelect1" style="background: none;" name="type">
							<option value="1">ອາຫານ</option>
							<option value="2">ເຄື່ອງດື່ມ</option>
						</select>

						<label class="mt-2">ຮູບພາບ</label><br>
						<input type="file" name="upload">

						<div class="text-center mt-3 mb-3">
							<button type="submit" class="btn bg-white">ເພີ່ມສິນຄ້າ</button>
						</div>

						<p class="text-center">
							<?php 
							if(isset($data["status"])){
								echo $data["status"];
							}
							?>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
