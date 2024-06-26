<?php
/**
 * File: Users
 *
 * Package: ERE - Settings
 *
 * This file container settings related users including user roles and their capabilities
 *
 * @since 2.2.0
 */


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$ere_allow_users_change_role      = $this->get_option( 'ere_allow_users_change_role', 'false' );
$user_roles                       = array( 'agent', 'agency', 'owner', 'buyer', 'seller', 'developer' );
$ere_allowed_user_roles           = get_option( 'ere_allowed_user_roles', [ 'agent' => true, 'agency' => true ] );
$user_role_options                = get_option( 'ere_user_role_options', [] );
$ere_user_sync                    = get_option( 'inspiry_user_sync', 'false' );
$ere_user_sync_avatar_fallback    = get_option( 'inspiry_user_sync_avatar_fallback', 'true' );
$ere_wp_default_user_roles_status = get_option( 'ere_wp_default_user_roles_status', 'true' );
$ere_auto_user_agent_assignment   = get_option( 'realhomes_auto_user_agent_assignment', 'none' );

// Checking if request source is safe so that we can update the option
if ( isset( $_POST['_wpnonce'] ) && wp_verify_nonce( $_POST['_wpnonce'], 'inspiry_ere_settings' ) ) {

	// Setting allowed user roles if posted
	if ( isset( $_POST['allowed_user_roles'] ) && is_array( $_POST['allowed_user_roles'] ) ) {
		$ere_allowed_user_roles = $_POST['allowed_user_roles'];
	}

	// Setting user role options if posted
	if ( isset( $_POST['user_role_options'] ) && is_array( $_POST['user_role_options'] ) ) {
		$user_role_options = $_POST['user_role_options'];
	}

	// Setting user role and post type (agent/agency) sync option
	if ( isset( $_POST['ere_role_post_type_sync'] ) ) {
		$ere_user_sync = $_POST['ere_role_post_type_sync'];
	}

	// Setting user sync avatar fallback option
	if ( isset( $_POST['ere_users_sync_avatar_fallback'] ) ) {
		$ere_user_sync_avatar_fallback = $_POST['ere_users_sync_avatar_fallback'];
	}

	// Setting default user role settings display status
	if ( isset( $_POST['ere_wp_default_user_roles_status'] ) ) {
		$ere_wp_default_user_roles_status = $_POST['ere_wp_default_user_roles_status'];
	}

	// Setting user sync avatar fallback option
	if ( isset( $_POST['ere_auto_user_agent_assignment'] ) ) {
		$ere_auto_user_agent_assignment = $_POST['ere_auto_user_agent_assignment'];
	}

	// Saving user options.
	update_option( 'ere_allow_users_change_role', $ere_allow_users_change_role );
	update_option( 'ere_allowed_user_roles', $ere_allowed_user_roles );
	update_option( 'ere_user_role_options', $user_role_options );
	update_option( 'inspiry_user_sync', $ere_user_sync );
	update_option( 'inspiry_user_sync_avatar_fallback', $ere_user_sync_avatar_fallback );
	update_option( 'ere_wp_default_user_roles_status', $ere_wp_default_user_roles_status );
	update_option( 'realhomes_auto_user_agent_assignment', $ere_auto_user_agent_assignment );
}

// Checking if request source is safe so that we can update user approval options
if ( isset( $_POST['user_approval_settings_nonce'] ) && wp_verify_nonce( $_POST['user_approval_settings_nonce'], 'ere_user_approval_nonce' ) ) {

	// Setting default user approval status
	if ( isset( $_POST['ere_new_user_approval_status'] ) ) {
		update_option( 'ere_registered_user_default_status', $_POST['ere_new_user_approval_status'] );
	}

	// Setting default user approval status
	if ( isset( $_POST['ere_pending_users_error_statement'] ) ) {
		update_option( 'ere_pending_users_error_statement', $_POST['ere_pending_users_error_statement'] );
	}

	// Setting default user approval status
	if ( isset( $_POST['ere_denied_users_error_statement'] ) ) {
		update_option( 'ere_denied_users_error_statement', $_POST['ere_denied_users_error_statement'] );
	}

	$this->notice();

}

// We are already sure that $user_roles is an array
foreach ( $user_roles as $role ) {
	if ( is_array( $ere_allowed_user_roles ) && array_key_exists( $role, $ere_allowed_user_roles ) ) {
		$allowed_user_roles[ $role ] = true;
	} else {
		$allowed_user_roles[ $role ] = false;
	}
}
?>
<div class="inspiry-ere-page-content ere-user-options-wrap">

    <div class="user-roles-management main-settings-section">
        <h3 class="main-head active"><?php esc_html_e( 'User Roles Management', 'easy-real-estate' ); ?></h3>
        <div class="user-role-options active">
            <form method="post" novalidate="novalidate">
                <div class="main-options-wrap">
                    <div class="left">
                        <h4><?php esc_html_e( 'Enable/Disable User Roles', 'easy-real-estate' ); ?></h4>
                    </div>
                    <div class="right">
                        <legend class="screen-reader-text">
                            <span><?php esc_html_e( 'Enable/Disable User Roles', 'easy-real-estate' ); ?></span>
                        </legend>
                        <ul class="inner-options user-roles">
                            <li>
                                <p class="fancy-checkbox-option">
                                    <input type="checkbox" id="allowed_user_roles_agent" name="allowed_user_roles[agent]" value="true" <?php echo checked( $allowed_user_roles['agent'], true ) ?>>
                                    <label class="button-primary" for="allowed_user_roles_agent"><i class="check-sign">&#10003;</i> <?php esc_html_e( 'Agent', 'easy-real-estate' ); ?></label>
                                </p>
                            </li>
                            <li>
                                <p class="fancy-checkbox-option">
                                    <input type="checkbox" id="allowed_user_roles_agency" name="allowed_user_roles[agency]" value="true" <?php echo checked( $allowed_user_roles['agency'], true ) ?>>
                                    <label class="button-primary" for="allowed_user_roles_agency"><i class="check-sign">&#10003;</i> <?php esc_html_e( 'Agency', 'easy-real-estate' ); ?></label>
                                </p>
                            </li>
                            <li>
                                <p class="fancy-checkbox-option">
                                    <input type="checkbox" id="allowed_user_roles_owner" name="allowed_user_roles[owner]" value="true" <?php echo checked( $allowed_user_roles['owner'], true ) ?>>
                                    <label class="button-primary" for="allowed_user_roles_owner"><i class="check-sign">&#10003;</i> <?php esc_html_e( 'Owner', 'easy-real-estate' ); ?></label>
                                </p>
                            </li>
                            <li>
                                <p class="fancy-checkbox-option">
                                    <input type="checkbox" id="allowed_user_roles_developer" name="allowed_user_roles[developer]" value="true" <?php checked( $allowed_user_roles['developer'], true ) ?>>
                                    <label class="button-primary" for="allowed_user_roles_developer"><i class="check-sign">&#10003;</i> <?php esc_html_e( 'Developer', 'easy-real-estate' ); ?></label>
                                </p>
                            </li>
                            <li>
                                <p class="fancy-checkbox-option">
                                    <input type="checkbox" id="allowed_user_roles_buyer" name="allowed_user_roles[buyer]" value="true" <?php echo checked( $allowed_user_roles['buyer'], true ) ?>>
                                    <label class="button-primary" for="allowed_user_roles_buyer"><i class="check-sign">&#10003;</i> <?php esc_html_e( 'Buyer', 'easy-real-estate' ); ?></label>
                                </p>
                            </li>
                            <li>
                                <p class="fancy-checkbox-option">
                                    <input type="checkbox" id="allowed_user_roles_seller" name="allowed_user_roles[seller]" value="true" <?php echo checked( $allowed_user_roles['seller'], true ) ?>>
                                    <label class="button-primary" for="allowed_user_roles_seller"><i class="check-sign">&#10003;</i> <?php esc_html_e( 'Seller', 'easy-real-estate' ); ?></label>
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="main-options-wrap">
                    <div class="left">
                        <h4><?php esc_html_e( 'Show user role option in profile', 'easy-real-estate' ); ?></h4>
                        <legend class="screen-reader-text">
                            <span><?php esc_html_e( 'Show user role option in profile.', 'easy-real-estate' ); ?></span>
                        </legend>
                    </div>
                    <div class="right">
                        <p class="fancy-radio-option">
                            <span class="allow">
                                <input type="radio" id="ere_users_change_role_allow" name="ere_allow_users_change_role" value="true" <?php checked( $ere_allow_users_change_role, 'true' ) ?>>
                                <label class="button-primary" for="ere_users_change_role_allow"><?php esc_html_e( 'Allow', 'easy-real-estate' ); ?></label>
                            </span>
                            <span class="deny">
                                <input type="radio" id="ere_users_change_role_deny" name="ere_allow_users_change_role" value="false" <?php checked( $ere_allow_users_change_role, 'false' ) ?>>
                                <label class="button-primary" for="ere_users_change_role_deny"><?php esc_html_e( 'Deny', 'easy-real-estate' ); ?></label>
                            </span>
                        </p>
                    </div>
                </div>

                <!-- Option moved from customizer @since 2.2.0 -->
                <div class="main-options-wrap">
                    <div class="left">
                        <h4><?php esc_html_e( 'Enable User Synchronisation with Agent/Agency', 'easy-real-estate' ); ?></h4>
                        <legend class="screen-reader-text">
                            <span><?php esc_html_e( 'Enable User Synchronisation with Agent/Agency', 'easy-real-estate' ); ?></span>
                        </legend>
                    </div>
                    <div class="right">
                        <p class="fancy-radio-option">
                            <span class="allow">
                                <input type="radio" id="ere_users_sync_allow" name="ere_role_post_type_sync" value="true" <?php checked( $ere_user_sync, 'true' ) ?>>
                                <label class="button-primary" for="ere_users_sync_allow"><?php esc_html_e( 'Allow', 'easy-real-estate' ); ?></label>
                            </span>
                            <span class="deny">
                                <input type="radio" id="ere_users_sync_deny" name="ere_role_post_type_sync" value="false" <?php checked( $ere_user_sync, 'false' ) ?>>
                                <label class="button-primary" for="ere_users_sync_deny"><?php esc_html_e( 'Deny', 'easy-real-estate' ); ?></label>
                            </span>
                        </p>
                    </div>
                </div>

                <!-- Option moved from customizer @since 2.2.0 -->
                <div class="main-options-wrap">
                    <div class="left">
                        <h4><?php esc_html_e( 'Enable Avatar as fallback for Agent/Agency/User-Profile Image', 'easy-real-estate' ); ?></h4>
                        <legend class="screen-reader-text">
                            <span><?php esc_html_e( 'Enable Avatar as fallback for Agent/Agency/User-Profile Image', 'easy-real-estate' ); ?></span>
                        </legend>
                    </div>
                    <div class="right">
                        <p class="fancy-radio-option">
                            <span class="allow">
                                <input type="radio" id="ere_users_sync_avatar_fallback_allow" name="ere_users_sync_avatar_fallback" value="true" <?php checked( $ere_user_sync_avatar_fallback, 'true' ) ?>>
                                <label class="button-primary" for="ere_users_sync_avatar_fallback_allow"><?php esc_html_e( 'Allow', 'easy-real-estate' ); ?></label>
                            </span>
                            <span class="deny">
                                <input type="radio" id="ere_users_sync_avatar_fallback_deny" name="ere_users_sync_avatar_fallback" value="false" <?php checked( $ere_user_sync_avatar_fallback, 'false' ) ?>>
                                <label class="button-primary" for="ere_users_sync_avatar_fallback_deny"><?php esc_html_e( 'Deny', 'easy-real-estate' ); ?></label>
                            </span>
                        </p>
                    </div>
                </div>

                <!-- Option moved from customizer @since 2.2.0 -->
                <div class="main-options-wrap">
                    <div class="left">
                        <h4><?php esc_html_e( 'Control auto assignment of user/agent if related section is disabled', 'easy-real-estate' ); ?></h4>
                        <legend class="screen-reader-text">
                            <span><?php esc_html_e( 'Control auto assignment of user/agent if related section is disabled', 'easy-real-estate' ); ?></span>
                        </legend>
                        <p class="desc"><?php esc_html_e( 'If agent is selected, but user agent sync is not enabled then user will be assigned instead. Display option will be similar to this setting as well.', 'easy-real-estate' ); ?></p>
                    </div>
                    <div class="right">
                        <p class="fancy-radio-option">
                            <span class="allow">
                                <input type="radio" id="ere_auto_user_agent_assignment_none" name="ere_auto_user_agent_assignment" value="none" <?php checked( $ere_auto_user_agent_assignment, 'none' ) ?>>
                                <label class="button-primary" for="ere_auto_user_agent_assignment_none"><?php esc_html_e( 'None', 'easy-real-estate' ); ?></label>
                            </span>
                            <span class="deny">
                                <input type="radio" id="ere_auto_user_agent_assignment_user" name="ere_auto_user_agent_assignment" value="user" <?php checked( $ere_auto_user_agent_assignment, 'user' ) ?>>
                                <label class="button-primary" for="ere_auto_user_agent_assignment_user"><?php esc_html_e( 'User', 'easy-real-estate' ); ?></label>
                            </span>
                            <span class="deny">
                                <input type="radio" id="ere_auto_user_agent_assignment_agent" name="ere_auto_user_agent_assignment" value="agent" <?php checked( $ere_auto_user_agent_assignment, 'agent' ) ?>>
                                <label class="button-primary" for="ere_auto_user_agent_assignment_agent"><?php esc_html_e( 'Agent', 'easy-real-estate' ); ?></label>
                            </span>
                        </p>
                    </div>
                </div>

                <!-- Show/Hide WordPress default user roles to manage -->
                <div class="main-options-wrap">
                    <div class="left">
                        <h4><?php esc_html_e( 'Show WordPress default user roles to manage', 'easy-real-estate' ); ?></h4>
                        <legend class="screen-reader-text">
                            <span><?php esc_html_e( 'Show WordPress default user roles to manage', 'easy-real-estate' ); ?></span>
                        </legend>
                        <p class="desc"><?php esc_html_e( 'If you want to manage default user roles provided by WordPress, similar to the theme managed ones, then you need to allow this option.', 'easy-real-estate' ); ?></p>
                    </div>
                    <div class="right">
                        <p class="fancy-radio-option">
                            <span class="allow">
                                <input type="radio" id="ere_wp_default_user_roles_show" name="ere_wp_default_user_roles_status" value="true" <?php checked( $ere_wp_default_user_roles_status, 'true' ) ?>>
                                <label class="button-primary" for="ere_wp_default_user_roles_show"><?php esc_html_e( 'Allow', 'easy-real-estate' ); ?></label>
                            </span>
                            <span class="deny">
                                <input type="radio" id="ere_wp_default_user_roles_hide" name="ere_wp_default_user_roles_status" value="false" <?php checked( $ere_wp_default_user_roles_status, 'false' ) ?>>
                                <label class="button-primary" for="ere_wp_default_user_roles_hide"><?php esc_html_e( 'Deny', 'easy-real-estate' ); ?></label>
                            </span>
                        </p>
                    </div>
                </div>

                <hr>
                <br>
				<?php
                $user_roles = inspiry_user_sync_roles();
				/*
                 * Default settings if not assigned manually
                 * Shorthand:   manage_profile: mp, user_agency: ua, manage_searches: ms, manage_favorites: mf,
                 *              check_invoices: ci, property_submit: ps, manage_listings: ml, manage_agents: ma
                 *              membership: mem, analytics: anl
                 */
				$role_defaults = array(
					'agent'     => array( 'mp' => true, 'ua' => true, 'ms' => true, 'mf' => true, 'ci' => true, 'ps' => true, 'ml' => true, 'ma' => false, 'mem' => true, 'anl'=> false ),
					'agency'    => array( 'mp' => true, 'ua' => true, 'ms' => true, 'mf' => true, 'ci' => true, 'ps' => true, 'ml' => true, 'ma' => true, 'mem' => true, 'anl'=> false ),
					'owner'     => array( 'mp' => true, 'ua' => false, 'ms' => true, 'mf' => true, 'ci' => false, 'ps' => true, 'ml' => false, 'ma' => false, 'mem' => true, 'anl'=> false ),
					'buyer'     => array( 'mp' => true, 'ua' => false, 'ms' => true, 'mf' => true, 'ci' => false, 'ps' => false, 'ml' => false, 'ma' => false, 'mem' => false, 'anl'=> false ),
					'seller'    => array( 'mp' => true, 'ua' => false, 'ms' => true, 'mf' => true, 'ci' => false, 'ps' => false, 'ml' => false, 'ma' => false, 'mem' => false, 'anl'=> false ),
					'developer' => array( 'mp' => true, 'ua' => false, 'ms' => true, 'mf' => true, 'ci' => false, 'ps' => false, 'ml' => false, 'ma' => false, 'mem' => true, 'anl'=> false )
				);

                // If default roles are enabled to be handled from here
                if ( $ere_wp_default_user_roles_status === 'true' ) {
                    $default_roles = array(
	                    'editor'      => 'Editor',
	                    'author'      => 'Author',
	                    'contributor' => 'Contributor',
	                    'subscriber'  => 'Subscriber'
                    );
	                $user_roles = array_merge( $user_roles, $default_roles );

	                $role_defaults['editor'] = array( 'mp' => true, 'ua' => false, 'ms' => true, 'mf' => true, 'ci' => false, 'ps' => true, 'ml' => false, 'ma' => false, 'mem' => false, 'anl'=> false );
	                $role_defaults['author'] = array( 'mp' => true, 'ua' => false, 'ms' => true, 'mf' => true, 'ci' => false, 'ps' => true, 'ml' => false, 'ma' => false, 'mem' => false, 'anl'=> false );
	                $role_defaults['contributor'] = array( 'mp' => true, 'ua' => false, 'ms' => true, 'mf' => true, 'ci' => false, 'ps' => true, 'ml' => false, 'ma' => false, 'mem' => false, 'anl'=> false );
	                $role_defaults['subscriber'] = array( 'mp' => true, 'ua' => false, 'ms' => true, 'mf' => true, 'ci' => false, 'ps' => false, 'ml' => false, 'ma' => false, 'mem' => false, 'anl'=> false );
                }

				if ( is_array( $user_roles ) && 0 < $user_roles ) {
					$selected_tab = '';
                    if (
                        isset( $_POST['user_role_settings_tab'] )
                        && (
                            ( isset( $allowed_user_roles[$_POST['user_role_settings_tab']] ) && $allowed_user_roles[$_POST['user_role_settings_tab']] === true )
                            || ( $ere_wp_default_user_roles_status === 'true' && array_key_exists( $_POST['user_role_settings_tab'], $default_roles ) )
                        )
                    ) {
	                    $selected_tab = $_POST['user_role_settings_tab'];
                    }
					$first_tab = true;
					?>
                    <div class="user-role-tabs ere-option-tabs clearfix">
						<?php
						foreach ( $user_roles as $role => $state ) {
							if ( function_exists( 'realhomes_get_current_user_role_option' ) && ! empty( realhomes_get_current_user_role_option('label', $role ) ) ) {
								$role_string = ucfirst( realhomes_get_current_user_role_option('label', $role ) );
							}

							if ( empty( $role_string ) ) {
								$role_string = ucfirst( $role );
							}
							?>
                            <label for="ere-role-tab-<?php echo esc_attr( $role ); ?>" class="<?php echo ( empty( $selected_tab ) && $first_tab ? 'current' : ( $role === $selected_tab ) ) ? 'current' : ''; ?>">
								<?php echo esc_html( $role_string ); ?>
                                <input type="radio" id="ere-role-tab-<?php echo esc_attr( $role ); ?>" name="user_role_settings_tab" value="<?php echo esc_attr( $role ); ?>">
                            </label>
							<?php
							$first_tab = false;
						}
						?>
                    </div>

                    <div class="role-settings-wrapper ere-options-wrap">
						<?php
						// Need it to manage tabs initial display
						$first_setting = true;

						// We know that $user_roles is array so no need to check it
						foreach ( $user_roles as $role => $state ) {

							// Beautifying user role name
							$role_string = ucfirst( $role );

							// Getting state of current options
							$role_label         = isset( $user_role_options[ $role ]['label'] ) ? $user_role_options[ $role ]['label'] : $role;
							$manage_profile     = isset( $user_role_options[ $role ]['manage_profile'] ) ? filter_var( $user_role_options[ $role ]['manage_profile'], FILTER_VALIDATE_BOOLEAN ) : $role_defaults[ $role ]['mp'];
							$user_agency        = isset( $user_role_options[ $role ]['user_agency'] ) ? filter_var( $user_role_options[ $role ]['user_agency'], FILTER_VALIDATE_BOOLEAN ) : $role_defaults[ $role ]['ua'];
							$manage_searches    = isset( $user_role_options[ $role ]['manage_searches'] ) ? filter_var( $user_role_options[ $role ]['manage_searches'], FILTER_VALIDATE_BOOLEAN ) : $role_defaults[ $role ]['ms'];
							$manage_favorites   = isset( $user_role_options[ $role ]['manage_favorites'] ) ? filter_var( $user_role_options[ $role ]['manage_favorites'], FILTER_VALIDATE_BOOLEAN ) : $role_defaults[ $role ]['mf'];
							$property_submit    = isset( $user_role_options[ $role ]['property_submit'] ) ? filter_var( $user_role_options[ $role ]['property_submit'], FILTER_VALIDATE_BOOLEAN ) : $role_defaults[ $role ]['ps'];
							$manage_listings    = isset( $user_role_options[ $role ]['manage_listings'] ) ? filter_var( $user_role_options[ $role ]['manage_listings'], FILTER_VALIDATE_BOOLEAN ) : $role_defaults[ $role ]['ml'];
							$manage_agents      = isset( $user_role_options[ $role ]['manage_agents'] ) ? filter_var( $user_role_options[ $role ]['manage_agents'], FILTER_VALIDATE_BOOLEAN ) : $role_defaults[ $role ]['ma'];
							$check_invoices     = isset( $user_role_options[ $role ]['check_invoices'] ) ? filter_var( $user_role_options[ $role ]['check_invoices'], FILTER_VALIDATE_BOOLEAN ) : $role_defaults[ $role ]['ci'];
							$memberships        = isset( $user_role_options[ $role ]['memberships'] ) ? filter_var( $user_role_options[ $role ]['memberships'], FILTER_VALIDATE_BOOLEAN ) : $role_defaults[ $role ]['mem'];
							$property_analytics = isset( $user_role_options[ $role ]['property_analytics'] ) ? filter_var( $user_role_options[ $role ]['property_analytics'], FILTER_VALIDATE_BOOLEAN ) : $role_defaults[ $role ]['anl'];
							?>
                            <div class="role-setting-wrap settings-<?php echo esc_attr( $role ); ?> <?php echo ( empty( $selected_tab ) && $first_setting ? 'current' : $role === $selected_tab ) ? 'current' : ''; ?>">
                                <ul class="role-capabilities-list">
                                    <li class="full">
                                        <div class="option-head">
                                            <h4><?php esc_html_e( 'Change role label', 'easy-real-estate' ); ?></h4>
                                            <p class="desc"><?php esc_html_e( 'Change default role label to your required one.', 'easy-real-estate' ); ?></p>
                                        </div>
                                        <div class="option-body">
                                            <label>
                                                <input type="text" name="user_role_options[<?php echo esc_attr( $role ); ?>][label]" value="<?php echo esc_attr( $role_label ); ?>">
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="option-head">
                                            <h4><?php esc_html_e( 'Manage Profile', 'easy-real-estate' ); ?></h4>
                                            <p class="desc"><?php esc_html_e( 'Allow users with this role to manage their profiles', 'easy-real-estate' ); ?></p>
                                        </div>
                                        <div class="option-body">
                                            <p class="fancy-radio-option">
                                                <span class="allow">
                                                    <input type="radio" id="ere_<?php echo esc_attr( $role ); ?>_option_mp_allow" name="user_role_options[<?php echo esc_attr( $role ); ?>][manage_profile]" value="true" <?php checked( $manage_profile, true ) ?>>
                                                    <label class="button-primary" for="ere_<?php echo esc_attr( $role ); ?>_option_mp_allow"><?php esc_html_e( 'Allow', 'easy-real-estate' ); ?></label>
                                                </span>
                                                <span class="deny">
                                                    <input type="radio" id="ere_<?php echo esc_attr( $role ); ?>_option_mp_deny" name="user_role_options[<?php echo esc_attr( $role ); ?>][manage_profile]" value="false" <?php checked( $manage_profile, false ) ?>>
                                                    <label class="button-primary" for="ere_<?php echo esc_attr( $role ); ?>_option_mp_deny"><?php esc_html_e( 'Deny', 'easy-real-estate' ); ?></label>
                                                </span>
                                            </p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="option-head">
                                            <h4><?php esc_html_e( 'Select Agency', 'easy-real-estate' ); ?></h4>
                                            <p class="desc"><?php esc_html_e( 'Allow users with this role to select or change their agency.', 'easy-real-estate' ); ?></p>
                                        </div>
                                        <div class="option-body">
                                            <p class="fancy-radio-option">
                                                <span class="allow">
                                                    <input type="radio" id="ere_<?php echo esc_attr( $role ); ?>_option_ua_allow" name="user_role_options[<?php echo esc_attr( $role ); ?>][user_agency]" value="true" <?php checked( $user_agency, true ) ?>>
                                                    <label class="button-primary" for="ere_<?php echo esc_attr( $role ); ?>_option_ua_allow"><?php esc_html_e( 'Allow', 'easy-real-estate' ); ?></label>
                                                </span>
                                                <span class="deny">
                                                    <input type="radio" id="ere_<?php echo esc_attr( $role ); ?>_option_ua_deny" name="user_role_options[<?php echo esc_attr( $role ); ?>][user_agency]" value="false" <?php checked( $user_agency, false ) ?>>
                                                    <label class="button-primary" for="ere_<?php echo esc_attr( $role ); ?>_option_ua_deny"><?php esc_html_e( 'Deny', 'easy-real-estate' ); ?></label>
                                                </span>
                                            </p>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="option-head">
                                            <h4><?php esc_html_e( 'Save Searches', 'easy-real-estate' ); ?></h4>
                                            <p class="desc"><?php esc_html_e( 'Allow users with this role to save/manage searches.', 'easy-real-estate' ); ?></p>
                                        </div>
                                        <div class="option-body">
                                            <p class="fancy-radio-option">
                                                <span class="allow">
                                                    <input type="radio" id="ere_<?php echo esc_attr( $role ); ?>_option_ms_allow" name="user_role_options[<?php echo esc_attr( $role ); ?>][manage_searches]" value="true" <?php checked( $manage_searches, true ) ?>>
                                                    <label class="button-primary" for="ere_<?php echo esc_attr( $role ); ?>_option_ms_allow"><?php esc_html_e( 'Allow', 'easy-real-estate' ); ?></label>
                                                </span>
                                                <span class="deny">
                                                    <input type="radio" id="ere_<?php echo esc_attr( $role ); ?>_option_ms_deny" name="user_role_options[<?php echo esc_attr( $role ); ?>][manage_searches]" value="false" <?php checked( $manage_searches, false ) ?>>
                                                    <label class="button-primary" for="ere_<?php echo esc_attr( $role ); ?>_option_ms_deny"><?php esc_html_e( 'Deny', 'easy-real-estate' ); ?></label>
                                                </span>
                                            </p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="option-head">
                                            <h4><?php esc_html_e( 'Save Favorites', 'easy-real-estate' ); ?></h4>
                                            <p class="desc"><?php esc_html_e( 'Allow users with this role to save/manage favorites.', 'easy-real-estate' ); ?></p>
                                        </div>
                                        <div class="option-body">
                                            <p class="fancy-radio-option">
                                                <span class="allow">
                                                    <input type="radio" id="ere_<?php echo esc_attr( $role ); ?>_option_mf_allow" name="user_role_options[<?php echo esc_attr( $role ); ?>][manage_favorites]" value="true" <?php checked( $manage_favorites ) ?>>
                                                    <label class="button-primary" for="ere_<?php echo esc_attr( $role ); ?>_option_mf_allow"><?php esc_html_e( 'Allow', 'easy-real-estate' ); ?></label>
                                                </span>
                                                <span class="deny">
                                                    <input type="radio" id="ere_<?php echo esc_attr( $role ); ?>_option_mf_deny" name="user_role_options[<?php echo esc_attr( $role ); ?>][manage_favorites]" value="false" <?php checked( $manage_favorites, false ) ?>>
                                                    <label class="button-primary" for="ere_<?php echo esc_attr( $role ); ?>_option_mf_deny"><?php esc_html_e( 'Deny', 'easy-real-estate' ); ?></label>
                                                </span>
                                            </p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="option-head">
                                            <h4><?php esc_html_e( 'Submit Listings', 'easy-real-estate' ); ?></h4>
                                            <p class="desc"><?php esc_html_e( 'Allowing this will make properties of this user role visible to himself in the dashboard as well.', 'easy-real-estate' ); ?></p>
                                        </div>
                                        <div class="option-body">
                                            <p class="fancy-radio-option">
                                                <span class="allow">
                                                    <input type="radio" id="ere_<?php echo esc_attr( $role ); ?>_option_ps_allow" name="user_role_options[<?php echo esc_attr( $role ); ?>][property_submit]" value="true" <?php checked( $property_submit ) ?>>
                                                    <label class="button-primary" for="ere_<?php echo esc_attr( $role ); ?>_option_ps_allow"><?php esc_html_e( 'Allow', 'easy-real-estate' ); ?></label>
                                                </span>
                                                <span class="deny">
                                                    <input type="radio" id="ere_<?php echo esc_attr( $role ); ?>_option_ps_deny" name="user_role_options[<?php echo esc_attr( $role ); ?>][property_submit]" value="false" <?php checked( $property_submit, false ) ?>>
                                                    <label class="button-primary" for="ere_<?php echo esc_attr( $role ); ?>_option_ps_deny"><?php esc_html_e( 'Deny', 'easy-real-estate' ); ?></label>
                                                </span>
                                            </p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="option-head">
                                            <h4><?php esc_html_e( 'Manage Listings', 'easy-real-estate' ); ?></h4>
                                            <p class="desc"><?php esc_html_e( 'Allow users with this role to edit or delete their own listings.', 'easy-real-estate' ); ?></p>
                                        </div>
                                        <div class="option-body">
                                            <p class="fancy-radio-option">
                                                <span class="allow">
                                                    <input type="radio" id="ere_<?php echo esc_attr( $role ); ?>_option_ml_allow" name="user_role_options[<?php echo esc_attr( $role ); ?>][manage_listings]" value="true" <?php checked( $manage_listings ) ?>>
                                                    <label class="button-primary" for="ere_<?php echo esc_attr( $role ); ?>_option_ml_allow"><?php esc_html_e( 'Allow', 'easy-real-estate' ); ?></label>
                                                </span>
                                                <span class="deny">
                                                    <input type="radio" id="ere_<?php echo esc_attr( $role ); ?>_option_ml_deny" name="user_role_options[<?php echo esc_attr( $role ); ?>][manage_listings]" value="false" <?php checked( $manage_listings, false ) ?>>
                                                    <label class="button-primary" for="ere_<?php echo esc_attr( $role ); ?>_option_ml_deny"><?php esc_html_e( 'Deny', 'easy-real-estate' ); ?></label>
                                                </span>
                                            </p>
                                        </div>
                                    </li>
									<?php
									if ( inspiry_is_rvr_enabled() ) {
										?>
                                        <li>
                                            <div class="option-head">
                                                <h4><?php esc_html_e( 'Check Invoices', 'easy-real-estate' ); ?></h4>
                                                <p class="desc"><?php esc_html_e( 'Allow users with this role to check current invoices.', 'easy-real-estate' ); ?></p>
                                            </div>
                                            <div class="option-body">
                                                <p class="fancy-radio-option">
                                                    <span class="allow">
                                                        <input type="radio" id="ere_<?php echo esc_attr( $role ); ?>_option_ci_allow" name="user_role_options[<?php echo esc_attr( $role ); ?>][check_invoices]" value="true" <?php checked( $check_invoices ) ?>>
                                                        <label class="button-primary" for="ere_<?php echo esc_attr( $role ); ?>_option_ci_allow"><?php esc_html_e( 'Allow', 'easy-real-estate' ); ?></label>
                                                    </span>
                                                    <span class="deny">
                                                        <input type="radio" id="ere_<?php echo esc_attr( $role ); ?>_option_ci_deny" name="user_role_options[<?php echo esc_attr( $role ); ?>][check_invoices]" value="false" <?php checked( $check_invoices, false ) ?>>
                                                        <label class="button-primary" for="ere_<?php echo esc_attr( $role ); ?>_option_ci_deny"><?php esc_html_e( 'Deny', 'easy-real-estate' ); ?></label>
                                                    </span>
                                                </p>
                                            </div>
                                        </li>
										<?php
									}

									// TODO: Totally temporary check untill we add agent submission and management sections to dashboard
									$agent_option_available = false;
									if ( $agent_option_available == true ) {
										?>
                                        <li>
                                            <div class="option-head">
                                                <h4><?php esc_html_e( 'Manage Agents', 'easy-real-estate' ); ?></h4>
                                                <p class="desc"><?php esc_html_e( 'Allow users with this role to manage agents.', 'easy-real-estate' ); ?></p>
                                            </div>
                                            <div class="option-body">
                                                <p class="fancy-radio-option">
                                                    <span class="allow">
                                                        <input type="radio" id="ere_<?php echo esc_attr( $role ); ?>_option_ma_allow" name="user_role_options[<?php echo esc_attr( $role ); ?>][manage_agents]" value="true" <?php checked( $manage_agents ) ?>>
                                                        <label class="button-primary" for="ere_<?php echo esc_attr( $role ); ?>_option_ma_allow"><?php esc_html_e( 'Allow', 'easy-real-estate' ); ?></label>
                                                    </span>
                                                    <span class="deny">
                                                        <input type="radio" id="ere_<?php echo esc_attr( $role ); ?>_option_ma_deny" name="user_role_options[<?php echo esc_attr( $role ); ?>][manage_agents]" value="false" <?php checked( $manage_agents, false ) ?>>
                                                        <label class="button-primary" for="ere_<?php echo esc_attr( $role ); ?>_option_ma_deny"><?php esc_html_e( 'Deny', 'easy-real-estate' ); ?></label>
                                                    </span>
                                                </p>
                                            </div>
                                        </li>
										<?php
									}

									if ( inspiry_is_membership_enabled() ) {
										?>
                                        <li>
                                            <div class="option-head">
                                                <h4><?php esc_html_e( 'Memberships', 'easy-real-estate' ); ?></h4>
                                                <p class="desc"><?php esc_html_e( 'Allow users with this role to see and subscribe membership packages to submit their listings.', 'easy-real-estate' ); ?></p>
                                            </div>
                                            <div class="option-body">
                                                <p class="fancy-radio-option">
                                                    <span class="allow">
                                                        <input type="radio" id="ere_<?php echo esc_attr( $role ); ?>_option_mem_allow" name="user_role_options[<?php echo esc_attr( $role ); ?>][memberships]" value="true" <?php checked( $memberships ) ?>>
                                                        <label class="button-primary" for="ere_<?php echo esc_attr( $role ); ?>_option_mem_allow"><?php esc_html_e( 'Allow', 'easy-real-estate' ); ?></label>
                                                    </span>
                                                    <span class="deny">
                                                        <input type="radio" id="ere_<?php echo esc_attr( $role ); ?>_option_mem_deny" name="user_role_options[<?php echo esc_attr( $role ); ?>][memberships]" value="false" <?php checked( $memberships, false ) ?>>
                                                        <label class="button-primary" for="ere_<?php echo esc_attr( $role ); ?>_option_mem_deny"><?php esc_html_e( 'Deny', 'easy-real-estate' ); ?></label>
                                                    </span>
                                                </p>
                                            </div>
                                        </li>
										<?php
									}
									?>
                                    <li>
                                        <div class="option-head">
                                            <h4><?php esc_html_e( 'Property Analytics', 'easy-real-estate' ); ?></h4>
                                            <p class="desc"><?php esc_html_e( 'Allow users with this role to see property analytics.', 'easy-real-estate' ); ?></p>
                                        </div>
                                        <div class="option-body">
                                            <p class="fancy-radio-option">
                                                <span class="allow">
                                                    <input type="radio" id="ere_<?php echo esc_attr( $role ); ?>_option_anl_allow" name="user_role_options[<?php echo esc_attr( $role ); ?>][property_analytics]" value="true" <?php checked( $property_analytics ) ?>>
                                                    <label class="button-primary" for="ere_<?php echo esc_attr( $role ); ?>_option_anl_allow"><?php esc_html_e( 'Allow', 'easy-real-estate' ); ?></label>
                                                </span>
                                                <span class="deny">
                                                    <input type="radio" id="ere_<?php echo esc_attr( $role ); ?>_option_anl_deny" name="user_role_options[<?php echo esc_attr( $role ); ?>][property_analytics]" value="false" <?php checked( $property_analytics, false ) ?>>
                                                    <label class="button-primary" for="ere_<?php echo esc_attr( $role ); ?>_option_anl_deny"><?php esc_html_e( 'Deny', 'easy-real-estate' ); ?></label>
                                                </span>
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
							<?php
							$first_setting = false;
						}
						?>
                    </div>
					<?php
				}
				?>

                <hr>
                <div class="submit">
	                <?php wp_nonce_field( 'inspiry_ere_settings' ); ?>
                    <input type="submit" name="submit" id="submit" class="button button-primary" value="<?php esc_attr_e( 'Save Changes', 'easy-real-estate' ); ?>">
                </div>
            </form>
        </div>
    </div>

    <?php
    $registered_user_default_status = get_option( 'ere_registered_user_default_status', 'pending' );
    $pending_users_error_statement = get_option( 'ere_pending_users_error_statement', esc_html__( 'Access approval is pending for this user.', 'easy-real-estate' ) );
    $denied_users_error_statement = get_option( 'ere_denied_users_error_statement', esc_html__( 'Access is denied for this user. Please contact the website administrator.', 'easy-real-estate' ) );
    ?>
    <div class="user-approval-wrap main-settings-section">
        <h3 class="main-head"><?php esc_html_e( 'User Approval Management', 'easy-real-estate' ); ?></h3>
        <div class="user-approval-list">
            <div class="user-approval-options user-pre-options-wrap">
                <form class="user-approval-settings" method="post">
                    <h3 class="inner-main-heading"><?php esc_html_e( 'Basic User Approval Options', 'easy-real-estate' ); ?></h3>
                    <div class="left">
                        <h4 class="label"><?php esc_html_e( 'Default newly registered user status', 'easy-real-estate' ); ?></h4>
                        <legend class="screen-reader-text">
                            <span><?php esc_html_e( 'Default newly registered user status', 'easy-real-estate' ); ?></span>
                        </legend>
                    </div>
                    <div class="right">
                        <p class="fancy-radio-option">
                        <span class="allow">
                            <input type="radio" id="ere_register_user_status_pending" name="ere_new_user_approval_status" value="pending" <?php checked( $registered_user_default_status, 'pending' ) ?>>
                            <label class="button-primary" for="ere_register_user_status_pending"><?php esc_html_e( 'Pending', 'easy-real-estate' ); ?></label>
                        </span>
                            <span class="deny">
                            <input type="radio" id="ere_register_user_status_approved" name="ere_new_user_approval_status" value="approved" <?php checked( $registered_user_default_status, 'approved' ) ?>>
                            <label class="button-primary" for="ere_register_user_status_approved"><?php esc_html_e( 'Approved', 'easy-real-estate' ); ?></label>
                        </span>
                        </p>
                    </div>

                    <div class="left">
                        <label for="ere_pending_users_error_statement"><?php esc_html_e( 'Login error statement for pending users', 'easy-real-estate' ); ?></label>
                        <p class="desc"><?php esc_html_e( 'This error will appear when newly registered user with pending approval status try to login.', 'easy-real-estate' ); ?></p>
                        <legend class="screen-reader-text">
                            <span><?php esc_html_e( 'Login error statement for pending users', 'easy-real-estate' ); ?></span>
                        </legend>
                    </div>
                    <div class="right">
                        <p class="fancy-radio-option">
                            <input type="text" id="ere_pending_users_error_statement" name="ere_pending_users_error_statement" value="<?php echo esc_attr( $pending_users_error_statement ); ?>">
                        </p>
                    </div>

                    <div class="left">
                        <label for="ere_denied_users_error_statement"><?php esc_html_e( 'Login error statement for denied users', 'easy-real-estate' ); ?></label>
                        <p class="desc"><?php esc_html_e( 'This error will appear when a user with denied status try to login.', 'easy-real-estate' ); ?></p>
                        <legend class="screen-reader-text">
                            <span><?php esc_html_e( 'Login error statement for denied users', 'easy-real-estate' ); ?></span>
                        </legend>
                    </div>
                    <div class="right">
                        <p class="fancy-radio-option">
                            <input type="text" id="ere_denied_users_error_statement" name="ere_denied_users_error_statement" value="<?php echo esc_attr( $denied_users_error_statement ); ?>">
                        </p>
                    </div>

                    <div class="submit">
                        <?php wp_nonce_field( 'ere_user_approval_nonce', 'user_approval_settings_nonce' ); ?>
                        <input type="submit" name="submit" id="submit" class="button button-primary" value="<?php esc_attr_e( 'Save Changes', 'easy-real-estate' ); ?>">
                    </div>
                </form>
            </div>

            <div class="user-approval-options users-list">
                <h3 class="inner-main-heading"><?php esc_html_e( 'Users List', 'easy-real-estate' ); ?></h3>
		        <?php
		        $user_list_filter = 'pending';
		        if ( isset( $_GET['user-list-filter'] ) && ! empty( $_GET['user-list-filter'] ) ) {
			        $user_list_filter = $_GET['user-list-filter'];
		        }
		        ?>
                <ul class="ere-users-approval-filters clearfix">
                    <li class="ere-users-approval-pending <?php ere_current_class( $user_list_filter, 'pending' ) ?>">
                        <a href="<?php echo esc_url( add_query_arg( array( 'user-list-filter' => 'pending' ) ) ); ?>"><?php esc_html_e( 'Pending', 'easy-real-estate' ); ?></a>
                    </li>
                    <li class="ere-users-approval-approved <?php ere_current_class( $user_list_filter, 'approved' ) ?>">
                        <a href="<?php echo esc_url( add_query_arg( array( 'user-list-filter' => 'approved' ) ) ); ?>"><?php esc_html_e( 'Approved', 'easy-real-estate' ); ?></a>
                    </li>
                    <li class="ere-users-approval-denied <?php ere_current_class( $user_list_filter, 'denied' ) ?>">
                        <a href="<?php echo esc_url( add_query_arg( array( 'user-list-filter' => 'denied' ) ) ); ?>"><?php esc_html_e( 'Denied', 'easy-real-estate' ); ?></a>
                    </li>
                    <li class="ere-users-approval-all <?php ere_current_class( $user_list_filter, 'all' ) ?>">
                        <a href="<?php echo esc_url( add_query_arg( array( 'user-list-filter' => 'all' ) ) ); ?>"><?php esc_html_e( 'All', 'easy-real-estate' ); ?></a>
                    </li>
                </ul>
		        <?php
		        $users = ere_get_users_by_approval_status( $user_list_filter );

		        // Manually set to 20. Will consider adding dropdown option for users along with per page users status
		        $users_per_page = 20;

		        $users_list = array_slice( $users, $users_per_page );

		        if ( false !== $users && 0 < count( $users ) ) {
			        // Add user column headings
			        ?>
                    <ul class="ere-users-approval-columns-head">
                        <li class="user-id"><?php esc_html_e( 'ID', 'easy-real-estate' ); ?></li>
                        <li class="user-login"><?php esc_html_e( 'Username', 'easy-real-estate' ); ?></li>
                        <li class="user-name"><?php esc_html_e( 'Name', 'easy-real-estate' ); ?></li>
                        <li class="user-email"><?php esc_html_e( 'Email', 'easy-real-estate' ); ?></li>
                        <li class="user-role"><?php esc_html_e( 'Role', 'easy-real-estate' ); ?></li>
                        <li class="user-status"><?php esc_html_e( 'Status', 'easy-real-estate' ); ?></li>
                        <li class="user-action"><?php esc_html_e( 'Action', 'easy-real-estate' ); ?></li>
                    </ul>

                    <ul id="ere-users-approval-users-list" class="ere-users-approval-users-list">
				        <?php
				        $users_counter = 1;
				        foreach ( $users as $user ) {

					        // Break if per page user exceeds
					        if ( $users_counter > $users_per_page ) {
						        break;
					        }

					        $user_status = ere_get_user_approval_status( $user->ID );
					        ?>
                            <li class="user-item status-<?php echo esc_attr( $user_status ); ?>">
                                <ul>
                                    <li class="user-id"><?php echo esc_html( $user->ID ); ?></li>
                                    <li class="user-login"><?php echo esc_html( $user->user_login ); ?></li>
							        <?php
							        if ( '' !== $user->first_name && '' !== $user->last_name ) {
								        $user_name = sprintf(
									        $user->first_name,
									        $user->last_name
								        );
							        } else {
								        $user_name = $user->display_name;
							        }
							        ?>
                                    <li class="user-name"><?php echo esc_html( $user_name ); ?></li>
                                    <li class="user-email"><?php echo esc_html( $user->user_email ); ?></li>
                                    <li class="user-role">
                                        <?php
                                        $current_user_role = realhomes_get_user_role( $user->ID );
                                        echo ucfirst( $current_user_role );
                                        ?>
                                    </li>
                                    <li class="user-status <?php echo esc_attr( $user_status ); ?>"><?php echo esc_html( $user_status ); ?></li>
							        <?php
							        if ( $user_status == 'denied' || $user_status == 'pending' ) {
								        $button_class = 'approved';
								        $current_text = esc_html__( 'Approve', 'easy-real-estate' );
								        $alter_text   = esc_html__( 'Deny', 'easy-real-estate' );
							        } else {
								        $button_class = 'denied';
								        $current_text = esc_html__( 'Deny', 'easy-real-estate' );
								        $alter_text   = esc_html__( 'Approve', 'easy-real-estate' );
							        }
							        ?>
                                    <li class="user-action">
                                        <a class="button-primary <?php echo esc_attr( $button_class ); ?>" data-user-id="<?php echo esc_attr( $user->ID ); ?>" data-current-status="<?php echo esc_attr( $user_status ); ?>" data-new-status="<?php echo esc_attr( $button_class ); ?>" data-current-text="<?php echo esc_attr( $current_text ); ?>" data-alter-text="<?php echo esc_attr( $alter_text ); ?>"><?php echo esc_html( $current_text ); ?></a>
                                        <p class="loader"><?php ere_safe_include_svg( '/images/loader.svg' ); ?></p>
                                    </li>
                                </ul>
                            </li>
					        <?php
					        $users_counter++;
				        }
				        ?>
                    </ul>
			        <?php
			        if ( $users_per_page < count( $users ) ) {
				        ?>
                        <p class="pagination-loader"><?php ere_safe_include_svg( '/images/loader.svg' ); ?></p>
                        <div class="user-pagination" data-user-status="<?php echo esc_attr( $user_list_filter ); ?>">
					        <?php
					        for ( $user_page = 1; ceil( count( $users ) / $users_per_page ) >= $user_page; $user_page++ ) {
						        ?>
                                <span class="num button-primary <?php echo $user_page === 1 ? 'current' : ''; ?>"><?php echo esc_html( $user_page ); ?></span><?php
					        }
					        ?>
                        </div>
				        <?php
			        }
		        } else {
			        ?>
                    <h4 class="ere-no-user-notice"><?php esc_html_e( 'There are no users in this category.', 'easy-real-estate' ); ?></h4>
			        <?php
		        }
		        ?>
            </div>
            <!-- .user-approval-options.users-list -->
        </div>
        <!-- .user-approval-list -->
    </div>
    <!-- .user-approval-wrap -->
</div>
<!-- .inspiry-ere-page-contents -->