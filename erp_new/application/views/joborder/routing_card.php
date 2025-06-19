<div style="width: 270px;padding: 5px;font-size: 11px;">
    <table border="0" width="100%" cellpadding="0" cellspacing="0" style="font-family: Tahoma;border-collapse: collapse;border: 1px #000 solid;">
        <tr>
            <td width="35%" style="border: 1px #000 solid;padding-left: 2px">SO</td>
            <td width="65%" style="border: 1px #000 solid;padding-left: 2px"><?php echo ($sonumber != "" ? $sonumber : $order_type); ?>               &nbsp;</td>
        </tr>
        <tr>
            <td style="border: 1px #000 solid;padding-left: 2px">CUSTOMER </td>
            <td style="border: 1px #000 solid;padding-left: 2px"><?php echo $customer_code; /* . " - " . $customer_name */ ?>&nbsp;</td>
        </tr>
        <tr>
            <td style="border: 1px #000 solid;padding-left: 2px">JOB ORDER</td>
            <td style="border: 1px #000 solid;padding-left: 2px"><?php echo $joborder_no ?>&nbsp;</td>
        </tr>        
        <tr>
            <td style="border: 1px #000 solid;padding-left: 2px">ORIGINAL CODE </td>
            <td style="border: 1px #000 solid;padding-left: 2px"><?php echo $originalcode ?>&nbsp;</td>
        </tr>
        <tr>
            <td style="border: 1px #000 solid;padding-left: 2px">ITEM CODE</td>
            <td style="border: 1px #000 solid;padding-left: 2px"><?php echo $item_code ?>&nbsp;</td>
        </tr>
        <tr>
            <td style="border: 1px #000 solid;padding-left: 2px">ITEM NAME</td>
            <td style="border: 1px #000 solid;padding-left: 2px"><?php echo $item_name ?>&nbsp;</td>
        </tr>
        <tr>
            <td style="border: 1px #000 solid;padding-left: 2px">BARCODE</td>
            <td style="border: 1px #000 solid;padding-left: 2px"><?php echo $serial ?>&nbsp;</td>
        </tr>

        <tr>
            <td style="border: 1px #000 solid;padding-left: 2px">PO#</td>
            <td style="border: 1px #000 solid;padding-left: 2px"><?php echo $po_no ?>&nbsp;</td>
        </tr>
        <tr>
            <td style="border: 1px #000 solid;padding-left: 2px">FINISHING</td>
            <td style="border: 1px #000 solid;padding-left: 2px;font-size: 10px;"><?php echo $finishing_description ?>&nbsp;</td>
        </tr>
        <tr>
            <td style="border: 1px #000 solid;padding-left: 2px">MIRROR/GLASS</td>
            <td style="border: 1px #000 solid;padding-left: 2px"><?php echo $mirrorglass_description ?>&nbsp;</td>
        </tr>
        <tr>
            <td style="border: 1px #000 solid;padding-left: 2px">FOAM</td>
            <td style="border: 1px #000 solid;padding-left: 2px"><?php echo $foam_description ?>&nbsp;</td>
        </tr>
        <tr>
            <td style="border: 1px #000 solid;padding-left: 2px">FABRIC</td>
            <td style="border: 1px #000 solid;padding-left: 2px"><?php echo $fabric_description ?>&nbsp;</td>
        </tr>
        <tr>
            <td style="border: 1px #000 solid;padding-left: 2px">INTERLINER</td>
            <td style="border: 1px #000 solid;padding-left: 2px"><?php echo $interliner_description ?>&nbsp;</td>
        </tr>
        <tr>
            <td style="border: 1px #000 solid;padding-left: 2px">FURRING COAT</td>
            <td style="border: 1px #000 solid;padding-left: 2px"><?php echo $furring_description ?>&nbsp;</td>
        </tr>
        <tr>
            <td style="border: 1px #000 solid;padding-left: 2px">ACCESSORIES</td>
            <td style="border: 1px #000 solid;padding-left: 2px"><?php echo $accessories_description ?>&nbsp;</td>
        </tr>
        <tr>
            <td style="border: 1px #000 solid;padding-left: 2px;">PILLOW</td>
            <td style="border: 1px #000 solid;padding-left: 2px;"><?php echo $pillow ?></td>
        </tr>
        <tr>
            <td style="border: 1px #000 solid;padding-left: 2px;">HARDWARE&nbsp;</td>
            <td style="border: 1px #000 solid;padding-left: 2px;"><?php echo $hardware ?></td>
        </tr>
        <tr valign="top">
            <td style="border: 1px #000 solid;padding-left: 2px">REMARKS</td>
            <td style="border: 1px #000 solid;padding-left: 2px;font-size: 9px;" height="60"><?php echo nl2br($sod_remark); ?></td>
        </tr>
        <tr>
            <td style="border: 1px #000 solid;padding-left: 2px">SIZE</td>
            <td style="border: 1px #000 solid;padding-left: 2px">
                <?php
                echo number_format($itemsize_mm_w) . " x " . number_format($itemsize_mm_d) . " x " . number_format($itemsize_mm_h);
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
                            <img src="<?php echo base_url() . "files/model/" . $imagename; ?>" style="max-height: 95px;max-width: 95px;border: none;"/>
                        </td>
                        <td width="50%" valign="top" style="border-left: 1px #000 solid;height: 50px;padding-left: 2px;font-size: 10px">
                            SHIPMENT DATE: <?php echo $ship_date; ?><br/>
                            Notes: <br/>
                            <?php
                            if ($joborderoutsourceid != 0) {
                                //echo " Outsource (" . $joborder_outsource_vendor_name . ")";
                                echo $joborder_outsource_vendor_name;
                                //echo " Outsource";
                            }if ($joborderitembarcode_reference_id != 0) {
                                echo "Stock Ref : " . $this->model_joborderitem->get_serial_by_id_joib($joborderitembarcode_reference_id);
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-left: 1px #000 solid;border-top: 1px #000 solid;height: 50px;padding-left: 2px" align="center">
                            <img src="<?php echo site_url('joborder/get_barcode/' . $serial) ?>" style="border: none;"/><br/>
                            <?php //echo $joborderitembarcodeid; ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
