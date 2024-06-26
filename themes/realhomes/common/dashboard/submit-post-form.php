<?php
/**
 * This file contains the common form to add/edit agent or agency.
 *
 * @since      4.3.0
 * @package    realhomes
 * @subpackage dashboard
 */

$target_post = '';
$current_user = wp_get_current_user();
$author_id = $current_user->ID;

$edit_post_id = 0;
$is_post_editable = false;
$post_meta_data = array();
$post_data = array();

$post_type = 'agent';
if (!empty($args['post_type'])) {
    $post_type = sanitize_text_field($args['post_type']);
}

$is_agent_post = ('agent' === $post_type);

$label = esc_attr__('Agent', 'framework');
if ('agency' === $post_type) {
    $label = esc_attr__('Agency', 'framework');
}

// Check if the post is editable.
if (isset($_GET['id']) && !empty($_GET['id'])) {

    // Get the ID of the post being edited.
    $edit_post_id = intval(trim($_GET['id']));

    // Retrieve the post object for the target post.
    $target_post = get_post($edit_post_id);

    // Verify that the target post exists and is of the correct post type.
    if (!empty($target_post) && ($post_type == $target_post->post_type)) {
        // Check if agents belong to the agency (currently logged-in user)
        $user_id = get_current_user_id();
        $agencyId = get_user_meta($user_id, 'inspiry_user_agency', true);
        if ($agencyId) {
            $agentAgency = get_post_meta($edit_post_id, 'REAL_HOMES_agency', true);
            if ($agentAgency === $agencyId) {
                $is_post_editable = true;

                // Retrieve custom post metadata for further processing.
                $post_meta_data = get_post_custom($target_post->ID);
            }
        }

        // Check if the currently logged-in user is the author of the post.
        // if ($target_post->post_author == $author_id) {
        //     $is_post_editable = true;

        //     // Retrieve custom post metadata for further processing.
        //     $post_meta_data = get_post_custom($target_post->ID);
        // }
    }
}

$post_data['email'] = !empty($post_meta_data["REAL_HOMES_{$post_type}_email"][0]) ? $post_meta_data["REAL_HOMES_{$post_type}_email"][0] : '';
$post_data['website'] = !empty($post_meta_data['REAL_HOMES_website'][0]) ? $post_meta_data['REAL_HOMES_website'][0] : '';
$post_data['whatsapp'] = !empty($post_meta_data['REAL_HOMES_whatsapp_number'][0]) ? $post_meta_data['REAL_HOMES_whatsapp_number'][0] : '';
$post_data['mobile'] = !empty($post_meta_data['REAL_HOMES_mobile_number'][0]) ? $post_meta_data['REAL_HOMES_mobile_number'][0] : '';
$post_data['office'] = !empty($post_meta_data['REAL_HOMES_office_number'][0]) ? $post_meta_data['REAL_HOMES_office_number'][0] : '';
$post_data['fax'] = !empty($post_meta_data['REAL_HOMES_fax_number'][0]) ? $post_meta_data['REAL_HOMES_fax_number'][0] : '';
$post_data['address'] = !empty($post_meta_data['REAL_HOMES_address'][0]) ? $post_meta_data['REAL_HOMES_address'][0] : '';
$post_data['verification'] = !empty($post_meta_data['ere_agent_verification_status'][0]) ? $post_meta_data['ere_agent_verification_status'][0] : '';
$post_data['facebook'] = !empty($post_meta_data['REAL_HOMES_facebook_url'][0]) ? $post_meta_data['REAL_HOMES_facebook_url'][0] : '';
$post_data['twitter'] = !empty($post_meta_data['REAL_HOMES_twitter_url'][0]) ? $post_meta_data['REAL_HOMES_twitter_url'][0] : '';
$post_data['linkedin'] = !empty($post_meta_data['REAL_HOMES_linked_in_url'][0]) ? $post_meta_data['REAL_HOMES_linked_in_url'][0] : '';
$post_data['instagram'] = !empty($post_meta_data['inspiry_instagram_url'][0]) ? $post_meta_data['inspiry_instagram_url'][0] : '';
$post_data['youtube'] = !empty($post_meta_data['inspiry_youtube_url'][0]) ? $post_meta_data['inspiry_youtube_url'][0] : '';
$post_data['pinterest'] = !empty($post_meta_data['inspiry_pinterest_url'][0]) ? $post_meta_data['inspiry_pinterest_url'][0] : '';

if ($is_agent_post) {
    $post_data['license'] = !empty($post_meta_data['REAL_HOMES_license_number'][0]) ? $post_meta_data['REAL_HOMES_license_number'][0] : '';
    $post_data['agent_agency'] = !empty($post_meta_data['REAL_HOMES_agency'][0]) ? $post_meta_data['REAL_HOMES_agency'][0] : -1;
}
?>
<form id="dashboard-submit-post-form" enctype="multipart/form-data">
    <div class="dashboard-submit-post-form-inner">

        <div class="profile-image-upload-container">
            <div id="profile-image" class="profile-image">
                <?php
                $post_thumbnail_id = get_post_thumbnail_id($edit_post_id);
                if (!empty($post_thumbnail_id)) {
                    echo get_the_post_thumbnail($edit_post_id, 'agent-image');
                    printf('<input type="hidden" class="profile-image-id" name="profile-image-id" value="%s" />', esc_attr($post_thumbnail_id));
                }
                ?>
            </div>
            <div class="profile-image-controls">
                <button id="select-profile-image"
                    class="btn btn-primary"><?php esc_html_e('Upload new Picture', 'framework'); ?></button>
                <button id="remove-profile-image"
                    class="btn btn-alt"><?php esc_html_e('Delete', 'framework'); ?></button>
                <p class="description">
                    <?php esc_html_e('* Minimum required size is 210px by 210px.', 'framework'); ?>
                    <br>
                    <?php esc_html_e('* Make sure to Save Changes after uploading fresh image.', 'framework'); ?>
                </p>
                <div id="errors-log" class="errors-log"></div>
            </div>
        </div>

        <div class="form-fields">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <label for="post_title"><?php esc_html_e('Name', 'framework'); ?></label>
                        <input id="post_title" name="post_title" type="text" class="required" value="<?php
                        if ($is_post_editable) {
                            echo esc_attr($target_post->post_title);
                        }
                        ?>" title="<?php esc_attr_e('* Please provide the name.', 'framework'); ?>" autofocus
                            required />
                    </p>

                    <label for="description"><?php esc_html_e('Description', 'framework'); ?></label>
                    <?php
                    $editor_id = 'description';
                    $editor_settings = array(
                        'media_buttons' => false,
                        'textarea_rows' => 8,
                    );
                    if ($is_post_editable) {
                        wp_editor($target_post->post_content, $editor_id, $editor_settings);
                    } else {
                        wp_editor('', $editor_id, $editor_settings);
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="form-fields">
            <div class="row">
                <div class="col-lg-6 col-xl-4">
                    <p>
                        <label for="email"><?php esc_html_e('Email', 'framework'); ?> *</label>
                        <input class="required" name="email" type="email" id="email"
                            value="<?php echo esc_attr($post_data['email']); ?>"
                            title="<?php esc_attr_e('* Please provide email address.', 'framework'); ?>" required />
                    </p>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <p>
                        <label for="whatsapp-number"><?php esc_html_e('WhatsApp Number', 'framework'); ?></label>
                        <span class="input-group">
                            <i class="fab fa-whatsapp fa-lg"></i>
                            <input name="whatsapp-number" type="text" id="whatsapp-number"
                                value="<?php echo esc_attr($post_data['whatsapp']); ?>" />
                        </span>
                    </p>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <p>
                        <label for="mobile-number"><?php esc_html_e('Mobile Number', 'framework'); ?></label>
                        <input name="mobile-number" type="text" id="mobile-number"
                            value="<?php echo esc_attr($post_data['mobile']); ?>" />
                    </p>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <p>
                        <label for="office-number"><?php esc_html_e('Office Number', 'framework'); ?></label>
                        <input name="office-number" type="text" id="office-number"
                            value="<?php echo esc_attr($post_data['office']); ?>" />
                    </p>
                </div>
                <?php /*
<div class="col-lg-6 col-xl-4">
<p>
<label for="fax-number"><?php esc_html_e( 'Fax Number', 'framework' ); ?></label>
<input name="fax-number" type="text" id="fax-number" value="<?php echo esc_attr( $post_data['fax'] ); ?>" />
</p>
</div> */ ?>
                <?php
                if ($is_agent_post) {
                    ?>
                    <div class="col-lg-6 col-xl-4">
                        <p>
                            <label for="license-number"><?php esc_html_e('License Number', 'framework'); ?></label>
                            <input name="license-number" type="text" id="license-number"
                                value="<?php echo esc_attr($post_data['license']); ?>" />
                        </p>
                    </div>
                    <?php
                }
                ?>
                <?php /*
<div class="col-lg-6 col-xl-4">
<p>
<label for="website_url"><?php esc_html_e('Website', 'framework'); ?></label>
<span class="input-group">
<i class="fas fa-globe fa-lg"></i>
<input name="website_url" type="url" id="website_url"
value="<?php echo esc_url($post_data['website']); ?>"
placeholder="<?php echo esc_attr('https://'); ?>" />
</span>
</p>
</div>
<div class="col-lg-6 col-xl-8">
<p>
<label for="address"><?php esc_html_e('Address', 'framework') ?></label>
<textarea name="address" id="address" rows="1"
cols="30"><?php echo esc_textarea($post_data['address']); ?></textarea>
</p>
</div>
if ($is_agent_post) {
?>
<div class="col-lg-6 col-xl-4">
<p>
<label for="agent_agency"><?php esc_html_e('Agency', 'framework'); ?></label>
<select name="agent_agency" id="agent_agency" class="inspiry_select_picker_trigger show-tick">
<?php inspiry_dropdown_posts('agency', $post_data['agent_agency'], true); ?>
</select>
</p>
</div>
<?php
}
<div class="col-lg-6 col-xl-4">
<p>&nbsp;</p>
<p class="checkbox-field">
<input id="verification_status" name="verification_status" type="checkbox" <?php checked('1', $post_data['verification']); ?> />
<label
for="verification_status"><?php printf(esc_html__('Mark the %s as Verified.', 'framework'), $label); ?></label>
</p>
</div>*/ ?>
            </div>
        </div>

        <div class="form-fields">
            <div class="row">
                <div class="col-12">
                    <label class="label-boxed"><?php esc_html_e('Social Links', 'framework'); ?></label>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-xl-4">
                    <p>
                        <label for="facebook_url"><?php esc_html_e('Facebook URL', 'framework'); ?></label>
                        <span class="input-group">
                            <i class="fab fa-facebook fa-lg"></i>
                            <input name="facebook_url" type="url" id="facebook_url"
                                value="<?php echo esc_url($post_data['facebook']); ?>"
                                placeholder="<?php echo esc_attr('https://'); ?>" />
                        </span>
                    </p>
                </div>
                <?php /*
<div class="col-lg-6 col-xl-4">
<p>
<label for="twitter_url"><?php esc_html_e('Twitter URL', 'framework'); ?></label>
<span class="input-group">
<i class="fab fa-twitter fa-lg"></i>
<input name="twitter_url" type="url" id="twitter_url"
value="<?php echo esc_url($post_data['twitter']); ?>"
placeholder="<?php echo esc_attr('https://'); ?>" />
</span>
</p>
</div> */ ?>
                <div class="col-lg-6 col-xl-4">
                    <p>
                        <label for="linkedin_url"><?php esc_html_e('LinkedIn URL', 'framework'); ?></label>
                        <span class="input-group">
                            <i class="fab fa-linkedin fa-lg"></i>
                            <input name="linkedin_url" type="url" id="linkedin_url"
                                value="<?php echo esc_url($post_data['linkedin']); ?>"
                                placeholder="<?php echo esc_attr('https://'); ?>" />
                        </span>
                    </p>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <p>
                        <label for="instagram_url"><?php esc_html_e('Instagram URL', 'framework'); ?></label>
                        <span class="input-group">
                            <i class="fab fa-instagram fa-lg"></i>
                            <input name="instagram_url" type="url" id="instagram_url"
                                value="<?php echo esc_url($post_data['instagram']); ?>"
                                placeholder="<?php echo esc_attr('https://'); ?>" />
                        </span>
                    </p>
                </div>
                <?php /* <div class="col-lg-6 col-xl-4">
<p>
<label for="pinterest_url"><?php esc_html_e('Pinterest URL', 'framework'); ?></label>
<span class="input-group">
<i class="fab fa-pinterest fa-lg"></i>
<input name="pinterest_url" type="url" id="pinterest_url"
value="<?php echo esc_url($post_data['pinterest']); ?>"
placeholder="<?php echo esc_attr('https://'); ?>" />
</span>
</p>
</div>
<div class="col-lg-6 col-xl-4">
<p>
<label for="youtube_url"><?php esc_html_e('YouTube URL', 'framework'); ?></label>
<span class="input-group">
<i class="fab fa-youtube fa-lg"></i>
<input name="youtube_url" type="url" id="youtube_url"
value="<?php echo esc_url($post_data['youtube']); ?>"
placeholder="<?php echo esc_attr('https://'); ?>" />
</span>
</p>
</div> */ ?>
            </div>
        </div>

    </div><!-- .dashboard-submit-form-inner -->

    <div id="dashboard-submit-post-form-actions" class="dashboard-form-actions dashboard-submit-post-form-actions">
        <?php
        // WordPress Nonce for Security Check.
        wp_nonce_field('submit_agent_agency', 'submit_post_nonce');

        $action_type = 'add_post';
        $button_label = sprintf(esc_attr__('Submit %s', 'framework'), $label);
        if ($is_post_editable) {
            $action_type = 'update_post';
            $button_label = sprintf(esc_attr__('Update %s', 'framework'), $label);
            ?>
            <input type="hidden" name="<?php echo esc_attr($post_type); ?>_id"
                value="<?php echo esc_attr($target_post->ID); ?>" />
            <button type="button" id="cancel"
                class="cancel btn btn-secondary"><?php esc_html_e('Cancel', 'framework') ?></button>
            <?php
        }
        ?>
        <input type="hidden" name="action" value="submit_agent_agency" />
        <input type="hidden" name="action_type" value="<?php echo esc_attr($action_type); ?>" />
        <input type="hidden" name="post_type" value="<?php echo esc_attr($post_type); ?>" />
        <input type="submit" id="submit-post-button" value="<?php echo esc_attr__($button_label); ?>"
            class="btn btn-primary submit-post-button" />
    </div><!-- .dashboard-form-actions -->
</form>