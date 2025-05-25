<?php
// include the TravelCalculator class
include_once ALVIIT_CF_PATH . 'classes/TravelCalculator.php';

class AlviitMultiStepForm{


     // Constructor
     public function __construct(){
        // Load text domain
        add_action( 'plugins_loaded',[$this, 'alviit_cf_load_textdomain'] );
        // admin menu hook
        add_action('admin_menu', [$this, 'alviit_cf_add_admin_menu']);
        // form shortcode
        add_shortcode('alviit_cf_form', [$this,'aitcf_render_form']);
        // enqueue assets
        add_action( 'wp_enqueue_scripts', [$this,'alviit_cf_enqueue_assets'] );
        // admin enqueue assets
        add_action("admin_enqueue_scripts", [$this, "alviit_cf_admin_plugin_assets"]);
        // ajax ahndler hook
        add_action('wp_ajax_alviit_cf_submit_ajax_handler', [$this, 'alviitcf_submit_ajax_handler']);
        add_action('wp_ajax_alviit_cf_load_data_ajax_handler', [$this, 'alviitcf_load_data_ajax_handler']);
        add_action('wp_ajax_alviit_cf_delete_data_ajax_handler', [$this, 'alviitcf_delete_data_ajax_handler']);

        add_action('admin_post_alviit_cf_handle_form_submission', [$this, 'handle_househol_option_form_submission']);
        


     }

    // Load text domain
    function alviit_cf_load_textdomain() {
        load_plugin_textdomain( 'aitcf-custom-form', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
    }

    //  form shortcode
    function aitcf_render_form() {
        ob_start();
        include ALVIIT_CF_PATH . 'templates/form-template.php';
        return ob_get_clean();
    }

     // Enqueue scripts and styles
    function alviit_cf_enqueue_assets() {
        // External CSS
        wp_enqueue_style( 'bootstrapcss', ALVIIT_CF_URL . 'assets/inc/css/bootstrap.min.css', [], '5.3.3' );
        wp_enqueue_style( 'aitcf-daterangepicker', ALVIIT_CF_URL . 'assets/inc/css/daterangepicker.css', [], '3.1' );

        // Plugin CSS
        wp_enqueue_style( 'aitcf-date-calender', ALVIIT_CF_URL . 'assets/css/date-calender.css', [], '1.0.0' );
        wp_enqueue_style( 'aitcf-style', ALVIIT_CF_URL . 'assets/css/style.css', [], '1.0.0' );
        wp_enqueue_style( 'aitcf-fontawesomepro', ALVIIT_CF_URL . 'assets/css/font-awesome-pro.css', [], '6.0.0' );
        wp_enqueue_style( 'aitcf-toastrcss', ALVIIT_CF_URL . 'assets/css/toastr.min.css', [], '2.1.3' );

        // External JS
        wp_enqueue_script( 'momentjs', ALVIIT_CF_URL . 'assets/inc/js/moment.min.js', ['jquery'], '2.29.4', true );
        wp_enqueue_script( 'daterangepicker', ALVIIT_CF_URL . 'assets/inc/js/daterangepicker.min.js', ['jquery'], '3.1', true );

        // Plugin JS
        wp_enqueue_script( 'bootstrapjs', ALVIIT_CF_URL . 'assets/inc/js/bootstrap.bundle.min.js', [], '5.3.3', true );
        wp_enqueue_script( 'aitcf-date', ALVIIT_CF_URL . 'assets/js/date.js', ['jquery'], '1.0.0', true );
        wp_enqueue_script( 'aitcf-household-tab', ALVIIT_CF_URL . 'assets/js/household-tab.js', ['jquery'], '1.0.0', true );
        wp_enqueue_script( 'aitcf-multi-step', ALVIIT_CF_URL . 'assets/js/multi-step-form.js', ['jquery'], '1.0.0', true );
        wp_enqueue_script( 'aitcf-step1', ALVIIT_CF_URL . 'assets/js/step1.js', ['jquery'], '1.0.0', true );
        wp_enqueue_script( 'aitcf-step2', ALVIIT_CF_URL . 'assets/js/step2.js', ['jquery'], '1.0.0', true );
        wp_enqueue_script( 'aitcf-step4', ALVIIT_CF_URL . 'assets/js/step4.js', ['jquery'], '1.0.0', true );
        wp_enqueue_script( 'aitcf-step5', ALVIIT_CF_URL . 'assets/js/step5.js', ['jquery'], '1.0.0', true );
        wp_enqueue_script( 'aitcf-toastrjs', ALVIIT_CF_URL . 'assets/js/toastr.min.js', ['jquery'], '2.1.3', true );

        wp_enqueue_script( 'aitcf-app', ALVIIT_CF_URL . 'assets/js/app.js', ['jquery'], '1.5.0', true );

        // inline script ajax url
        $script_data = "const aitcf_ajax_url = '" . admin_url( 'admin-ajax.php' ) . "';";
        wp_add_inline_script('aitcf-multi-step', $script_data);

        // is thank you page exist inlien script
        $aitcf_thank_you_page = get_page_by_path('thank-you');
        $aitcf_page_exists = $aitcf_thank_you_page ? 'true' : 'false';
        $thank_your_script_data  = "const aitcf_has_thank_you_page = {$aitcf_page_exists};";
        wp_add_inline_script('aitcf-app', $thank_your_script_data);


    }

    // alviit_cf_add_plugin_assets
    function alviit_cf_admin_plugin_assets() {

        if (isset($_GET['page']) && in_array($_GET['page'], ['alviit-cf', 'alviit-cf-households-options', 'alviit-cf-view-record', 'alviit-cf-add-record'])) {
            // plugin css
            wp_enqueue_style( 'bootstrapcss', ALVIIT_CF_URL . 'assets/inc/css/bootstrap.min.css', [], '5.3.3' );
            wp_enqueue_style( 'alviit-cf-single-css', ALVIIT_CF_URL . 'assets/css/form-single.css', [], '1.0.0' );
            wp_enqueue_style( 'aitcf-toastrcss', ALVIIT_CF_URL . 'assets/css/toastr.min.css', [], '2.1.3' );

            // plugin js
            wp_enqueue_script( 'bootstrapjs', ALVIIT_CF_URL . 'assets/inc/js/bootstrap.bundle.min.js', [], '5.3.3', true );
            wp_enqueue_script( 'load-alvi-cf-data', ALVIIT_CF_URL . 'assets/js/load-alvi-cf-data.js', [], '1.0.0', true );
            wp_enqueue_script( 'load-alvi-cf-single-data', ALVIIT_CF_URL . 'assets/js/load-alvi-cf-single-data.js', [], '1.0.0', true );
            wp_enqueue_script( 'aitcf-toastrjs', ALVIIT_CF_URL . 'assets/js/toastr.min.js', ['jquery'], '2.1.3', true );


            // inline script ajax url
            $script_data = "const aitcf_ajax_url = '" . admin_url( 'admin-ajax.php' ) . "';";
            $script_data .= "const aitcf_admin_url = '" . admin_url( 'admin.php' ) . "';";
            wp_add_inline_script('load-alvi-cf-data', $script_data);

        
        }

    }

    // Admin menu for plugin
    function alviit_cf_add_admin_menu() {
        // Add main menu page and set 'Form List' as the default submenu item
        add_menu_page(
            'Alviit Custom Form',               // Page title
            'Alviit Form',                      // Menu title
            'manage_options',                   // Capability
            'alviit-cf',                        // Menu slug (unique identifier)
            array($this, 'aitcf_render_form_list_table'),  // Function to render the page
            'dashicons-database',               // Icon
            21                                  // Position
        );

        // Form List
        add_submenu_page(
            'alviit-cf',                         // Parent slug (this ensures the submenu is under 'Alviit Form')
            'Form List',                         // Page title
            'Form List',                         // Menu title
            'manage_options',                    // Capability
            'alviit-cf',                    // Menu slug (unique identifier)
            array($this, 'aitcf_render_form_list_table')  // Function to render the form list
        );

         //View Record
         add_submenu_page(
            "alviit-cf", 
            "View Record", 
            "", 
            "manage_options", 
            "alviit-cf-view-record", 
            array($this, "aitcf_render_form_single_page")
         );

        // Form households options
        add_submenu_page(
            'alviit-cf',                         // Parent slug (this ensures the submenu is under 'Alviit Form')
            'Households Options List',                         // Page title
            'Households Options',                         // Menu title
            'manage_options',                    // Capability
            'alviit-cf-households-options',                    // Menu slug (unique identifier)
            array($this, 'aitcf_render_form_households_options')  // Function to render the form list
        );


        

    }

    // Render the form page
    function aitcf_render_form_single_page() {
        // Render your main form page here
        include_once( plugin_dir_path( __FILE__ ) . '../templates/form-single-data.php');
    }

    // Render the form list page
    function aitcf_render_form_list_table() {
        include_once( plugin_dir_path( __FILE__ ) . '../templates/form-data-table.php');
    }

    // render the form households options page
    function aitcf_render_form_households_options() {
        $action_page = $_GET['action-page'] ?? '';

        if ($action_page === 'household-option-list') {
            include_once plugin_dir_path(__FILE__) . '../templates/form-househol-options-list.php';
        } else {
            include_once plugin_dir_path(__FILE__) . '../templates/form-househol-options.php';
        } 

    }


    // Create alviit_cf_form Table
    public function create_alviit_Cf_form_tables() {


        // Insert dummy data
        $this->insert_alviit_Cf_household_rooms_data();

        global $wpdb;
        $prefix = $wpdb->prefix;
        $charset_collate = $wpdb->get_charset_collate();

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';

        $tables = [];

        // Main Request Table
        $tables[] = "
            CREATE TABLE {$prefix}alviit_cf_requests (
                id INT NOT NULL AUTO_INCREMENT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (id)
            ) $charset_collate;
        ";

        // Addresses A Table
        $tables[] = "
            CREATE TABLE {$prefix}alviit_cf_addresses_a (
                id INT NOT NULL AUTO_INCREMENT,
                request_id INT NOT NULL,
                country VARCHAR(100) NOT NULL,
                postal VARCHAR(255) NOT NULL,
                house_number VARCHAR(50) NOT NULL,
                addition VARCHAR(255),
                city VARCHAR(255) NOT NULL,
                street VARCHAR(255) NOT NULL,
                floor_number VARCHAR(50),
                is_lift_available BOOLEAN,
                job_description TEXT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (id),
                KEY request_id (request_id)
            ) $charset_collate;
        ";

       // Addresses B Table
        $tables[] = "
            CREATE TABLE {$prefix}alviit_cf_addresses_b (
                id INT NOT NULL AUTO_INCREMENT,
                request_id INT NOT NULL,
                country VARCHAR(100) NOT NULL,
                postal VARCHAR(255) NOT NULL,
                house_number VARCHAR(50) NOT NULL,
                addition VARCHAR(255),
                city VARCHAR(255) NOT NULL,
                street VARCHAR(255) NOT NULL,
                floor_number VARCHAR(50),
                is_lift_available BOOLEAN,
                job_description TEXT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (id),
                KEY request_id (request_id)
            ) $charset_collate;
        ";

        // Preferred Dates Table
        $tables[] = "
            CREATE TABLE {$prefix}alviit_cf_preferred_dates (
                id INT NOT NULL AUTO_INCREMENT,
                request_id INT NOT NULL,
                date_flexibility ENUM('exact', 'estimate') NOT NULL,
                date_period VARCHAR(50),
                preferred_date DATE,
                start_time TIME,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (id),
                KEY request_id (request_id)
            ) $charset_collate;
        ";

        // Contact Details Table
        $tables[] = "
            CREATE TABLE {$prefix}alviit_cf_contact_details (
                id INT NOT NULL AUTO_INCREMENT,
                request_id INT NOT NULL,
                email VARCHAR(100) NOT NULL,
                first_name VARCHAR(100) NOT NULL,
                middle_name VARCHAR(100),
                last_name VARCHAR(100) NOT NULL,
                telephone VARCHAR(30) NOT NULL,
                contact_preference ENUM('email', 'phone') DEFAULT 'email',
                is_business BOOLEAN,
                name_of_svs_employee VARCHAR(255),
                business_name VARCHAR(255),
                kvk_number VARCHAR(50),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (id),
                KEY request_id (request_id)
            ) $charset_collate;
        ";

        // Extra Options Table
        $tables[] = "
            CREATE TABLE {$prefix}alviit_cf_extra_options (
                id INT NOT NULL AUTO_INCREMENT,
                request_id INT NOT NULL,
                is_handyman BOOLEAN,
                handyman_description TEXT,
                is_move_lift BOOLEAN,
                is_full_service BOOLEAN,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (id),
                KEY request_id (request_id)
            ) $charset_collate;
        ";

        // Household Table (Stores rooms and items as JSON)
        $tables[] = "
            CREATE TABLE {$prefix}alviit_cf_households (
                id INT NOT NULL AUTO_INCREMENT,
                request_id INT NOT NULL,
                data JSON NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (id),
                KEY request_id (request_id)
            ) $charset_collate;
        ";

        // Household Rooms with Items
        $tables[] = "
            CREATE TABLE {$prefix}alviit_cf_household_rooms  (
                id INT NOT NULL AUTO_INCREMENT,
                room_type VARCHAR(150) NOT NULL,
                item_name VARCHAR(255) NOT NULL,
                m3_value FLOAT DEFAULT 0,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (id)
             ) $charset_collate;
        ";

        $tables[] = "
            CREATE TABLE {$prefix}alviit_cf_total_estimations (
                id INT NOT NULL AUTO_INCREMENT,
                request_id INT NOT NULL,
                loading_time VARCHAR(5) DEFAULT '00:00',
                travel_time VARCHAR(5) DEFAULT '00:00',
                unloading_time VARCHAR(5) DEFAULT '00:00',
                total_hours VARCHAR(5) DEFAULT '02:00',
                travel_distance VARCHAR(5) DEFAULT '',
                travel_cost DECIMAL(10,2) NOT NULL DEFAULT 0.00,
                estimated_price DECIMAL(10,2) NOT NULL DEFAULT 0.00,
                currency VARCHAR(10) DEFAULT 'EUR',
                cubic_meter FLOAT NOT NULL DEFAULT 0,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (id),
                KEY request_id (request_id)
            ) $charset_collate;
        ";



        // Run each table creation
        foreach ($tables as $sql) {
            dbDelta($sql);
        }
    }

    // drop alviit_cf_form Table
    public function drop_alviit_cf_form_tables() {
        global $wpdb;

        $prefix = $wpdb->prefix;
        $db_user = DB_USER;
        $db_password = DB_PASSWORD;
        $db_name = DB_NAME;
        $wp_content_path = WP_CONTENT_DIR;

        // Timestamped filename
        $version = time();
        $filename = "alviit-cf-db-backup-" . $version . ".sql";
        $backup_path = "{$wp_content_path}/alviit-cf-plugin/{$filename}";

        // Table list to drop
        $tables = [
            "{$prefix}alviit_cf_requests",
            "{$prefix}alviit_cf_addresses_a",
            "{$prefix}alviit_cf_addresses_b",
            "{$prefix}alviit_cf_preferred_dates",
            "{$prefix}alviit_cf_contact_details",
            "{$prefix}alviit_cf_extra_options",
            "{$prefix}alviit_cf_household_rooms",
            "{$prefix}alviit_cf_households",
            "{$prefix}alviit_cf_total_estimations"
        ];

        $table_names_for_backup = implode(" ", $tables);

        // Ensure backup directory exists
        if (!is_dir("{$wp_content_path}/alviit-cf-plugin")) {
            mkdir("{$wp_content_path}/alviit-cf-plugin", 0777, true);
        }

        // Run MySQL dump
        shell_exec("mysqldump -u {$db_user} -p{$db_password} {$db_name} {$table_names_for_backup} > {$backup_path}");

        // Drop tables
        foreach ($tables as $table) {
            $wpdb->query("DROP TABLE IF EXISTS {$table}");
        }
    }

    // Insert dummy data
    public function insert_alviit_Cf_household_rooms_data()
    {
        global $wpdb;

        $table_name = $wpdb->prefix . 'alviit_cf_household_rooms';

        // Check if table exists
        if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") !== $table_name) {
            return;
        }

        $room_items = [
            'WOONKAMER' => [
                ['Dozen', 0.1], ['2-persoonsbank', 1], ['3-persoonsbank', 1.5], ['Fauteuil', 0.5],
                ['Vloerkleed', 0.5], ['Stoel', 0.2], ['Kast', 1], ['Salontafel', 0.4],
                ['Dressoirkast', 1], ['Bureau', 1], ['Eettafel', 0.75], ['Dressoir', 1],
                ['Grote stoel', 0.5], ['Schilderijen', 0.15], ['Planten', 0.1], ['Secretaire', 0.5],
                ['Bijzettafel', 0.2], ['Klein meubilair', 0.3], ['TV', 0.4],
            ],
            'SLAAPKAMER' => [
                ['Dozen', 0.1], ['Babybadje', 0.2], ['Nachtkastje', 0.3], ['Box', 0.2],
                ['Stoel', 0.2], ['Ombouw', 0.5], ['Wieg', 0.4], ['Kast met 2 deuren', 1],
                ['Kast met 3 deuren', 2], ['Bureau', 1], ['Tweepersoonsbed', 0.7], ['Ladekast', 1],
                ['Kaptafel', 0.6], ['Kinderstoel (baby)', 0.15], ['Groot speelgoed', 0.5],
                ['Grote kledingkast', 0.6], ['Matras', 0.1], ['Eenpersoonsbed', 0.3],
                ['Kleine kledingkast', 0.4], ['Stereo', 0.2], ['TV', 0.4],
            ],
            'BADKAMER' => [
                ['Dozen', 0.1], ['Kast', 1], ['Droger', 0.6], ['Wasmachine', 0.6],
            ],
            'WERKKAMER' => [
                ['Dozen', 0.1], ['Boekenkast', 1], ['Stoel', 0.2], ['Computer', 0.25], ['Bureau', 1],
            ],
            'KEUKEN' => [
                ['Dozen', 0.1], ['Buffetkast', 1], ['Kast', 1], ['Eethoek', 1],
                ['Vaatwasser', 0.5], ['Vriezer', 0.5], ['Magnetron', 0.3],
                ['Oven', 0.3], ['Koelkast', 0.5], ['Fornuis', 0.5],
            ],
            'SCHUUR' => [
                ['Dozen', 0.1], ['Tuingereedschap', 0.5], ['Ladder', 0.3],
                ['Grote fiets', 0.5], ['Kleine fiets', 0.3], ['Werkbank', 1],
            ],
            'TUIN' => [
                ['Tuintafels', 0.75], ['Plantenbak', 0.5], ['Hout', 0.1],
            ],
            'ZOLDER' => [
                ['Dozen', 0.1], ['Bed', 0.3], ['Kampeeruitrusting', 1],
                ['Kerstversiering', 0.5], ['Kast', 1], ['Wiegje', 0.5],
            ],
            'OVERIG' => [
                ['Overig 0.5m3', 0.5], ['Overig 1.0m3', 1],
            ]
        ];

        foreach ($room_items as $room => $items) {
            foreach ($items as [$item, $m3_value]) {
                $wpdb->insert(
                    $table_name,
                    [
                        'room_type'   => $room,
                        'item_name'   => $item,
                        'm3_value'    => $m3_value,
                        'created_at'  => current_time('mysql'),
                        'updated_at'  => current_time('mysql')
                    ]
                );
            }
        }
    }


    // validtion requed field
    private function validate_required_fields($data, $requiredFields, $sectionName = '') {
    foreach ($requiredFields as $field) {
        if (!isset($data[$field]) || $data[$field] === '') {
            wp_send_json_error([
                'message' => "Missing required field: {$field}" . ($sectionName ? " in section '{$sectionName}'" : '')
            ], 400);
            wp_die();
        }
    }
}


    // 1. ajax handler submit hook
    public function alviitcf_submit_ajax_handler() {
    

            // 1. Nonce Verification
            if (!isset($_POST['nonce']) || 
                !wp_verify_nonce($_POST['nonce'], 'wp_nonce_aitcf_multistep_form_submit')) {
                wp_send_json_error(['message' => 'Invalid nonce.']);
                wp_die();
            }

            // 2. Decode Payload
            $raw_payload = stripslashes($_POST['payload']);
            $data = json_decode($raw_payload, true);

            // 3. Ensure param is correct
            if (!isset($_POST['param']) || $_POST['param'] !== 'save_form') {
                wp_send_json_error(['message' => 'Invalid request.']);
                wp_die();
            }

            global $wpdb;
            $prefix = $wpdb->prefix;

            try {
                // Step 1: Insert into requests table (create a base request ID)
                $wpdb->insert("{$prefix}alviit_cf_requests", [
                    'created_at' => current_time('mysql'), // Or whatever fields are required
                ]);
                $request_id = $wpdb->insert_id;

                if (!$request_id) {
                    wp_send_json_error(['message' => 'Failed to create request ID.']);
                    wp_die();
                }

                // Step 2.1: Insert into addresses
                $address_a = $data['fromAddress'];
                $this->validate_required_fields($address_a, ['country', 'postal', 'houseNumber', 'city', 'street'], 'Addresses');

                $wpdb->insert("{$prefix}alviit_cf_addresses_a", [
                    'request_id' => $request_id,
                    'country' => $address_a['country'],
                    'postal' => $address_a['postal'],
                    'house_number' => $address_a['houseNumber'],
                    'addition' => $address_a['addition'],
                    'city' => $address_a['city'],
                    'street' => $address_a['street'],
                    'floor_number' => $address_a['floorNumber'],
                    'is_lift_available' => $address_a['isLiftAvailable'] ? 1 : 0,
                    'job_description' => $address_a['jobDescription'],
                ]);
                // Step 2.2: Insert into addresses
                $address_b = $data['toAddress'];
                $this->validate_required_fields($address_b, ['country', 'postal', 'houseNumber', 'city', 'street'], 'Addresses');

                $wpdb->insert("{$prefix}alviit_cf_addresses_b", [
                    'request_id' => $request_id,
                    'country' => $address_b['country'],
                    'postal' => $address_b['postal'],
                    'house_number' => $address_b['houseNumber'],
                    'addition' => $address_b['addition'],
                    'city' => $address_b['city'],
                    'street' => $address_b['street'],
                    'floor_number' => $address_b['floorNumber'],
                    'is_lift_available' => $address_b['isLiftAvailable'] ? 1 : 0,
                    'job_description' => $address_b['jobDescription'],
                ]);

                // Step 3: Insert into preferred_date
                $pref = $data['preferred_date'];
                $wpdb->insert("{$prefix}alviit_cf_preferred_dates", [
                    'request_id' => $request_id,
                    'date_flexibility' => $pref['dateFlexibility'],
                    'date_period' => $pref['datePeriod'],
                    'preferred_date' => date('Y-m-d', strtotime($pref['preferredDate'])),
                    'start_time' => $pref['startTime'],
                ]);

                // Step 4: Insert contact details
                $contact = $data['contact_details'];
                $this->validate_required_fields($contact, ['email', 'firstName', 'lastName', 'telephone'], 'Contact details');

                $wpdb->insert("{$prefix}alviit_cf_contact_details", [
                    'request_id' => $request_id,
                    'email' => $contact['email'],
                    'first_name' => $contact['firstName'],
                    'middle_name' => $contact['middleName'],
                    'last_name' => $contact['lastName'],
                    'telephone' => $contact['telephone'],
                    'contact_preference' => $contact['contactPreference'],
                    'is_business' => $contact['isBusiness'] ? 1 : 0,
                    'name_of_svs_employee' => $contact['nameOfSVSEmployee'],
                    'business_name' => $contact['businessName'],
                    'kvk_number' => $contact['kvkNumber'],
                ]);

                // Step 5: Extra options
                $extra = $data['extra_options'];
                $wpdb->insert("{$prefix}alviit_cf_extra_options", [
                    'request_id' => $request_id,
                    'is_handyman' => $extra['isHandyman'] ? 1 : 0,
                    'handyman_description' => $extra['handymanDescription'],
                    'is_move_lift' => $extra['isMoveLift'] ? 1 : 0,
                    'is_full_service' => $extra['isFullService'] ? 1 : 0,
                ]);

                // Step 6: Household (store as JSON)
                $household = $data['household'];
                if (!is_array($household)) {
                    wp_send_json_error(['success' => false,'message' => 'Invalid household data.'], 400);
                    wp_die();
                }
                // unset($household['specialObject']); // Optional: remove empty field
                $wpdb->insert("{$prefix}alviit_cf_households", [
                    'request_id' => $request_id,
                    'data' => wp_json_encode($household),
                ]);

                
                // ================ Travel Calculation ================
                $fromAddress = $address_a; // should be an array with 'street', 'city', 'country'
                $toAddress = $address_b;     // same format

                $calculator = new TravelCalculator($fromAddress, $toAddress);
                $calculator->calculate();

                $distanceKm = $calculator->getDistanceKm();
                $travelTimeFormatted = $calculator->getFormattedTravelTime();
                $travelCost = $calculator->getTravelCost();
                $travelHours = $calculator->getTravelHours();


                // ================ Estimate Final Calculation ================
                $base_volume = 2.5;
                $base_time_minutes = 120;
                $base_price = 301.80;
                $step_volume = 0.5;
                $step_time = 2; // per 0.5 m³ load or unload time
                $step_price = 9.36;

                $total_cubic_meter = 0;
                foreach ($household as $room_name => $items) {
                    foreach ($items as $item) {
                        $room_id = $item['id'];
                        $quantity = $item['qty'];

                        $room = $wpdb->get_row($wpdb->prepare(
                            "SELECT m3_value FROM {$prefix}alviit_cf_household_rooms WHERE id = %d",
                            $room_id
                        ));

                        if ($room) {
                            $total_cubic_meter += $room->m3_value * $quantity;
                        }
                    }
                }

                // Use floor or ceil consistently here — to match frontend, use floor
                $extra_volume = max(0, $total_cubic_meter - $base_volume);
                $extra_steps = floor($extra_volume / $step_volume);

                $loading_minutes = $extra_steps * $step_time + 2;
                $unloading_minutes = $extra_steps * $step_time + 2;
                $travel_minutes = $travelHours * 60;

                $total_minutes = $base_time_minutes + $loading_minutes + $unloading_minutes + $travel_minutes;

                $extra_volume_price = $extra_steps * $step_price;
                $estimated_price = $base_price + $extra_volume_price + $travelCost;

                function formatMinutesToTime($mins) {
                    $h = floor($mins / 60);
                    $m = $mins % 60;
                    return sprintf('%02d:%02d', $h, $m);
                }

                $loading_time = formatMinutesToTime($loading_minutes);
                $unloading_time = formatMinutesToTime($unloading_minutes);
                $total_time = formatMinutesToTime($total_minutes);

                // ================ Save to Database ================

  


                $wpdb->insert("{$prefix}alviit_cf_total_estimations", [
                    'request_id' => $request_id,
                    'loading_time' => $loading_time,
                    'travel_time' => $travelTimeFormatted,
                    'unloading_time' => $unloading_time,
                    'total_hours' => $total_time,
                    'estimated_price' => round($estimated_price, 2),
                    'currency' => 'EUR',
                    'cubic_meter' => round($total_cubic_meter, 2),
                    'travel_distance' => $distanceKm,
                    'travel_cost' => $travelCost,
                ]);














                

                // Success Response
                wp_send_json_success([ 
                    'success' => true,
                    'message' => 'Form submitted successfully!',
                    ], 201); // 201 = Created

            } catch (Exception $e) {
                wp_send_json_error(['success' => false, 'message' => 'Something went wrong.', 'error' => $e->getMessage()]);
            }
            wp_die();
       



    }

    // 2. ajax handler load data 
    public function alviitcf_load_data_ajax_handler() {
        if (!isset($_GET['param']) || $_GET['param'] !== 'load_alviit_cf_data') {
            wp_send_json_error(['message' => 'Invalid request.']);
            wp_die();
        }

        global $wpdb;
        $prefix = $wpdb->prefix;

        $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
        $offset = ($page - 1) * $limit;

        // Fetch paginated data
        $data = $wpdb->get_results("
            SELECT 
                CONCAT_WS(' ', c.first_name, c.middle_name, c.last_name) AS full_name,
                c.telephone,
                c.email,
                c.request_id ,
                r.created_at
            FROM {$prefix}alviit_cf_requests r
            JOIN {$prefix}alviit_cf_contact_details c ON r.id = c.request_id
            ORDER BY r.created_at DESC
            LIMIT $limit OFFSET $offset
        ", ARRAY_A);

        // Count total rows for pagination
        $total = $wpdb->get_var("
            SELECT COUNT(*) 
            FROM {$prefix}alviit_cf_requests r
            JOIN {$prefix}alviit_cf_contact_details c ON r.id = c.request_id
        ");

        if ($data) {
            wp_send_json_success([
                'rows' => $data,
                'total' => intval($total)
            ]);
        } else {
            wp_send_json_error(['message' => 'No data found.']);
        }

        wp_die();
    }

    // 3. ajax handler delete data
    // public function alviitcf_delete_data_ajax_handler() {
    //     if (!isset($_POST['param']) || $_POST['param'] !== 'delete_alviit_cf_data') {
    //         wp_send_json_error(['message' => 'Invalid request.']);
    //         wp_die();
    //     }
    // }
    public function alviitcf_delete_data_ajax_handler() {
        global $wpdb;

        try {
            if (!isset($_POST['param']) || $_POST['param'] !== 'delete_alviit_cf_data') {
                throw new Exception('Invalid request.');
            }

            $request_id = isset($_POST['request_id']) ? intval($_POST['request_id']) : 0;

            if ($request_id <= 0) {
                throw new Exception('Invalid request ID.');
            }

            $prefix = $wpdb->prefix;

            // Related tables
            $tables = [
                "{$prefix}alviit_cf_addresses_a",
                "{$prefix}alviit_cf_addresses_b",
                "{$prefix}alviit_cf_preferred_dates",
                "{$prefix}alviit_cf_contact_details",
                "{$prefix}alviit_cf_extra_options",
                "{$prefix}alviit_cf_households"
            ];

            // Delete from each related table
            foreach ($tables as $table) {
                $wpdb->delete($table, ['request_id' => $request_id]);
            }

            // Delete from parent table
            $wpdb->delete("{$prefix}alviit_cf_requests", ['id' => $request_id]);

            wp_send_json_success(['message' => 'Data deleted successfully.']);
        } catch (Exception $e) {
            wp_send_json_error(['message' => $e->getMessage()]);
        }

        wp_die();
    }

    // 4. ajax handler household datq
    public function handle_househol_option_form_submission() {
            global $wpdb;

            // Nonce check
            if (!isset($_POST['nonce']) || 
                !wp_verify_nonce($_POST['nonce'], 'wp_nonce_aitcf_househol_option')) {
                wp_redirect(add_query_arg(['msg' => 'error', 'error' => 'Invalid form token.'], wp_get_referer()));
                exit;
            }

            // Validate required fields
            $room_type = sanitize_text_field($_POST['room_type'] ?? '');
            $item_name = sanitize_text_field($_POST['item_name'] ?? '');
            $m3_value = floatval($_POST['m3_value'] ?? 0);

            if (empty($room_type) || empty($item_name) ) {
                wp_redirect(add_query_arg(['msg' => 'error', 'error' => 'Please fill in all required fields.'], wp_get_referer()));
                exit;
            }

            // Insert into DB
            $table = $wpdb->prefix . 'alviit_cf_household_rooms';
            $inserted = $wpdb->insert($table, [
                'room_type' => $room_type,
                'item_name' => $item_name,
                'm3_value' => $m3_value,
            ], [
                '%s', '%s', '%f'
            ]);

            if ($inserted === false) {
                wp_redirect(add_query_arg(['msg' => 'error', 'error' => 'Failed to save data.'], wp_get_referer()));
            } else {
                wp_redirect(add_query_arg('msg', 'success', wp_get_referer()));
            }

            exit;
    }
    

    // 3. ajax handler view data
    public function alviitcf_view_data_ajax_handler() {
        if (!isset($_GET['param']) || $_GET['param'] !== 'view_alviit_cf_data') {
            wp_send_json_error(['message' => 'Invalid request.']);
            wp_die();
        }
    }







}


