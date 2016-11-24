<div class="site-content">
    <div class="container">
        <div class="row">
            <main id="main" class="site-main col-sm-9 alignright product" role="main">


                <div id="product-503" style="border-bottom: 1px solid #e5e5e5;"
                     class="post-503 product type-product status-publish has-post-thumbnail product_cat-cook product_cat-rice product_tag-antephasellus product_tag-imperdiet product_tag-parturient first instock shipping-taxable purchasable product-type-simple">

                    <div class="images">
                        <div id="slider">
                            <ul class="slides">
                                <li><a href="{img}"
                                       class="woocommerce-main-image zoom" title="{name}"
                                       data-rel="prettyPhoto[product-gallery]"><img width="570" height="570"
                                                                                    src="{img}"
                                                                                    class="attachment-shop_single size-shop_single wp-post-image"
                                                                                    alt="{name}" title="{name}"
                                                                                    srcset="{img} 570w, {img} 150w, {img} 768w, {img} 124w, {img} 370w, {img} 780w"
                                                                                    sizes="(max-width: 570px) 100vw, 570px"/></a>
                                </li>
                                <li><a href="{img1}"
                                       class="woocommerce-main-image zoom" title="{name}"
                                       data-rel="prettyPhoto[product-gallery]"><img width="570" height="570"
                                                                                    src="{img1}"
                                                                                    class="attachment-shop_single size-shop_single"
                                                                                    alt="{name}"
                                                                                    srcset="{img1} 570w, {img1} 150w, {img1} 768w, {img1} 124w, {img1} 370w, {img1} 780w"
                                                                                    sizes="(max-width: 570px) 100vw, 570px"/></a>
                                </li>
                                <li><a href="{img2}"
                                       class="woocommerce-main-image zoom" title="{name}"
                                       data-rel="prettyPhoto[product-gallery]"><img width="570" height="570"
                                                                                    src="{img2}"
                                                                                    class="attachment-shop_single size-shop_single"
                                                                                    alt="{name}"
                                                                                    srcset="{img2} 570w, {img2} 150w, {img2} 768w, {img2} 124w, {img2} 370w, {img2} 780w"
                                                                                    sizes="(max-width: 570px) 100vw, 570px"/></a>
                                </li>
                            </ul>
                        </div>
                        <div id="carousel" class="thumbnail_product">
                            <ul class="slides">
                                <li><img width="124" height="124"
                                         src="{img}" title="{name}"
                                         class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image"
                                         alt="{name}"
                                         srcset="{img} 124w, {img} 150w, {img} 768w, {img} 370w, {img} 570w, {img} 780w"
                                         sizes="(max-width: 124px) 100vw, 124px"/></li>
                                <li><img width="124" height="124"
                                         src="{img1}"
                                         class="attachment-shop_thumbnail size-shop_thumbnail" alt="{name}" title="{name}"
                                         srcset="{img1}, {img1} 150w, {img1} 768w, {img1} 370w, {img1} 570w, {img1} 780w"
                                         sizes="(max-width: 124px) 100vw, 124px"/></li>
                                <li><img width="124" height="124"
                                         src="{img2}"
                                         class="attachment-shop_thumbnail size-shop_thumbnail" alt="{name}" title="{name}"
                                         srcset="{img2} 124w, {img2} 150w, {img2} 768w, {img2} 370w, {img2} 570w, {img2} 780w"
                                         sizes="(max-width: 124px) 100vw, 124px"/></li>
                            </ul>
                        </div>

                    </div>

                    <div class="summary entry-summary">

                        <h1 itemprop="name" class="product_title entry-title" style="font-size: 20px">{name}</h1>
                        <div itemprop="offers" itemscope itemtype="">



                            <span class="price">

		<del style="color: #797979;">
            <span class="woocommerce-Price-amount amount">
               {price_sales_format}
        </del>
            <ins style="color: #ee2b2a;font-size: 30px;text-decoration: none;"><span class="woocommerce-Price-amount amount"><span
                            class="woocommerce-Price-currencySymbol"></span> {price_format}</span> vnđ
            </ins>	</span>

                        </div>

                        <div class="woocommerce-product-rating">
                            <div class="star-rating" title="">
                                {start}
                            </div>
                            <a style="text-align: center" href="#reviews" class="woocommerce-review-link"
                               rel="nofollow">(<span
                                        itemprop="reviewCount" class="count">{count_danhgia}</span> đánh giá)</a>
                            <a style="margin-left: 30px" class="woocommerce-review-link"><span
                                        itemprop="reviewCount" class="count"><i class="fa fa-thumbs-up"></i> <span  id="num_like_{id}">{num_like}</span></span>
                            </a>
                        </div>


                        <div class="product_meta">
                            <span class="sku_wrapper">Mã thực đơn: <span class="sku" itemprop="sku">{code}</span></span>
                            <span class="posted_in">Danh mục: {cate}</span>
                        </div>


                        <form class="cart" action="{SITE-NAME}/gio-hang/" method="post" enctype='multipart/form-data'>

                            <div class="quantity">
                                <input type="number" step="1" min="1" max="" name="SoLuong" value="1"
                                       title="Qty" class="input-text qty text" size="4" pattern="[0-9]*"
                                       inputmode="numeric"/>
                                <input hidden value="{id}" name="Idsanpham">
                                <input hidden value="{link}" name="Linksanpham">
                            </div>
                            <button type="submit" value="dathang" class="single_add_to_cart_button button alt">Add to cart
                            </button>

                        </form>


                        <div class="yith-wcwl-add-to-wishlist add-to-wishlist-503">
                            <div class="yith-wcwl-add-button show" style="display:block">


                                <a href="javascript:void(0)" rel="nofollow"
                                   data-product-id-like="{id}" data-product-type="simple" class="add_to_wishlist">
                                    Like</a>
                            </div>



                            <div style="clear:both"></div>
                            <div class="yith-wcwl-wishlistaddresponse"></div>

                        </div>

                        <div class="clear"></div>
                        <div class="description">
                            <p>{content_short}</p>
                        </div>

                        <ul class="woo_share_social">
                            <li><a target="_blank" class="facebook"
                                   href="https://www.facebook.com/sharer/sharer.php?u={link}"
                                   title="Facebook"><i class="fa fa-facebook"></i></a></li>
                            <li><a target="_blank" class="twitter"
                                   href="https://twitter.com/intent/tweet?source=webclient&text={link}"
                                   title="Twitter"><i class="fa fa-twitter"></i></a></li>
                            <li><a target="_blank" class="pinterest"
                                   href="http://pinterest.com/pin/create/button/?url={link}"
                                   onclick="window.open(this.href); return false;" title="Pinterest"><i
                                            class="fa fa-pinterest"></i></a></li>
                            <li><a target="_blank" class="googleplus"
                                   href="https://plus.google.com/share?url={link}"
                                   title="Google Plus"
                                   onclick='javascript:window.open(this.href, "", "menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600");return false;'><i
                                            class="fa fa-google"></i></a></li>
                            <li>
                                <a class="googleplus" target="_blank" title="Chia sẻ qua email"
                                   href="mailto:?Subject={name}?&amp;body={name}:{content_short_strip}"
                                   rel="nofollow"><i class="fa fa-envelope"></i></a>
                            </li>
                        </ul>
                    </div><!-- .summary -->


                    <div class="woocommerce-tabs wc-tabs-wrapper">
                        <ul class="tabs wc-tabs">
                            <li class="description_tab">
                                <a href="#tab-description">Mô tả</a>
                            </li>
                            <li class="reviews_tab">
                                <a href="#tab-reviews">Đánh giá ({count_danhgia})</a>
                            </li>
                        </ul>
                        <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--description panel entry-content wc-tab"
                             id="tab-description">
                            {content}
                        </div>
                        <div  class="woocommerce-Tabs-panel woocommerce-Tabs-panel--reviews panel entry-content wc-tab"
                             id="tab-reviews">

                            <div id="reviews">
                                <div id="comments" style="{width}">
                                    <ol class="commentlist">
                                        {danhgia}
                                    </ol>
                                </div>
                                <div id="review_form_wrapper">
                                    <div id="review_form">
                                        <div id="respond" class="comment-respond">
                                            <h3 id="reply-title" class="comment-reply-title">Cho chúng tôi biết cảm nghĩ của bạn
                                            </h3>
                                            <form action="" method="post" id="commentform" class="comment-form" >
                                                <div class="row">
                                                    <div class="col-sm-4 comment-form-author"><input id=""
                                                                                                     name="name_ct"
                                                                                                     type="text"
                                                                                                     value=""
                                                                                                     size="30"
                                                                                                     required
                                                                                                     aria-required="true"
                                                                                                     placeholder="Họ tên*"/>
                                                    </div>
                                                    <div class="col-sm-4 comment-form-email"><input style="padding: 6px 15px;
    border: 2px solid #ddd;
    width: 100%;
    background: #f9f9f9;" id="email"
                                                                                                    name="email_ct"
                                                                                                    type="email"
                                                                                                    value=""
                                                                                                    size="30"
                                                                                                    required
                                                                                                    aria-required="true"
                                                                                                    placeholder="Email*"/>
                                                    </div>
                                                    <div class="col-sm-4 comment-form-author">
                                                        <select name="start_ct" style="padding: 11px 15px; required
    border: 2px solid #ddd;
    width: 100%;
    background: #f9f9f9;">
                                                            <option value="0">Chọn thứ hạng</option>
                                                            <option value="1">1 sao</option>
                                                            <option value="2">2 sao</option>
                                                            <option value="3">3 sao</option>
                                                            <option value="4">4 sao</option>
                                                            <option value="5">5 sao</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <p class="comment-form-comment"><textarea id="comment" required
                                                                                          name="content_ct"
                                                                                          cols="45" rows="10"
                                                                                          aria-required="true"
                                                                                          placeholder="Cảm nhận của bạn"></textarea>
                                                </p>
                                                <p class="form-submit"><input name="danhgia_ct" type="submit"
                                                                              id="submit" class="submit"
                                                                              value="Đánh giá"/> <input
                                                </p>
                                            </form>
                                        </div><!-- #respond -->
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>

                        </div>
                    </div>

                </div><!-- #product-503 -->
                <div class="related-products">
                    <div class="vi-heading">
                        <h3 class="before-title lienquan_item">Danh sách</h3>
                        <h4 class="title_lienquan">Thực đơn khác</h4>
                    </div>
                    <ul class="product-grid category-product-list row archive_switch">
                        {sanpham_lienquan}
                    </ul>
                </div>

            </main>

