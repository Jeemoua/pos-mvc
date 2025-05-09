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
                <p class="float-left cl font-weight-bold mb-0" style="font-size: 130%"></p>
                <a href="../Home" style="text-decoration: none;color:black;">
                    <div id="back-button" class="btn bg-white float-right">ກັບຄືນ</div>
                </a>
                <div style="clear: both;"></div>
            </div>

            <div style="height: calc(100vh - 120px);overflow-y: auto;">
                <div class="row m-0">
                    <div class="col-6 p-0">
                        <div class="row m-0 p-2">
                            <div class="col-12 p-2">
                                
                            </div>

                            <div class="col-12 p-2">
                                <div class="p-2 cl bg2">
                                    <p class="text-center" style="font-size: 130%">ໂຕະ</p>
                                    <div style="clear: both;"></div>
                                    <div class="row m-0">
                                        <table class="table bg2 cl">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ເບີໂຕະ</th>                                
                                                    <th scope="col">ຈັດການ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $typeText;
                                                foreach ($data["Table"] as $value) {

                                                    echo '<tr>
                                                    <td>'.$value["number"].'</td>                                                 
                                                    <td>                                                  
                                                    <a href="../Table/DeleteTable/'.$value["id"].'" 
                                                    style="text-decoration: none;color:black;">
                                                    <div class="btn bg-white text-dark float-left">ລົບ</div>
                                                    </a>
                                                    </td>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <form id="form-edit-table" action="../Table/EditTable" method="post" style="display: none;">
                                        <div style="display: flex;">
                                            <input id="idTable"  type="" name="idTable" style="display: none;">
                                            <div class="px-2" style="width: 30%">
                                                <label>ເບີ</label><br>
                                                <input id="numberTable" type="" class="form-control" name="numberTable">
                                            </div>
                                        </div>
                                    </form>
                                    <form id="form-add-table" action="../Table/AddTable" method="post">
                                        <div style="display: flex;">
                                            <div class="px-2" style="width: 30%">
                                                <label>ເບີໂຕະ</label><br>
                                                <input type="" class="form-control" name="numberTable">
                                            </div>
                                    
                                            <div  class="px-2" style="width: 30%">
                                                <button type="submit" class="btn" style="margin-top: 32px">ເພີ່ມໂຕະ</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function SetDefaultColor(){
        $("#color1").val('#121421');
        $("#color2").val('#1e202c');
        $("#color3").val('#292b37');
        $("#color4").val('#ffffff');
    }

    function EditTable(id,number,type){
        $("#form-add-table").hide();
        $("#form-edit-table").show();
        $("#numberTable").val(number);
        $("#typeTable").val(type);
        $("#idTable").val(id);
    }
</script>