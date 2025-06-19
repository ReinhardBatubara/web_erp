<div id="pemakaian_proses_sub_kontrak_toolbar" style="padding-bottom: 0px;">
  <form id="pemakaian_proses_sub_kontrak_form_search" style="margin-bottom: 0">
    Date From :
    <input type="text" size="15" name="datefrom" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" required="true"/>
    To :
    <input type="text" size="15" name="dateto" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" required="true"/>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="report_pemakaian_proses_sub_kontrak_search()"></a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-view_detail_item" plain="true" onclick="report_pemakaian_proses_sub_kontrak_preview()">Preview</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="report_pemakaian_proses_sub_kontrak_print()">Print</a>
  </form>
</div>
<table id="pemakaian_proses_sub_kontrak" data-options="
       url:'<?php echo site_url('report/pemakaian_proses_sub_kontrak_get') ?>',
       method:'post',
       title:'Laporan Pemakaian Barang Dalam Proses Kegiatan Sub Kontra',
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
       toolbar:'#pemakaian_proses_sub_kontrak_toolbar'">
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
    $('#pemakaian_proses_sub_kontrak').datagrid({});
  });
</script>


