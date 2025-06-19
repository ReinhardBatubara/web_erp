<div id="model_search_list-toolbar" style="padding-bottom: 2px;">
    Original Code : <input type="text" style="width: 80px" name="msl_originalcode_s" id="msl_originalcode_s" size="20" class="easyui-validatebox" onkeyup="if (event.keyCode === 13) {
                model_search_list_do_search()
            }"/>
    Master Code : <input type="text" style="width: 80px" name="msl_mastercode_s" id="msl_mastercode_s" size="20" class="easyui-validatebox" onkeyup="if (event.keyCode === 13) {
                model_search_list_do_search()
            }"/>
    Item Code : <input type="text" style="width: 80px" name="msl_code_s" id="msl_code_s" size="20" class="easyui-validatebox" onkeyup="if (event.keyCode === 13) {
                model_search_list_do_search()
            }"/>
    Category : <input type="text" style="width: 80px" id="msl_modelcategorycode_s" style="width: 150px" name="msl_modelcategorycode_s"/>
    <script type="text/javascript">
        $('#msl_modelcategorycode_s').combogrid({
            panelWidth: 350,
            mode: 'remote',
            idField: 'code',
            textField: 'description',
            url: '<?php echo site_url('modelcategory/get_remote_data') ?>',
            columns: [[
                    {field: 'code', title: 'Code', width: 100, halign: 'center'},
                    {field: 'description', title: 'Description', width: 200, halign: 'center'}
                ]],
            onChange: function () {
                model_search_list_do_search();
            }
        });
    </script>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="model_search_list_do_search()">Search</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-pointer" plain="true" onclick="model_search_list_do_set('<?php echo $form ?>')">Set</a>
</div>
<table id="model_search_list" data-options="
       url:'<?php echo site_url('model/get_ready') ?>',
       method:'post',
       border:false,
       singleSelect:true,
       fit:true,
       pageSize:30,
       rownumbers:true,
       fitColumns:true,
       pagination:true,
       striped:true,
       toolbar:'#model_search_list-toolbar'">
    <thead>
        <tr>
            <th field="code" width="80" halign="center">Item Code</th>
            <th field="mastercode" width="80" halign="center">Master Code</th>
            <th field="name" width="80" halign="center">Item Name</th>
            <th field="modelcategory" width="100" halign="center">Category</th>
            <th field="finishing" width="100" halign="center">Finishing</th>
            <th field="selling_price" width="100" halign="center" align="right" formatter="formatPrice">Selling Price</th>
            <th field="currency" width="50" align="center">Currency</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function () {
        $('#model_search_list').datagrid({
            onDblClickRow: function (rowIndex, rowData) {
                model_search_list_do_set('<?php echo $form ?>')
            }
        }).datagrid('getPager').pagination({
            pageList: [30, 50, 70, 90, 110],
            displayMsg: '{from} to {to} of {total} Rows'
        });
    });
    
</script>

