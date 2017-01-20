<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/24/2016
 * Time: 8:04 AM
 */
?>
<div class="page-header">
    <input hidden value="<?php echo SITE_NAME?>" id="url_input">
    <h1>
        Danh sách nhân viên
    </h1>

</div><!-- /.page-header -->
<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
            <div class="col-xs-12">
                <div class="clearfix">
                    <div class="col-md-6 col-sm-6 col-xs-12 pink" style="padding-left: 0px">
                        <a href="#modal-form" role="button"  data-toggle="modal" class="green btn btn-white btn-create btn-hover-white">
                            <i class="ace-icon fa fa-plus bigger-120 "></i>
                            Create popup
                            <i class="ace-icon fa fa-external-link"></i>
                        </a>
                        <a href="" class="btn btn-white  btn-create-new-tab btn-create-new-tab-hover" >
                            <i class="ace-icon fa fa-plus bigger-120 "></i>
                            Create new tab
                            <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                        </a>
                        <a href="" class="btn btn-white  btn-refresh" >
                            <i class="ace-icon fa fa-refresh"></i>
                            Refresh
                        </a>
                        <div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-sm btn-danger dropdown-toggle btn-action-gird" aria-expanded="false">
                                Action
                                <i class="ace-icon fa fa-angle-down icon-on-right"></i>
                            </button>

                            <ul class="dropdown-menu dropdown-danger">
                                <li>
                                    <a href="">Edit</a>
                                </li>

                                <li>
                                    <a href="">Delete</a>
                                </li>

                                <li>
                                    <a href="">Something else here</a>
                                </li>

                                <li class="divider"></li>

                                <li>
                                    <a href="">Separated link</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 " style="padding-left: 0px">
                        <div class="pull-right tableTools-container"></div>
                    </div>
                </div>

                <div class="hr hr-18 dotted hr-double"></div>
                <!--<div class="table-header">
                    Results for "Users"
                </div>-->

                <!-- div.table-responsive -->

                <!-- div.dataTables_borderWrap -->
                <div>
                    <table id="dynamic-table" class="table table-striped table-bordered table-hover table-responsive">
                        <thead>
                        <tr>
                            <th class="center">
                                <label class="pos-rel">
                                    <input type="checkbox" class="ace" />
                                    <span class="lbl"></span>
                                </label>
                            </th>
                            <th>#</th>
                            <th>Họ tên</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Gender</th>
                            <th>Status</th>

                            <th class="sorting" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" aria-label="

															Update
														: activate to sort column ascending">
                                <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                                Created
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" aria-label="

															Update
														: activate to sort column ascending">
                                <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                                Update
                            </th>
                            <th >Action</th>

                        </tr>
                        </thead>
                        <form action="" method="post">
                            <tbody>
                            <?php if(count($list)>0){?>
                                <?php $dem=1;?>
                                <?php foreach($list as $row){?>
                                    <tr>
                                        <td class="center">
                                            <label class="pos-rel">
                                                <input type="checkbox" class="ace click_check_list" value="<?php echo $row->id?>" />
                                                <span class="lbl"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <?php echo $dem;?>
                                        </td>
                                        <td>
                                            <a href="<?php echo SITE_NAME?>/nhan-vien/chi-tiet/<?php echo $row->id?>"><?php echo $row->name?></a>
                                        </td>
                                        <td><?php echo $row->user_email?></td>
                                        <td><?php echo $row->phone?></td>
                                        <td>
                                            <span hidden><?php echo (int)$row->gender?></span>
                                            <?php if($row->gender==0) echo ' <i style="font-size: 20px;" class="fa fa-male"></i>'?>
                                            <?php if($row->gender==1) echo ' <i style="font-size: 20px; color: #ec008c" class="fa fa-female"></i>'?>
                                        </td>
                                        <td>
                                            <span hidden><?php echo (int)$row->status?></span>
                                            <label>
                                                <input <?php if($row->status) echo 'checked'?> id="checkbox_status_<?php echo $row->id?>" countid="<?php echo $row->id?>" name_record="<?php echo $row->name?>" table="user" field="status"  class="ace ace-switch ace-switch-7 checkbox_status" type="checkbox">
                                                <span class="lbl"></span>
                                            </label>
                                        </td>
                                        <td><?php echo _returnDateFormatConvert($row->created)?></td>
                                        <td><?php echo _returnDateFormatConvert($row->updated)?></td>

                                        <td>
                                            <div class="hidden-sm hidden-xs action-buttons">
                                                <a class="blue" href="#"  title="View popup">
                                                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                                </a>
                                                <a class="" href="#" title="Sửa popup">
                                                    <i class="ace-icon glyphicon glyphicon-edit"></i>
                                                </a>
                                                <a title="Sửa tab mới" class="green" href="<?php echo SITE_NAME?>/nhan-vien/sua/<?php echo $row->id?>">
                                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                </a>

                                                <a title="Xóa"  class="red delete_record" href="javascript:void(0)" deleteid="<?php echo $row->id?>" name_record_delete="<?php echo $row->name?>" url_delete="<?php echo SITE_NAME?>/nhan-vien/xoa/">
                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                </a>
                                                <a title="Phân quyền" class="blue" href="<?php echo SITE_NAME?>/nhan-vien/phan-quyen/<?php echo $row->id?>">
                                                    <i class="ace-icon fa fa-cogs bigger-130"></i>
                                                </a>
                                            </div>

                                            <div class="hidden-md hidden-lg">
                                                <div class="inline pos-rel">
                                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                        <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                                    </button>

                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                        <li>
                                                            <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
																				<span class="blue">
																					<i class="ace-icon fa fa-search-plus bigger-120"></i>
																				</span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
																				<span class="green">
																					<i class="ace-icon fa fa-pencil bigger-120"></i>
																				</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Chỉnh sửa">
																				<span class="">
																					<i class="ace-icon glyphicon glyphicon-edit  bigger-120"></i>
																				</span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="javascript:void(0)" deleteid="<?php echo $row->id?>" name_record_delete="<?php echo $row->name?>" url_delete="<?php echo SITE_NAME?>/nhan-vien/xoa/" class="tooltip-error delete_record"  title="Xóa">
																				<span class="red">
																					<i class="ace-icon fa fa-trash-o bigger-120"></i>
																				</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
																				<span class="green">
																					<i class="ace-icon fa fa-cogs bigger-120"></i>
																				</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $dem++;?>
                                <?php }?>
                            <?php }?>
                            </tbody>
                        </form>

                    </table>
                </div>
                <div class="hr hr-18 dotted hr-double"></div>
                <div class="btn-groupn col-md-12" style="padding-left: 0px">
                    <button data-toggle="dropdown" class="btn btn-sm btn-danger dropdown-toggle btn-action-gird" aria-expanded="false">
                        Action
                        <i class="ace-icon fa fa-angle-down icon-on-right"></i>
                    </button>

                    <ul class="dropdown-menu dropdown-danger">
                        <li>
                            <a class="edit_function" href="javascript:void(0)">Sửa</a>
                        </li>

                        <li>
                            <a class="delete_function" href="javascript:void(0)">Xóa</a>
                        </li>

                        <li class="divider"></li>

                        <li>
                            <a href="<?php echo SITE_NAME?>/nhan-vien/them-moi/">Thêm</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>


        <div  id="modal-form" class="modal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="blue bigger">Tạo mới nhân viên</h4>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-xs-12 col-sm-4 col-md-4">
                                        <div id="preview">
                                            <img class="img-responsive" src="<?php echo SITE_NAME?>/view/default/themes/images/no-image.jpg">
                                        </div>

                                        <input name="image" type="file" id="id-input-file-2"/>
                                        <input id="button" type="submit" value="Upload">
                                    </div>

                                </div>


                                <div class="col-xs-12 col-sm-7">
                                    <div class="form-group">
                                        <label for="form-field-select-3">Location</label>

                                        <div>
                                            <select class="chosen-select" data-placeholder="Choose a Country...">
                                                <option value="">&nbsp;</option>
                                                <option value="AL">Alabama</option>
                                                <option value="AK">Alaska</option>
                                                <option value="AZ">Arizona</option>
                                                <option value="AR">Arkansas</option>
                                                <option value="CA">California</option>
                                                <option value="CO">Colorado</option>
                                                <option value="CT">Connecticut</option>
                                                <option value="DE">Delaware</option>
                                                <option value="FL">Florida</option>
                                                <option value="GA">Georgia</option>
                                                <option value="HI">Hawaii</option>
                                                <option value="ID">Idaho</option>
                                                <option value="IL">Illinois</option>
                                                <option value="IN">Indiana</option>
                                                <option value="IA">Iowa</option>
                                                <option value="KS">Kansas</option>
                                                <option value="KY">Kentucky</option>
                                                <option value="LA">Louisiana</option>
                                                <option value="ME">Maine</option>
                                                <option value="MD">Maryland</option>
                                                <option value="MA">Massachusetts</option>
                                                <option value="MI">Michigan</option>
                                                <option value="MN">Minnesota</option>
                                                <option value="MS">Mississippi</option>
                                                <option value="MO">Missouri</option>
                                                <option value="MT">Montana</option>
                                                <option value="NE">Nebraska</option>
                                                <option value="NV">Nevada</option>
                                                <option value="NH">New Hampshire</option>
                                                <option value="NJ">New Jersey</option>
                                                <option value="NM">New Mexico</option>
                                                <option value="NY">New York</option>
                                                <option value="NC">North Carolina</option>
                                                <option value="ND">North Dakota</option>
                                                <option value="OH">Ohio</option>
                                                <option value="OK">Oklahoma</option>
                                                <option value="OR">Oregon</option>
                                                <option value="PA">Pennsylvania</option>
                                                <option value="RI">Rhode Island</option>
                                                <option value="SC">South Carolina</option>
                                                <option value="SD">South Dakota</option>
                                                <option value="TN">Tennessee</option>
                                                <option value="TX">Texas</option>
                                                <option value="UT">Utah</option>
                                                <option value="VT">Vermont</option>
                                                <option value="VA">Virginia</option>
                                                <option value="WA">Washington</option>
                                                <option value="WV">West Virginia</option>
                                                <option value="WI">Wisconsin</option>
                                                <option value="WY">Wyoming</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="space-4"></div>

                                    <div class="form-group">
                                        <label for="form-field-username">Username</label>

                                        <div>
                                            <input type="text" id="form-field-username" placeholder="Username" value="alexdoe" />
                                        </div>
                                    </div>

                                    <div class="space-4"></div>

                                    <div class="form-group">
                                        <label for="form-field-first">Name</label>

                                        <div>
                                            <input type="text" id="form-field-first" placeholder="First Name" value="Alex" />
                                            <input type="text" id="form-field-last" placeholder="Last Name" value="Doe" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-sm" data-dismiss="modal">
                                <i class="ace-icon fa fa-times"></i>
                                Cancel
                            </button>

                            <button class="btn btn-sm btn-primary">
                                <i class="ace-icon fa fa-check"></i>
                                Save
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div><!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->

</div><!-- /.row -->

