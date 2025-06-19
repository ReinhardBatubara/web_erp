<html>
    <head>
        <title>Sales Invoice</title>
        <style>
            *{
                font-size: 8pt;
                font-family: Tahoma;
            }
        </style>
    </head>
    <body>
        <table width="800" align="center" border="0" cellpadding="0" cellspacing="0"">
               <tr>
                <td width="100%">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="60%" valign="top">
                                <table border="0" width="100%" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td width="19%">&nbsp;</td>
                                        <td width="2%">&nbsp;</td>
                                        <td width="79%" align="right">
                                            <div style="width: 90%;border: 1px #000 solid;text-align: left; border-radius: 3px;overflow-y: auto; min-height: 50px;margin-bottom: 4px;padding: 2px;">
                                                <span style="float: left;font-size: 13px;font-weight: bold;"><?php echo $company->name ?></span><br/>
                                                <hr style="border: 2px dotted #000; border-top: none; height: 1px;"/>
                                                <span style="float: left;"><?php echo nl2br($company->address) ?></span><br/>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr valign="top">
                                        <td>Bill To</td>
                                        <td>:</td>
                                        <td height="58" style="padding: 3px;border-top: 1px #000 solid;border-right: 1px #000 solid; border-left: 1px #000 solid; border-top-left-radius: 5px; border-top-right-radius: 5px;border-bottom: 2px #000 dotted;">
                                            <span style="font-size: 13px;font-weight: bold;"><?php echo $salesinvoice->customer_name ?></span><br/>
                                            <span><?php echo nl2br($salesinvoice->bill_to) ?></span><br/>
                                        </td>
                                    </tr>
                                    <tr valign="top">
                                        <td>Ship To</td>
                                        <td>:</td>
                                        <td height="56" style="padding: 3px;border-right: 1px #000 solid; border-left: 1px #000 solid; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;border-bottom: 1px #000 solid;" >
                                            <span style="font-size: 12px;"><?php echo nl2br($salesinvoice->ship_to) ?></span>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td width="40%" align="right" valign="top">
                                <span style="font-size: 35px;margin-right: 20px;">Sales Invoice</span>
                                <table width="95%" border="0" cellpadding="0" cellspacing="0" style="padding: 3px; border: 1px #000 solid; border-radius: 3px">
                                    <tr valign="top">
                                        <td height="35" width="50%" align="center" style="padding-left: 2px; border-bottom:2px #000 dotted;border-right:2px #000 dotted;">
                                            <span style="float: left">Invoice Date</span><br/>
                                            <span><?php echo $salesinvoice->invoice_date_format; ?></span>
                                        </td>
                                        <td width="50%" align="center" style="padding-left: 2px; border-bottom:2px #000 dotted;">
                                            <span style="float: left">Invoice No.</span><br/>
                                            <span><?php echo $salesinvoice->invoice_no ?></span>
                                        </td>
                                    </tr>
                                    <tr valign="top">
                                        <td height="35" align="center" style="padding-left: 2px; border-bottom:2px #000 dotted; border-right:2px #000 dotted;">
                                            <span style="float: left">Terms :</span><br/>
                                            <span><?php echo $salesinvoice->terms ?></span>
                                        </td>
                                        <td align="center" style="padding-left: 2px; border-bottom:2px #000 dotted;">
                                            <span style="float: left">FOB :</span><br/>
                                            <span><?php echo $salesinvoice->fob ?></span>
                                        </td>
                                    </tr>
                                    <tr valign="top">
                                        <td height="35" align="center" style="padding-left: 2px; border-bottom:2px #000 dotted;border-right:2px #000 dotted;">
                                            <span style="float: left">Ship Via :</span><br/>
                                            <span><?php echo $salesinvoice->ship_via ?></span>
                                        </td>
                                        <td align="center" style="padding-left: 2px; border-bottom:2px #000 dotted;">
                                            <span style="float: left">Ship Date :</span><br/>
                                            <span><?php echo $salesinvoice->ship_date_format ?></span>
                                        </td>
                                    </tr>
                                    <tr valign="top">
                                        <td align="center" height="35" style="padding-left: 2px; border-right:2px #000 dotted;">
                                            <span style="float: left">PO No. :</span><br/>
                                            <span><?php echo $salesinvoice->po_no ?></span>
                                        </td>
                                        <td align="center">
                                            <span style="padding-left: 2px;float: left">Currency :</span><br/>
                                            <span><?php echo $salesinvoice->currency ?></span>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>   
            <tr>
                <td>
                    <table width="100%" style="margin-top: 15px" cellpadding="0" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="14%" style="border: 1px solid;font-weight: bold;" align="center">Item</th>
                                <th width="30%" style="border-right: 1px solid;border-top: 1px solid;border-bottom: 1px solid;font-weight: bold;" align="center">Description</th>
                                <th width="5%"  style="border-right: 1px solid;border-top: 1px solid;border-bottom: 1px solid;" align="center">Qty</th>
                                <th width="11%" style="border-right: 1px solid;border-top: 1px solid;border-bottom: 1px solid;" align="center">Unit Price</th>
                                <th width="11%" style="border-right: 1px solid;border-top: 1px solid;border-bottom: 1px solid;" align="center">Disc</th>
                                <th width="11%" style="border-right: 1px solid;border-top: 1px solid;border-bottom: 1px solid;" align="center">Tax</th>
                                <th width="20%" style="border-right: 1px solid;border-top: 1px solid;border-bottom: 1px solid;" align="center">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 12;
                            if (!empty($salesinvoicedetail)) {
                                foreach ($salesinvoicedetail as $result) {
                                    ?>
                                    <tr>
                                        <td style="border-left: 1px #000 solid;border-right: 1px solid;padding: 2px;font-size: 8pt;" align="center"><?php echo $result->modelcode ?></td>
                                        <td style="border-right: 1px solid;padding: 2px;font-size: 8pt;"><?php echo $result->modelname ?></td>
                                        <td style="border-right: 1px solid;padding: 2px;font-size: 8pt;" align="center"><?php echo $result->qty ?></td>
                                        <td style="border-right: 1px solid;padding: 2px;font-size: 8pt;" align="right"><?php echo number_format($result->unitprice, 2) ?></td>
                                        <td style="border-right: 1px solid;padding: 2px;font-size: 8pt;" align="right"><?php echo number_format($result->discount, 2) ?></td>
                                        <td style="border-right: 1px solid;padding: 2px;font-size: 8pt;" align="right"><?php echo number_format($result->tax, 2) ?></td>
                                        <td style="border-right: 1px solid;padding: 2px;font-size: 8pt;" align="right"><?php echo number_format($result->amount, 2) ?></td>
                                    </tr>
                                    <?php
                                    $count--;
                                }
                                if ($count > 0) {
                                    for ($i = 0; $i <= 10; $i++) {
                                        ?>
                                        <tr>
                                            <td style="border-left: 1px #000 solid;border-right: 1px solid;padding: 2px;font-size: 8pt;" align="center">&nbsp;</td>
                                            <td style="border-right: 1px solid;padding-left: 2px;font-size: 8pt;">&nbsp;</td>
                                            <td style="border-right: 1px solid;padding-left: 2px;font-size: 8pt;" align="center">&nbsp;</td>
                                            <td style="border-right: 1px solid;padding-left: 2px;font-size: 8pt;" align="right">&nbsp;</td>
                                            <td style="border-right: 1px solid;padding-left: 2px;font-size: 8pt;" align="right">&nbsp;</td>
                                            <td style="border-right: 1px solid;padding-left: 2px;font-size: 8pt;" align="right">&nbsp;</td>
                                            <td style="border-right: 1px solid;padding-left: 2px;font-size: 8pt;" align="right">&nbsp;</td>
                                        </tr>
                                        <?php
                                    }
                                }
                            }
                            ?>
                            <tr>
                                <td style="border-left: 1px #000 solid;border-bottom: 1px solid;border-right: 1px solid;">&nbsp;</td>
                                <td style="border-right: 1px solid;border-bottom: 1px solid;">&nbsp;</td>
                                <td style="border-right: 1px solid;border-bottom: 1px solid;">&nbsp;</td>
                                <td style="border-right: 1px solid;border-bottom: 1px solid;">&nbsp;</td>
                                <td style="border-right: 1px solid;border-bottom: 1px solid;">&nbsp;</td>
                                <td style="border-right: 1px solid;border-bottom: 1px solid;">&nbsp;</td>
                                <td style="border-right: 1px solid;border-bottom: 1px solid;">&nbsp;</td>
                            </tr>
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
                                                <?php echo $this->component->convert_number_to_words($salesinvoice->totalinvoice); ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <fieldset style="padding: 2px; border: 1px #000 solid;border-radius: 3px;min-height: 80px;">
                                                <legend>Description</legend>
                                                <?php echo nl2br($salesinvoice->description) ?>
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
                                                        <?php echo number_format($salesinvoice->subtotal, 2) ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="40%" height="25"  align="right">Discount :</td>
                                                    <td width="60%" align="right" style="padding: 2px;">
                                                        <?php echo number_format($salesinvoice->discount, 2) ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="100%">
                                            <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border: 1px #000 solid; border-radius: 3px;">
                                                <tr>
                                                    <td width="40%" height="25" align="right">Tax/PPN:</td>
                                                    <td width="60%" align="right" style="padding: 2px;"><?php echo number_format($salesinvoice->tax, 2) ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="40%" height="25" align="right">Total Invoice:</td>
                                                    <td width="60%" align="right" style="padding: 2px;"><?php echo number_format($salesinvoice->totalinvoice, 2) ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="100%">
                                            <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border: 1px #000 solid; border-radius: 3px;">
                                                <tr>
                                                    <td width="40%" height="30" align="right">Down Payment :</td>
                                                    <td width="60%" style="font-weight: bold;padding: 2px;" align="right"><?php echo number_format($salesinvoice->downpayment, 2) ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="100%">
                                            <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border: 1px #000 solid; border-radius: 3px;">
                                                <tr>
                                                    <td width="40%" height="30" align="right" style="font-weight: bold;">Balance Payment :</td>
                                                    <td width="60%" style="font-weight: bold;padding: 2px;" align="right"><?php echo number_format($salesinvoice->balancepayment, 2) ?></td>
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
