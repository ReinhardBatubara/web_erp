<html>
    <head>
        <title>Print Model & Process Stock</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/print.css') ?>"/>
    </head>
    <body>
        <table>
            <tr>
                <td>
                    <span style="font-size: 20px;font-weight: bold;"><?php echo $company->name ?></span><br/>
                    <span style="font-size: 12px;"><?php echo nl2br($company->address) ?></span><br/>
                </td>
            </tr>
            <tr>
                <td style="border-bottom: 2px #000 solid;font-size: 24px;font-weight: bold;padding-top: 20px;">
                    Model & Process Stock
                </td>
            </tr>
            <tr>
                <td style="padding-top: 10px;">
                    <table class="data_table">
                        <thead>
                            <tr>
                                <th width="20">No</th>
                                <th width="100">Serial</th>
                                <th width="300">Process Name</th>
                                <th width="120">Model Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
//                            print_r($model_process);
                            if (!empty($model_process)) {
                                $no = 1;
                                foreach ($model_process as $result) {
                                    ?>
                                    <tr>
                                        <td align="right"><?php echo $no++;?></td>
                                        <td><?php echo $result->serial;?></td>
                                        <td><?php echo $result->process_name;?></td>
                                        <td><?php echo $result->model_name;?></td>
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
    </body>
</html>
