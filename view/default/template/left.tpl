<div style="float: left;" id="secondary" class="widget-area col-sm-3" role="complementary">
    <aside id="woocommerce_products-2" class="widget woocommerce widget_products"><h3
                class="widget-title">Đặt bàn</h3>
        <form action="" method="post">
            <ul class="product_list_widget">
                <li style="margin-bottom: 13px;">
                    <div class="vi-date-wrap " style="width: 100%;">
                        <label for="date-otreservations">Chọn ngày <span style="color: red">*</span></label>
                        <div style="" class="wrapper-input">
                            <input id="date-otreservations" name="date_book" required
                                   class="vi-reservation-date input_left" type="text"
                                   value="">
                        </div>
                    </div>
                </li>
                <li style="margin-bottom: 13px;">
                    <label for="time-otreservations">Chọn giờ <span style="color: red">*</span></label>
                    <div class="wrapper-input">
                        <select id="time-otreservations" name="time_book" required
                                class="vi-reservation-time input_left">
                            <option value="8:00am">8:00 am</option>
                            <option value="8:30am">8:30 am</option>
                            <option value="9:00am">9:00 am</option>
                            <option value="9:30am">9:30 am</option>
                            <option value="10:00am">10:00 am</option>
                            <option value="10:30am">10:30 am</option>
                            <option value="11:00am">11:00 am</option>
                            <option value="11:30am">11:30 am</option>
                            <option value="12:00pm">12:00 pm</option>
                            <option value="12:30pm">12:30 pm</option>
                            <option value="1:00pm">1:00 pm</option>
                            <option value="1:30pm">1:30 pm</option>
                            <option value="2:00pm">2:00 pm</option>
                            <option value="2:30pm">2:30 pm</option>
                            <option value="3:00pm">3:00 pm</option>
                            <option value="3:30pm">3:30 pm</option>
                            <option value="4:00pm">4:00 pm</option>
                            <option value="4:30pm">4:30 pm</option>
                            <option value="5:00pm">5:00 pm</option>
                            <option value="5:30pm">5:30 pm</option>
                            <option value="6:00pm">6:00 pm</option>
                            <option value="6:30pm">6:30 pm</option>
                            <option value="7:00pm">7:00 pm</option>
                            <option value="7:30pm">7:30 pm</option>
                            <option value="8:00pm">8:00 pm</option>
                            <option value="8:30pm">8:30 pm</option>
                            <option value="9:00pm">9:00 pm</option>
                            <option value="9:30pm">9:30 pm</option>
                            <option value="10:00pm">10:00 pm</option>
                        </select>
                    </div>
                </li>
                <li style="margin-bottom: 13px;">
                    <label for="party-otreservations">Số người <span style="color: red">*</span></label>
                    <div class="wrapper-input">
                        <select id="party-otreservations" name="member_book" required
                                class="vi-party-size-select input_left">
                            <option value="1">1 Người</option>
                            <option value="2">2 Người</option>
                            <option value="3">3 Người</option>
                            <option value="4">4 Người</option>
                            <option value="5">5 Người</option>
                            <option value="6">6 Người</option>
                            <option value="7">7 Người</option>
                            <option value="8">8 Người</option>
                            <option value="9">9 Người</option>
                            <option value="10">10 Người</option>
                            <option value="11">11 Người</option>
                            <option value="12">12 Người</option>
                            <option value="13">13 Người</option>
                            <option value="14">14 Người</option>
                            <option value="15">15 Người</option>
                            <option value="16">16 Người</option>
                            <option value="17">17 Người</option>
                            <option value="18">18 Người</option>
                            <option value="19">19 Người</option>
                            <option value="20">20 Người</option>
                            <option value="Trên 20 người">Trên 20 Người</option>
                        </select>
                    </div>
                </li>
                <li style="margin-bottom: 13px;">
                    <label for="date-otreservations" style="margin-top: 10px">Họ tên <span style="color: red">*</span></label>
                    <div class="wrapper-input">
                        <input  required name="name_book" required
                                class=" input_left" type="text"
                                value="">
                    </div>
                </li>
                <li style="margin-bottom: 13px;">
                    <label for="date-otreservations" style="margin-top: 10px">Email <span style="color: red">*</span></label>
                    <div class="wrapper-input">
                        <input  required name="email_book" required
                                class="input_left" type="email"
                                value="">
                    </div>
                </li>
                <li style="margin-bottom: 13px;">
                    <label for="date-otreservations" style="margin-top: 10px">Điện thoại <span style="color: red">*</span></label>
                    <div class="wrapper-input">
                        <input required name="phone_book" class="input_left" required type="text" value="">
                    </div>
                </li>
                <li style="margin-bottom: 13px;">
                    <label for="date-otreservations" style="margin-top: 10px">Yêu cầu</label>
                    <div class="wrapper-input">
                        <textarea class="input_left" name="yeucau_book"></textarea>
                    </div>
                </li>
                <li style="margin-bottom: 13px;">
                    <input type="submit" class="otreservations-submit btn-primary btn" name="datban_book"
                           value="ĐẶT BÀN"/>
                </li>
            </ul>
        </form>
    </aside>
   {danhmuc_left}
    <aside id="woocommerce_products-2" class="widget woocommerce widget_products"><h3
                class="widget-title">TOP SELLER</h3>
        <ul class="product_list_widget">
         {noibat_left}
        </ul>
    </aside>
    <!--<aside id="echion_widget_single_image-4" class="widget echion_Widget_Single_Image_class">
        <div class="vi-single-image">
            <img class="vi-single-image" src="themes/wp-content/uploads/2016/07/ads.jpg" alt=""></div>
    </aside>-->
</div><!-- #secondary --></div>