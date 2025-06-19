<div style="width: 100%;padding: 5px;">
    <table width="98%" border="0">
        <tr valign="top">
            <td width="50%">
                <table border="0" width="100%" cellpadding="0" cellspacing="0" style="font-family: Tahoma;border-collapse: collapse;border: 1px #000 solid;">
                    <tr>
                        <td width="35%" style="border: 1px #000 solid;padding: 2px;">SO</td>
                        <td width="65%" style="border: 1px #000 solid;padding: 2px;"><?php echo ($item->sonumber != "" ? $item->sonumber : $item->order_type); ?>               &nbsp;</td>
                    </tr>
                    <tr>
                        <td style="border: 1px #000 solid;padding: 2px;">CUSTOMER </td>
                        <td style="border: 1px #000 solid;padding: 2px;"><?php echo $item->customer_code . " - " . $item->customer_name ?>&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="border: 1px #000 solid;padding: 2px;">JOB ORDER</td>
                        <td style="border: 1px #000 solid;padding: 2px;"><?php echo $item->joborder_no ?>&nbsp;</td>
                    </tr>        
                    <tr>
                        <td style="border: 1px #000 solid;padding: 2px;">ORIGINAL CODE </td>
                        <td style="border: 1px #000 solid;padding: 2px;"><?php echo $item->originalcode ?>&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="border: 1px #000 solid;padding: 2px;">ITEM CODE</td>
                        <td style="border: 1px #000 solid;padding: 2px;"><?php echo $item->item_code ?>&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="border: 1px #000 solid;padding: 2px;">ITEM NAME</td>
                        <td style="border: 1px #000 solid;padding: 2px;"><?php echo $item->item_name ?>&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="border: 1px #000 solid;padding: 2px;">BARCODE</td>
                        <td style="border: 1px #000 solid;padding: 2px;"><?php echo $item->serial ?>&nbsp;</td>
                    </tr>

                    <tr>
                        <td style="border: 1px #000 solid;padding: 2px;">PO#</td>
                        <td style="border: 1px #000 solid;padding: 2px;"><?php echo $item->po_no ?>&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="border: 1px #000 solid;padding: 2px;">FINISHING</td>
                        <td style="border: 1px #000 solid;padding: 2px;font-size: 10px;"><?php echo $item->finishing_description ?>&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="border: 1px #000 solid;padding: 2px;">MIRROR/GLASS</td>
                        <td style="border: 1px #000 solid;padding: 2px;"><?php echo $item->mirrorglass_description ?>&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="border: 1px #000 solid;padding: 2px;">FOAM</td>
                        <td style="border: 1px #000 solid;padding: 2px;"><?php echo $item->foam_description ?>&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="border: 1px #000 solid;padding: 2px;">FABRIC</td>
                        <td style="border: 1px #000 solid;padding: 2px;"><?php echo $item->fabric_description ?>&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="border: 1px #000 solid;padding: 2px;">INTERLINER</td>
                        <td style="border: 1px #000 solid;padding: 2px;"><?php echo $item->interliner_description ?>&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="border: 1px #000 solid;padding: 2px;">FURRING COAT</td>
                        <td style="border: 1px #000 solid;padding: 2px;"><?php echo $item->furring_description ?>&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="border: 1px #000 solid;padding: 2px;">ACCESSORIES</td>
                        <td style="border: 1px #000 solid;padding: 2px;"><?php echo $item->accessories_description ?>&nbsp;</td>
                    </tr>
                    <tr valign="top">
                        <td style="border: 1px #000 solid;padding: 2px;">REMARKS</td>
                        <td style="border: 1px #000 solid;padding: 2px;font-size: 9px;" height="80"><?php echo nl2br($item->sod_remark); ?></td>
                    </tr>
                    <tr>
                        <td style="border: 1px #000 solid;padding: 2px;">SIZE</td>
                        <td style="border: 1px #000 solid;padding: 2px;">
                            <?php
                            echo number_format($item->itemsize_mm_w) . " x " . number_format($item->itemsize_mm_d) . " x " . number_format($item->itemsize_mm_h);
                            ?>
                            &nbsp;
                            &nbsp;
                            &nbsp;

                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" width="100%" style="border: 1px #000 solid;">
                            <table border="0" width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse">
                                <tr>
                                    <td width="50%" rowspan="2" style="height: 100px;" align="center">
                                        <img src="<?php echo base_url() . "../files/model/" . $item->imagename; ?>" style="max-height: 95px;max-width: 95px;border: none;"/>
                                    </td>
                                    <td width="50%" valign="top" style="border-left: 1px #000 solid;height: 50px;padding: 2px;font-size: 10px">
                                        SHIPMENT DATE: <?php echo $item->ship_date; ?><br/>
                                        Notes: <br/>
                                        <?php
                                        if ($item->joborderoutsourceid != 0) {
                                            echo " Outsource ";
                                        }
                                        /*if ($item->joborderitembarcode_reference_id != 0){
                                            $this->load->model('model_joborderitem');
                                            echo "Stock Ref : " . $this->model_joborderitem->get_serial_by_id_joib($item->joborderitembarcode_reference_id);
                                        }*/
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border-left: 1px #000 solid;border-top: 1px #000 solid;height: 50px;padding: 2px;" align="center">
                                        <img src="<?php echo site_url('joborder/get_barcode/' . $item->serial) ?>" style="border: none;"/><br/>
                                        <?php //echo $joborderitembarcodeid; ?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td> 
            <td width="50%">
                <table border="0" width="100%" cellpadding="0" cellspacing="0" style="font-family: Tahoma;border-collapse: collapse;border: 1px #000 solid;">
                    <tr>
                        <td width="100%" style="border: 1px #000 solid;padding: 2px;" align="center"><strong>PRODUCTION PROCESS</strong></td>
                    </tr>
                    <tr>
                        <td width="100%" style="border: 1px #000 solid;padding: 2px;" align="center">
                            <table width="100%" class="data_table5">
                                <tr>
                                    <td colspan="5" align="center"><b>Roughmill</b></td>
                                </tr>
                                <tr>
                                    <td align="center" width="25%">Target</td>
                                    <td align="center" width="25%">In</td>
                                    <td align="center" width="25%">Out</td>
                                    <td align="center" width="15%">Aging</td>
                                    <td align="center" width="10%">LT</td>
                                </tr>
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                </tr>
                            </table>
                            <table width="100%"  class="data_table5" class="data_table5">
                                <tr>
                                    <td colspan="5" align="center"><b>Machine/Assembly</b></td>
                                </tr>
                                <tr>
                                    <td align="center" width="25%">Target</td>
                                    <td align="center" width="25%">In</td>
                                    <td align="center" width="25%">Out</td>
                                    <td align="center" width="15%">Aging</td>
                                    <td align="center" width="10%">LT</td>
                                </tr>
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                </tr>
                            </table>
                            <table width="100%"  class="data_table5">
                                <tr>
                                    <td colspan="5" align="center"><b>Carving</b></td>
                                </tr>
                                <tr>
                                    <td align="center" width="25%">Target</td>
                                    <td align="center" width="25%">In</td>
                                    <td align="center" width="25%">Out</td>
                                    <td align="center" width="15%">Aging</td>
                                    <td align="center" width="10%">LT</td>
                                </tr>
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                </tr>
                            </table>
                            <table width="100%"  class="data_table5">
                                <tr>
                                    <td colspan="5" align="center"><b>Sanding</b></td>
                                </tr>
                                <tr>
                                    <td align="center" width="25%">Target</td>
                                    <td align="center" width="25%">In</td>
                                    <td align="center" width="25%">Out</td>
                                    <td align="center" width="15%">Aging</td>
                                    <td align="center" width="10%">LT</td>
                                </tr>
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                </tr>
                            </table>
                            <table width="100%"  class="data_table5">
                                <tr>
                                    <td colspan="5" align="center"><b>Finishing</b></td>
                                </tr>
                                <tr>
                                    <td align="center" width="25%">Target</td>
                                    <td align="center" width="25%">In</td>
                                    <td align="center" width="25%">Out</td>
                                    <td align="center" width="15%">Aging</td>
                                    <td align="center" width="10%">LT</td>
                                </tr>
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                </tr>
                            </table>
                            <table width="100%"  class="data_table5">
                                <tr>
                                    <td colspan="5" align="center"><b>Upholstry</b></td>
                                </tr>
                                <tr>
                                    <td align="center" width="25%">Target</td>
                                    <td align="center" width="25%">In</td>
                                    <td align="center" width="25%">Out</td>
                                    <td align="center" width="15%">Aging</td>
                                    <td align="center" width="10%">LT</td>
                                </tr>
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                </tr>
                            <table width="100%"  class="data_table5">
                                <tr>
                                    <td colspan="5" align="center"><b>Packing</b></td>
                                </tr>
                                <tr>
                                    <td align="center" width="25%">Target</td>
                                    <td align="center" width="25%">In</td>
                                    <td align="center" width="25%">Out</td>
                                    <td align="center" width="15%">Aging</td>
                                    <td align="center" width="10%">LT</td>
                                </tr>
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                </tr>
                            </table>
                            </table>
                        </td>
                    </tr>
                </table>
            </td> 
        </tr>
    </table>
</div>
