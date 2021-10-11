<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Invoice</title>
</head>
<body>
<table style="width: 80%; margin: 0 auto; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 30px;">
    <thead>
        <tr>
            <th colspan="2"><img src="https://edugatein.com/assets/front/images/logo.png" width="180" alt=""></th>
        </tr>
        <tr><th colspan="2" style="border-bottom: 1px solid #ddd;">&nbsp;</th></tr>
        <tr>
            <th colspan="2" style="background:#fae6f0;text-align: center; padding: 10px; font-size: 25px;">
                <?php if($school[0]['school_category_id'] == 1){ ?>
                School Platinum Package
                <?php } else if($school[0]['school_category_id'] == 2){ ?>
                School Premium Package
                <?php } else if($school[0]['school_category_id'] == 3){ ?>
                School Spectrum Package
                <?php } else if($school[0]['school_category_id'] == 4) { ?>
                School Trial Package
                <?php } ?>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td width="50%">
                To : <b style="font-size: 18px;color: #d12881;"><?php echo $user[0]['name']; ?></b><br>
                Address : <b><?php echo $user[0]['address']; ?></b><br>
                Phone No : <b><?php echo $user[0]['phone']; ?></b><br>
                Email : <b><?php echo $user[0]['email']; ?></b>
            </td>
            <td style="text-align: right;">
                <b>Invoice</b><br>
                <?php $invoice_date = date('d-m-Y',strtotime($school[0]['created_at'])); ?>
                <!-- ID: <b style="font-size: 15px;">#111-222</b><br> -->
                Invoice Date : <b><?php echo $invoice_date ?></b>
            </td>
        </tr>
        <tr><td height="30">&nbsp;</td></tr>        
    </tbody>
</table>
<table style="width: 80%; margin: 0 auto; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 30px;">
    <thead>
        <tr style="background-color: #d12881; color: #fff; font-weight: 600;">
            <th width="70%" style="padding: 10px; text-align: left;">Package Details</th>
            <th width="30%" style="padding: 10px; text-align: right;">Amount</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="padding: 10px;">
                <?php if($school[0]['school_category_id'] == 1){ ?>
                    PLATINUM PACKAGE (90 + 10) DAYS	
                <?php } else if($school[0]['school_category_id'] == 2){ ?>
                    PREMIUM PACKAGE (90 + 10) DAYS	
                <?php } else if($school[0]['school_category_id'] == 3){ ?>
                    SPECTRUM PACKAGE (90 + 10) DAYS	
                <?php } else if($school[0]['school_category_id'] == 4) { ?>
                    TRIAL PACKAGE (20 + 10) DAYS	
                <?php } ?>
                </td>
            <td style="padding: 10px; text-align: right;">
                <?php if($school[0]['school_category_id'] == 1){ ?>
                     55,085.00
                <?php } else if($school[0]['school_category_id'] == 2){ ?>
                     25424.00
                <?php } else if($school[0]['school_category_id'] == 3){ ?>
                     10,594.00
                <?php } else if($school[0]['school_category_id'] == 4) {?>
                     0.00
                <?php } ?>
            </td>
        </tr>


        <?php if($school[0]['school_category_id'] == 1){ ?>
            <tr style="background: #fae6f0;">
                <td align="right" style="padding: 10px; text-align: right;">GST - 10% </td>
                <td style="padding: 10px; text-align: right;">
                    9,915.30
                </td>
            </tr>
        <?php } else if($school[0]['school_category_id'] == 2){ ?>
            <tr style="background: #fae6f0;">
                <td align="right" style="padding: 10px; text-align: right;">GST - 10% </td>
                <td style="padding: 10px; text-align: right;">
                    4,576.32.00
                </td>
            </tr>
        <?php } else if($school[0]['school_category_id'] == 3){ ?>
            <tr style="background: #fae6f0;">
                <td align="right" style="padding: 10px; text-align: right;">GST - 10% </td>
                <td style="padding: 10px; text-align: right;">
                    1,906.92
                </td>
            </tr>
        <?php } ?>
        <?php if($school[0]['school_category_id'] == 1){ ?>
        <tr>
            <td style="padding: 10px; text-align: right;border-bottom: 1px solid #ddd;">ROUND OFF (-)</td>
            <td style="padding: 10px; text-align: right;border-bottom: 1px solid #ddd;"> 0.30</td>
        </tr>
        <?php } ?>
        <?php if($school[0]['school_category_id'] == 2){ ?>
        <tr>
            <td style="padding: 10px; text-align: right;border-bottom: 1px solid #ddd;">ROUND OFF (-)</td>
            <td style="padding: 10px; text-align: right;border-bottom: 1px solid #ddd;"> 0.32</td>
        </tr>
        <?php } ?>
        <?php if($school[0]['school_category_id'] == 3){ ?>
        <tr>
            <td style="padding: 10px; text-align: right;border-bottom: 1px solid #ddd;">ROUND OFF (-)</td>
            <td style="padding: 10px; text-align: right;border-bottom: 1px solid #ddd;"> 0.92</td>
        </tr>
        <?php } ?>
        <tr style="background: #fae6f0; font-size: 20px; font-weight:600;">
            <td style="padding: 10px; text-align: right;">Total</td>
            <td style="padding: 10px; text-align: right; font-size: 30px;">
                <?php if($school[0]['school_category_id'] == 1){ ?>
                     65,000
                <?php } else if($school[0]['school_category_id'] == 2){ ?>
                     30,000
                <?php } else if($school[0]['school_category_id'] == 3){ ?>
                     12,500
                <?php } else if($school[0]['school_category_id'] == 4){ ?>
                     0.00
                <?php } ?>    
            </td>
        </tr>
        <tr>
            <td colspan="2" style="border-top: 1px solid #ddd;">Thank you for your business</td>
        </tr>
        <tr>
            <td colspan="2" height="50">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2" style="border-top: 1px solid #ddd; text-align: center;"><b>support@edugatein.com</b> | <b>1800-120-235600</b> | <b><a href="https://edugatein.com/">www.edugatein.com</a></b></td>
        </tr>
    </tbody>
</table>


</body>
</html>
