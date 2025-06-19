<div class="easyui-layout" data-options="fit:true">        
  <div region="center" style="border: none;" title="Transfer Stock">
    <div id="transferstock_toolbar" style="padding-bottom: 0;">
      <form id="transferstock_form_search2" style="margin-bottom: 0px" onsubmit="return false">
        TS : 
        <input type="text" 
               size="12" 
               name="number"
               class="easyui-validatebox" 
               onkeyup="if (event.keyCode === 13) {
                     transferstock_search2()
                   }"/>  
        Date From :
        <input type="text" size="15" name="datefrom" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser"/>
        To :
        <input type="text" size="15" name="dateto" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser"/>               
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="transferstock_search2()">Search</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="transferstock_add()">Add</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="transferstock_edit()">Edit</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="transferstock_delete()">Delete</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="transferstock_print()">Print</a>                
      </form>
    </div>
    <table id="transferstock" data-options="  
           method:'post',
           border:true,       
           singleSelect:true,
           fit:true,
           rownumbers:true,
           fitColumns:false,
           striped:true,
           pagination:true,
           sortName:'id',
           sortOrder:'desc',
           toolbar:'#transferstock_toolbar'">
      <thead>
        <tr>
          <th field="chck" checkbox="true"></th>
          <th field="number" width="90" halign="center" sortable="true">TS No</th>            
          <th field="date_f" width="80" align="center" sortable="true">Date</th>
          <th field="warehouse_from" width="100" align="center" sortable="true">Transfer From</th>
          <th field="warehouse_to" width="100" align="center" sortable="true">Transfer To</th>
          <th field="delivered_by" width="150" halign="center" sortable="true">Delivered By</th>
          <th field="received_by" width="150" halign="center" sortable="true">Received By</th>
          <th field="remark" width="500" halign="center" sortable="true">Remark</th>
        </tr>
      </thead>
    </table>
    <script type="text/javascript">
      $(function() {
        $('#transferstock').datagrid({
          url: '<?php echo site_url('transferstock/get') ?>',
          onSelect: function(rowIndex, rowData) {
            $('#transferstockdetail').datagrid('reload', {
              transferstockid: rowData.id
            });
          }
        });
      });
    </script>
  </div>
  <div region="south" split="true" style="height:250px;border: none;" title="Item" collapsible="false">
    <?php $this->load->view('transferstock/detail/view'); ?>
  </div>
</div>
<?php
$this->load->view('transferstock/add');
?>