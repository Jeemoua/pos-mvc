<?php include("./mvc/views/partials/theme.php"); ?> 

<div class="container-fluid bg2 d-flex justify-content-center align-items-center" style="height: 100vh; overflow: auto;">
  <div class="row w-100 d-flex justify-content-center">
    <div class="col-sm-12 col-md-4 shadow-sm bg3 p-4" style="border-radius: 30px; min-width: 350px;">
      <p class="cl text-center" style="font-weight: bold; font-size: 1.3rem;">ຮ້ານອາຫານແບມໂບ</p>
      <div class="col-12 pb-3">
        <div class="form-group">
          <label class="cl">ຊື່ຜູ້ໃຊ້ງານ</label>
          <input id="username" type="text" name="username" class="form-control" placeholder="Username">
        </div>
        <div class="form-group">
          <label class="cl">ລະຫັດຜ່ານ</label>
          <input id="password" type="password" name="password" class="form-control" placeholder="Passwords">
        </div>      
      </div>
      <p id="check-login-status" class="text-center text-danger" style="font-size: 90%; display: none;">ຊື່ຜູ້ໃຊ້ງານ ຫຼື ລະຫັດຜ່ານບໍຖືກຕອ້ງ</p>
      <div onclick="Login()" class="btn bg1 cl btn-block mt-1 mb-3 mx-auto" style="width: 70%;border-radius: 10px;">ເຂົ້າສູ່ລະບົບ</div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function Login(){
    var username = $("#username").val();
    var password = $("#password").val();
    $.post("../Account/CheckLogin/", { username: username, password: password }, function(data){  
      console.log(data);
      if(data == 1){
        window.location.href = "../Home";
      } else {
        $("#check-login-status").show();
      }
    });
  }
</script>
