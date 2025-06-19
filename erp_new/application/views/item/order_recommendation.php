<div id="or_toolbar" style="padding-bottom: 0">  
    <form id="or_search_form" style="margin-bottom: 0px">
        <span style="display: inline-block;">Item
            <input type="text" 
                   size="12" 
                   name="code"
                   class="easyui-validatebox"
                   onkeypress="if (event.keyCode === 13) {
                               or_search();
                           }"
                   />
        </span>
        <?php
        if (($this->session->userdata('department') == 9 && $this->session->userdata('optiongroup') == -1) || $this->session->userdata('id') == 'admin') {
            ?>
            <span style="display: inline-block;">
                Warehouse : 
                <input type="text"
                       name="warehouseid" 
                       id="item_search_warehouseid" 
                       class="easyui-combobox" 
                       url="<?php echo site_url('warehouse/get') ?>"
                       data-options="
                       valueField: 'id',
                       textField: 'code',
                       onChange:function(o,n){or_search()}" 
                       style="width: 80px" 
                       panelHeight="auto"
                       required="true" >
                       <?php
                   }
                   ?>
        </span>
        <span style="display: inline-block;">
            Group : 
            <input class="easyui-combobox" name="groupid" data-options="
                   url: '<?php echo site_url('itemgroup/get') ?>',
                   method: 'post',
                   valueField: 'id',
                   textField: 'name',
                   mode: 'remote',
                   panelHeight: '200',
                   panelWidth:'200',
                   formatter: itemSearchFormatGroup,
                   onChange:function(o,n){or_search()}"
                   style="width: 80px" 
                   />
            <script type="text/javascript">
                function itemSearchFormatGroup(row) {
                    var s = '<span style="font-weight:bold">' + row.code + '</span><br/>' +
                            '<span style="color:#888">Name: ' + row.name + '</span><br/>';
                    return s;
                }
            </script>
        </span>
        <span style="display: inline-block">
            Stock Status
            <select style="width: 80px" class="easyui-combobox" panelHeight="auto" name="stock_status">
                <option value="">All</option>
                <option value="1">Empty</option>
                <option value="2">Available</option>
            </select>
        </span>
        
        <span style="display: inline-block">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="or_search()"></a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="or_print()">Print</a>
        </span>
        
        
        
    </form>
</div>
<table id="or_stock" data-options="
       url:'<?php echo site_url('item/get_order_recommendation') ?>',
       method:'post',
       singleSelect:true,
       title:'Order Recommendation',
       fit:true,
       pageSize:50,
       pageList: [50, 100, 150, 200, 250],
       border:false,
       striped:true,
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       nowrap: true,
       idField: 'id',
       scrollbarSize: 5,
       sortName:'id',
       sortOrder:'desc',
       toolbar:'#or_toolbar'">
    <thead>
        <tr>           
            <th field="code" width="80" halign="center" fixed="true" sortable="true">Item Code</th>
            <th field="description" width="250" halign="center" fixed="true" sortable="true">Item Description</th>
            <th field="itemgroup" width="80" halign="center" sortable="true">Item group</th>
            <th field="category_f" width="80" align="center" sortable="true">Category</th>
            <th field="unitcode" width="80" align="center" fixed="true" sortable="true">Base Unit</th>
            <th field="isstock" width="50" align="center" fixed="true" sortable="true">Is Stock</th>
            <th field="stock" width="80" align="center" fixed="true" sortable="true">Stock</th>
            <th field="moq" width="50" align="center" fixed="true" sortable="true">MoQ</th>
            <th field="reorderpoint" width="50" align="center" fixed="true" sortable="true">RoP</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function () {
        $('#or_stock').datagrid({});
    });
    function or_search() {
        $('#or_stock').datagrid('reload', $('#or_search_form').serializeObject());
    }
    
    function or_print(){
        open_target('POST',base_url+'item/print_order_recommendation',$('#or_search_form').serializeObject(),'_blank');
    }

</script>