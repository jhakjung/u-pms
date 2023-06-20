<?php

function wpatt_plugin_options()
{
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }

    if (isset($_POST['submit-general'])) {

        update_option('wpatt_option_localization', $_POST["wpatt_option_localization_n"]);
        update_option('wpatt_option_date_localization', $_POST["wpatt_option_date_localization_n"]);

        if (isset($_POST['wpatt_show_orderby_n'])) {
            update_option('wpatt_show_orderby', '1');
        } else {
            update_option('wpatt_show_orderby', '0');
        }

        if (isset($_POST['wpatt_option_showdate_n'])) {
            update_option('wpatt_option_showdate', '1');
        } else {
            update_option('wpatt_option_showdate', '0');
        }

        if (isset($_POST['wpatt_option_includeimages_n'])) {
            update_option('wpatt_option_includeimages', '1');
        } else {
            update_option('wpatt_option_includeimages', '0');
        }

        if (isset($_POST['wpatt_option_targetblank_n'])) {
            update_option('wpatt_option_targetblank', '1');
        } else {
            update_option('wpatt_option_targetblank', '0');
        }

        if (isset($_POST['wpatt_option_restrictload_n'])) {
            update_option('wpatt_option_restrictload', '1');
        } else {
            update_option('wpatt_option_restrictload', '0');
        }

        if (isset($_POST['wpatt_counter_n'])) {
            update_option('wpatt_counter', '1');
        } else {
            update_option('wpatt_counter', '0');
        }
        if (isset($_POST['wpatt_excludelogged_counter_n'])) {
            update_option('wpatt_excludelogged_counter', '1');
        } else {
            update_option('wpatt_excludelogged_counter', '0');
        }
    }
    if (isset($_POST['submit-appearance'])) {
        update_option('wpa_ict', $_POST['style']);
        update_option('wpa_template', $_POST['template']);
        update_option('wpa_template_custom', stripslashes($_POST['wpa_template_custom']));
    }
    wpa_register_initial_settings();

    echo '<h2><strong style="font-size: 1.2em;">WP Attachments</strong><small> ' . get_option('wpa_version_number') . '</small></h2><br><br>';

    echo '<form method="post" name="options" target="_self">';

    settings_fields('wpatt_option_group');

    if (isset($_GET['tab'])) {
        $current = $_GET['tab'];
    } else {
        $current = 'general';
    }

    $tabs = array(
        'general' => __('Settings'),
        'appearance' => __('Appearance')
    );
    echo '<h2 class="nav-tab-wrapper">';
    echo '<div style="float:right;">
        <a href="http://wordpress.org/support/view/plugin-reviews/wp-attachments" target="_blank" class="add-new-h2">Rate this plugin</a>
        <a href="http://wordpress.org/plugins/wp-attachments/changelog/" target="_blank" class="add-new-h2">Changelog</a>
    </div>';
    foreach ($tabs as $tab => $name) {
        $class = ($tab == $current) ? ' nav-tab-active' : '';
        echo "<a class='nav-tab$class' href='?page=wpatt-option-page&tab=$tab'>$name</a>";
    }
    echo '</h2>';

    if (isset($_GET['tab'])) {
        $tab = $_GET['tab'];
    } else {
        $tab = 'general';
    }

    echo '<table class="form-table">';
    switch ($tab) {
        case 'general':

            echo '<table class="form-table">
                <tr valign="top">
                    <th scope="row">' . __('List Head', 'wp-attachments') . '</th>
                    <td><input type="text" name="wpatt_option_localization_n" value="' . esc_html(get_option('wpatt_option_localization')) . '" />&nbsp;' . __('Attachments list title', 'wp-attachments') . '<br>
                    <input type="checkbox" name="wpatt_show_orderby_n" ';
            $wpatt_show_orderby_get = get_option('wpatt_show_orderby');
            if ($wpatt_show_orderby_get == "1") {
                echo "checked ";
            }
            echo ' />' . __('Show order by', 'wp-attachments') . '</td>
                </tr>
                <tr valign="top">
                    <th scope="row">' . __('Date localization', 'wp-attachments') . '</th>
                    <td><input type="text" name="wpatt_option_date_localization_n" value="' . esc_html(get_option('wpatt_option_date_localization')) . '" />&nbsp;' . __('Attachments date localization', 'wp-attachments') . '</td>
                </tr>
                <tr valign="top">
                    <th scope="row">' . __('Show date', 'wp-attachments') . '</th>
                    <td><input type="checkbox" name="wpatt_option_showdate_n" ';
            $wpatt_option_showdate_get = get_option('wpatt_option_showdate');
            if ($wpatt_option_showdate_get == "1") {
                echo "checked ";
            }
            echo ' />' . __('Show attachments date', 'wp-attachments') . '</td>
                </tr>
                <tr valign="top">
                    <th scope="row">' . __('Include images', 'wp-attachments') . '</th>
                    <td><input type="checkbox" name="wpatt_option_includeimages_n" ';
            $wpatt_option_includeimages_get = get_option('wpatt_option_includeimages');
            if ($wpatt_option_includeimages_get == "1") {
                echo "checked ";
            }
            echo ' />' . __('Include images in list', 'wp-attachments') . '</td>
                </tr>
                <tr valign="top">
                    <th scope="row">' . __('Open attachments in new window', 'wp-attachments') . '</th>
                    <td><input type="checkbox" name="wpatt_option_targetblank_n" ';
            $wpatt_option_targetblank_get = get_option('wpatt_option_targetblank');
            if ($wpatt_option_targetblank_get == "1") {
                echo "checked ";
            }
            echo ' />' . __('Open attachments in a new window', 'wp-attachments') . '</td>
                </tr>
                <tr valign="top">
                    <th scope="row">' . __('Restrict download', 'wp-attachments') . '</th>
                    <td><input type="checkbox" name="wpatt_option_restrictload_n" ';
            $wpatt_option_restrictload_get = get_option('wpatt_option_restrictload');
            if ($wpatt_option_restrictload_get == "1") {
                echo "checked ";
            }
            echo ' />' . __('Restrict download to logged-in users', 'wp-attachments') . '</td>
                </tr>
                <tr valign="top">
                    <th scope="row">' . __('Attachments counter', 'wp-attachments') . '</th>
                    <td><input type="checkbox" name="wpatt_counter_n" ';
            $wpatt_counter_get = get_option('wpatt_counter');
            if ($wpatt_counter_get == "1") {
                echo "checked ";
            }
            echo ' />' . __('Enable attachments counter', 'wp-attachments') . '</td>
                </tr>
                <tr valign="top">
                    <th scope="row">' . __('Exclude logged-in users from counter', 'wp-attachments') . '</th>
                    <td><input type="checkbox" name="wpatt_excludelogged_counter_n" ';
            $wpatt_excludelogged_counter_get = get_option('wpatt_excludelogged_counter');
            if ($wpatt_excludelogged_counter_get == "1") {
                echo "checked ";
            }
            echo ' />' . __('Exclude logged-in users from attachments counter', 'wp-attachments') . '</td>
                </tr>
            </table>';

            break;

        case 'appearance':

            echo '<table class="form-table">
                <tr valign="top">
                    <th scope="row">' . __('Select Style', 'wp-attachments') . '</th>
                    <td>
                        <select name="style" id="style">
                            <option value="default"';
            $wpa_ict_get = get_option('wpa_ict');
            if ($wpa_ict_get == "default") {
                echo "selected";
            }
            echo '>' . __('Default', 'wp-attachments') . '</option>
                            <option value="list"';
            if ($wpa_ict_get == "list") {
                echo "selected";
            }
            echo '>' . __('List', 'wp-attachments') . '</option>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">' . __('Select Template', 'wp-attachments') . '</th>
                    <td>
                        <select name="template" id="template">
                            <option value="default"';
            $wpa_template_get = get_option('wpa_template');
            if ($wpa_template_get == "default") {
                echo "selected";
            }
            echo '>' . __('Default', 'wp-attachments') . '</option>
                            <option value="custom"';
            if ($wpa_template_get == "custom") {
                echo "selected";
            }
            echo '>' . __('Custom', 'wp-attachments') . '</option>
                        </select>
                    </td>
                </tr>
                <tr valign="top" id="wpa_template_custom_tr"';
            if ($wpa_template_get != "custom") {
                echo 'style="display:none;"';
            }
            echo '>
                    <th scope="row">' . __('Custom Template', 'wp-attachments') . '</th>
                    <td><textarea rows="15" cols="70" name="wpa_template_custom">' . get_option('wpa_template_custom') . '</textarea></td>
                </tr>
            </table>';

            break;

        default:
            break;
    }
    echo '</table>';

    submit_button(__('Save Changes'), 'primary', 'submit-general', false);

    echo '</form>';
}

add_action('admin_init', 'wpatt_plugin_options');