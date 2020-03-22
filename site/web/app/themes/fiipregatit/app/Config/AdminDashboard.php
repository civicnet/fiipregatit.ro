<?php

function fiipregatit_page_content() {
	?>
		<h1>
			<?php esc_html_e( 'Setări globale / fiipregatit.ro', 'fiipregatit-textdomain' ); ?>
    </h1>
    <form method="POST" action="options.php">
    <?php
      settings_fields( 'optiuni-fiipregatit' );
      do_settings_sections( 'optiuni-fiipregatit' );
      submit_button();
    ?>
    </form>
	<?php
}

function fiipregatit_admin_menu() {
  add_menu_page(
    'Setări globale',
    'Setări globale',
    'manage_options',
    'optiuni-fiipregatit',
    'fiipregatit_page_content',
    'dashicons-admin-generic',
    3
);
}

add_action( 'admin_menu', 'fiipregatit_admin_menu' );

function fiipregatit_alert_section_cb( $args ) {
	echo '<p></p>';
}

function fiipregatit_alert_text_markup() {
  wp_editor(
    get_option( 'fiipregatit_alert_text_setting_field' ),
    "fiipregatit_alert_text_setting_field",
    array(
      'textarea_rows'=> 4,
      'wpautop' => false,
    )
  );
}

function fiipregatit_alert_severity_markup() {
  ?>
  <input
    type="checkbox"
    name="fiipregatit_alert_severity_setting_field"
    value="1"
    <?php checked( 1 == get_option('fiipregatit_alert_severity_setting_field')) ?>
  />
  <?php
}

function fiipregatit_alert_section_init() {
  add_settings_section(
    'fiipregatit_alert_setting_section',
    'Alertă',
    'fiipregatit_alert_section_cb',
    'optiuni-fiipregatit'
  );

  add_settings_field(
    'fiipregatit_alert_text_setting_field',
    'Text alertă',
    'fiipregatit_alert_text_markup',
    'optiuni-fiipregatit',
    'fiipregatit_alert_setting_section'
  );
  register_setting(
    'optiuni-fiipregatit',
    'fiipregatit_alert_text_setting_field'
  );

  add_settings_field(
    'fiipregatit_alert_severity_setting_field',
    'Important?',
    'fiipregatit_alert_severity_markup',
    'optiuni-fiipregatit',
    'fiipregatit_alert_setting_section'
  );
  register_setting(
    'optiuni-fiipregatit',
    'fiipregatit_alert_severity_setting_field'
  );

}

add_action( 'admin_init', 'fiipregatit_alert_section_init' );
