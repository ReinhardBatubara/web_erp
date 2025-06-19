<html>
    <head>
        <title>Print Order Order Recommendation</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/print.css') ?>"/>
        <style>
            *{
                margin-left:2px;
                margin-right:auto;
            }
        </style>
    </head>
    <body>
        <div>
        <table cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td>
                    <span style="font-size: 20px;font-weight: bold;"><?php echo $company->name ?></span><br/>
                    <span style="font-size: 11px;"><?php echo nl2br($company->address) ?></span><br/>
                </td>
            </tr>
            <tr>
                <td style="border-bottom: 2px #000 solid;font-size: 18px;font-weight: bold;padding-top: 20px;">
                    PRODUCTION ORDER FORM
                </td>
            </tr>
            <tr>
                <td>
                    <table width="600" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="50%">
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td width="60%">Released By</td>
                                        <td>: PPIC</td>
                                    </tr>
                                    <tr>
                                        <td>Order Type</td>
                                        <td>: Job Order</td>
                                    </tr>
                                </table>
                            </td>
                            <td width="50%">
                                <table width="100%">
                                    <tr>
                                        <td width="60%">Received By</td>
                                        <td>: Production</td>
                                    </tr>
                                    <tr>
                                        <td>Date</td>
                                        <td>: </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding-top: 10px;">
                    <table class="data_table" cellpadding="0" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="min-width:50px;">WEEK PER</th>
                                <th style="min-width:100px;">EXPECTED DELIVERY DATE</th>
                                <th style="min-width:60px;">CUSTOMER</th>
                                <th style="min-width:80px;">PROJECT NAME</th>
                                <th style="min-width:90px;">PO#</th>
                                <th style="min-width:100px;">NEW CODE</th>
                                <th style="min-width:80px;">IMAGE</th>
                                <th style="min-width:100px;">ITEM</th>
                                <th style="min-width:30px;">W</th>
                                <th style="min-width:30px;">D</th>
                                <th style="min-width:30px;">H</th>
                                <th style="min-width:150px;">FINISHING STANDARD</th>
                                <th style="min-width:120px;">SPECIAL ORDER FINISHING</th>
                                <th style="min-width:100px;">FABRIC</th>
                                <th style="min-width:100px;">MATERIAL</th>
                                <th style="min-width:100px;">MIRROR</th>
                                <th style="min-width:100px;">SUPPLIER</th>
                                <th style="min-width:100px;">POSITION</th>
                                <th style="min-width:100px;">TOTAL</th>
                                <th style="min-width:100px;">NOTES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
//                            print_r($joborder_item);
                            if (!empty($joborder_item)) {
                                $no = 1;
                                foreach ($joborder_item as $result) {
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo $result->week; ?></td>
                                        <td align="center"><?php echo date('d/m/Y', strtotime($result->expected_delivery_date)); ?></td>
                                        <td align="center"><?php echo $result->customer_code; ?></td>
                                        <td><?php echo $result->project_name; ?></td>
                                        <td align="center"><?php echo $result->po_no; ?></td>
                                        <td><?php echo $result->modelcode; ?></td>
                                        <td align='center'><img src="<?php echo base_url('/files/model/' . $result->images); ?>" style="max-height: 80px;max-width: 80px;"/></td>                                        
                                        <td><?php echo $result->modelname; ?></td>
                                        <td align="center"><?php echo $result->itemsize_mm_w; ?></td>
                                        <td align="center"><?php echo $result->itemsize_mm_d; ?></td>
                                        <td align="center"><?php echo $result->itemsize_mm_h; ?></td>
                                        <td align="center"><?php echo $result->finishing_std; ?></td>
                                        <td align="center">
                                            <?php
                                            if ($result->fin_code_std != $result->fin_sof_code) {
                                                echo $result->finishing_sof;
                                            }
                                            ?>
                                        </td>
                                        <td align="center"><?php echo $result->fabric; ?></td>
                                        <td align="center"><?php echo $result->material; ?></td>
                                        <td align="center"><?php echo $result->mirrorglass; ?></td>
                                        <td align="center">
                                            <?php
                                            $supplier = $this->model_joborderoutsource->select_vendor_by_joborder_item_id($result->id);
                                            if(!empty($supplier)){
                                                foreach ($supplier as $rst_spl){
                                                    echo "- ".$rst_spl->vendor_name."<br/>";
                                                }
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $position = $this->model_joborderitem->select_all_position($result->id);
                                            if(!empty($position)){
                                                foreach ($position as $rst2){
                                                    echo $rst2->qty." ".$rst2->tracking_process_name."<br/>";
                                                }
                                            }
                                            ?>
                                        </td>
                                        <td align="center"><?php echo $result->qty; ?></td>
                                        <td align="center">-</td>
                                        
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
        </div>
    </body>
</html>
