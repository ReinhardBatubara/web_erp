<div id="stockout_all_detail_toolbar" style="padding-bottom: 0;">
    <form id="stockout_all_detail_form_search" style="margin-bottom: 0">
        Date From : 
        <input type="text" 
               size="13" 
               class="easyui-datebox" 
               id="stockout_all_detail_datefrom_s" 
               data-options="formatter:myformatter,parser:myparser"
               name="datefrom"
               required="true"
               />
        To :
        <input type="text" 
               size="13" 
               class="easyui-datebox" 
               id="stockout_all_detail_dateto_s" 
               data-options="formatter:myformatter,parser:myparser"
               name="dateto"
               required="true"
               />
        Item Code : 
        <input type="text" 
               size="8" 
               name="item_code"
               class="easyui-validatebox" 
               id="stockoutdetail_detail_code_s" 
               onkeypress="if (event.keyCode === 13) {stockoutdetail_transaction_search();}"
               />
        Description :
        <input type="text" 
               class="easyui-validatebox" 
               name="item_description"
               id="stockoutdetail_detail_description_s" 
               onkeyup="if (event.keyCode === 13) {stockoutdetail_transaction_search();}"
               />
        <a href="#" onclick="stockoutdetail_transaction_search()" class="easyui-linkbutton" plain="true" iconCls="icon-search"></a>  
        <a href="#" onclick="stockoutdetail_transaction_print()" class="easyui-linkbutton" plain="true" iconCls="icon-print">Print</a>  
        <a href="#" onclick="stockoutdetail_transaction_excel()" class="easyui-linkbutton" plain="true" iconCls="icon-excel">Excel</a>
    </form>
</div>
<table id="stockout_all_detail" data-options="       
       method:'post',
       border:true,       
       singleSelect:true,
       title:'Stock Out Detail',
       fit:true,
       rownumber:true,
       striped:true,
       fitColumns:false,
       pagination:false,
       rownumbers: true,
       sortName:'transactionid',
       sortOrder:'desc',
       toolbar:'#stockout_all_detail_toolbar'" class="easyui-datagrid">
    <thead>        
        <tr>      
            <th field="stockout_number" width="80" halign="center" sortable="true">STO</th>
            <th field="date" width="70" align="center" formatter="myFormatDate" sortable="true">Date</th>
            <th field="nota_no" width="80" halign="center" sortable="true">MW/Nota No</th>
            <th field="item_code" width="80" halign="center" sortable="true">Item Code</th>
            <th field="item_description" width="180" halign="center">Item Description</th>
            <th field="unitcode" width="60" align="center">Unit</th>
            <th field="qty" width="70" align="center">Qty</th>
            <th field="warehouse_name_out" width="80" align="center">Out From</th>
            <th field="employee_request_by" width="90" halign="center">Request By</th>            
            <th field="remark" width="100" halign="center">Remark</th>
            <th field="stockoutdetail_remark" width="100" halign="center">Required For</th>
        </tr>
    </thead>
</table>