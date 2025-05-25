<?php
// Fetch the request ID from the URL or predefined variable
$request_id = isset($_GET['alviitcrequestid']) ? intval($_GET['alviitcrequestid']) : 0;

global $wpdb;
$prefix = $wpdb->prefix;

// Fetch Address
$address_a = $wpdb->get_row("SELECT * FROM {$prefix}alviit_cf_addresses_a WHERE request_id = $request_id", ARRAY_A);
$address_b = $wpdb->get_row("SELECT * FROM {$prefix}alviit_cf_addresses_b WHERE request_id = $request_id", ARRAY_A);

// Fetch Preferred Date
$preferred_date = $wpdb->get_row("SELECT * FROM {$prefix}alviit_cf_preferred_dates WHERE request_id = $request_id", ARRAY_A);

// Fetch Household Items
$household_items = $wpdb->get_results("SELECT * FROM {$prefix}alviit_cf_households WHERE request_id = $request_id", ARRAY_A);

// Fetch Extra Options
$extras = $wpdb->get_row("SELECT * FROM {$prefix}alviit_cf_extra_options WHERE request_id = $request_id", ARRAY_A);
// Fetch Contact
$contact = $wpdb->get_row("SELECT * FROM {$prefix}alviit_cf_contact_details WHERE request_id = $request_id", ARRAY_A);
// Fetch Total Estimations
$total_estimation = $wpdb->get_row("SELECT * FROM {$prefix}alviit_cf_total_estimations WHERE request_id = $request_id", ARRAY_A);


?>

<div class="container mt-4">
  <!-- Header -->
  <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 p-4 mb-4 bg-light border rounded shadow-sm">
    <div>
      <h3 class="mb-1 fw-bold">View Submission Details</h3>
      <p class="mb-0 text-muted">Below is the detailed summary of the submitted form data.</p>
    </div>
    <a href="<?= esc_url(admin_url('admin.php?page=alviit-cf')) ?>" class="btn btn-success ">Go Back</a>
  </div>

  <div class="row">

    <!-- Address a -->
    <div class="col-md-4">
      <div class="card px-0 shadow-sm border-0 h-100">
        <div class="card-header bg-primary text-white fw-semibold">Address A Details</div>
        <div class="card-body">
          <p><strong>Country:</strong> <?= esc_html($address_a['country'] ?? '-') ?></p>
          <p><strong>Postal:</strong> <?= esc_html($address_a['postal'] ?? '-') ?></p>
          <p><strong>House Number:</strong> <?= esc_html($address_a['house_number'] ?? '-') ?></p>
          <p><strong>Street:</strong> <?= esc_html($address_a['street'] ?? '-') ?></p>
          <p><strong>City:</strong> <?= esc_html($address_a['city'] ?? '-') ?></p>
          <p><strong>Floor Number:</strong> <?= esc_html(is_array($address_a) ? ($address_a['floor_number'] ?? '-') : '-') ?></p>
          <p><strong>Lift Available:</strong> <?= (is_array($address_a) && !empty($address_a['is_lift_available'])) ? 'Yes' : 'No' ?></p>
          <p><strong>Job Description:</strong> <?= esc_html($address_a['job_description'] ?? '-') ?></p>
        </div>
      </div>
    </div>

    
    <!-- Address b -->
    <div class="col-md-4">
      <div class="card px-0 shadow-sm border-0 h-100">
        <div class="card-header bg-primary text-white fw-semibold">Address B Details</div>
        <div class="card-body">
          <p><strong>Country:</strong> <?= esc_html($address_b['country'] ?? '-') ?></p>
          <p><strong>Postal:</strong> <?= esc_html($address_b['postal'] ?? '-') ?></p>
          <p><strong>House Number:</strong> <?= esc_html($address_b['house_number'] ?? '-') ?></p>
          <p><strong>Street:</strong> <?= esc_html($address_b['street'] ?? '-') ?></p>
          <p><strong>City:</strong> <?= esc_html($address_b['city'] ?? '-') ?></p>
          <p><strong>Floor Number:</strong> <?= esc_html(is_array($address_b) ? ($address_b['floor_number'] ?? '-') : '-') ?></p>
          <p><strong>Lift Available:</strong> <?= (is_array($address_b) && !empty($address_b['is_lift_available'])) ? 'Yes' : 'No' ?></p>
          <p><strong>Job Description:</strong> <?= esc_html($address_b['job_description'] ?? '-') ?></p>
        </div>
      </div>
    </div>

    <!-- Preferred Date -->
    <div class="col-md-4">
      <div class="card px-0 shadow-sm border-0 h-100">
        <div class="card-header bg-info text-white fw-semibold">Preferred Date</div>
        <div class="card-body">
          <p><strong>Preferred Date:</strong> <?= esc_html($preferred_date['preferred_date'] ?? '-') ?></p>
          <p><strong>Flexibility:</strong> <?= esc_html($preferred_date['date_flexibility'] ?? '-') ?></p>
          <p><strong>Period:</strong> <?= esc_html($preferred_date['date_period'] ?? '-') ?></p>
          <p><strong>Start Time:</strong> <?= esc_html($preferred_date['start_time'] ?? '-') ?></p>
        </div>
      </div>
    </div>

    <!-- Household -->
    <div class="col-md-4">
      <div class="card px-0 shadow-sm border-0 h-100">
        <div class="card-header bg-secondary text-white fw-semibold">Household Items</div>
        <div class="card-body py-3 px-3">
          <?php
          global $wpdb;
          $prefix = $wpdb->prefix;

          // Step 1: Decode household data JSON
          $jsonData = $household_items[0]['data'] ?? '{}';
          $itemsByRoom = json_decode($jsonData, true);

          // Step 2: Extract special note if exists
          $specialNote = $itemsByRoom['specialObject'] ?? null;
          unset($itemsByRoom['specialObject']);

          // Step 3: Prepare item ID list
          $itemIds = [];
          foreach ($itemsByRoom as $roomItems) {
            foreach ($roomItems as $item) {
              if (isset($item['id'])) {
                $itemIds[] = intval($item['id']);
              }
            }
          }

          // Step 4: Fetch item names in one query
          $placeholders = implode(',', array_fill(0, count($itemIds), '%d'));
          $itemMap = [];

          if (!empty($itemIds)) {
            $query = $wpdb->prepare(
              "SELECT id, item_name FROM {$prefix}alviit_cf_household_rooms WHERE id IN ($placeholders)",
              ...$itemIds
            );
            $results = $wpdb->get_results($query, ARRAY_A);

            foreach ($results as $row) {
              $itemMap[$row['id']] = $row['item_name'];
            }
          }

          // Step 5: Utility to format room name
          function formatRoomName($key) {
            return ucwords(str_replace('_', ' ', strtolower($key)));
          }

          // Step 6: Divide rooms for two-column display
          $roomKeys = array_keys($itemsByRoom);
          $half = ceil(count($roomKeys) / 2);
          $leftRooms = array_slice($roomKeys, 0, $half);
          $rightRooms = array_slice($roomKeys, $half);

          // Step 7: Render items
          function renderRoomItems($roomKeys, $itemsByRoom, $itemMap) {
            foreach ($roomKeys as $roomKey) {
              $items = $itemsByRoom[$roomKey] ?? [];

              if (!empty($items)) {
                echo "<h6 class='fw-semibold text-decoration-underline mt-3 mb-2'>" . esc_html(formatRoomName($roomKey)) . "</h6>";

                foreach ($items as $itemData) {
                  $itemId = $itemData['id'] ?? null;
                  $qty = $itemData['qty'] ?? 0;

                  if ($itemId && isset($itemMap[$itemId])) {
                    echo "<p class='mb-1'><strong>" . esc_html($itemMap[$itemId]) . ":</strong> " . esc_html($qty) . "</p>";
                  }
                }
              }
            }
          }
          ?>

          <div class="row">
            <div class="col">
              <?php renderRoomItems($leftRooms, $itemsByRoom, $itemMap); ?>
            </div>
            <div class="col">
              <?php renderRoomItems($rightRooms, $itemsByRoom, $itemMap); ?>
            </div>
          </div>

          <?php if ($specialNote): ?>
            <hr>
            <p class="mt-3 mb-0"><strong>Special Note:</strong> <?= esc_html($specialNote) ?></p>
          <?php endif; ?>
        </div>
      </div>
    </div>


    <!-- Extra Options -->
    <div class="col-md-4">
      <div class="card px-0 shadow-sm border-0 h-100">
        <div class="card-header bg-warning text-dark fw-semibold">Extra Options</div>
        <div class="card-body">
          <p><strong>Handyman:</strong> <?= !empty($extras['is_handyman']) ? 'Yes' : 'No' ?></p>
          <p><strong>Handyman Description:</strong> <?= esc_html($extras['handyman_description'] ?? '-') ?></p>
          <p><strong>Move Lift:</strong> <?= !empty($extras['is_move_lift']) ? 'Yes' : 'No' ?></p>
          <p><strong>Full Service:</strong> <?= !empty($extras['is_full_service']) ? 'Yes' : 'No' ?></p>
        </div>
      </div>
    </div>

    <!-- Contact Info -->
    <div class="col-md-4">
      <div class="card px-0 shadow-sm border-0">
        <div class="card-header bg-success text-white fw-semibold">Contact Details</div>
        <div class="card-body">
          <p><strong>Name:</strong> <?= esc_html(trim(($contact['first_name'] ?? '') . ' ' . ($contact['middle_name'] ?? '') . ' ' . ($contact['last_name'] ?? '')) ?: '-') ?></p>
          <p><strong>Email:</strong> <?= esc_html($contact['email'] ?? '-') ?></p>
          <p><strong>Telephone:</strong> <?= esc_html($contact['telephone'] ?? '-') ?></p>
          <p><strong>Contact Preference:</strong> <?= esc_html($contact['contact_preference'] ?? '-') ?></p>
          <p><strong>Business Name:</strong> <?= esc_html($contact['business_name'] ?? '-') ?></p>
          <p><strong>KVK Number:</strong> <?= esc_html($contact['kvk_number'] ?? '-') ?></p>
        </div>
      </div>
    </div>

    <!-- Total Estimation -->
  <div class="col-md-4">
    <div class="card px-0 shadow-sm border-0 h-100">
      <div class="card-header bg-success text-white fw-semibold">Total Estimation</div>
      <div class="card-body">
        <p><strong>Loading Time:</strong><?= esc_html($total_estimation['loading_time'] ?? '-') ?></p>
        <p><strong>Travel Time:</strong> <?= esc_html($total_estimation['travel_time'] ?? '-') ?></p>
        <p><strong>Travel Cost:</strong> €<?= esc_html($total_estimation['travel_cost'] ?? '-') ?></p>
        <p><strong>Travel Distance:</strong> <?= esc_html($total_estimation['travel_distance'] ?? '-') ?> km</p>
        <p><strong>Unloading Time:</strong> <?= esc_html($total_estimation['unloading_time'] ?? '-') ?></p>
        <p><strong>Total Hours:</strong> <?= esc_html($total_estimation['total_hours'] ?? '-') ?></p>
        <p><strong>Cubic Meter:</strong> <?= esc_html($total_estimation['cubic_meter'] ?? '0') ?> m³</p>
        <p><strong>Estimated Price:</strong> €<?= esc_html(number_format($total_estimation['estimated_price'] ?? 0.00, 2)) ?> </p>
        <p><strong>Created At:</strong> 
            <?= esc_html( !empty($total_estimation['created_at']) ? mysql2date('F j, Y, g:i A', $total_estimation['created_at']) : '-' ) ?>
        </p>
        <p><strong>Updated At:</strong> 
            <?= esc_html( !empty($total_estimation['updated_at']) ? mysql2date('F j, Y, g:i A', $total_estimation['updated_at']) : '-' ) ?>
        </p>
      </div>
    </div>
  </div>



  </div>
</div>
