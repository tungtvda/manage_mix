<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/24/2016
 * Time: 8:04 AM
 */
?>

<div class="page-header">

    <h1>
        <?php echo $tieude?>
    </h1>

</div><!-- /.page-header -->
<div class="row">
    <div class="col-xs-12">
        <form class="form-horizontal" id="submit_form" role="form" action="" method="post" enctype="multipart/form-data">



            <div class="col-sm-19">
                <div class="widget-box">

                    <div class="widget-header">
                        <h4 class="widget-title">Thông tin phản hồi</h4>
                    </div>
                    <style>
                        .control-label{
                            font-size: 14px;
                        }
                        .form-horizontal .form-group {
                            margin-left: 0px;
                            margin-right: 0px;
                        }
                    </style>

                    <div class="widget-body">
                        <div class="widget-main">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-group" >
                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Hotel  </label>
                                            <div class="col-sm-9">
											<span class="input-icon width_100">
												<input value="<?php echo $hotel_name ?>"  name="hotel_name" type="text" disabled id="input_hotel_name" class="width_100 " required="">

											</span>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Customer </label>
                                        <div class="col-sm-9">

                                           <span class="input-icon width_100">
												<input  value="<?php echo $customer ?>" name="customer_name" disabled type="text" id="input_customer" class="width_100 " required="">

											</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-group" >
                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Hotel Code  </label>
                                            <div class="col-sm-9">
											<span class="input-icon width_100">
												<input  value="<?php echo $hotel_code ?>"  name="hotel_code" disabled type="text" id="input_hotel_code" class="width_100 "  >

											</span>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Domain </label>
                                        <div class="col-sm-9">

                                           <span class="input-icon width_100">
												<input  value="<?php echo $domain ?>"  name="domain" type="text" id="input_domain" disabled class="width_100 " >

											</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-group" >
                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Start date  </label>
                                            <div class="col-sm-9">
											<span class="input-icon width_100">
												<input  value="<?php echo $start_date ?>" disabled name="content" type="text" id="input_start_date" class="width_100 " >

											</span>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> End date </label>
                                        <div class="col-sm-9">

                                           <span class="input-icon width_100">
												<input  value="<?php echo $end_date ?>"  disabled name="content" type="text" id="input_end_date" class="width_100 " >

											</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="space-4"></div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group" >
                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Clear  </label>
                                        <div class="col-sm-9">
												<span style="width: 50%" class="input-icon width_100">
												<input  name="input"  type="text" id="input_clear" disabled class="width_100"  value="<?php echo $clear ?>"/>
											</span>
                                            <label class="inline">
                                                <input  name="show_clear"  <?php echo $show_clear ?> type="checkbox" class="ace input-lg">
                                                <span class="lbl"> Show </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Comfort </label>
                                        <div class="col-sm-9">
												<span style="width: 50%" class="input-icon width_100">
												<input disabled name="input"  type="text" id="input_comfort" class="width_100"  value="<?php echo $comfort ?>"/>
											</span>
                                            <label class="inline">
                                                <input  name="show_comfort" type="checkbox"  <?php echo $show_comfort ?> class="ace input-lg">
                                                <span class="lbl"> Show </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="space-4"></div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Convenient </label>
                                        <div class="col-sm-9">
												<span style="width: 50%" class="input-icon width_100">
												<input disabled  name="input"  type="text" id="input_convenient" class="width_100" value="<?php echo $convenient ?>"/>
											</span>
                                            <label class="inline">
                                                <input  name="show_convenient" type="checkbox" <?php echo $show_convenient ?> class="ace input-lg">
                                                <span class="lbl"> Show </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Staff </label>
                                        <div class="col-sm-9">
												<span style="width: 50%" class="input-icon width_100">
												<input  name="input"  type="text" disabled id="input_staff" class="width_100" value="<?php echo $staff ?>"/>
											</span>
                                            <label class="inline">
                                                <input  name="show_staff" type="checkbox" <?php echo $show_staff ?> class="ace input-lg">
                                                <span class="lbl"> Show </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="space-4"></div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Room </label>
                                        <div class="col-sm-9">
												<span style="width: 50%" class="input-icon width_100">
												<input name="input"  disabled type="text" id="input_room" class="width_100" value="<?php echo $room ?>"/>
											</span>
                                            <label class="inline">
                                                <input  name="show_room" type="checkbox" <?php echo $show_room ?> class="ace input-lg">
                                                <span class="lbl"> Show </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Price </label>
                                        <div class="col-sm-9">
												<span style="width: 50%" class="input-icon width_100">
												<input name="input"  type="text" disabled id="input_price" class="width_100" value="<?php echo $price ?>"/>
											</span>
                                            <label class="inline">
                                                <input  name="show_price" type="checkbox" <?php echo $show_price ?> class="ace input-lg">
                                                <span class="lbl"> Show </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="space-4"></div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Food </label>
                                        <div class="col-sm-9">
												<span style="width: 50%" class="input-icon width_100">
												<input name="input"  disabled type="text" id="input_food" class="width_100" value="<?php echo $food ?>"/>
											</span>
                                            <label class="inline">
                                                <input  name="show_food" type="checkbox" <?php echo $show_food ?> class="ace input-lg">
                                                <span class="lbl"> Show </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Place </label>
                                        <div class="col-sm-9">
                                                        <span style="width: 50%" class="input-icon width_100">
                                                        <input name="input"  type="text" disabled id="input_place" class="width_100" value="<?php echo $place ?>"/>
											            </span>
                                            <label class="inline">
                                                <input  name="show_place" type="checkbox" <?php echo $show_place ?> class="ace input-lg">
                                                <span class="lbl"> Show </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="space-4"></div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Upcoming Tour </label>
                                        <div class="col-sm-9">
                                            <textarea id="upcoming_tour" name="upcoming_tour" disabled style="width: 100%;height: 70px" ><?php echo $upcoming_tour ?></textarea>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Content </label>
                                        <div class="col-sm-9">

                                           <span class="input-icon width_100">
												<input value="<?php echo $content ?>"  name="domain" type="text" id="input_content" disabled class="width_100 " >

											</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="space-4"></div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Comment </label>
                                        <div class="col-sm-9">
                                            <textarea name="comment" id="input_comment" disabled style="width: 100%;height: 100px" ><?php echo $comment ?></textarea>

                                        </div>

                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <label class="inline">
                                        <input name="show_comment" type="checkbox" <?php echo $show_coment ?> class="ace input-lg">
                                        <span class="lbl"> Show </span>
                                    </label>
                                </div>
                                <div class="col-sm-2">
                                    <label class="inline">
                                        <input  name="status" type="checkbox" <?php echo $status ?> class="ace input-lg">
                                        <span class="lbl"> Status </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="">
                        <div class="space-4"></div>

                        <div class="clearfix">
                            <div class=" col-md-12" style="text-align: right">
                                <button class="btn btn-info" type="button" id="submit_form_action">
                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                    Submit
                                </button>

                            </div>
                        </div>

                        <div style="margin-bottom: 11px" class="hr hr-24"></div>

                    </div>
                </div>
            </div>

    </div>
    </form>
    <!-- PAGE CONTENT BEGINS -->

</div><!-- /.col -->
</div><!-- /.row -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $('#submit_form_action').click(function () {
        $('form').submit();
    })
</script>






