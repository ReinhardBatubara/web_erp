<div id="pemakaian_bahan_baku_toolbar" style="padding-bottom: 0px;">
  <form id="pemakaian_bahan_baku_form_search" style="margin-bottom: 0">
    Date From :
    <input type="text" size="15" name="datefrom" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" required="true"/>
    To :
    <input type="text" size="15" name="dateto" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" required="true"/>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="report_pemakaian_bahan_baku_search()"></a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-view_detail_item" plain="true" onclick="report_pemakaian_bahan_baku_preview()">Preview</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="report_pemakaian_bahan_baku_print()">Print</a>
  </form>
</div>
<table id="pemakaian_bahan_baku" data-options="
       url:'<?php echo site_url('report/pemakaian_bahan_baku_get') ?>',
       method:'post',
       title:'Laporan Pemakaian Bahan Baku',
       border:true,
       singleSelect:true,
       fit:true,
       pageSize:30,
       pageList: [30, 50, 70, 90, 110],
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       striped:true,
       sortName:'id',
       sortOrder:'desc',
       toolbar:'#pemakaian_bahan_baku_toolbar'">
  <thead>
    <tr>     
      <th field="item_code" width="150" halign="center" sortable="true">Item Code</th>
      <th field="item_description" width="500" halign="center" sortable="true">Item Description</th>
      <th field="unitcode" width="80" align="center" sortable="true">Unit Code</th>
      <th field="qty" width="80" halign="center" align="center" sortable="true">Qty</th>     
    </tr>
  </thead>
</table>
<script>
  $(function() {
    $('#pemakaian_bahan_baku').datagrid({});
  });
</script>


