<form id="po_change_vendor_form" method="post" novalidate class="table_form">
    <table width="100%" border="0">
        <tr>
            <td align="right" width="30%"><strong>Supplier/Vendor : </strong></td>
            <td width="70%">
                <input type="hidden" name='id'/>
                <input id="text" 
                       name="vendorid" 
                       class="easyui-combobox" 
                       data-options="
                       valueField: 'id',
                       textField: 'text',
                       url: '<?php echo site_url('vendor/get_remote_data') ?>'" 
                       mode="remote" 
                       required="true"
                       style="width: 100%">
            </td>
        </tr>
        <tr>
            <td align="right"><strong>Currency : </strong></td>
            <td>
                <select class="easyui-combobox" name='currency' editable="false" required='true' panelHeight="auto" style="width: 100px">
                    <option></option>
                    <?php
                    foreach ($currency as $result) {
                        echo "<option value='" . $result->code . "'>" . $result->code . "</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td align="right"><strong>Remark : </strong></td>
            <td>
                <textarea name="change_vendor_remark" style="width: 100%;height: 45px;"></textarea>
            </td>
        </tr>
    </table>        
</form>