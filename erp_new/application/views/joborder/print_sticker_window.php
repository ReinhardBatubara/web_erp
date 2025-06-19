<div style="height: 410px">
    <div style="height: 370px;border-bottom: 1px #005e8c solid">
        <div id="jo_print_sticker_custom_toolbar" style="padding-bottom:0;">
            <form id="jo_print_sticker_custom_form_search" style="margin: 0">
                Customer: 
                <input class="easyui-combobox" name="customerid" id="joborder_print_sticker_customerid" data-options="
                       url: '<?php echo site_url('joborder/get_customer/' . $joborderid) ?>',
                       method: 'post',
                       valueField: 'id',
                       textField: 'name',
                       panelHeight: 'auto',
                       panelWidth: '200',
                       mode: 'remote',
                       formatter: joborder_print_sticker_format_customer,
                       onSelect:function(row){
                       joborder_print_sticker_item_search();
                       }"
                       style="width: 100px" 
                       required="true">
                <script type="text/javascript">
                    function joborder_print_sticker_format_customer(row) {
                        return '<span>' + row.name + '/' + row.code + '</span><br/>';
                    }
                </script>
                S.O No.
                <input type="text" 
                       class="easyui-validatebox" 
                       style="width: 100px"
                       name="so"
                       id="joborder_print_sticker_so"
                       onkeyup="if (event.keyCode === 13) {
                                   joborder_print_sticker_item_search();
                               }"
                       />
                Serial :
                <input type="text" 
                       class="easyui-validatebox" 
                       style="width: 100px"
                       name="serial"
                       id="joborder_print_sticker_serial"
                       onkeyup="if (event.keyCode === 13) {
                                   joborder_print_sticker_item_search()
                               }"
                       />
                Item Code / Name:
                <input type="text" 
                       class="easyui-validatebox" 
                       style="width: 100px"
                       id="joborder_print_sticker_code_name"
                       name="itemcode_or_name"
                       onkeyup="if (event.keyCode === 13) {
                                   joborder_print_sticker_item_search()
                               }"
                       />
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="joborder_print_sticker_item_search()"></a>
            </form>
        </div>
        <table id="jo_print_sticker_custom" data-options="
               url:'<?php echo site_url('joborder/get_detail_item/0') ?>',
               method:'post',
               border:false,
               singleSelect:false,
               fit:true,
               rownumbers:true,
               fitColumns:true,
               pagination:false,
               striped:true,
               toolbar:'#jo_print_sticker_custom_toolbar'">
            <thead>
                <tr>
                    <th field="pst_chck" checkbox="true" />
                    <th field="serial" width="120" halign="center">Serial</th>
                    <th field="sonumber" width="100" halign="center">SO NO</th>            
                    <th field="itemcode" width="130" halign="center">Item Code</th>
                    <th field="itemname" width="200" halign="center">Item Name</th> 
                </tr>
            </thead>
        </table>
        <script type="text/javascript">
            $(function () {
                $('#jo_print_sticker_custom').datagrid({});
            });
        </script>
    </div>
    <div style="height: 40px;">
        <table style="padding-top: 5px;">
            <tr>
                <td>
                    Item Code View 
                    <select name="jo_ps_item_code_type"
                            panelHeight="auto"
                            class="easyui-combobox" 
                            id="jo_ps_item_code_type"
                            editable="false">
                        <option value="0">Original Code</option>
                        <option value="1">Customer Code</option>
                    </select>
                    View Logo :
                    <select name="companylogo" panelHeight="auto" id="jo_ps_company_logo" class="easyui-combobox" editable="false">
                        <option value="true">Yes</option>
                        <option value="false">No</option>
                    </select>
                    <span style="vertical-align: middle">Display Made In :
                        <select name="madein" panelHeight="auto" id="jo_ps_made_id" class="easyui-combobox" editable="false" style="width: 100px">
                            <option value="false">No</option>
                            <option value="true">Yes</option>
                        </select>
                    </span>
                    Remark: 
                    <input class="easyui-validatebox" name="remark" id="jo_ps_remark_id" style="width: 200px"/>
                </td>
            </tr>
        </table>
    </div>
</div>
