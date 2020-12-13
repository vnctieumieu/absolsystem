<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Absol Pokemart</title>
     <link rel="stylesheet" href="/vendor/css/pokemart.css">
     <link rel="stylesheet" href="/vendor/css/grid.css">
     <link rel="icon" href="/vendor/img/pokemart.png">
     <script src="/vendor/js/jquery-3.5.1.min.js"></script>
     <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
     <header>
          <div class="header_navbar grid wide">
               <div class="navbar-logo">
                    <img src="/vendor/img/absol.png">
                    <span>APM</span>
               </div>
               <div class="navbar-menu_box">
                    <a href="/pokemart" class="menu-title">
                         <img src="/vendor/img/pokemart.png">
                         <span>Pokemart</span>
                    </a>
                    <div class="menu-list">
                         <span>giỏ hàng của bạn</span>
                    </div>
               </div>
               <div class="navbar-customer">
                    <div class="customer">
                         <svg style="color: #ff5403; box-shadow: 0 0 30px white;" class="active" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="shopping-cart" class="svg-inline--fa fa-shopping-cart fa-w-18" role="img" viewBox="0 0 576 512"><path fill="currentColor" d="M528.12 301.319l47.273-208C578.806 78.301 567.391 64 551.99 64H159.208l-9.166-44.81C147.758 8.021 137.93 0 126.529 0H24C10.745 0 0 10.745 0 24v16c0 13.255 10.745 24 24 24h69.883l70.248 343.435C147.325 417.1 136 435.222 136 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-15.674-6.447-29.835-16.824-40h209.647C430.447 426.165 424 440.326 424 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-22.172-12.888-41.332-31.579-50.405l5.517-24.276c3.413-15.018-8.002-29.319-23.403-29.319H218.117l-6.545-32h293.145c11.206 0 20.92-7.754 23.403-18.681z"/></svg>
                    </div>
               <!--<span class="cart_count">1</span> -->
                    <?php if ($this->session->userdata('account')): ?>
                         <span class="nameuser"><?php echo $this->session->userdata('account')['userName'];?></span>
                         <a class="logout" href="/AccountAuthentic/LogOut">đăng xuất</a>
                    <?php endif ?>
               </div>
          </div>
     </header>
     <div class="container">
          <div class="container-contents grid wide" id="container-contents">
               <div class="table_box">
                    <table class="table_product_selected">
                         <tr>
                              <td colspan="4"><span class="table_title">Sản phẩm bạn đã chọn</span></td>
                         </tr>
                         <tr class="table_collumn_name">
                              <th>STT</th>
                              <th>Tên Sản Phẩm</th>
                              <th>Số Lượng</th>
                              <th>Giá</th>
                              <th></th>
                         </tr>
                        <!--  number_format($value['price']) -->
                    <?php if ($arDetail): ?>
                              <?php foreach ($arDetail as $key => $value): ?>    
                                   <tr class="product_selected">
                                        <td><?php echo $key+1 ?></td>
                                        <td><?php echo $value['name']?></td>
                                        <td><?php echo $value['amount'];?></td>
                                        <td><?php if ($value['amount'] > 1 ) {
                                             echo number_format($value['price']*$value['amount']);
                                        }else {
                                             echo number_format($value['price']);
                                        } ?> vnđ</td>
                                        <td class="clear_box">
                                             <span hidden class="id_product_selected"><?php echo $value['id'];?></span>
                                             <span class="material-icons clear">clear</span>
                                        </td>
                                   </tr>
                              <?php endforeach ?>
                              <tr class="product_total">
                                   <td colspan="2"><?php echo $arDetailMore['amoutProduct'];?> sản phẩm</td>
                                   <td colspan="2">tổng: <?php echo number_format($arDetailMore['priceSum']);?> vnđ</td>
                              </tr>
                    </table>
                    <a href="/pokemart/SoftToy/SoftToy/FinnishOrderByUser/<?php echo $value['orderID'];?>" class="submit_order">xác nhận đặt hàng</a>
                    <?php endif ?>
               </div>
          </div>
     </div>
     <script>
          document.querySelectorAll('.clear').forEach( function(element, index) {
               element.onclick = function(event) {
                    var idProductDetail = element.parentElement.querySelector('.id_product_selected').innerText;
                    $.ajax({
                         url: '/pokemart/SoftToy/SoftToy/DeleteProductSelectByIDDetail/'+idProductDetail,
                         type: 'POST',
                         dataType: 'json',
                    })
                    .done(function(data) {
                         if (data.status == true) {
                              alert(data.msg);
                              location.reload();
                         }
                    })
                    .fail(function() {
                         console.log("error");
                    })
                    .always(function() {
                         console.log("complete");
                    });
               }
          });
     </script>
</body>
</html>