<div class="easyui-layout" data-options="fit:true">
  <div region="north"
       style="height:250px;" 
       collasible="false"
       split="true"
       title="Material Planning">
    <div id="mrp_joborder_toolbar" style="padding-bottom: 0px;">
      <form id="mrp_joborder_form" style="margin: 0" onsubmit="return false">
        <table>
          <tr>
            <td>JO Number</td>
            <td>
              <input type="text" 
                     class="easyui-validatebox" 
                     name="jonumber"
                     style="width: 100px;margin: 0 10px 0 0px;"
                     onkeyup="if (event.keyCode === 13) {
                           mrp_search();
                         }" 
                     />
              Project Name 
              <input type="text" 
                     class="easyui-validatebox" 
                     name="projectname"
                     style="width: 100px;margin: 0 10px 0 0px;"
                     onkeyup="if (event.keyCode === 13) {
                           mrp_search();
                         }" 
                     />
              Order Type <select class="easyui-combobox" name="order_type" panelHeight='200' panelWidth=200' style="width: 80px;" data-options="onChange:function(n,o){mrp_search()}">
                <option></option>
                <option value="Order">Order</option>
                <option value="Stock/Sample">Stock/Sample</option>
              </select>
              Status <select class="easyui-combobox" name="jostatus" panelHeight='200' panelWidth=200' style="width: 80px;" data-options="onChange:function(n,o){mrp_search()}">
                <option></option>
                <option value="True">Submitted</option>
                <option value="False">Not Submitted (New)</option>
              </select>
            </td>
            <td>
              <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="mrp_search()">Find</a>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-generate" plain="true" onclick="joborder_generate_mrp()">Re/Generate MRP</a>
              <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-process_approve" plain="true" onclick="joborder_mark_mrp_as_final()">Submit >></a>
              <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" id='mrp_btn_print' plain="true" onclick="joborder_print_mrp()">Print</a>    
            </td>
          </tr>
        </table>
      </form>
    </div>
    <table id="mrp_joborder" data-options="
           url:'<?php echo site_url('joborder/get_for_mrp') ?>',
           method:'post',
           border:false,
           singleSelect:true,
           fit:true,
           pageSize:30,
           pageList: [30, 60, 90, 120],
           rownumbers:true,
           fitColumns:false,
           nowrap:false,
           pagination:true,
           striped:true,
           idField:'id',
           sortName:'id',
           sortOrder:'desc',
           toolbar:'#mrp_joborder_toolbar'">
      <thead>
        <tr>
          <th feld="jo_mrp_chck50" checkbox="true"></th>
          <th field="joborder_no" width="80" halign="center" sortable="true">JO No</th>
          <th field="project_name" width="150" halign="center" sortable="true">Project Name</th>
          <th field="week" width="50" align="center" sortable="true">Week</th>
          <th field="order_type" width="100" halign="center" sortable="true">Order Type</th>
          <th field="status" data-options="formatter:function(value,row,index){return row.status_remark}" width="150" halign="center" sortable="true">Status</th>
        </tr>
      </thead>
    </table>
    <script type="text/javascript">
      $(function() {
        $('#mrp_joborder').datagrid({
          onSelect: function(value, row, index) {
            $('#mrp').datagrid('reload', {
              joborderid: row.id
            });
          }, rowStyler: function(index, row) {
            if (row.final_mrp == 'f') {
              return 'background-color:#ffecec;'; // return inline style                            
            }
          }
        });
      });
    </script>
  </div>
  <div region="center" 
       title="Material List" 
       collapsible="false"                  
       href="<?php echo site_url('joborder/view_mrp/0') ?>"
       />
</div>
</div>
