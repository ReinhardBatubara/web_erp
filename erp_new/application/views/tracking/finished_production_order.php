<div id="finished_production_order_toolbar" style="padding-bottom: 0px;">
    <form id="finished_production_order_search_form" onsubmit="return false;" style="margin: 0;">
        <table>
            <tr>
                <td>Serial</td>
                <td>
                    <input type="text" 
                           class="easyui-validatebox" 
                           name="serial"
                           style="width: 100px;margin: 0 10px 0 0px;"
                           onkeyup="if (event.keyCode === 13) {
                                       tracking_finish_production_search();
                                   }"
                           />
                    Item Code <input type="text" 
                                     class="easyui-validatebox" 
                                     name="itemcode" 
                                     style="width: 100px;margin: 0 10px 0 0px;"
                                     onkeyup="if (event.keyCode === 13) {
                                                 tracking_finish_production_search();
                                             }" 
                                     />
                    Item Name <input type="text" 
                                     class="easyui-validatebox" 
                                     name="itemname" 
                                     style="width: 100px;margin: 0 10px 0 0px;" 
                                     onkeyup="if (event.keyCode === 13) {
                                                 tracking_finish_production_search();
                                             }" 
                                     />
                    JO No <input type="text" 
                                 class="easyui-validatebox" 
                                 name="jo_no" 
                                 style="width: 100px;margin: 0 10px 0 0px;"
                                 onkeyup="if (event.keyCode === 13) {
                                             tracking_finish_production_search();
                                         }" />
                    SO No <input type="text" 
                                 class="easyui-validatebox" 
                                 name="so_no" 
                                 style="width: 100px;margin: 0 10px 0 0px;"
                                 onkeyup="if (event.keyCode === 13) {
                                             tracking_finish_production_search();
                                         }" 
                                 />
                    PO No <input type="text" 
                                 class="easyui-validatebox" 
                                 name="po_no"
                                 style="width: 100px;margin: 0 10px 0 0px;"
                                 onkeyup="if (event.keyCode === 13) {
                                             tracking_finish_production_search();
                                         }" 
                                 />

                </td>
            </tr>
            <tr>
                <td>Customer</td>
                <td>                 
                    <input class="easyui-combobox" name="customerid" id="t_customerid" data-options="
                           url: '<?php echo site_url('customer/get') ?>',
                           method: 'post',
                           valueField: 'id',
                           textField: 'name',
                           panelHeight: '200',
                           panelWidth:'150',
                           mode: 'remote',
                           formatter: format_fpt_customerid_s,
                           onSelect:function(row){tracking_finish_production_search()}"
                           style="width: 100px">
                    <script type="text/javascript">
                        function format_fpt_customerid_s(row) {
                            return '<span>' + row.code + '<br/>' + row.name + '</span>';
                        }
                    </script>
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="tracking_finish_production_search()"></a>
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-shipping" plain="true" onclick="joborder_item_shipment2()">Shipment |></a>
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-csv" plain="true" onclick="joborder_import_shipment()">Import File</a>
                </td>
            </tr>
        </table>
    </form>
</div>
<table id="finished_production_order" data-options="
       url:'<?php echo site_url('tracking/finished_production_order_get') ?>',
       method:'post',
       title:'Finished Production Order',
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
       toolbar:'#finished_production_order_toolbar'">
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
            <th field="pack_out" width="70" formatter="myFormatDate" align="center" rowspan="2" sortable="true">Finish<br/>Date</th>
            <th field="ship_date" width="70" formatter="myFormatDate" align="center" rowspan="2" sortable="true">Ship<br/>Date</th>
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
        $('#finished_production_order').datagrid();
    });
</script>

