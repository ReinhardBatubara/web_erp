<div id="goodsreceivedetail_toolbar" style="padding-bottom: 2px;">
    Item : 
    <input type="text" 
           size="12" 
           class="easyui-validatebox" 
           onkeyup="if (event.keyCode === 13) {
                       goodsreceivedetail_search();
                   }"
           />    
    Description : 
    <input type="text" 
           size="12" 
           class="easyui-validatebox" 
           id="gr_detail_description_s" 
           onkeyup="if (event.keyCode === 13) {
                       goodsreceivedetail_search();
                   }"
           />
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="goodsreceivedetail_search()"></a>
    <?php if ($this->session->userdata('department') == 9) { ?>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="goodsreceivedetail_add()">Add</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="goodsreceivedetail_edit()">Edit</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="goodsreceivedetail_delete()">Delete</a>
    <?php } ?>

</div>
<table id="goodsreceivedetail" data-options="
       title:'List Items',
       method:'post',
       border:true,       
       singleSelect:true,
       fit:true,
       rownumber:true,
       striped:true,
       fitColumns:false,
       pagination:true,
       sortName:'id',
       sortOrder:'desc',
       toolbar:'#goodsreceivedetail_toolbar'" class="easyui-datagrid">
    <thead>        
        <tr>
            <th field="chck" checkbox="true"></th>
            <th field="id" hidden="true"></th>            
            <th field="itemid" hidden="true"></th>
            <th field="itemcode" width="80" halign="center" sortable="true">Item</th>
            <th field="itemdescription" width="300" halign="center" sortable="true">Description</th>
            <th field="unitcode" width="80" align="center" sortable="true">Unit</th>
            <th field="qty" width="120" align="center" sortable="true">Qty</th>
            <th field="po_no" width="100" halign="center" sortable="true">P.O Number</th>
            <th field="remark" width="300" halign="center">Remark</th>
        </tr>
    </thead>
</table>
