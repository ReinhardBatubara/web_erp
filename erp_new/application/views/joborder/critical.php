<div id="critical_order_toolbar" style="padding-bottom: 0px;">
    Serial
    <input type="text" 
           class="easyui-validatebox" 
           id="fpo_serial"
           style="width: 100px;margin: 0 10px 0 0px;"
           onkeyup="if (event.keyCode === 13) {
                       tracking_finish_production_search();
                   }"
           />
    Item Code <input type="text" 
                     class="easyui-validatebox" 
                     id="fpo_itemcode" 
                     style="width: 100px;margin: 0 10px 0 0px;"
                     onkeyup="if (event.keyCode === 13) {
                                 tracking_finish_production_search();
                             }" 
                     />
    JO No <input type="text" 
                 class="easyui-validatebox" 
                 id="fpo_jo_no" 
                 style="width: 100px;margin: 0 10px 0 0px;"
                 onkeyup="if (event.keyCode === 13) {
                             tracking_finish_production_search();
                         }" />
    SO No <input type="text" 
                 class="easyui-validatebox" 
                 id="fpo_so_no" 
                 style="width: 100px;margin: 0 10px 0 0px;"
                 onkeyup="if (event.keyCode === 13) {
                             tracking_finish_production_search();
                         }" 
                 />
    PO No <input type="text" 
                 class="easyui-validatebox" 
                 id="fpo_po_no"
                 style="width: 100px;margin: 0 10px 0 0px;"
                 onkeyup="if (event.keyCode === 13) {
                             tracking_finish_production_search();
                         }" 
                 />
    Customer
    <input class="easyui-combobox" name="orderby" id="orderby" data-options="
           url: '<?php echo site_url('customer/get') ?>',
           method: 'post',
           valueField: 'id',
           textField: 'name',
           panelHeight: '200',
           mode: 'remote',
           formatter: format_order_by2"
           style="width: 100px"/>
    <script type="text/javascript">
        function format_order_by2(row) {
            return '<span>' + row.name + '/' + row.code + '</span><br/>';
        }
    </script>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="tracking_finish_production_search()"></a>
</div>
<table id="critical_order" data-options="
       url:'<?php echo site_url('tracking/get_critical_order') ?>',
       method:'post',
       title:'Critical Order',
       border:true,
       singleSelect:false,
       fit:true,
       pageSize:50,
       pageList: [50, 100, 150],
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       striped:true,
       sortName:'id',
       sortOrder:'desc',
       toolbar:'#critical_order_toolbar'">
    <thead>
        <tr> 
            <th field="tracking_chck" checkbox="true" rowspan="2"></th>            
            <th field="customer_code" width="80" align="center" rowspan="2" sortable="true">Customer</th>
            <th field="po_no" width="70" halign="center" rowspan="2" sortable="true">PO</th>
            <th field="so_no" width="80" align="center" rowspan="2" sortable="true">SO</th>
            <th field="jo_no" width="70" align="center" rowspan="2" sortable="true">JO</th>         
            <th field="serial" width="60" halign="center" rowspan="2" sortable="true">Serial</th>
            <th field="modelcode" width="70" halign="center" rowspan="2" sortable="true">Item Code</th>
            <th field="originalcode" width="70" halign="center" rowspan="2" sortable="true">Original<br/>Code</th>
            <th field="modelname" width="90" halign="center" rowspan="2" sortable="true">Item Name</th>
            <th colspan="3">Size</th>
            <th colspan="3">Packaging Size</th>
            <th field="expected_ship_date" width="100" formatter="myFormatDate" align="center" rowspan="2" sortable="true">Expected Ship Date</th>
        </tr>
    </thead>
    <thead>
        <tr>
            <th field="size_w" width="30" align="center">W</th>
            <th field="size_d" width="30" align="center">D</th>
            <th field="size_h" width="30" align="center">H</th>
            <th field="packing_size_w" width="30" align="center">W</th>
            <th field="packing_size_d" width="30" align="center">D</th>
            <th field="packing_size_h" width="30" align="center">H</th>            
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function () {
        $('#critical_order').datagrid();
    });
</script>

