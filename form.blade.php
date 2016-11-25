@extends('ecommerce.backend.layout.backend')

@section('content')
    <div id="content">
    @include('partials.layout.page-header')
    <!-- /.page-header -->

        <!-- .page-content -->
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-pencil"></i>
                        {!! $cfg['panelTitle'] !!}
                    </h3>
                </div>
                <div class="panel-body">
                {!! Form::model($node, ['url' => '', 'id' => "form-role"]) !!}

                {!! Form::bsText('name', null, 'Role Name', ['class' => 'form-control', 'placeholder' => 'Add New Role', 'required' => true]) !!}
                <!-- /.form-group-name -->

                {!! Form::bsCheckbox('type', 'super_administrator', 'Is Super Admin', (!empty($node->type) && 'super_administrator' == $node->type) ?true : false) !!}
                <!-- /.form-group-name -->
                    <div class="permissions col-md-12 clear-fix">
                        <div class="tree x-tree" id="resource-tree"></div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    @include('partials.layout.loading')

@endsection

@push('style-top')
<link rel="stylesheet" type="text/css" href="{{URL::asset("backend/plugins/easyui/themes/metro/easyui.css")}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset("backend/plugins/easyui/themes/icon.css")}}">
<style>
    .list-group {
        margin: 0;
    }

    #administrators .list-group-item .fa-angle {
        margin-left: 5px;
        color: #000;
    }

    #administrators .list-group-item .fa-angle:before {
        content: "\f107";
        transition: all 0.5s ease;
    }

    #administrators .list-group-item .collapsed .fa-angle:before {
        content: "\f105" !important;
    }


</style>

@endpush

@push('scripts')
<script src="{{URL::asset("backend/plugins/easyui/jquery.easyui.min.js")}}"></script>
<script type="text/javascript">
    (function ($) {
        /**
         * Submit ajax
         * */
        $('.page-header button[type="button"]').on('click', function () {
            $('.wrap-overlay').show();
            $('.error').html('');
            var $form = $('form#form-role');
            var formData = new FormData($form[0]);
            formData.append('permission', JSON.stringify($('#resource-tree').tree('getChecked')));
            $.ajax({
                "url": $form.action,
                "method": 'POST',
                "processData": false, // Don't process the files
                "contentType": false,
                "dataType": "json",
                "data": formData, // $form.serialize()
                error: function (xhr, status, error) {
                    var responseJSON = xhr.responseJSON;
                    (responseJSON.redirect) ? (location.href = responseJSON.redirect) : (location.href = '/');
                }
            })
                    .then(function (response) {
                        if (response.success) {
                            location.href = "{{URL::route('admin_roles')}}";
                        }

                        if (response.errors) {
                            $.each(response.errors, function (index, item) {
                                $('.error.error-' + index).html(item[0]);
                            });
                        }
                        $('.wrap-overlay').hide();
                    })
                    .then(function (errors) {
                        if (errors) {
                            console.log(errors);
                        }
                        $('.wrap-overlay').hide();
                    });

        });

        /**
         *
         * */
                <?php
                $permissionAsigned = isset($node->permission) ? $node->permission : null;
                $permissionList = Permission::permissionJson('administrator', $permissionAsigned);
                $permissionJson = json_encode($permissionList, JSON_PRETTY_PRINT);
                ?>
        var permissions = <?php print $permissionJson; ?>;

        $('#resource-tree').tree({
            'animate': true,
            'checkbox': true,
            'data': [{
                "text": "Allow All Access",
                "route": "",
                "children": JSON.parse(permissions)
            }]
        });
    }(jQuery));


</script>
@endpush


