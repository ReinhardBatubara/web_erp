<div id="model_stock_toolbar" style="padding-bottom: 2px;">
    <form id="model_stock_form_search" style="margin: 0">
        Model Code : <input size="13" 
                            class="easyui-validatebox"
                            name="modelcode"
                            onkeypress="if (event.keyCode === 13) {model_stock_search();}"
                            />  
        Model Name : <input type="text" 
                            name="modelname"  
                            size="13" 
                            class="easyui-validatebox"
                            />
        Category: <input type="text" 
                         id="model_stock_modelcategorycode" 
                         name="modelcategorycode"
                         style="width: 90px" 
                         name="modelcategorycode" 
                         />
        <script type="text/javascript">
            $('#model_stock_modelcategorycode').combogrid({
                panelWidth: 250,
                mode: 'remote',
                idField: 'code',
                textField: 'description',
                url: '<?php echo site_url('modelcategory/get_remote_data') ?>',
                columns: [[
                        {field: 'code', title: 'Code', width: 80, halign: 'center'},
                        {field: 'description', title: 'Description', width: 130, halign: 'center'}
                    ]]
            });
        </script>
        <a href="javascript:void(0)" 
           class="easyui-linkbutton" 
           iconCls="icon-search" 
           plain="true" 
           onclick="model_stock_search()">Search</a>
        <a href="javascript:void(0)" 
           class="easyui-linkbutton" 
           iconCls="icon-edit" 
           plain="true" 
           onclick="model_stock_edit()">Edit Stock</a>
    </form>
</div>
<table id="model_stock" data-options="
       url:'<?php echo site_url('modelstock/get_model_stock') ?>',
       method:'post',
       title:'Model Stock',
       border:true,
       singleSelect:true,
       fit:true,
       pageSize:30,
       pageList: [30, 50, 70, 90, 110],
       rownumbers:true,
       fitColumns:true,
       pagination:true,
       striped:true,
       toolbar:'#model_stock_toolbar'">
    <thead>
        <tr>        
            <th field="code" width="150" halign="center">Model Code</th>
            <th field="name" width="250" halign="center">Model Name</th>
            <th field="modelcategory" width="150" halign="center" rowspan="2">Category</th>
            <th field="stock" width="80" align="center" rowspan="2">Stock</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function() {
        $('#model_stock').datagrid({
            onRowContextMenu:function(e, index, row){
                $(this).datagrid('selectRow',index);
                e.preventDefault();
                if (!cmenu_model_stock){
                    createColumnMenu(row);
                }
                cmenu_model_stock.menu('show', {
                    left:e.pageX,
                    top:e.pageY
                });
            }
        });
        var cmenu_model_stock;
        function createColumnMenu(row){
            cmenu_model_stock = $('<div/>').appendTo('body');
            cmenu_model_stock.menu();
            cmenu_model_stock.menu('appendItem', {
                text: 'View Process',
                name: 'edit',
                iconCls: 'icon-preview',
                onclick:function(){
                    model_stock_view_process();
                }
            });
        }
    });
</script>

<div id="model_stock-form" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:300px; padding: 5px 5px" closed="true" buttons="#model_stock-button">
    <form id="model_stock-input" method="post" novalidate>
        <table width="100%">
            <tr>
                <td width="40%" align="right"><label class="field_label">Stock :</label></td>
                <td width="60%"><input type="text" name="stock" size="10" style="text-align: center" class="easyui-numberbox" required="true"/></td>
            </tr>
        </table>
    </form>
</div>
<div id="model_stock-button">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="model_stock_save()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#model_stock-form').dialog('close')">Cancel</a>
</div>