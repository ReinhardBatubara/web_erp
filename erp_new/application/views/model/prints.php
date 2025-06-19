<html>
    <head>
        <title>PRINT BOM</title>
        <?php
        $post_id_ = $this->input->post('id');
        if (!empty($post_id_)) {
            ?>
            <link rel="stylesheet" type="text/css" href="../../css/print.css">
        <?php } else { ?>
            <link rel="stylesheet" type="text/css" href="css/print.css">
        <?php } ?>        
    </head>
    <table width="800" border="0" align="center" style="font-size: 7pt;">
        <tr>
            <td width="100%" style="pading-bottom: 5px;">
                <table border="0" width="100%" cellpadding="0" cellspacing="0">
                    <tr valign="top">
                        <td width=40%">
                            <table border="0" width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="30%"><strong>VERSION</strong></td>
                                    <td width="5%" align="center">:</td>
                                    <td width="65%">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><strong>FINALIZED DATE</strong></td>
                                    <td align="center">:</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><strong>REVISION DATE</strong></td>
                                    <td align="center">:</td>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                            <table width="99%"  border="0" cellpadding="0" cellspacing="0" class="data_table_mode" style="margin-top: 5px">
                                <tr>
                                    <td colspan="2" align="center"><strong>Fabric Required</strong></td>
                                    <td colspan="2" align="center"><strong>Product Size</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="2" width="50%">Roll width</td>
                                    <td width="25%" align="center"><strong>W</strong></td>
                                    <td width="25%" align="center"><?php echo $model->itemsize_mm_w ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" width="50%">Meter run</td>
                                    <td width="25%" align="center"><strong>D</strong></td>
                                    <td width="25%" align="center"><?php echo $model->itemsize_mm_d ?></td>
                                </tr>
                                <tr>
                                    <td width="25%">Product</td>
                                    <td width="25%">&nbsp;</td>
                                    <td width="25%" align="center"><strong>H</strong></td>
                                    <td width="25%" align="center"><?php echo $model->itemsize_mm_h ?></td>
                                </tr>
                                <tr>
                                    <td width="25%">Packed</td>
                                    <td width="25%">&nbsp;</td>
                                    <td width="25%" align="center"><strong>M3</strong></td>
                                    <td width="25%" align="center"><?php echo number_format((($model->itemsize_mm_d * $model->itemsize_mm_w * $model->itemsize_mm_h) / 1000000000), 2, '.', ''); ?></td>
                                </tr>
                            </table><br/>
                            <table width="99%"  border="0" cellpadding="0" cellspacing="0" class="data_table_mode" style="margin-right: 5px;">
                                <tr>
                                    <td colspan="2" align="center"><strong>BOM FOR PRODUCTION</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center">ALL ITEM</td>
                                </tr>
                                <tr>
                                    <td width="40%">Item Description</td>
                                    <td width="60%"><?php echo $model->name ?></td>
                                </tr>
                                <tr>
                                    <td>Item code</td>
                                    <td><?php echo $model->code ?></td>
                                </tr>
                                <tr>
                                    <td>Pe per 40 ft cont</td>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                        <td width="60%" align="center" style="border: 1px #000 solid;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="border-bottom: 1px #000 solid" align="center">
                                        <strong>PRODUCT PHOTO</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" valign="middle">
                                        <?php if (!empty($post_id_)) { ?>
                                            <img src="../../files/model/<?php echo $model->images ?>" style="max-height: 180px;max-width: 400px;padding-top: 20px"/>
                                        <?php } else { ?>
                                            <img src="files/model/<?php echo $model->images ?>" style="max-height: 180px;max-width: 400px;padding-top: 20px"/>
                                        <?php } ?>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>
                </table>
                <br/>
                <table width="100%" cellpadding="0" cellspacing="0" border="0" class="data_table_mode">
                    <thead>
                        <tr>
                            <th align="center" colspan="13" >SOLID WOOD</th>
                        </tr>
                        <tr>
                            <th rowspan="2" align="center" width="2%">NO</th>
                            <th rowspan="2" align="center" width="26%">DESCRIPTION</th>
                            <th rowspan="2" align="center" width="10%">MATERIAL</th>
                            <th colspan="3" align="center" width="12%">FINISHED SIZE</th>
                            <th rowspan="2" align="center" width="5%">QTY</th>
                            <th colspan="3" align="center" width="12%">RAW SIZE</th>
                            <th colspan="2" align="center" width="15%">WOOD</th>
                            <th rowspan="2" align="center" width="18%">REMARK</th>
                        </tr>
                        <tr>
                            <th align="center" width="4%">L</th>
                            <th align="center" width="4%">W</th>
                            <th align="center" width="4%">T</th>
                            <th align="center" width="4%">L</th>
                            <th align="center" width="4%">W</th>
                            <th align="center" width="4%">T</th>
                            <th align="center">Fin size m3</th>
                            <th align="center">Raw size m3</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($solidwood as $result) {
                            if ($result->havechild == 1) {
                                ?>
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td><b>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $result->description ?></b></td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td><?php echo $result->remark ?></td>
                                </tr>
                                <?php
                            } else {
                                ?>
                                <tr>
                                    <td align="center"><?php echo $no++; ?></td>
                                    <td><?php echo $result->description ?></td>
                                    <td align="center"><?php echo $result->itemcode ?></td>
                                    <td align="center"><?php echo $result->finishedsize_l ?></td>
                                    <td align="center"><?php echo $result->finishedsize_w ?></td>
                                    <td align="center"><?php echo $result->finishedsize_t ?></td>
                                    <td align="center"><?php echo $result->qty ?></td>
                                    <td align="center"><?php echo $result->rawsize_l ?></td>
                                    <td align="center"><?php echo $result->rawsize_w ?></td>
                                    <td align="center"><?php echo $result->rawsize_t ?></td>
                                    <td align="right" style="padding-right: 2px;"><?php echo $result->vol_finished ?></td>
                                    <td align="right" style="padding-right: 2px;"><?php echo $result->vol_raw ?></td>
                                    <td><?php echo $result->remark ?></td>
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
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td width="100%">
                <table width="100%" cellpadding="0" cellspacing="0" border="1" class="data_table_mode">
                    <thead>
                        <tr>
                            <th align="center" colspan="10" >PLYWOOD/MDF</th>
                        </tr>
                        <tr>
                            <th align="center" width="2%">NO</th>
                            <th align="center" width="26%">DESCRIPTION</th>
                            <th align="center" width="10%">TYPE</th>
                            <th align="center" width="4%">L</th>
                            <th align="center" width="4%">W</th>
                            <th align="center" width="4%">T</th>
                            <th align="center" width="10%">QTY</th>
                            <th align="center" width="10%">Material Required Qty</th>
                            <th align="center" width="5%">UNIT</th>
                            <th align="center">REMARK</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($plywood as $result) {
                            if ($result->havechild == 1) {
                                ?>
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td><b>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $result->description ?></b></td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <?php
                            } else {
                                ?>
                                <tr>
                                    <td align="center"><?php echo $no++; ?></td>
                                    <td><?php echo $result->description ?></td>
                                    <td align="center"><?php echo $result->itemcode ?></td>
                                    <td align="center"><?php echo ($result->size_l != 0 ? $result->size_l : ''); ?></td>
                                    <td align="center"><?php echo ($result->size_w != 0 ? $result->size_w : ''); ?></td>
                                    <td align="center"><?php echo ($result->size_t != 0 ? $result->size_t : ''); ?></td>
                                    <td align="center"><?php echo $result->qty ?></td>
                                    <td align="center"><?php echo $result->total_qty ?></td>
                                    <td align="center"><?php echo $result->unitcode ?></td>
                                    <td>&nbsp;</td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <br/>                
                <table width="100%" cellpadding="0" cellspacing="0" border="1" class="data_table_mode">
                    <thead>
                        <tr>
                            <th align="center" colspan="10" >MIRROR/GLASS</th>
                        </tr>
                        <tr>
                            <th align="center" width="2%">NO</th>
                            <th align="center" width="26%">DESCRIPTION</th>
                            <th align="center" width="10%">TYPE</th>
                            <th align="center" width="4%">L</th>
                            <th align="center" width="4%">W</th>
                            <th align="center" width="4%">T</th>
                            <th align="center" width="10%">QTY</th>
                            <th align="center" width="10%">Material Required Qty</th>
                            <th align="center" width="5%">UNIT</th>                            
                            <th align="center">REMARK</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($mirror as $result) {
                            ?>
                            <tr>
                                <td align="center"><?php echo $no++; ?></td>
                                <td><?php echo $result->description ?></td>
                                <td align="center"><?php echo $result->itemcode ?></td>
                                <td align="center"><?php echo ($result->size_l != 0 ? $result->size_l : ''); ?></td>
                                <td align="center"><?php echo ($result->size_w != 0 ? $result->size_w : ''); ?></td>
                                <td align="center"><?php echo ($result->size_t != 0 ? $result->size_t : ''); ?></td>
                                <td align="center"><?php echo $result->qty ?></td>
                                <td align="center"><?php echo $result->total_qty ?></td>
                                <td align="center"><?php echo $result->unitcode ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <br/>
                <table width="100%" cellpadding="0" cellspacing="0" border="1" class="data_table_mode">
                    <thead>
                        <tr>
                            <th align="center" colspan="10">HARDWARE & ACCESSORIES</th>
                        </tr>
                        <tr>
                            <th align="center" width="2%">NO</th>
                            <th align="center" width="26%">DESCRIPTION</th>
                            <th align="center" width="10%">TYPE</th>
                            <th align="center" width="4%">L</th>
                            <th align="center" width="4%">W</th>
                            <th align="center" width="4%">T</th>
                            <th align="center" width="10%">QTY</th>
                            <th align="center" width="10%">Material Required Qty</th>
                            <th align="center" width="5%">Unit</th>                            
                            <th align="center">REMARK</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($hardware as $result) {
                            ?>
                            <tr>
                                <td align="center"><?php echo $no++; ?></td>
                                <td><?php echo $result->description ?></td>
                                <td align="center"><?php echo $result->itemcode ?></td>
                                <td align="center"><?php echo ($result->size_l != 0 ? $result->size_l : ''); ?></td>
                                <td align="center"><?php echo ($result->size_w != 0 ? $result->size_w : ''); ?></td>
                                <td align="center"><?php echo ($result->size_t != 0 ? $result->size_t : ''); ?></td>
                                <td align="center"><?php echo ($result->qty != 0 ? $result->qty : ''); ?></td>
                                <td align="center"><?php echo $result->total_qty ?></td>
                                <td align="center"><?php echo $result->unitcode ?></td>
                                <td align="center">&nbsp;</td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <br/>
                <table width="100%" cellpadding="0" cellspacing="0" border="1" class="data_table_mode">
                    <thead>
                        <tr>
                            <th align="center" colspan="10">UPHOLSTRY</th>
                        </tr>
                        <tr>
                            <th align="center" width="2%">NO</th>
                            <th align="center" width="26%">DESCRIPTION</th>
                            <th align="center" width="10%">TYPE</th>
                            <th align="center" width="4%">L</th>
                            <th align="center" width="4%">W</th>
                            <th align="center" width="4%">T</th>
                            <th align="center" width="10%">QTY</th>
                            <th align="center" width="10%">Material Required Qty</th>
                            <th align="center" width="5%">UNIT</th>
                            <th align="center">REMARK</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($upholstry as $result) {
                            ?>
                            <tr>
                                <td align="center"><?php echo $no++; ?></td>
                                <td><?php echo $result->description ?></td>
                                <td align="center"><?php echo $result->itemcode ?></td>
                                <td align="center"><?php echo ($result->size_l != 0 ? $result->size_l : ''); ?></td>
                                <td align="center"><?php echo ($result->size_w != 0 ? $result->size_w : ''); ?></td>
                                <td align="center"><?php echo ($result->size_t != 0 ? $result->size_t : ''); ?></td>
                                <td align="center"><?php echo $result->qty ?></td>
                                <td align="center"><?php echo $result->total_qty ?></td>
                                <td align="center"><?php echo $result->unitcode ?></td>
                                <td align="center">&nbsp;</td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <br/>
                <table width="100%" cellpadding="0" cellspacing="0" border="1" class="data_table_mode">
                    <thead>
                        <tr>
                            <th align="center" colspan="10">FINISHING SEEN FACE</th>
                        </tr>
                        <tr>
                            <th align="center" width="2%">NO</th>
                            <th align="center" width="26%">DESCRIPTION</th>
                            <th align="center" width="10%">TYPE</th>
                            <th align="center" width="4%">AREA</th>
                            <th align="center" width="4%">L</th>
                            <th align="center" width="4%">W</th>
                            <th align="center" width="10%">QTY</th>
                            <th align="center" width="10%">M2</th>
                            <th align="center">REMARK</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($finishingseen as $result) {
                            ?>
                            <tr>
                                <td align="center"><?php echo $no++; ?></td>
                                <td><?php echo $result->description ?></td>
                                <td align="center"><?php echo $result->finishing_type_name ?></td>
                                <td align="center"><?php echo ($result->area != 0 ? $result->area : ''); ?></td>
                                <td align="center"><?php echo ($result->size_l != 0 ? $result->size_l : ''); ?></td>
                                <td align="center"><?php echo ($result->size_w != 0 ? $result->size_w : ''); ?></td>
                                <td align="center"><?php echo $result->qty ?></td>
                                <td align="center"><?php echo $result->total_area ?></td>
                                <td><?php echo $result->remark ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <br/>
                <table width="100%" cellpadding="0" cellspacing="0" border="1" class="data_table_mode">
                    <thead>
                        <tr>
                            <th align="center" colspan="10">FINISHING BACK & UNSEEN FACE</th>
                        </tr>
                        <tr>
                            <th align="center" width="2%">NO</th>
                            <th align="center" width="26%">DESCRIPTION</th>
                            <th align="center" width="10%">TYPE</th>
                            <th align="center" width="4%">AREA</th>
                            <th align="center" width="4%">L</th>
                            <th align="center" width="4%">W</th>
                            <th align="center" width="10%">QTY</th>
                            <th align="center" width="10%">M2</th>
                            <th align="center">REMARK</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($finishingunseen as $result) {
                            ?>
                            <tr>
                                <td align="center"><?php echo $no++; ?></td>
                                <td><?php echo $result->description ?></td>
                                <td align="center"><?php echo $result->finishing_type_name ?></td>
                                <td align="center"><?php echo $result->area ?></td>
                                <td align="center"><?php echo $result->size_l ?></td>
                                <td align="center"><?php echo $result->size_w ?></td>
                                <td align="center"><?php echo $result->qty ?></td>
                                <td align="center"><?php echo $result->total_area ?></td>
                                <td><?php echo $result->remark ?></td>  
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>

                <br/>
                <table width="100%" cellpadding="0" cellspacing="0" border="1" class="data_table_mode">
                    <thead>
                        <tr>
                            <th align="center" colspan="10">FINISHING TOP</th>
                        </tr>
                        <tr>
                            <th align="center" width="2%">NO</th>
                            <th align="center" width="26%">DESCRIPTION</th>
                            <th align="center" width="10%">TYPE</th>
                            <th align="center" width="4%">AREA</th>
                            <th align="center" width="4%">L</th>
                            <th align="center" width="4%">W</th>
                            <th align="center" width="10%">QTY</th>
                            <th align="center" width="10%">M2</th>                            
                            <th align="center">REMARK</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($finishingtop as $result) {
                            ?>
                            <tr>
                                <td align="center"><?php echo $no++; ?></td>
                                <td><?php echo $result->description ?></td>
                                <td align="center"><?php echo $result->finishing_type_name ?></td>
                                <td align="center"><?php echo $result->area ?></td>
                                <td align="center"><?php echo $result->size_l ?></td>
                                <td align="center"><?php echo $result->size_w ?></td>
                                <td align="center"><?php echo $result->qty ?></td>
                                <td align="center"><?php echo $result->total_area ?></td>
                                <td><?php echo $result->remark ?></td>  
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>

                <br/>
                <table width="100%" cellpadding="0" cellspacing="0" border="1" class="data_table_mode">
                    <thead>
                        <tr>
                            <th align="center" colspan="10">PACKAGING</th>
                        </tr>
                        <tr>
                            <th align="center" width="2%">NO</th>
                            <th align="center" width="26%">DESCRIPTION</th>
                            <th align="center" width="10%">TYPE</th>
                            <th align="center" width="4%">L</th>
                            <th align="center" width="4%">W</th>
                            <th align="center" width="4%">T</th>
                            <th align="center" width="10%">QTY</th>
                            <th align="center" width="10%">Material Total Qty</th>
                            <th align="center" width="5%">UNIT</th>
                            <th align="center">REMARK</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($packaging as $result) {
                            ?>
                            <tr>
                                <td align="center"><?php echo $no++; ?></td>
                                <td><?php echo $result->description ?></td>
                                <td align="center"><?php echo $result->itemcode ?></td>
                                <td align="center"><?php echo ($result->size_l != 0 ? $result->size_l : ''); ?></td>
                                <td align="center"><?php echo ($result->size_w != 0 ? $result->size_w : ''); ?></td>
                                <td align="center"><?php echo ($result->size_t != 0 ? $result->size_t : ''); ?></td>
                                <td align="center"><?php echo ($result->qty != 0 ? $result->qty : ''); ?></td>
                                <td align="center"><?php echo ($result->total_qty != 0 ? $result->total_qty : ''); ?></td>
                                <td align="center"><?php echo $result->unitcode ?></td>
                                <td align="center">&nbsp;</td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <br/>
                <?php
                if (!empty($additionalmaterial)) {
                    ?>

                    <table width="100%" cellpadding="0" cellspacing="0" border="1" class="data_table_mode">
                        <thead>
                            <tr>
                                <th align="center" colspan="9">ADDITIONAL MATERIAL</th>
                            </tr>
                            <tr>
                                <th align="center" width="1%">NO</th>
                                <th align="center" width="36%">DESCRIPTION</th>
                                <th align="center" width="20%">MATERIAL</th>
                                <th align="center" width="7%">QTY</th>
                                <th align="center" width="5%">UNIT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($additionalmaterial as $result) {
                                ?>
                                <tr>
                                    <td align="center"><?php echo $no++; ?></td>
                                    <td><?php echo $result->description ?></td>
                                    <td align="center"><?php echo $result->itemcode ?></td>
                                    <td align="center"><?php echo $result->qty ?></td>
                                    <td align="center"><?php echo $result->unitcode ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                }
                ?>
            </td>           
        </tr>
    </table>
</body>
</html>
