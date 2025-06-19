<form id="goodsreceivedetail_input_form" method="post" novalidate style="margin: 4px">
    <table width="100%" border="0" class="table_form">
        <tr>
            <td align="right" width="25%"><label class="field_label">Item Code : </label></td>
            <td width="75%">
                <select class="easyui-combogrid" name="purchaseorderdetailid" style="width:300px" data-options="
                        panelWidth: 600,
                        idField: 'id',
                        textField: 'itemdescription',
                        url: '<?php echo site_url('purchaseorderdetail/get_not_deliver_by_vendor/' . $vendorid) ?>',
                        method: 'get',
                        columns: [[
                        {field:'itemcode',title:'Item Code',width:80},
                        {field:'itemdescription',title:'Item Description',width:200},
                        {field:'unitcode',title:'UoM',width:50,align:'center'},
                        {field:'qty',title:'Order',width:70,halign:'center',align:'right'},
                        {field:'qty_ots',title:'Ots',width:70,halign:'center',align:'right'},
                        {field:'po_no',title:'P.O No',width:90},
                        {field:'po_date',title:'P.O Date',width:80,align:'center',formatter:myFormatDate}
                        ]],
                        fitColumns: true,
                        onSelect:function(index,row){
                        console.log(row.unitcode)
                        $('#goodsreceivedetail_unitcode').val(row.unitcode);
                        $('#goodsreceivedetail_qty').numberbox('setValue',row.qty_ots);

                        if($('#goodsreceivedetail_warehouseid').length > 0){
                        $('#goodsreceivedetail_warehouseid').combobox('clear');
                        $('#goodsreceivedetail_warehouseid').combobox('reload', base_url + 'item/get_warehouse/' + row.itemid + '/' + row.unitcode)
                        }

                        }
                        ">
                </select>
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
            <td><input name="qty" id="goodsreceivedetail_qty"  style="width: 150px" class="easyui-numberbox" precision="5" required="true"/></td>
        </tr>       
        <?php if (($this->session->userdata('department') == 9 && $this->session->userdata('optiongroup') == -1) || $this->session->userdata('id') == 'admin') { ?>
            <tr>
                <td align="right"><label class="field_label">Store To : </label></td>
                <td>
                    <input type="text"
                           name="warehouseid" 
                           id="goodsreceivedetail_warehouseid" 
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
            <td><textarea name="remark" style="width: 300px;height: 40px"></textarea></td>
        </tr>
    </table>      
</form>