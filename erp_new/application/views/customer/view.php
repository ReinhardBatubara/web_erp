<div id="customer_toolbar" style="padding-bottom: 0;">            
  Code : <input type="text" size="12" class="easyui-validatebox" id="customer_code_s"
                onkeyup="if(event.keyCode===13){customer_search()}"/>    
  Name : <input type="text" size="12" class="easyui-validatebox" id="customer_name_s" 
                onkeyup="if(event.keyCode===13){customer_search()}"/>   
  <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="customer_search()"></a>
  <?php
  if (in_array('add', $action)) {
    ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="customer_add()">Add</a>
    <?php
  }if (in_array('edit', $action)) {
    ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="customer_edit()">Edit</a>
    <?php
  }if (in_array('delete', $action)) {
    ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="customer_delete()">Delete</a>
    <?php
  }
  ?>
</div>
<table id="customer" data-options="
       'url':'<?php echo site_url('customer/get') ?>',
       method:'post',
       title:'Customer',
       border:true,
       singleSelect:true,
       fit:true,
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       striped:true,
       sortName:'id',
       sortOrder:'desc',
       toolbar:'#customer_toolbar'">
  <thead>
    <tr>
      <th field="id"hidden="true"></th>            
      <th field="code" width="100" align="center" sortable="true">Code</th>
      <th field="name" width="150" halign="center" sortable="true">Name</th>
      <th field="address1" width="200" halign="center" sortable="true">Address</th>
      <th field="city" width="100" align="center" sortable="true">City</th>
      <th field="state" width="100" align="center" sortable="true">State</th>
      <th field="zipcode" width="100" align="center">Zip Code</th>
      <th field="country" width="100" align="center" sortable="true">Country</th>
      <th field="contact" width="100" align="center">Contact Person</th>
      <th field="service" width="200" halign="center" sortable="true">Service</th>
      <th field="phone" width="100" align="center" sortable="true">Phone</th>
      <th field="fax" width="100" align="center">Fax</th>
      <th field="email" width="100" align="center">Email</th>
    </tr>
  </thead>
</table>
<script type="text/javascript">
  $(function() {
    $('#customer').datagrid({});
  });
</script>
<?php
$this->load->view('customer/add');
