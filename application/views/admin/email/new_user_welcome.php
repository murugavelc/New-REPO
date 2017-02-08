<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $subj; ?></title>
    <style type="text/css">
        body {
            background:#f3f3f3;
            padding-top: 0 !important;
            padding-bottom: 0 !important;
            padding-top: 0 !important;
            padding-bottom: 0 !important;
            margin:0 !important;
            width: 100% !important;
        }
        .tableContent img {
            border: 0 !important;
            display: block !important;
            outline: none !important;
        }
        a{
            color:#382F2E;
        }

        p, h1{
            color:#382F2E;
            margin:0;
        }
        p{
            text-align:left;
            color:#999999;
            font-size:14px;
            font-weight:normal;
            line-height:19px;
        }

        a.link1{
            color:#382F2E;
        }
        a.link2{
            font-size:16px;
            text-decoration:none;
            color:#ffffff;
        }

        h2{
            text-align:left;
            color:#222222;
            font-size:19px;
            font-weight:normal;
        }
        div,p,ul,h1{
            margin:0;
        }

        .bgItem {
            background: #ffffff none repeat scroll 0 0;
            border-radius: 13px;
            padding: 0 0 17px;
        }

    </style>



</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableContent bgBody" align="center"  style="background:#f3f3f3;">


    <tr><td align="center" height="80px"><img src="<?php echo BASE; ?>assets/images/email-logo.png" style="margin-top: 15px; margin-bottom: 15px;" /></td></tr>

    <tr>
        <td>
            <table width="600" border="0" cellspacing="0" cellpadding="0" align="center" class='bgItem'>
                <tr>
                    <td width='40'></td>
                    <td width='520'>
                        <table width="520" border="0" cellspacing="0" cellpadding="0" align="center">
                            <tr>
                                <td class='movableContentContainer ' valign='top'>

                                    <div class='movableContent'>
                                        <table width="520" border="0" cellspacing="0" cellpadding="0" align="center">
                                            <tr>
                                                <td valign='top' align='center'>
                                                    <img src="<?php echo BASE; ?>assets/images/email-banner.png" style="border-radius: 10px 10px 0 0;" />
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class='movableContent'>
                                        <table width="570" border="0" cellspacing="0" cellpadding="0" align="center">
                                            <tr>
                                                <td align='center'>
                                                    <h2 style="font-family:Tahoma, Geneva, sans-serif; font-size:24px; margin: 13px 0 0; text-align: center;">Notification</h2>

                                                </td>
                                            </tr>

                                            <tr><td height='15'></td></tr>

                                            <tr>
                                                <td align='left'>



                                                    <p style="font-family:Tahoma, Geneva, sans-serif;; font-size:13px; color:#333">
                                                        Hi <?php echo $user['first_name'].' '.$user['last_name'];?>,<br><br>
                                                        You have been added as <?php GLOBAL $USER_ROLES; echo $USER_ROLES[$user['role']]; ?> to salvage admin panel to manage. Please click activate button to create your password and activate your account.<br /><br />

                                                        <a href="<?php echo ADMIN_URL; ?>users/activate/<?php echo $reset_key; ?>" style="background: #0080c3; border-radius: 3px;  color: #fff; display: inherit; margin: 10px 0;padding: 5px 8px; text-decoration: none;  text-align: center;" target="_blank">Activate your Account</a>
                                                    </p>


                                                </td>
                                            </tr>

                                            <tr><td height='15'></td></tr>



                                            <tr>
                                                <td align='left'>
                                                    <p style="font-family:Tahoma, Geneva, sans-serif;; font-size:13px; color:#333">
                                                        If you have any questions about your account or any other matter, please feel free to contact us at support@salvage.com or by phone at 1800 000 000.
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr><td height="10px"></td></tr>
                                            <tr><td><p style="font-family:Tahoma, Geneva, sans-serif;; font-size:13px; color:#333; text-align:center">Thank you</p></td></tr>


                                        </table>
                                    </div>





                                </td>
                            </tr>
                            <!-- =============================== footer ====================================== -->




                        </table>
                    </td>
                    <td width='40'></td>
                </tr>

            </table>
    <tr><td height="10px"></td></tr>
    <tr><td><p style="font-family:Tahoma, Geneva, sans-serif;; font-size:13px; color:#333; text-align:center">Email Send By <strong>Salvage</strong></p></td></tr>
    <tr><td height="10px"></td></tr>
    <tr><td><p style="font-family:Tahoma, Geneva, sans-serif;; font-size:13px; color:#333; text-align:center">Copyright © 2017 Salvage. All Rights Reserved</p></td></tr>
    </td>
    </tr>

    <tr><td height='88'></td></tr>


</table>

</body>
</html>


















