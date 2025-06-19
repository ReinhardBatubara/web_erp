<form id="goodsreceivedetail_edit_form" method="post" novalidate style="margin: 4px">
    <table width="100%" border="0" class="table_form">
        <tr>
            <td align="right" width="25%"><label class="field_label">Item Code : </label></td>
            <td width="75%">
                <input type="text" name="itemcode" style="width: 100%"/>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Unit Code : </label></td>
            <td>
                <input id="goodsreceivedetail_unitcode" name="unitcode" readonly class="easyui-validatebox" required="true"  style="width: 150px">
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Qty :</label></td>
            <td><input unit="text" name="qty" id="goodsreceivedetail_qty"  style="width: 150px" class="easyui-numberbox" precision="5" size="5" required="true" value=""/></td>
        </tr>       
        <?php if (($this->session->userdata('department') == 9 && $this->session->userdata('optiongroup') == -1) || $this->session->userdata('id') == 'admin') { ?>
            <tr>
                <td align="right"><label class="field_label">Store To : </label></td>
                <td>
                    <input type="text"
                           name="warehouseid" 
                           id="e23_goodsreceivedetail_warehouseid" 
                           class="easyui-combobox" 
                           data-options="
                           valueField: 'warehouseid',
                           textField: 'warehousename'
                           " 
                           style="width: 150px" 
                           panelHeight="auto"
                           required="true" >
                </td>
            </tr>
        <?php } else {
            ?>
            <input type="hidden" name="warehouseid" value="<?php echo $this->session->userdata('optiongroup') ?>" />
            <?php
        }
        ?>
        <tr>
            <td align="right"><label class="field_label">Remark : </label></td>
            <td><textarea name="remark" style="width: 100%;height: 40px"></textarea></td>
        </tr>
    </table>      
</form>