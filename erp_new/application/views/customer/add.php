<div id="customer-form" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:600px; padding: 5px 5px" closed="true" buttons="#customer-button">
   <form id="customer-input" method="post" novalidate>
      <table width="100%" border="0">
         <tr>
            <td width="50%">
               <table width="100%">
                  <tr>
                     <td width="40%" align="right"><span class="field_label">Code : </span></td>
                     <td><input size='8' type='text' name='code' id='code' value="" class="easyui-validatebox" required="true"/></td>
                  </tr>
                  <tr>
                     <td align="right"><span class="field_label">Name : </span></td>
                     <td><input size='25' type='text' name='name' id='name' class="easyui-validatebox"  required="true"/></td>
                  </tr>                  
                  <tr>
                     <td align="right"><span class="field_label">Contact : </span></td>
                     <td><input size='25' type='text' name='contact' id='contact' class="easyui-validatebox"  /></td>
                  </tr>
                  <tr>
                     <td align="right"><span class="field_label">Phone : </span></td>
                     <td><input type='text' name='phone' id='phone' class="easyui-validatebox"  /></td>
                  </tr>
                  <tr>
                     <td align="right"><span class="field_label">Fax : </span></td>
                     <td><input type='text' name='fax' id='fax' class="easyui-validatebox"  /></td>
                  </tr>
                  <tr>
                     <td align="right"><span class="field_label">Email : </span></td>
                     <td><input size='25' type='text' name='email' id='email' /></td>
                  </tr>
                  <tr>
                     <td align="right"><span class="field_label">Address: </span></td>
                     <td><textarea style="width: 100%;height: 35px" name='address' id="address" class="easyui-validatebox" ></textarea></td>
                  </tr>                 
               </table>
            </td>
            <td width="50%">
               <table width="100%">
                  <tr>
                     <td width="40%" align="right"><span class="field_label">City : </span></span></td>
                     <td><input type='text' name='city' id='city'  class="easyui-validatebox" /></td>
                  </tr>
                  <tr>
                     <td align="right"><span class="field_label">State : </span></td>
                     <td><input type='text' name='state' id='state'  class="easyui-validatebox"  /></td>
                  </tr>
                  <tr>
                     <td align="right"><span class="field_label">Zip code : </span></td>
                     <td><input type='text' name='zipcode' id='zipcode' class="easyui-validatebox"  /></td>
                  </tr>
                  <tr>
                     <td align="right"><span class="field_label">Country : </span></td>
                     <td><input type='country' name='country' id='country' class="easyui-validatebox"  /></td>
                  </tr>							
                  <tr>
                     <td align="right"><span class="field_label">Service : </span></td>
                     <td><textarea style="width: 100%;height: 35px" name='service' id="service"  class="easyui-validatebox" ></textarea></td>
                  </tr>                          
               </table>
            </td>
         </tr>         
      </table>
   </form>
</div>
<div id="customer-button">
   <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="customer_save()">Save</a>
   <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#customer-form').dialog('close')">Cancel</a>
</div>