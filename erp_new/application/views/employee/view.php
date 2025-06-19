<div id="employee_toolbar" style="padding-bottom: 0;">
  <form id="employee_form_search2" style="margin-bottom: 0px">
    ID : <input type="text" 
                size="12" 
                class="easyui-validatebox" 
                name="id" id="employee_id_s" 
                onkeyup="if (event.keyCode == 13) {
                      employee_search()
                    }"/>    
    Name : <input type="text" 
                  size="12" 
                  class="easyui-validatebox" 
                  name="name" 
                  id="employee_name_s" 
                  onkeyup="if (event.keyCode == 13) {
                        employee_search()
                      }"/>   
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="employee_search()"></a>
    <?php
    if (in_array('add', $action)) {
      ?>
      <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="employee_add()"> Add</a>
      <?php
    }if (in_array('edit', $action)) {
      ?>
      <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="employee_edit()"> Edit</a>
      <?php
    }if (in_array('delete', $action)) {
      ?>
      <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="employee_delete()"> Delete</a>
      <?php
    }
    ?>
  </form>
</div>
<table id="employee" data-options="
       'url':'<?php echo site_url('employee/get') ?>',
       method:'post',
       title:'Employee',
       border:true,
       singleSelect:true,
       fit:true,
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       striped:true,
       idField:'id',
       nowrap:true,
       sortName:'id',
       sortOrder:'desc',
       toolbar:'#employee_toolbar'">
  <thead>
    <tr>            
      <th field="id" width="60" align="center" sortable="true">ID</th>
      <th field="name" width="120" halign="center" sortable="true">Name</th>
      <th field="startdate_f" width="80" align="center" sortable="true">Join Date</th>
      <th field="payrollstatus" width="80" align="center" sortable="true">Payroll Status</th>
      <th field="status" width="50" align="center" sortable="true">Status</th>
      <th field="department" width="120" halign="center" sortable="true">Department</th>
      <th field="section" width="100" halign="center" sortable="true">Section</th>
      <!--<th field="subsection" width="100" halign="center" sortable="true">Sub Section</th>-->
      <th field="position" width="100" halign="center" sortable="true">Job Title</th>
      <th field="birthplace" width="80" halign="center" sortable="true">Birth Place</th>
      <th field="dob_f" width="80" align="center" sortable="true">DoB</th>
      <th field="sex" width="40" align="center" sortable="true">Sex</th>
      <th field="familystatus" width="40" align="center" sortable="true">Dependent</th>
      <th field="address" width="250" halign="center" sortable="true">Address</th>
      <th field="othersidentity" width="120" halign="center">Identity</th>
      <th field="phone" width="100" halign="center">Phone</th>
      <th field="email" width="100" halign="center">Email</th>
<!--            <th field="dob" width="80" align="center">DoB</th>
      <th field="department" width="100" halign="center">Department</th>
      <th field="position" width="100" halign="center">Job Title</th>
      <th field="address" width="160" halign="center">Address</th>
      <th field="city" width="80" align="center">City</th>
      <th field="zipcode" width="80" align="center">Zip Code</th>
      <th field="country" width="80" align="center">Country</th>
      <th field="workphone" width="80" align="center">Work Phone</th>
      <th field="phonenumber" width="80" align="center">Phone Number</th>
      <th field="startdate" width="80" align="center">Start Date</th>
      <th field="enddate" width="80" align="center">End Date</th>            -->
    </tr>
  </thead>
</table>
<script type="text/javascript">
  $(function() {
    $('#employee').datagrid().datagrid('getPager').pagination({
      pageList: [30, 50, 70, 90, 110]
    });
  });
</script>
<?php
$this->load->view('employee/add');
