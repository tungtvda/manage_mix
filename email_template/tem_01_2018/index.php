<?php
function returnEmail01218(){
    return '<head>
    <title>{{TITLE}}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body bgcolor="#ebeff0">
<table align="center" class="emailphoneresize" border="0" cellspacing="0" cellpadding="0" width="100%"
       bgcolor="#ebeff0">
    <tbody>
    <tr>
        <td align="center">
            <table align="center" class="emailphoneresize" border="0" cellspacing="0" cellpadding="0" width="900"
                   bgcolor="#ffffff">
                <tbody>
                <tr>
                    <td align="center">
                        <table align="center" class="emailphoneresize" border="0" cellspacing="0" cellpadding="0"
                               width="900" bgcolor="#ebeff0">
                            <tbody>
                            <tr>
                                <td class="mobpadnav" style="padding: 20px 30px 20px 30px;" bgcolor="#ebeff0">


                                    <table class="emailphoneresize" style="float: left" cellpadding="0" cellspacing="0"
                                           border="0" align="left" bgcolor="#ebeff0">
                                        <tbody>
                                        <tr>
                                            <td class="padleft10" bgcolor="#ebeff0"
                                                style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#374959;">
                                                <a href="#" style="color:#374959; text-decoration:none;"
                                                   target="_blank">{{DATE_NOW}}</a></td>
                                        </tr>
                                        </tbody>
                                    </table>

                                    <table class="nomob" style="float: right" cellpadding="0" cellspacing="0" border="0" align="left"
                                           bgcolor="#ebeff0">
                                        <tbody>
                                        <tr>
                                            <td class="padleft10"
                                                style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#374959;">
                                                <a href="{{LINK_WEBSITE}}" style="color:#374959; text-decoration:none;"
                                                   target="_blank">{{WEBSITE}}</a></td>
                                        </tr>
                                        </tbody>
                                    </table>


                                </td>

                            </tr>
                            </tbody>
                        </table>
                        <table class="emailphoneresize" border="0" cellspacing="0" cellpadding="0" width="900"
                               bgcolor="#ffffff">
                            <tbody>
                            <tr>
                                <td align="center" style="padding-left:10px" class="AAlogoPad"><a
                                        href="{{LINK_WEBSITE}}" target="_blank"><img style="width: 200px"
                                                                                                  src="{{LOGO}}"
                                                                                                  border="0"
                                                                                                  alt="{{NAME}}"
                                                                                                  title="{{NAME}}"

                                                                                                  class="resizeimageto200"></a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <table align="center" style="font-size:1px; line-height:1px; border-collapse:collapse;"
                               class="emailphoneresize" border="0" cellspacing="0" cellpadding="0" width="900"
                               bgcolor="#bfbfbf">
                            <tbody>
                            <tr>
                                <td height="1"
                                    style="padding:0px; background-color:#bfbfbf; font-size:0px; line-height:0px; border-collapse:collapse;">
                                    <img src="http://www.aa.com/content/images/email/marketingOneOff/PDP/spacer50.gif"
                                         border="0" alt="" width="1" height="1" style="display:block;"></td>
                            </tr>
                            </tbody>
                        </table>
                        <table align="center" class="nomob" border="0" cellspacing="0" cellpadding="0" width="900"
                               bgcolor="#ffffff">
                            <tbody>
                            <tr>
                                <td class="resizeimageto320" align="center" ><a href="{{LINK_BANNE}}" target="_blank"><img
                                        style="display:block; width: 100%;"
                                        src="{{BANNER}}"
                                        border="0" alt="{{NAME}}" title="{{NAME}}"
                                        class="nomob" width="900"></a></td>
                            </tr>
                            </tbody>
                        </table>

                        <table align="center" style="font-size:1px; line-height:1px; border-collapse:collapse;"
                               class="emailphoneresize" border="0" cellspacing="0" cellpadding="0" width="900"
                               bgcolor="#bfbfbf">
                            <tbody>
                            <tr>
                                <td height="1"
                                    style="padding:0px; background-color:#bfbfbf; font-size:0px; line-height:0px; border-collapse:collapse;">
                                    <img src="http://www.aa.com/content/images/email/marketingOneOff/PDP/spacer50.gif"
                                         border="0" alt="" width="1" height="1" style="display:block;"></td>
                            </tr>
                            </tbody>
                        </table>
                        <table class="emailphoneresize" border="0" cellspacing="0" cellpadding="0" width="900"
                               align="center">
                            <tbody>
                            <tr>
                                <td class="paddingB30pxLR20px"
                                    style="font-family:Arial, Helvetica, sans-serif; font-size:18px; line-height:18px; color:#36495A; font-weight:bold;padding:30px 30px 34px 30px;"
                                    align="left">
                                    <p style="text-align: center; text-transform: uppercase">
                                        <span style="font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif !important;mso-line-height-rule:exactly;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;    color: #0061AB;">{{TITLE}}</span>
                                    </p>

                                    <div class="content" style="font-size: 14px; float: left;width: 100%">
                                       {{CONTENT}}
                                    </div>

                                    <div class="link_khoi_hanh" style="float: left; width: 100%; margin-bottom: 40px; text-align: center;    margin-top: 20px;">
                                       <a href="{{LINK_KHOI_HANH}}" style=" text-decoration: none;color: #ffffff;background-color: #f36f21;padding: 10px 10px;font-size: 16px;">Mời bạn tham khảo: Lịch khởi hành mới nhất tại đây >></a>
                                    </div>

                                    <div class="banner_qc" style="float: left; width: 100%; margin-bottom: 20px; text-align: center;box-shadow: 0px 0px 5px rgba(0,0,0,.1);">
                                       <a href="{{LINK_BANNER_QC}}"><img src="{{BANNER_QC}}" style="width: 100%"></a>
                                    </div>
                                    <div class="tour_quan_tam"
                                         style="float: left; width: 100%; border-top:1px solid #c7c8c8">
                                        <p style="text-align: center; text-transform: uppercase">
                                            <span style="font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif !important;mso-line-height-rule:exactly;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;    color: #0061AB;">Có thể bạn quan tâm</span>
                                        </p>
                                       {{TOUR_NOI_BAT}}
                                    </div>

                                    <div class="footer"  style="float: left; width: 100%; border-top:1px solid #c7c8c8; padding-top: 20px">
                                       {{FOOTER}}
                                    </div>
                                </td>
                            </tr>


                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>


</body>';
}
?>



