<div id="transferstock-form" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:450px; padding: 2px 2px" closed="true" buttons="#transferstock-button">
    <form id="transferstock-input" method="post" novalidate class="table_form" style="padding: 2px">
        <table width="100%" border="0">
            <tr>
                <td align="right" width="25%"><label class="field_label">Date : </label></td>
                <td width="75%"><input type="text" size="15" name="date" class="easyui-datebox" id="date" data-options="formatter:myformatter,parser:myparser" required="true"/></td>
            </tr>   
            <?php if (($this->session->userdata('department') == 9 && $this->session->userdata('optiongroup') == -1) || $this->session->userdata('id') == 'admin') { ?>                
                <tr>
                    <td align="right"><label class="field_label">Transfer From : </label></td>
                    <td>
                        <input type="text"
                               name="fromwarehouseid" 
                               id="transferstock_fromwarehouseid" 
                               class="easyui-combobox" 
                               url="<?php echo site_url('warehouse/get') ?>"
                               data-options="
                               valueField: 'id',
                               textField: 'code'" 
                               style="width: 80px" 
                               panelHeight="auto"
                               required="true" >
                        <script type="text/javascript">
                            $(function () {
                                $('#transferstock_fromwarehouseid').combobox({
                                    onSelect: function (row) {
                                        $('#transferstock_towarehouseid').combobox('reload', base_url + 'warehouse/get_filter/' + row.id);
                                    }
                                });
                            });
                        </script>
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <td align="right"><label class="field_label">Transfer To : </label></td>
                <td>
                    <?php
                    if (($this->session->userdata('department') == 9 && $this->session->userdata('optiongroup') == -1) || $this->session->userdata('id') == 'admin') {
                        ?>
                        <input type="text"
                               name="towarehouseid" 
                               id="transferstock_towarehouseid" 
                               class="easyui-combobox"
                               data-options="
                               valueField: 'id',
                               textField: 'code'" 
                               style="width: 80px" 
                               panelHeight="auto"
                               required="true" >
                               <?php
                           } else {
                               ?>
                        <input type="text"
                               name="towarehouseid" 
                               id="transferstock_towarehouseid" 
                               class="easyui-combobox" 
                               url="<?php echo site_url('warehouse/get_filter/' . $this->session->userdata('optiongroup')) ?>"
                               data-options="
                               valueField: 'id',
                               textField: 'code'" 
                               style="width: 80px" 
                               panelHeight="auto"
                               required="true" >
                               <?php
                           }
                           ?>

                </td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Receive By : </label></td>
                <td>
                    <input type="text" name="receivedby" id="ts_receivedby" mode="remote" style="width: 150px" required="true"/>
                    <script type="text/javascript">
                        $('#ts_receivedby').combogrid({
                            panelWidth: 450,
                            idField: 'id',
                            textField: 'name',
                            url: '<?php echo site_url('employee/get_remote_data') ?>',
                            columns: [[
                                    {field: 'id', title: 'ID', width: 60},
                                    {field: 'name', title: 'Name', width: 100},
                                    {field: 'department', title: 'Department', width: 100},
                                    {field: 'jobtitle', title: 'Job Title', width: 100}
                                ]]
                        });
                    </script>
                </td>
            </tr>
            <tr valign="top">
                <td align="right"><label class="field_label">Remark : </label></td>
                <td>
                    <textarea name="remark" class="easyui-validatebox" style="width: 95%;height: 50px"></textarea>
                </td>
            </tr>            
        </table>        
    </form>
</div>
<div id="transferstock-button">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="transferstock_save()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#transferstock-form').dialog('close')">Cancel</a>
</div>