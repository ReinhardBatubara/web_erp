<div id="materialtrash_toolbar" style="padding-bottom:0px;">
    <form id="materialtrash_search_form" style="margin-bottom: 0px">
        Date From :
        <input type="text" 
               size="11" 
               class="easyui-datebox" 
               name="datefrom" 
               data-options="formatter:myformatter,parser:myparser"
               />
        To : 
        <input type="text" 
               size="11" 
               class="easyui-datebox" 
               name="dateto" 
               data-options="formatter:myformatter,parser:myparser"
               />
        Item Code : 
        <input type="text" 
               size="12" 
               name="itemcode"
               class="easyui-validatebox" 
               onkeypress="if (event.keyCode === 13) {
                       materialtrash_search();
                   }"
               /> 
        Item Name : 
        <input type="text" 
               size="12" 
               name="itemname"
               class="easyui-validatebox" 
               onkeypress="if (event.keyCode === 13) {
                       materialtrash_search();
                   }"
               /> 
        Category :
        <select
            name="category" 
            class="easyui-combobox" 
            style="width: 80px" 
            panelHeight="auto" panelWidth="90" data-options="onChange:function(o,n){materialtrash_search()}">
            <option></option>
            <option value="1">Local</option>
            <option value="2">Import</option>
        </select>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="materialtrash_search()"></a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="materialtrash_add()">Add</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="materialtrash_edit()">Edit</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="materialtrash_delete()">Delete</a>
    </form>
</div>
<table id="materialtrash" data-options="
       url:'<?php echo site_url('materialtrash/get') ?>',
       method:'post',
       title:'Material Waste/Scrap',
       border:true,
       singleSelect:true,
       fit:true,
       pageSize:30,
       rownumbers:true,
       fitColumns:false,
       pageList: [30, 50, 70, 90, 110],
       pagination:true,
       striped:true,
       toolbar:'#materialtrash_toolbar'">
    <thead>
        <tr>         
            <th field="date_f" width="80" align="center" sortable="true">Date</th>
            <th field="code" width="110" align="center" sortable="true">Item Code</th>
            <th field="materialdescription" width="250" halign="center" sortable="true">Item Description</th>
            <th field="unitcode" width="80" align="center" sortable="true">Unit</th>
            <th field="qty" width="80" align="center" sortable="true">Qty</th>
            <th field="category_f" width="100" halign="center" sortable="true">Category</th>
            <th field="remark" width="300" sortable="true">Remark</th>            
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function () {
        $('#materialtrash').datagrid();
    });
</script>
<?php
$this->load->view('materialtrash/add');

