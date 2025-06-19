<div id="pengeluaran_hasil_produksi_toolbar" style="padding-bottom: 0px;">
  <form id="pengeluaran_hasil_produksi_form_search" style="margin-bottom: 0">
    Date From :
    <input type="text" size="15" name="datefrom" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" required="true"/>
    To :
    <input type="text" size="15" name="dateto" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" required="true"/>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="report_pengeluaran_hasil_produksi_search()"></a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-view_detail_item" plain="true" onclick="report_pengeluaran_hasil_produksi_preview()">Preview</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="report_pengeluaran_hasil_produksi_print()">Print</a>
  </form>
</div>
<table id="pengeluaran_hasil_produksi" data-options="
       url:'<?php echo site_url('report/pengeluaran_hasil_produksi_get') ?>',
       method:'post',
       title:'Laporan Pengeluaran Hasil Produksi',
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
       toolbar:'#pengeluaran_hasil_produksi_toolbar'">
  <thead>
    <tr>     
      <th field="item_code" width="150" halign="center" sortable="true">Item Code</th>
      <th field="item_description" width="500" halign="center" sortable="true">Item Description</th>
      <th field="unit_code" width="80" align="center" sortable="true">Unit Code</th>
      <th field="qty" width="80" halign="center" align="center" sortable="true">Qty</th>     

    </tr>
  </thead>
</table>
<script>
  $(function() {
    $('#pengeluaran_hasil_produksi').datagrid({});
  });
</script>


