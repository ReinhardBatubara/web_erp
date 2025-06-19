<html>
    <head>
        <title>Print Purchase Order</title>
        <style>
            *{
                font-size: 8pt;
                font-family: Tahoma;
            }

            @media print {
                @page {
                    size: A4 portrait;
                    margin: 1.0cm;
                }
            }
        </style>
    </head>
    <body>
        <table width="800" align="center" border="0" cellpadding="0" cellspacing="0"">
            <tr>
                <td style="border-bottom: 2px #000 solid">
                    <span style="float: left;font-size: 16px;font-weight: bold;"><?php echo $company->name ?></span><br/><br/>
                    <span style="float: left;font-size: 12px;"><?php echo nl2br($company->address) ?></span><br/>
                </td>
            </tr>
            <tr>
                <td align="center" style="padding: 10px">
                    <span style="font-size: 35px;margin-right: 20px;">Purchase Order</span>
                </td>
            </tr>
            <tr valign="top">
                <td>
                    <table>
                        <tr>
                            <td width="60%">
                                <table width="100%">
                                    <tr>
                                        <td width="30%"><strong>PO Number </strong></td>
                                        <td width="1%"><strong>:</strong></td>
                                        <td width="69%"><?php echo $purchaseorder->number ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>PO Date</strong></td>
                                        <td><strong>:</strong></td>
                                        <td><?php echo date('d F Y', strtotime($purchaseorder->date)); ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Terms</strong></td>
                                        <td><strong>:</strong></td>
                                        <td><?php echo $purchaseorder->terms ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Delivery Date</strong></td>
                                        <td><strong>:</strong></td>
                                        <td><?php echo (!empty($purchaseorder->expected_date)) ? date('d F Y', strtotime($purchaseorder->expected_date)) : ""; ?></td>
                                    </tr>
                                    <tr valign="top">
                                        <td><strong>Ship To</strong></td>
                                        <td><strong>:</strong></td>
                                        <td height="60">
                                            <?php echo nl2br($purchaseorder->shipto) ?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td width="40%" valign="top">
                                <strong>To</strong><br/>
                                <span style="font-size: 14px;font-weight: bold;"><?php echo $purchaseorder->vendor ?></span><br/>
                                <span style="font-size: 12px;"><?php echo nl2br($purchaseorder->vendoraddress) ?></span><br/>
                                Phone : <?php $purchaseorder->vendor_phone ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td>
                    <table width="100%" style="border: 1px #000 solid;border-collapse: collapse;margin-top: 15px">
                        <thead>
                            <tr>
                                <th width="11%" style="border: 1px solid;font-weight: bold;" align="center">Item</th>
                                <th width="30%" style="border: 1px solid;font-weight: bold;" align="center">Description</th>
                                <th width="5%" style="border: 1px solid;font-weight: bold;" align="center">UoM</th>
                                <th width="5%" style="border: 1px solid;font-weight: bold;" align="center">Qty</th>
                                <th width="15%" style="border: 1px solid;font-weight: bold;" align="center">Unit Price</th>
                                <th width="6%" style="border: 1px solid;font-weight: bold;" align="center">Disc %</th>
                                <th width="11%" style="border: 1px solid;font-weight: bold;" align="center">Tax</th>
                                <th width="20%" style="border: 1px solid;font-weight: bold;" align="center">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 10;
                            if (!empty($purchaseorderdetail)) {
                                foreach ($purchaseorderdetail as $result) {
                                    ?>
                                    <tr>
                                        <td style="border-left: 1px #000 solid;border-right: 1px solid;padding-left: 2px;"><?php echo $result->itemcode ?></td>
                                        <td style="border-right: 1px #000 solid;padding-left: 2px;font-size: 8pt;"><?php echo $result->itemdescription ?></td>
                                        <td style="border-right: 1px #000 solid;padding-left: 2px;font-size: 8pt;" align="center"><?php echo $result->unitcode ?></td>
                                        <td style="border-right: 1px #000 solid;padding-left: 2px;font-size: 8pt;" align="center"><?php echo $result->qty ?></td>
                                        <td style="border-right: 1px #000 solid;padding-left: 2px;font-size: 8pt;" align="right"><?php echo number_format($result->price, 2, '.', ',') ?></td>
                                        <td style="border-right: 1px #000 solid;padding-left: 2px;font-size: 8pt;" align="right"><?php echo $result->discount_percent ?></td>
                                        <td style="border-right: 1px #000 solid;padding-left: 2px;font-size: 8pt;" align="right"><?php echo number_format($result->ppn, 2, '.', ',') ?></td>
                                        <td style="border-right: 1px #000 solid;padding-left: 2px;font-size: 8pt;" align="right"><?php echo number_format($result->amount, 2, '.', ',') ?></td>
                                    </tr>
                                    <?php
                                    $count--;
                                }
                                for ($i = 0; $i < $count; $i++) {
                                    ?>
                                    <tr>
                                        <td style="border-left: 1px #000 solid;border-right: 1px solid;">&nbsp;</td>
                                        <td style="border-right: 1px #000 solid;">&nbsp;</td>
                                        <td style="border-right: 1px #000 solid;">&nbsp;</td>
                                        <td style="border-right: 1px #000 solid;">&nbsp;</td>
                                        <td style="border-right: 1px #000 solid;">&nbsp;</td>
                                        <td style="border-right: 1px #000 solid;">&nbsp;</td>
                                        <td style="border-right: 1px #000 solid;">&nbsp;</td>
                                        <td style="border-right: 1px #000 solid;">&nbsp;</td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="padding-top: 10px;">
                        <tr>
                            <td width="66%" valign="top">
                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                    <tr valign="top">
                                        <td width="10%">Say</td>
                                        <td>
                                            <div style="padding: 2px; width: 99%;border: 1px #000 solid;border-radius: 3px;height: 60px;margin-bottom: 4px;">
                                                <?php echo $this->component->convert_number_to_words($purchaseorder->grand_total); ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <fieldset style="padding: 2px; border: 1px #000 solid;border-radius: 3px;height: 60px;overflow-y: auto;">
                                                <legend>Description</legend>
                                                <?php echo nl2br($purchaseorder->description) ?>
                                            </fieldset>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <table width="100%" border="0" style="margin-top:10px ">
                                                <tr valign="top">
                                                    <td width="50%" align="left">
                                                        Prepared By:
                                                        <br/>
                                                        <br/>
                                                        <br/>
                                                        <br/>
                                                        <hr style="width: 100px;float: left;border: 1px solid #000;padding: 0px;"/><br/>
                                                        Date :
                                                    </td>
                                                    <td width="50%">
                                                        Approved By:
                                                        <br/>
                                                        <br/>
                                                        <br/>
                                                        <br/>
                                                        <hr style="width: 100px;float: left;border: 1px solid #000;padding: 0px;"/><br/>
                                                        Date :
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td width="34%" valign="top">
                                <table width="100%">
                                    <tr valign="top">
                                        <td width="100%">
                                            <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border: 1px #000 solid; border-radius: 3px;">
                                                <tr>
                                                    <td width="40%" height="25" align="right"> Sub Total :</td>
                                                    <td width="60%" align="right" style="padding: 2px;">
                                                        <?php echo number_format($purchaseorder->sub_total, 2, '.', ',') ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="40%" height="25"  align="right">Discount :</td>
                                                    <td width="60%" align="right" style="padding: 2px;">
                                                        <?php echo number_format($purchaseorder->discount, 2, '.', ',') ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="100%">
                                            <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border: 1px #000 solid; border-radius: 3px;">
                                                <tr>
                                                    <td width="40%" height="25" align="right">Tax :</td>
                                                    <td width="60%" align="right">
                                                        <?php echo number_format($purchaseorder->tax, 2, '.', ',') ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="40%" height="25" align="right">:</td>
                                                    <td width="60%">&nbsp;</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="100%">
                                            <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border: 1px #000 solid; border-radius: 3px;">
                                                <tr>
                                                    <td width="40%" height="30" align="right">Estimated Freight :</td>
                                                    <td width="60%">&nbsp;</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="100%">
                                            <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border: 1px #000 solid; border-radius: 3px;">
                                                <tr>
                                                    <td width="40%" height="30" align="right" style="font-weight: bold;">Total Order :</td>
                                                    <td width="60%" style="font-weight: bold;padding: 2px;" align="right"><?php echo number_format($purchaseorder->grand_total, 2, '.', ',') ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>
<script>window.print();</script>