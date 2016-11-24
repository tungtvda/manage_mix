
<div class="site-content">
    <div class="container">
        <div class="row">
            <main id="main" class="site-main col-sm-9 alignright product" role="main">
                <div class="wrapper-pagination-top">
                    <div class="shop-top">
                        <ul class="list-unstyled list-products-layout">
                            <li class="switchToGrid active"><span><i class="fa fa-th"></i></span></li>
                            <li class="switchToList"><span><i class="fa fa-list"></i></span></li>
                        </ul>
                        <input hidden id="url_link" value="{SITE-NAME}/tim-kiem/">
                        <form class="woocommerce-ordering" method="get">
                            <select name="orderby" class="orderby">
                               {order}
                            </select>
                        </form>
                        <script>
                            jQuery(function (a) {
                                a(".woocommerce-ordering").on("change", "select.orderby", function () {
                                    var url=a('#url_link').val();
                                    var select=a(this).val()
                                    window.location=url+'orderby-'+select+'/giatri-{giatri}';
                                }), a("input.qty:not(.product-quantity input.qty)").each(function () {
                                    var b = parseFloat(a(this).attr("min"));
                                    b >= 0 && parseFloat(a(this).val()) < b && a(this).val(b)
                                })
                            });
                        </script>
                    </div>
                    <div class="wrapper-pagination">
                        <div class="pagination loop-pagination">
                            <ul class='page-numbers'>

                            </ul>
                        </div>
                    </div>


                </div>
                <ul class="product-grid category-product-list row archive_switch">
                    {danhsach}
                </ul>

                <div class="wrapper-pagination-footer">
                    <div class="wrapper-pagination">
                        <div class="pagination loop-pagination">
                            <ul class='page-numbers'>

                            </ul>
                        </div>
                    </div>


                    <p class="woocommerce-result-count">
                       </p>
                </div>


            </main>


