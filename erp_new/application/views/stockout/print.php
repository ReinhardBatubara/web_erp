<center>
    <style>
        .mydatatabel{
            font-size:12px;
            font-family:Arial,Helvetica,sans-serif;
        }
        .mydatatabel th{
            padding: 5px;
        }
        .mydatatabel td{
            padding: 5px 0 0 0;
        }
    </style>
    <div style="width: 750px;">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">                    
            <tr>
                <td colspan="2" align="center" style="padding: 15px 0px 15px 0px">
                    <span style="font-size: 16px;font-weight: bold;font-family: Helvetica,Tahoma">STOCK OUT / MATERIAL DELIVERY</span>
                </td>
            </tr>
    <!--                    <tr valign="top">
                <td width="50%">
                    <table width="100%" >
                        <tr>
                            <td width="30%" class="data_label">STO No #</td>
                            <td width="1%" align="center">:</td>
                            <td width="69%"><?php echo $stockout->number ?></td>
                        </tr>
                        <tr>
                            <td class="data_label">Date </td>
                            <td>:</td>
                            <td><?php echo date('d/m/Y', strtotime($stockout->date)); ?></td>
                        </tr>
                        <tr>
                            <td class="data_label">MW No #</td>
                            <td>:</td>
                            <td><?php echo $stockout->mw_number ?></td>
                        </tr>
    
                    </table>
                </td>
                <td width="50%">
                    <table width="100%">
                        <tr>
                            <td class="data_label">Request Date </td>
                            <td>:</td>
                            <td><?php echo date('d/m/Y', strtotime($stockout->request_date)); ?></td>
                        </tr>
                        <tr>
                            <td width="30%" class="data_label">Request By</td>
                            <td width="1%" align="center">:</td>
                            <td width="69%"><?php echo $stockout->employee_requestby ?></td>
                        </tr>
                        <tr>
                            <td class="data_label">Out By </td>
                            <td>:</td>
                            <td><?php echo $stockout->employee_outby ?></td>
                        </tr>
                    </table>
                </td>
            </tr>-->
        </table>
        <table border='0' width='100%' class="mydatatabel" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th width="5%"  align="center" style="border-bottom: 1px solid #000;border-top: 1px solid #000">NO</th>
                    <th width="15%" align="center" style="border-bottom: 1px solid #000;border-top: 1px solid #000">ITEM CODE</th>
                    <th width="40%" align="center" style="border-bottom: 1px solid #000;border-top: 1px solid #000">ITEM DESCRIPTION</th>
                    <th width="5%" align="center" style="border-bottom: 1px solid #000;border-top: 1px solid #000">UNIT</th>
                    <th width="10%" align="center" style="border-bottom: 1px solid #000;border-top: 1px solid #000">QTY</th>
                    <th width="35%" align="center" style="border-bottom: 1px solid #000;border-top: 1px solid #000">REMARK /REQUIRED FOR</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 10;
                if (!empty($stockoutdetail)) {
                    $no = 1;
                    foreach ($stockoutdetail as $result) {
                        ?>
                        <tr>
                            <td align="center"><?php echo $no++ ?></td>
                            <td align="center"><?php echo $result->itemcode ?></td>
                            <td align="left"><?php echo $result->itemdescription ?></td>
                            <td align="center"><?php echo $result->unitcode ?></td>
                            <td align="center"><?php echo $result->qty ?></td>
                            <td align="left"><?php echo $result->remark ?>&nbsp;</td>
                        </tr>
                        <?php
                        $count -= 1;
                    }
                }
                for ($i = 0; $i < $count; $i++) {
                    ?>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <?php
                }
                ?>
                <tr style="height: 5px">
                    <td style="border-bottom: 1px #000 solid">&nbsp;</td>
                    <td style="border-bottom: 1px #000 solid">&nbsp;</td>
                    <td style="border-bottom: 1px #000 solid">&nbsp;</td>
                    <td style="border-bottom: 1px #000 solid">&nbsp;</td>
                    <td style="border-bottom: 1px #000 solid">&nbsp;</td>
                    <td style="border-bottom: 1px #000 solid">&nbsp;</td>
                </tr>

            </tbody>
        </table><br/>
        <table width="100%" border="0" class="mydatatabel">
            <tr valign="top">
                <td align="center" width="25%">
                    <b>Approve By</b><br/><br/><br/>
                    <br/>                    
                    <hr style="border: 0; height: 1px; background: #333; width: 80%" /> 
                    Kepala Bagian
                </td>
                <td align="center" width="25%">
                    <b>Out By</b><br/><br/><br/>
                    <?php echo $stockout->employee_outby ?><br/>
                    <hr style="border: 0; height: 1px; background: #333; width: 80%" /> 
                    Warehouse Admin
                </td>
                <td align="center" width="25%">
                    <b>Receive By</b><br/><br/><br/>
                    <?php echo $stockout->employee_requestby ?><br/>
                    <hr style="border: 0; height: 1px; background: #333; width: 80%" /> 
                    Warehouse Admin
                </td>
                <td align="center" width="25%">
                    <b>Recorded By</b><br/><br/><br/>
                    <br/>
                    <hr style="border: 0; height: 1px; background: #333; width: 80%" /> 
                    Accounting
                </td>
            </tr>
        </table>
    </div>
</center>