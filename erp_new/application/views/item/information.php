<div style="margin: 5px;width:700px;">
    <table width="100%" border="1">
        <tr>
            <td width="20%" align="center"><b>Image</b></td>
            <td width="40%">&nbsp;</td>
            <td width="40%">&nbsp;</td>
        </tr>
        <tr>
            <td align="center">
                <img src="files/<?php echo $image ?>" style='max-width: 80px;max-height: 80px;;width: 80px;height: 80px;'/><br/>
                <?php if (in_array('change_image', $action)) { ?>
                    <a href="javascript:void(0)" onclick="item_change_image()">Change Image</a>
                <?php } ?>
            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
    </table>

</div>