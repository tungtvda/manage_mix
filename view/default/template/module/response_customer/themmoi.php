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

                        <div class="widget-toolbar">
                            <a href="#" data-action="collapse">
                                <i class="ace-icon fa fa-chevron-up"></i>
                            </a>
                            <a href="#" data-action="close">
                                <i class="ace-icon fa fa-times"></i>
                            </a>
                        </div>
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
                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tour  </label>
                                            <div class="col-sm-9">
											<span class="input-icon width_100">
												<input value="<?php echo $tour_name ?>" name="tour_name" type="text" disabled id="input_tour_name" class="width_100 " required="">

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
												<input value="<?php echo $customer ?>" name="customer_name" disabled type="text" id="input_customer" class="width_100 " required="">

											</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-group" >
                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tour Code  </label>
                                            <div class="col-sm-9">
											<span class="input-icon width_100">
												<input value="<?php echo $tour_code ?>"  name="tour_code" disabled type="text" id="input_tour_code" class="width_100 "  >

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
												<input value="<?php echo $domain ?>"  name="domain" type="text" id="input_domain" disabled class="width_100 " >

											</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-group" >
                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Content  </label>
                                            <div class="col-sm-9">
											<span class="input-icon width_100">
												<input value="<?php echo $content ?>" disabled name="content" type="text" id="input_content" class="width_100 " >

											</span>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Departure </label>
                                        <div class="col-sm-9">

                                           <span class="input-icon width_100">
												<input value="<?php echo $departure ?>"  disabled name="departure" type="text" id="input_departure" class="width_100 " >

											</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="space-4"></div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group" >
                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Program  </label>
                                        <div class="col-sm-9">
												<span style="width: 50%" class="input-icon width_100">
												<input  name="input"  type="text" id="input_program" disabled class="width_100" value="<?php echo $program ?>"/>
											</span>
                                            <label class="inline">
                                                <input <?php echo $show_program ?> name="show_program" type="checkbox" class="ace input-lg">
                                                <span class="lbl"> Show </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Hotel </label>
                                        <div class="col-sm-9">
												<span style="width: 50%" class="input-icon width_100">
												<input disabled name="input"  type="text" id="input_show_hotel" class="width_100" value="<?php echo $hotel?>"/>
											</span>
                                            <label class="inline">
                                                <input <?php echo $show_hotel?> name="show_hotel" type="checkbox" class="ace input-lg">
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
                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tour guide full </label>
                                        <div class="col-sm-9">
												<span style="width: 50%" class="input-icon width_100">
												<input disabled  name="input"  type="text" id="input_tour_guide_full" class="width_100" value="<?php echo $tour_guide_full?>"/>
											</span>
                                            <label class="inline">
                                                <input <?php echo $show_tour_guide_full?> name="show_tour_guide_full" type="checkbox" class="ace input-lg">
                                                <span class="lbl"> Show </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tour guide local </label>
                                        <div class="col-sm-9">
												<span style="width: 50%" class="input-icon width_100">
												<input  name="input"  type="text" disabled id="input_tour_guide_local" class="width_100" value="<?php echo $tour_guide_local?>"/>
											</span>
                                            <label class="inline">
                                                <input <?php echo $show_tour_guide_local?> name="show_tour_guide_local" type="checkbox" class="ace input-lg">
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
                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Restaurant </label>
                                        <div class="col-sm-9">
												<span style="width: 50%" class="input-icon width_100">
												<input name="input"  disabled type="text" id="input_restaurant" class="width_100" value="<?php echo $restaurant?>"/>
											</span>
                                            <label class="inline">
                                                <input <?php echo $show_restaurant?> name="show_restaurant" type="checkbox" class="ace input-lg">
                                                <span class="lbl"> Show </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Transportation </label>
                                        <div class="col-sm-9">
												<span style="width: 50%" class="input-icon width_100">
												<input name="input"  type="text" disabled id="input_transportation" class="width_100" value="<?php echo $transportation?>"/>
											</span>
                                            <label class="inline">
                                                <input <?php echo $show_transportation?> name="show_transportation" type="checkbox" class="ace input-lg">
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
											    <textarea name="upcoming_tour" disabled style="width: 100%;height: 70px" ><?php echo $upcoming_tour ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9">
                                            <label class="inline">
                                                <input <?php echo $status?> name="status" type="checkbox" class="ace input-lg">
                                                <span class="lbl"> Status </span>
                                            </label>
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
                                            <textarea name="comment" disabled style="width: 100%;height: 200px" ><?php echo $comment ?></textarea>

                                        </div>

                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <label class="inline">
                                        <input <?php echo $show_coment?> name="show_coment" type="checkbox" class="ace input-lg">
                                        <span class="lbl"> Show </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <div class="space-4"></div>

                        <div class="clearfix">
                            <div class=" col-md-12" style="text-align: right">
                                <button class="btn btn-info" type="button" id="submit_form_action">
                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                    Submit
                                </button>

                                &nbsp; &nbsp; &nbsp;
                                <button class="btn" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i>
                                    Reset
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






