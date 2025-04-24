<?php include("./mvc/views/partials/theme.php"); ?> 
<div id="checkout-box" class="container-fluid p-0">
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
				<p class="float-left cl font-weight-bold mb-0" style="font-size: 130%">ລາຍການອາຫານ</p>
				<a href="../../Home">
					<div id="back-button" class="btn bg-white float-right">ກັບຄືນ</div>
				</a>
				<div style="clear: both;"></div>
			</div>

			<div class="px-2" style="width: 800px;height: 300px;margin: auto">
				<table id="get-html-table" class="table bg2 cl">
					<thead>
						<tr>
							<th scope="col">ລຳດັບ</th>
							<th scope="col">ຊື່</th>
							<th scope="col">ຈຳນວນ</th>
							<th scope="col">ລາຄາ</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$stt = 1;
						foreach ($data["GetOrderCheckout"] as $value) {
							echo '<tr>
								<th scope="row">'.$stt++.'</th>
								<td>'.$value["name"].'</td>
								<td>'.$value["quanlity"].'</td>
								<td>'.number_format($value["price"] * $value["quanlity"]).' ກີບ</td>
							</tr>';
						}
						?>
					</tbody>
					<tfoot>
						<tr>
							<th colspan="3" class="text-right">ທັງຫມົດ</th>
							<th id="total">0 ກີບ</th>
						</tr>
					</tfoot>
				</table>

				<div id="finish-button">
					<div id="FinishCheckout" class="btn bg2 cl mt-4 float-left" style="width: 78%;">ສຳເລັດ</div>
					<div class="js-print-link btn bg2 cl mt-4 float-right" style="width: 20%;">
						<i class="fa fa-print cl" aria-hidden="true" style="font-size: 130%"></i>
					</div>
				</div>								
			</div>
		</div>
	</div>
</div>

<!-- Print Bill Section -->
<div id="print" class="mt-2 p-4 shadow-ok" style="width: 350px;height: 500px;display: none;">
	<p class="text-center">23-02-2020 Code Order #3</p>
	<p class="mb-0">ຮ້ານອາຫານແບບໂບ</p>
	<p class="mb-0">ຕິດຕໍ່: 02096329791</p>
	<p>ຜູ້ຈັດການ : Phoumee</p>
	<p class="float-left mb-0 font-weight-bold" style="width: 50%">ຊື່</p>
	<p class="float-left mb-0 font-weight-bold" style="width: 25%">ຈຳນວນ</p>
	<p class="float-right mb-0 font-weight-bold" style="width: 25%">ລາຄາ</p>
	<div style="clear: both;"></div>

	<div>
		<?php
		foreach ($data["GetOrderCheckout"] as $value) {
			echo '<p class="float-left mb-0" style="width: 50%">'.$value['name'].'</p>
				  <p class="float-left mb-0" style="width: 25%">'.$value['quanlity'].'</p>
				  <p class="float-right mb-0" style="width: 25%">'.number_format($value['quanlity']*$value['price']).' ກີບ</p>
				  <div style="clear: both;"></div>';
		}
		?>
	</div>

	<p class="float-left mb-0 font-weight-bold mt-3" style="font-size: 130%">ຈຳນວນທັງຫມົດ</p>
	<p id="total-bill" class="float-right mb-0 font-weight-bold mt-3" style="font-size: 130%">0 ກີບ</p>
	<div style="clear: both;"></div>
</div>

<script type="text/javascript">
	$('.js-print-link').on('click', function () {
		$("#checkout-box").hide();
		$("#print").show();
		window.print();
		$("#checkout-box").show();
		$(".hidePrinf").show();
		$("#print").hide();
	});

	var total = JSON.parse(localStorage.getItem('total')) || 0;
	$("#total").text(total.toLocaleString() + ' ກີບ');
	$("#total-bill").text(total.toLocaleString() + ' ກີບ');

	$(document).ready(function(){
		var id = JSON.parse(localStorage.getItem('idTable'));
		$.ajax({
			url: '../../Table/ResetTable/' + id,
			type: 'get',
			dataType: 'json',
			success: function(data){}
		});

		$("#FinishCheckout").on('click', function(){
			var getHtmlTable = $("#get-html-table").html();
			$.post("../../Checkout/AddCheckout/", {content: getHtmlTable}, function(data){	
				window.location.href = "../../Home";
			});
		});
	});
</script>