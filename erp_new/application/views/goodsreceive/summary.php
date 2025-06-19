<div id="stockin_summary_toolbar" style="padding-bottom: 0;">
  <form id="stockin_summary_form_search" style="margin-bottom: 0">
    Date From : 
    <input type="text" 
           size="13" 
           class="easyui-datebox" 
           id="stockin_datefrom_s" 
           data-options="formatter:myformatter,parser:myparser"
           name="datefrom"
           required="true"
           />
    To :
    <input type="text" 
           size="13" 
           class="easyui-datebox" 
           id="stockin_summary_dateto_s" 
           data-options="formatter:myformatter,parser:myparser"
           name="dateto"
           required="true"
           />
    Item Code : 
    <input type="text" 
           size="12" 
           name="itemcode"
           class="easyui-validatebox" 
           id="stockin_summary_code_s" 
           onkeypress="if (event.keyCode === 13) {
                 stockindetail_summary_search();
               }"
           />
    Description :
    <input type="text" 
           class="easyui-validatebox" 
           name="itemdescription"
           size="12" 
           id=stockin_summary_description_s" 
           onkeyup="if (event.keyCode === 13) {
                 stockindetail_summary_search();
               }"
           />
    Item Group : 
    <input class="easyui-combobox" name="groupid" data-options="
           url: '<?php echo site_url('itemgroup/get') ?>',
           method: 'post',
           valueField: 'id',
           textField: 'name',
           mode: 'remote',
           panelHeight: '200',
           panelWidth:'200',
           formatter: stockinSummaryFormatGroup,
           onChange:function(o,n){stockindetail_summary_search()}"
           style="width: 100px" 
           />
    <script type="text/javascript">
      function stockinSummaryFormatGroup(row) {
        var s = '<span style="font-weight:bold">' + row.code + '</span><br/>' +
                '<span style="color:#888">Name: ' + row.name + '</span><br/>';
        return s;
      }
    </script>
    <a href="#" onclick="stockindetail_summary_search()" class="easyui-linkbutton" plain="true" iconCls="icon-search"></a>   
  </form>
</div>
<table id="stockin_summary" data-options="       
       method:'post',
       border:true,       
       singleSelect:true,
       title:'Stock In Summary',
       fit:true,
       rownumber:true,
       striped:true,
       fitColumns:false,
       pagination:false,
       rownumbers: true,
       sortName:'id',
       sortOrder:'desc',
       toolbar:'#stockin_summary_toolbar'" class="easyui-datagrid">
  <thead>        
    <tr>      
      <th field="itemcode" width="120" halign="center" sortable="true">Item</th>
      <th field="itemdescription" width="350" halign="center" sortable="true">Description</th>
      <th field="groupcode" width="100" halign="center" sortable="true">Group</th>
      <th field="unitcode" width="60" align="center" sortable="true">Unit</th>
      <th field="qty" width="70" align="right" halign="center" sortable="true">Qty</th>
    </tr>
  </thead>
</table>