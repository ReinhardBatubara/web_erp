<div class="easyui-layout" data-options="fit:true">        
    <div data-options="region:'center'" border="false">
        <div class="easyui-layout" data-options="fit:true">
            <div data-options="region:'center'" title="Model" href="<?php echo site_url('model/view') ?>"></div>
            <div data-options="region:'east',split:true" title="Image" collapsible="false" style="width:160px;border-width: 1px;border-top: none;">
                <table width="100%">
                    <tr>
                        <td align="center" height="180" id="temp_image_model">
                            <img src="files/no-image.jpg" id="image-item" style="padding-top: 10px; max-width: 150px;max-height: 150px;"/>
                        </td>                           
                    </tr>
                    <tr>
                        <td align="center">
                            <button class="button" onclick="model_change_image()">Change Image</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div 
        collapsible="false"
        title="Detail"
        data-options="region:'south',split:true" 
        style="height:60%;" 
        href="<?php echo site_url('model/detail_layout') ?>">
    </div>
</div>
<?php
$this->load->view('model/change_image');
