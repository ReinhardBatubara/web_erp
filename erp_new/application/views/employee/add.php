<div id="employee-form" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:400px; padding: 5px 5px" closed="true" buttons="#employee-button">
    <form id="employee-input" method="post" novalidate>
        <table width="100%" border="0" cellpadding="1" cellspacing="1">
            <tr>
                <td width="30%" align="right"><span class="field_label">ID : </span></td>
                <td><input size='25' type='text' name='id' id='id' value="" class="easyui-validatebox" required="true"/></td>
            </tr>
            <tr>
                <td align="right"><span class="field_label">Name : </span></td>
                <td><input type='text' name='name' id='name' class="easyui-validatebox" required="true" style="width: 90%"/></td>
            </tr>
            <tr>
                <td align="right"><span class="field_label">Department : </span></td>
                <td>
                    <input class="easyui-combobox" name="departmentid" data-options="
                           url: '<?php echo site_url('department/get') ?>',
                           method: 'post',
                           valueField: 'id',
                           textField: 'name',
                           panelHeight: '200',
                           formatter: formatDepartment"
                           style="width: 200px" 
                           required="true">

                    <script type="text/javascript">
                        function formatDepartment(row){
                            var s = '<span>Code: ' + row.code +'</span><br/>' +
                                '<span>Name: ' + row.name +'</span><br/>' +
                                '<span style="color:#888">Desc: ' + row.description + '</span>';
                            return s;
                        }
                    </script>
                </td>
            </tr>
            <tr>
                <td align="right"><span class="field_label">Section : </span></td>
                <td>
                    <input class="easyui-combobox" name="sectionid" data-options="
                           url: '<?php echo site_url('section/get') ?>',
                           method: 'post',
                           valueField: 'id',
                           textField: 'name',
                           panelHeight: '200',
                           formatter: formatSection"
                           style="width: 200px" 
                           required="true">
                    <script type="text/javascript">
                        function formatSection(row){
                            var s = '<span>Code: ' + row.code +'</span><br/>' +
                                '<span>Name: ' + row.name +'</span><br/>' +
                                '<span style="color:#888">Desc: ' + row.description + '</span>';
                            return s;
                        }
                    </script>
                </td>
            </tr>
<!--            <tr>
                <td align="right"><span class="field_label">Sub Section : </span></td>
                <td>
                    <input class="easyui-combobox" name="subsectionid" data-options="
                           url: '<?php echo site_url('subsection/get') ?>',
                           method: 'post',
                           valueField: 'id',
                           textField: 'name',
                           panelHeight: '200',
                           formatter: formatSubSection"
                           style="width: 200px" required="true">
                    <script type="text/javascript">
                        function formatSubSection(row){
                            var s = '<span>Code: ' + row.code +'</span><br/>' +
                                '<span>Name: ' + row.name +'</span><br/>' +
                                '<span style="color:#888">Desc: ' + row.description + '</span>';
                            return s;
                        }
                    </script>
                </td>
            </tr>            -->
            <tr>
                <td align="right"><span class="field_label">Job Title : </span></td>
                <td>
                    <input class="easyui-combobox" name="jobtitleid" data-options="
                           url: '<?php echo site_url('jobtitle/get') ?>',
                           method: 'post',
                           valueField: 'id',
                           textField: 'name',
                           panelHeight: '200',
                           formatter: formatJobtitle"
                           style="width: 200px" required="true">
                    <script type="text/javascript">
                        function formatJobtitle(row){
                            var s = '<span>Code: ' + row.code +'</span><br/>' +
                                '<span>Name: ' + row.name +'</span><br/>' +
                                '<span style="color:#888">Desc: ' + row.description + '</span>';
                            return s;
                        }
                    </script>
                </td>
            </tr>
            <tr>
                <td align="right"><span class="field_label">Status : </span></td>
                <td>
                    <select class="easyui-combobox" panelHeight="auto" name="status" style="width:100px;">
                        <option value="S">S</option>
                        <option value="NS">NS</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right"><span class="field_label">Payroll Status : </span></td>
                <td>
                    <select class="easyui-combobox" panelHeight="auto" name="payrollstatus" style="width:100px;">
                        <option value="HL">HL</option>
                        <option value="BL">BL</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right"><span class="field_label">Start date : </span></td>
                <td><input type='text' name='startdate' id='startdate' class="easyui-datebox" data-options="formatter:myformatter,parser:myparser"/></td>
            </tr>
            <tr>
                <td align="right"><span class="field_label">End date : </span></td>
                <td><input type='text' name='enddate' id='enddate' class="easyui-datebox" data-options="formatter:myformatter,parser:myparser"/></td>
            </tr>
            <tr>
                <td align="right"><span class="field_label">Birth Place : </span></td>
                <td><input type='text' name='birthplace' id='birthplace' class="easyui-validatebox" style="width: 90%"/></td>
            </tr>
            <tr>
                <td align="right"><span class="field_label">DOB : </span></td>
                <td><input type='text' name='dob' id='dob' class="easyui-datebox" data-options="formatter:myformatter,parser:myparser"/></td>
            </tr>
            <tr>
                <td align="right"><span class="field_label">Sex : </span></td>
                <td>
                    <select class="easyui-combobox" panelHeight="auto" name="sex" style="width:100px;">
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right"><span class="field_label">Dependent : </span></td>
                <td>
                    <select class="easyui-combobox" panelHeight="auto" name="familystatus" style="width:100px;">
                        <option value="TK">TK</option>
                        <option value="K0">K0</option>
                        <option value="K1">K1</option>
                        <option value="K2">K2</option>
                        <option value="K3">K3</option>
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <td align="right"><span class="field_label">Address : </span></td>
                <td><textarea style="width: 100%;height: 45px" name='address' id="address" class="easyui-validatebox"></textarea></td>
            </tr> 
            <tr>
                <td align="right"><span class="field_label">Identity : </span></td>
                <td><input type='text' name='othersidentity' class="easyui-validatebox" style="width: 90%"/></td>
            </tr>
            <tr>
                <td align="right"><span class="field_label">E-mail : </span></td>
                <td><input type='text' name='email' class="easyui-validatebox" style="width: 90%"/></td>
            </tr>
            <tr>
                <td align="right"><span class="field_label">Phone No : </span></td>
                <td><input type='text' name='phone' class="easyui-validatebox" style="width: 90%"/></td>
            </tr>   
        </table>
    </form>
</div>
<div id="employee-button">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="employee_save()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#employee-form').dialog('close')">Cancel</a>
</div>