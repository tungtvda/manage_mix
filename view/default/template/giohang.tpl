<div class="site-content">
    <div class="container">
        <div class="row">
            <main id="main" class="site-main col-sm-9 alignright page" role="main">
                <article id="post-7" class="post-7 page type-page status-publish hentry">
                    <div class="entry-content">
                        <div class="woocommerce">
                            <form action="" method="post">


                                <table class="shop_table cart" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th class="product-name">Thực đơn</th>
                                        <th class="product-price">Giá</th>
                                        <th class="product-quantity">Số lượng</th>
                                        <th class="product-subtotal">Thành tiền</th>
                                        <th class="product-remove">&nbsp;</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                   {list_cart}

                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-sm-6 vi-coupon">
                                        <div class="coupon">

                                            <!--<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="Coupon code">-->
                                            <input style="background-color: #ee2b2a;" type="submit" class="button" name="xoagiohang" value="Xóa giỏ hàng">

                                        </div>
                                    </div>
                                    <div class="vi-update-cart col-sm-6">
                                        <input type="submit" class="button btn-primary" name="capnhatgh" value="Cập nhật giỏ hàng">

                                        <div class="wc-proceed-to-checkout">


                                            <a href="{SITE-NAME}/checkout/" class="checkout-button button alt wc-forward">
                                                Checkout</a>

                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="cart-collaterals">
                                <div class="cart_totals">
                                    <div class="row">

                                        <div class="col-sm-6 ">


                                            <h2>Tổng tiền</h2>

                                            <table cellspacing="0">

                                                <tbody><tr class="cart-subtotal">
                                                    <th>Subtotal</th>
                                                    <td><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"></span>{total} vnđ</span></td>
                                                </tr>





                                                <!--<tr class="order-total">
                                                    <th>Total</th>
                                                    <td><strong><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>87.24</span></strong> </td>
                                                </tr>-->


                                                </tbody></table>



                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- .entry-content -->

                </article><!-- #post-## -->
            </main>

