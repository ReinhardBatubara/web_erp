<input type="hidden" value="<?php echo $id ?>" id="privilege_user_id"/>
<table width="98%" border="1" style="margin:5px;border-collapse: collapse;" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th>&nbsp;</th>
            <th width="15%">Menu</th>
            <th width="55%">Action</th>
            <th width="30%">Data View Option</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($menu as $result) {
            $checked_menu = "";
            $disable_action = "disabled";
            if (in_array($result->scriptview, $user_list_menu)) {
                $checked_menu = "checked";
                $disable_action = "";
            }

            if ($result->scriptview == 'purchaserequest') {
                if ($departmentid == 7) {
                    $explode_list_action = explode('|', $result->actions);
                } else {
                    $explode_list_action = array("");
                }
            } else {
                $explode_list_action = explode('|', $result->actions);
            }
            $list_action = array_diff($explode_list_action, array(""));
            $user_action = explode('|', $this->model_menuaccess->get_user_action($id, $result->scriptview));
            ?>
            <tr valign="top">
                <td><input type="checkbox" <?php echo $checked_menu ?> style="padding: 0px;height: 15px" id="<?php echo str_replace("/", "_", $result->scriptview) ?>" value="<?php echo $result->scriptview ?>" onclick="user_privilege_click_menu(<?php echo "'" . str_replace("/", "_", $result->scriptview) . "'," . count($list_action) ?>)"/></td>
                <td style="padding: 2px"><?php echo $result->label ?></td>
                <td>
    <!--                    <input type="checkbox" style="padding: 0px;height: 15px;vertical-align: middle;"/>Check All<br/>-->
                    <?php
                    for ($i = 0; $i < count($list_action); $i++) {
                        $checked = "";
                        if (in_array($list_action[$i], $user_action)) {
                            $checked = "checked";
                        }
                        ?>
                        <input type="checkbox" <?php echo $checked . " " . $disable_action ?> onclick="user_action_set(this, '<?php echo $result->scriptview; ?>')" style="padding: 0px;height: 15px;vertical-align: middle;" id="<?php echo str_replace("/", "_", $result->scriptview) . "" . $i ?>" value="<?php echo $list_action[$i] ?>"/><?php echo $list_action[$i] ?><br/>
                        <?php
                    }
                    ?>
                </td>
                <td valign="top">
                    <?php
                    $option_view = $this->model_menuaccess->get_option_view($id, $result->scriptview);
                    if ($result->optionview == 't') {
                        if ($result->scriptview == 'purchaserequest') {
                            $checked1 = ($option_view == 1) ? 'checked' : '';
                            ?>
                            <input type="radio" <?php echo $disable_action . " " . $checked1 ?> name="<?php echo $result->scriptview ?>_option_view" id="o_v_1_<?php echo $result->scriptview ?>" value="1" style="vertical-align: bottom;height: 15px;" onclick="user_privilege_option_view(this, '<?php echo $result->scriptview ?>')">All<br/>
                            <input type="radio" <?php echo $disable_action ?> name="<?php echo $result->scriptview ?>_option_view" id="o_v_3_<?php echo $result->scriptview ?>" value="0" style="vertical-align: bottom;height: 15px;" onclick="user_privilege_option_view(this, '<?php echo $result->scriptview ?>')">None
                            <?php
                        } elseif ($result->scriptview == 'purchaseorder') {
                            $checked1 = ($option_view == 1) ? 'checked' : '';
                            ?>
                            <input type="radio" <?php echo $disable_action . " " . $checked1 ?> name="<?php echo $result->scriptview ?>_option_view" id="o_v_1_<?php echo $result->scriptview ?>" value="1" style="vertical-align: bottom;height: 15px;" onclick="user_privilege_option_view(this, '<?php echo $result->scriptview ?>')">All<br/>
                            <input type="radio" <?php echo $disable_action ?> name="<?php echo $result->scriptview ?>_option_view" id="o_v_3_<?php echo $result->scriptview ?>" value="0" style="vertical-align: bottom;height: 15px;" onclick="user_privilege_option_view(this, '<?php echo $result->scriptview ?>')">None
                            <?php
                        } elseif ($result->scriptview == 'goodsreceive') {
                            $checked1 = ($option_view == 1) ? 'checked' : '';
                            ?>
                            <input type="radio" <?php echo $disable_action . " " . $checked1 ?> name="<?php echo $result->scriptview ?>_option_view" id="o_v_1_<?php echo $result->scriptview ?>" value="1" style="vertical-align: bottom;height: 15px;" onclick="user_privilege_option_view(this, '<?php echo $result->scriptview ?>')">All<br/>
                            <input type="radio" <?php echo $disable_action ?> name="<?php echo $result->scriptview ?>_option_view" id="o_v_3_<?php echo $result->scriptview ?>" value="0" style="vertical-align: bottom;height: 15px;" onclick="user_privilege_option_view(this, '<?php echo $result->scriptview ?>')">None
                            <?php
                        } elseif ($result->scriptview == 'stockout') {
                            $checked1 = ($option_view == 1) ? 'checked' : '';
                            ?>
                            <input type="radio" <?php echo $disable_action . " " . $checked1 ?> name="<?php echo $result->scriptview ?>_option_view" id="o_v_1_<?php echo $result->scriptview ?>" value="1" style="vertical-align: bottom;height: 15px;" onclick="user_privilege_option_view(this, '<?php echo $result->scriptview ?>')">All<br/>
                            <input type="radio" <?php echo $disable_action ?> name="<?php echo $result->scriptview ?>_option_view" id="o_v_3_<?php echo $result->scriptview ?>" value="0" style="vertical-align: bottom;height: 15px;" onclick="user_privilege_option_view(this, '<?php echo $result->scriptview ?>')">None
                            <?php
                        } else {
                            $checked1 = ($option_view == 1) ? 'checked' : '';
                            $checked2 = ($option_view == 2) ? 'checked' : '';
                            ?>
                            <input type="radio" <?php echo $disable_action . " " . $checked1 ?> name="<?php echo $result->scriptview ?>_option_view" id="o_v_1_<?php echo $result->scriptview ?>" value="1" style="vertical-align: bottom;height: 15px;" onclick="user_privilege_option_view(this, '<?php echo $result->scriptview ?>')">All<br/>
                            <input type="radio" <?php echo $disable_action . " " . $checked2 ?> name="<?php echo $result->scriptview ?>_option_view" id="o_v_2_<?php echo $result->scriptview ?>" value="2" style="vertical-align: bottom;height: 15px;" onclick="user_privilege_option_view(this, '<?php echo $result->scriptview ?>')">Department Appropriate<br/>
                            <input type="radio" <?php echo $disable_action ?> name="<?php echo $result->scriptview ?>_option_view" id="o_v_3_<?php echo $result->scriptview ?>" value="0" style="vertical-align: bottom;height: 15px;" onclick="user_privilege_option_view(this, '<?php echo $result->scriptview ?>')">None
                            <?php
                        }
                    }
                    ?>
                    &nbsp;
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>