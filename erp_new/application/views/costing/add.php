<div id="costing-form" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true,shadow:false"
     style="width:400px; padding: 5px 5px" closed="true" buttons="#costing-button">
    <form id="costing-input" method="post" novalidate enctype="multipart/form-data" class="table_form">
        <table width="100%" border="0">
            <tr>
                <td align="right" width="45%"><label class="field_label">Date  :</label></td>
                <td><input type="tex" class="easyui-datebox" name="date" id="date" size="13" required="true" data-options="formatter:myformatter,parser:myparser"/></td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Costing for Model :</label></td>
                <td>
                    <input type="text" size="20" name="modelid" id="modelid" required="true"/>
                    <script>
                        $('#modelid').combogrid({
                            panelWidth: 450,
                            idField: 'id',
                            mode: 'remote',
                            textField: 'name',
                            url: '<?php echo site_url('model/get_available_for_costing') ?>',
                            columns: [[
                                    {field: 'id', hidden: true, rowspan: 2},
                                    {field: 'code', title: 'Item Code', width: 100, rowspan: 2},
                                    {field: 'name', title: 'Item Name', width: 100, rowspan: 2},
                                    {title: 'Item Size', width: 100, colspan: 3},
                                    {title: 'Packing size', width: 100, colspan: 3}
                                ], [
                                    {field: 'itemsize_mm_w', title: 'W', width: 50, align: 'center'},
                                    {field: 'itemsize_mm_d', title: 'D', width: 50, align: 'center'},
                                    {field: 'itemsize_mm_h', title: 'H', width: 50, align: 'center'},
                                    {field: 'packagingsize_mm_w', title: 'W', width: 50, align: 'center'},
                                    {field: 'packagingsize_mm_d', title: 'D', width: 50, align: 'center'},
                                    {field: 'packagingsize_mm_h', title: 'H', width: 50, align: 'center'}
                                ]]
                        });
                    </script>
                </td>
            </tr>    
            <tr>
                <td align="right"><label class="field_label">Rate  :</label></td>
                <td><input type="tex" class="easyui-numberbox" name="rate" id="rate" precision="0" required="true" style="width: 100px;text-align: right;"/></td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Carving  :</label></td>
                <td><input type="tex" class="easyui-numberbox" name="carving" id="carving" precision="0" required="true" style="width: 150px;text-align: right;"/></td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Labor Cost Percentage  :</label></td>
                <td><input type="tex" class="easyui-numberbox" name="labour_cost_percentage" id="labour_cost_percentage" precision="0" required="true" style="width: 100px;text-align: right;"/> %</td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">X FACTOR Percentage :</label></td>
                <td><input type="tex" class="easyui-numberbox" name="xfactor_percentage" id="xfactor_percentage" precision="0" required="true" style="width: 100px;text-align: right;"/> %</td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Overhead Percentage :</label></td>
                <td><input type="tex" class="easyui-numberbox" name="overhead_percentage" id="overhead_percentage" precision="0" required="true" style="width: 100px;text-align: right;"/> %</td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Shipment Cost Percentage :</label></td>
                <td><input type="tex" class="easyui-numberbox" name="shipment_cost_expense" id="shipment_cost_expense" precision="0" required="true" style="width: 100px;text-align: right;"/>%</td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Margin Percentage :</label></td>
                <td><input type="tex" class="easyui-numberbox" name="margin_percentage" id="margin_percentage" precision="0" required="true" style="width: 100px;text-align: right;"/> %</td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Selling Price Percentage :</label></td>
                <td><input type="tex" class="easyui-numberbox" name="selling_price_percentage" id="selling_price_percentage" precision="0" required="true" style="width: 100px;text-align: right;"/> %</td>
            </tr>
<!--            <tr>
                <td align="right"><label class="field_label">Image :</label></td>
                <td><input type="file" name="fileupload" id="costing-fileupload" style="width: 200px"/></td>
            </tr>-->
        </table>        
    </form>
</div>
<div id="costing-button">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="costing_save()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#costing-form').dialog('close')">Cancel</a>
</div>