<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/24/2016
 * Time: 8:04 AM
 */
?>
<link rel="stylesheet" type="text/css" href="<?php echo SITE_NAME?>/view/default/themes/admin/css/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php echo SITE_NAME?>/view/default/themes/admin/css/icon.css">

<div class="page-header">
    <h1>
        Phân quyền tài khoản <?php echo $_SESSION["user_name"]?>
    </h1>
</div>
<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->

        <div class="row">
            <div class="col-sm-6">
                <div class="widget-box widget-color-blue2">
                    <div class="widget-body">
                        <div class="widget-main padding-8">

                            <input hidden value="<?php echo $user_id?>" id="id_user_hidden">
                            <input hidden value="<?php echo $user_id?>" id="id_user_hidden">
                            <div style="margin:20px 0;">
                                <a href="javascript:void(0)" class="easyui-linkbutton btn btn-white  btn-create-new-tab btn-create-new-tab-hover"> <i class="ace-icon fa fa-edit bigger-120 "></i> Cập nhật quyền</a>
                            </div>
                            <div style="margin:10px 0">
<!--                                <input type="checkbox" checked onchange="$('#tt').tree({cascadeCheck:$(this).is(':checked')})">CascadeCheck-->
<!--                                <input type="checkbox" onchange="$('#tt').tree({onlyLeafCheck:$(this).is(':checked')})">OnlyLeafCheck-->
                            </div>
                            <div class="easyui-panel" style="padding:5px">
                                <form action="" method="post">
                                    <ul id="tt" class="easyui-tree" data-options="url:'<?php echo SITE_NAME?>/tree-phan-quyen?id=<?php echo $user_id?>',method:'get',animate:true,checkbox:true"></ul>
                                </form>

                            </div>
                            <script type="text/javascript">

//                                function getChecked(){
//                                    var nodes = $('#tt').tree('getChecked');
//                                    var test=JSON.stringify($('#tt').tree('getChecked'));
//                                    console.log(nodes);
//                                    $.ajax({
//                                        "url": '<?php //echo SITE_NAME?>//',
//                                        "method": 'POST',
//                                        "processData": false, // Don't process the files
//                                        "contentType": false,
//                                        "dataType": "json",
//                                        "data": test, // $form.serialize()
//                                        error: function (xhr, status, error) {
//                                        }
//                                    })
//                                    var s = '';
//                                    for(var i=0; i<nodes.length; i++){
//                                        if (s != '') s += ',';
//                                        s += nodes[i].text;
//                                    }
//                                    alert(s);
//                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <script type="text/javascript">
            var $assets = "dist";//this will be used in fuelux.tree-sampledata.js
        </script>

        <!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
</div><!-- /.row -->
