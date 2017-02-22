<?php
$data_khach_hang = customer_getByTop('', '', 'name asc');
$string_data='[';
if(count($data_khach_hang)>0){
    foreach($data_khach_hang as $row_kh){
        $name_kh='';
        if($row_kh->mr!=''){
            $name_kh.=$row_kh->mr.'.';
        }
        $name_kh.=$row_kh->name;

        if($row_kh->avatar!=''){
            $avatar_kh=SITE_NAME.$row_kh->avatar;
        }
        else{
            $avatar_kh=SITE_NAME.'/view/default/themes/images/no-avatar.png';
        }
        $cate_name='Nhóm khách hàng ...';
        $cate_id='';
        if($row_kh->category!=0){
            $data_cate=customer_category_getById($row_kh->category);
            if(count($data_cate)>0){
                $cate_name=$data_cate[0]->name;
                $cate_id=$data_cate[0]->id;
            }
        }
        $string_data.="['".$name_kh."','".$avatar_kh."','".$row_kh->id."','".$row_kh->email."','".$row_kh->phone."','".$row_kh->address."','".$row_kh->fax."','".$cate_id."','".$cate_name."'],";
    }
}
$string_data.='];';
?>
<script src="<?php echo SITE_NAME?>/view/default/themes/admin/js/valid/booking.js"></script>
<link rel="stylesheet"
      href="<?php echo SITE_NAME ?>/view/default/themes/admin/js/autoComplete/jquery.auto-complete.css">
<script src="<?php echo SITE_NAME ?>/view/default/themes/admin/js/autoComplete/jquery.auto-complete.js"></script>


<script>
    $(function () {
        $('#hero-demo').autoComplete({
            minChars: 1,
            source: function (term, suggest) {
                term = term.toLowerCase();
                var choices = ['ActionScript', 'AppleScript', 'Asp', 'Assembly', 'BASIC', 'Batch', 'C', 'C++', 'CSS', 'Clojure', 'COBOL', 'ColdFusion', 'Erlang', 'Fortran', 'Groovy', 'Haskell', 'HTML', 'Java', 'JavaScript', 'Lisp', 'Perl', 'PHP', 'PowerShell', 'Python', 'Ruby', 'Scala', 'Scheme', 'SQL', 'TeX', 'XML'];
                var suggestions = [];
                for (i = 0; i < choices.length; i++)
                    if (~choices[i].toLowerCase().indexOf(term)) suggestions.push(choices[i]);
                suggest(suggestions);
            }
        });
        $('#input_name_customner').autoComplete({
            minChars: 0,
            source: function (term, suggest) {
                term = term.toLowerCase();
                var choices =<?php echo $string_data?>
                var suggestions = [];
                for (i = 0; i < choices.length; i++)
                    if (~(choices[i][0] + ' ' + choices[i][1]).toLowerCase().indexOf(term)) suggestions.push(choices[i]);
                suggest(suggestions);
            },
            renderItem: function (item, search) {
                search = search.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
                var re = new RegExp("(" + search.split(' ').join('|') + ")", "gi");
                return '<div title="' + item[0] + '-'+item[3]+'-'+item[4]+'" class="autocomplete-suggestion" data-langname="' + item[0] + '" data-id="' + item[2] + '" data-phone="' + item[4] + '" data-fax="' + item[6] + '" data-cateid="' + item[7] + '" data-catename="' + item[8] + '" data-email="' + item[3] + '" data-address="' + item[5] + '" data-val="' + search + '"><img style="width: 40px; height: 40px" src="' + item[1] + '"> ' + item[0] + '-'+item[3]+'</div>';
            },
            onSelect: function (e, term, item) {
//                console.log('Item "' + item.data('langname') + ' (' + item.data('lang') + ')" selected by ' + (e.type == 'keydown' ? 'pressing enter or tab' : 'mouse click') + '.');
                $('#input_name_customner').val(item.data('langname'));
                $('#input_id_customner').val(item.data('id'));
                $('#input_address').val(item.data('address'));
                $('#input_phone').val(item.data('phone'));
                $('#input_fax').val(item.data('fax'));
                $('#input_email').val(item.data('email'));
                $(".nhom_khach_hang .chosen-default span").html(item.data('catename'));
                $('#input_id_category').val(item.data('cateid'));
            }
        });
    });


</script>
<script src="j"></script>