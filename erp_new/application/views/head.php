<?php
$this->load->model('model_company');
$company = $this->model_company->select();
?>
<table width="100%">
    <tr>
<!--        <td width="20%"></td>-->
        <td width="100%" style="border-bottom: 2px #000 solid">
            <span style="font-size: 18px;font-weight: bold;font-family: Tahoma">
                <?php echo $company->name ?>
            </span>
            <br/>
            <span style="font-size: 8pt"><?php echo nl2br($company->address) ?></span>
        </td>
    </tr>
</table>
