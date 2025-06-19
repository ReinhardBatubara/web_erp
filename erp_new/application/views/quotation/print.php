<html>
    <head>
        <title>Print Quotation</title>
        <style>
            *{
                font-size: 8pt;
                font-family: Tahoma;
            }
        </style>
    </head>
    <body>
        <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td>
                    <span style="font-size: 18px;font-weight: bold;"><?php echo $company->name ?></span><br/>
                    <span><?php echo nl2br($company->address) ?></span><br/>
                    <span>TELP. <?php echo $company->telp ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; FAX. <?php echo $company->fax ?></span>
                </td>
            </tr>   
            <tr>
                <td>
                    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-top: 5px;">
                        <tr>
                            <td width="33%" valign="top">
                                <table width="100%">
                                    <tr>
                                        <td width="40%">TO</td>
                                        <td width="60%">: <?php echo $quotation->to ?></td>
                                    </tr>
                                    <tr>
                                        <td>COMPANY</td>
                                        <td>: <?php echo $quotation->company ?></td>
                                    </tr>
                                    <tr>
                                        <td>PROJECT</td>
                                        <td>: <?php echo $quotation->project ?></td>
                                    </tr>
                                </table>
                            </td>
                            <td width="34%">&nbsp;</td>
                            <td width="33%" valign="top">
                                <table width="100%">
                                    <tr>
                                        <td width="40%">DATE</td>
                                        <td width="60%">: <?php echo date('d-M-y', strtotime($quotation->date)) ?></td>
                                    </tr>
                                    <tr>
                                        <td>REF</td>
                                        <td>: <?php echo $quotation->ref ?></td>
                                    </tr>
                                    <tr>
                                        <td>Currency</td>
                                        <td>: <?php echo $quotation->currency ?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="center"><span style="font-size: 18px;font-weight: bold;">QUOTATION-</span><span style="font-size: 14px;">NO. <?php echo $quotation->number ?></span></td>
            </tr>
            <tr>
                <td>
                    <table width="100%" style="border: 1px #000 solid;border-collapse: collapse;margin-top: 5px">
                        <thead>
                            <tr>
                                <th width="1%" style="border: 1px solid;font-weight: bold;" align="center" rowspan="2">No</th>
                                <th width="15%" style="border: 1px solid;font-weight: bold;" align="center" rowspan="2">Item Code</th>
                                <th width="25%" style="border: 1px solid;font-weight: bold;" align="center" rowspan="2">Item Picture</th>
                                <th width="15%" style="border: 1px solid;font-weight: bold;" align="center" colspan="3">Dimension (mm)</th>
                                <th width="12%" style="border: 1px solid;font-weight: bold;" align="center" rowspan="2">Finishing</th>
                                <th width="10%" style="border: 1px solid;font-weight: bold;" align="center" rowspan="2">Price</th>
                                <th width="22%" style="border: 1px solid;font-weight: bold;" align="center" rowspan="2">Remarks</th>
                            </tr>
                            <tr>
                                <th style="border: 1px solid;font-weight: bold;" align="center">W</th>
                                <th style="border: 1px solid;font-weight: bold;" align="center">D</th>
                                <th style="border: 1px solid;font-weight: bold;" align="center">H</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($quotationdetail)) {
                                $no = 1;
                                foreach ($quotationdetail as $result) {
                                    ?>
                                    <tr style="height: 80px">
                                        <td style="border-left: 1px #000 solid;border-right: 1px solid;padding-left: 2px;font-size: 8pt;"><?php echo $no++ ?></td>
                                        <td style="border-right: 1px #000 solid;padding-left: 2px;font-size: 8pt;" align="center">
                                            <?php
                                            echo "<b>" . $result->modelcode . "</b><br/>" . $result->modelname;
                                            ?>
                                        </td>
                                        <td style="border-right: 1px #000 solid;padding-left: 2px;font-size: 8pt;" align="center">
                                            <?php
                                            if (!empty($result->images)) {
                                                
                                                if ($result->modelid != 0) {
                                                    ?>
                                                    <img src="../../files/model/<?php echo $result->images ?>" style="max-width: 90px;max-height: 90px "/>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <img src="../../files/<?php echo $result->images ?>" style="max-width: 90px;max-height: 90px "/>
                                                    <?php
                                                }
                                            }
                                            ?>

                                        </td>
                                        <td style="border-right: 1px #000 solid;padding-left: 2px;font-size: 8pt;" align="center"><?php echo $result->item_size_w ?></td>
                                        <td style="border-right: 1px #000 solid;padding-left: 2px;font-size: 8pt;" align="center"><?php echo $result->item_size_d ?></td>
                                        <td style="border-right: 1px #000 solid;padding-left: 2px;font-size: 8pt;" align="center"><?php echo $result->item_size_h ?></td>
                                        <td style="border-right: 1px #000 solid;padding-left: 2px;font-size: 8pt;" align="center"><?php echo $result->finishing ?></td>                                        
                                        <td style="border-right: 1px #000 solid;padding-right: 5px;font-size: 8pt;" align="right"><?php echo number_format($result->price, 0, '', ',') ?></td>
                                        <td style="border-right: 1px #000 solid;padding-left: 2px;font-size: 8pt;"><?php echo $result->remark ?></td>
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
                    Note: <?php echo $quotation->note ?>
                </td>
            </tr>
        </table>
    </body>
</html>
