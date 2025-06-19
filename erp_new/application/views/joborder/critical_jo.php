<div id="critical_job_order_toolbar" style="padding-bottom: 0px;">
    <form id="critical_jo_order_search_form" onsubmit="critical_jo_order_search();
            return false;" style="margin: 0;">
        Serial
        <input type="text" 
               class="easyui-validatebox" 
               name="serial"
               style="width: 100px;margin: 0 10px 0 0px;"
               onkeyup="if (event.keyCode === 13) {
                           critical_jo_order_search();
                       }"
               />
        Product <input type="text" 
                         class="easyui-validatebox" 
                         name="itemcode" 
                         style="width: 100px;margin: 0 10px 0 0px;"
                         onkeyup="if (event.keyCode === 13) {
                                     critical_jo_order_search();
                                 }" 
                         />
        JO No <input type="text" 
                     class="easyui-validatebox" 
                     name="jo_no" 
                     style="width: 100px;margin: 0 10px 0 0px;"
                     onkeyup="if (event.keyCode === 13) {
                                 critical_jo_order_search();
                             }" />
        SO No <input type="text" 
                     class="easyui-validatebox" 
                     name="so_no" 
                     style="width: 100px;margin: 0 10px 0 0px;"
                     onkeyup="if (event.keyCode === 13) {
                                 critical_jo_order_search();
                             }" 
                     />
        PO No <input type="text" 
                     class="easyui-validatebox" 
                     name="po_no"
                     style="width: 100px;margin: 0 10px 0 0px;"
                     onkeyup="if (event.keyCode === 13) {
                                 critical_jo_order_search();
                             }" 
                     />
        Customer
        <input class="easyui-combobox" name="customer_id" data-options="
               url: '<?php echo site_url('customer/get') ?>',
               method: 'post',
               valueField: 'id',
               textField: 'name',
               panelHeight: '200',
               panelWidth:'250',
               mode: 'remote',
               formatter: format_order_by3,
               onSelect:function(){
               critical_jo_order_search();
               }"
               style="width: 100px"/>
        <script type="text/javascript">
            function format_order_by3(row) {
                return '<span>' + row.name + '/' + row.code + '</span><br/>';
            }
        </script>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="critical_jo_order_search()">Search</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="critical_jo_order_print()">Print</a>
    </form>
</div>
<table id="critical_job_order" data-options="
       url:'<?php echo site_url('tracking/get_critical_job_order') ?>',
       method:'post',
       title:'Critical Job Order',
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
       toolbar:'#critical_job_order_toolbar'">
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
            <th field="expected_delivery_date" width="100" formatter="myFormatDate" align="center" rowspan="2" sortable="true">Expected Delivery Date</th>
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
        $('#critical_job_order').datagrid();
    });
</script>

