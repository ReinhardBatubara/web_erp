<div id="stockoutdetail_toolbar" style="padding-bottom: 0;">
    Item Code : 
    <input type="text" 
           size="8" 
           class="easyui-validatebox" 
           id="stockoutdetail_detail_code_s" 
           onkeypress="if (event.keyCode === 13) {
                     stockoutdetail_search();
                 }"
           />
    Description :
    <input type="text" 
           class="easyui-validatebox" 
           id="stockoutdetail_detail_description_s" 
           onkeyup="if (event.keyCode === 13) {
                     stockoutdetail_search();
                 }"
           />
    <a href="#" onclick="stockoutdetail_search()" class="easyui-linkbutton" plain="true" iconCls="icon-search"></a>
    <?php
    if ($this->session->userdata('department') == 9) {
        ?>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="stockoutdetail_add()">Add</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="stockoutdetail_edit()"> Edit</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="stockoutdetail_delete()"> Delete</a>
        <?php
    }
    ?>
</div>
<table id="stockoutdetail" data-options="       
       method:'post',
       border:true,       
       singleSelect:true,
       fit:true,
       rownumber:true,
       striped:true,
       fitColumns:false,
       pagination:false,
       rownumbers: true,
       sortName:'id',
       sortOrder:'desc',
       toolbar:'#stockoutdetail_toolbar'" class="easyui-datagrid">
    <thead>        
        <tr>
            <th field="chck" checkbox="true"></th>            
            <th field="itemcode" width="120" halign="center" sortable="true">Item</th>
            <th field="itemdescription" width="350" halign="center" sortable="true">Description</th>
            <th field="unitcode" width="60" align="center" sortable="true">Unit</th>
            <th field="qty" width="70" align="center" sortable="true">Qty</th>
            <th field="remark" width="400" halign="center" sortable="true">Remark</th>
        </tr>
    </thead>
</table>
<div id="sto_add_item"></div>
