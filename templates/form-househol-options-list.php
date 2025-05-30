<?php 
  global $wpdb;

  // Table and nonce setup
  $table = $wpdb->prefix . 'alviit_cf_household_rooms';
  $aitcf_nonce = wp_create_nonce("wp_nonce_aitcf_househol_option");

  // Handle deletion
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['aitcf_delete_id']) && isset($_POST['aitcf_nonce'])) {
    if (wp_verify_nonce($_POST['aitcf_nonce'], 'wp_nonce_aitcf_househol_option')) {
      $delete_id = intval($_POST['aitcf_delete_id']);
      $wpdb->delete($table, ['id' => $delete_id]);
      echo '<div class="container mt-3"><div class="alert alert-success">Item deleted successfully.</div></div>';
    } else {
      echo '<div class="container mt-3"><div class="alert alert-danger">Security check failed.</div></div>';
    }
  }

  // Fetch and group data
  $results = $wpdb->get_results("SELECT * FROM $table ORDER BY created_at DESC");

  $grouped = [];
  foreach ($results as $row) {
    $type = strtoupper(trim($row->room_type));
    $grouped[$type][] = $row;
  }

  $room_types = [
  'WOONKAMER' => 'primary',        // LIVING ROOM
  'SLAAPKAMER' => 'success',       // BEDROOM
  'BADKAMER' => 'info',            // BATHROOM
  'STUDEERKAMER' => 'warning',     // STUDY
  'KEUKEN' => 'danger',            // KITCHEN
  'SCHUUR' => 'secondary',         // SHED
  'TUIN' => 'dark',                // GARDEN
  'ZOLDER' => 'light',             // ATTIC
  'OVERIG' => 'custom-other'       // OTHER
  ];
?>

<div class="container mt-4">
  <!-- Header -->
  <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 p-4 mb-4 bg-light border rounded shadow-sm">
    <div>
      <h3 class="mb-1 fw-bold">📋 Household Items List</h3>
      <p class="mb-0 text-muted">Below is the detailed summary of the Household options data.</p>
    </div>
    <a href="<?= esc_url(admin_url('admin.php?page=alviit-cf-households-options')) ?>" class="btn btn-primary">Add New Item</a>
  </div>

  <?php if ($results): ?>
    <!-- Tabs -->
    <ul class="nav nav-pills mb-3" id="roomTabs" role="tablist">
      <?php
        $i = 0;
        foreach ($room_types as $type => $color):
          if (!isset($grouped[$type])) continue;
          $textColor = in_array($color, ['light', 'muted']) ? 'text-dark' : 'text-white';
      ?>
        <li class="nav-item" role="presentation">
          <button 
            class="nav-link <?= $i === 0 ? 'active' : '' ?> <?= $textColor ?> bg-<?= $color ?> me-2" 
            id="tab-<?= $i ?>" 
            data-bs-toggle="pill" 
            data-bs-target="#room-<?= $i ?>" 
            type="button" 
            role="tab">
            <?= esc_html($type) ?>
          </button>
        </li>
      <?php $i++; endforeach; ?>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content bg-white rounded shadow-sm" id="roomTabContent">
      <?php
        $i = 0;
        foreach ($room_types as $type => $color):
          if (!isset($grouped[$type])) continue;
      ?>
        <div class="tab-pane fade <?= $i === 0 ? 'show active' : '' ?>" id="room-<?= $i ?>" role="tabpanel">
          <div class="table-responsive">
            <table class="table table-bordered table-hover mb-0">
              <thead class="table-<?= $color ?>">
                <tr>
                  <th>Item Name</th>
                  <th>Cubic Meter (m³)</th>
                  <th>Created At</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($grouped[$type] as $item): ?>
                  <tr>
                    <td><?= esc_html($item->item_name) ?></td>
                    <td><?= esc_html($item->m3_value) ?></td>
                    <td><?= date('M d, Y', strtotime($item->created_at)) ?></td>
                    <td>
                      <form method="post" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this item?');">
                        <input type="hidden" name="aitcf_delete_id" value="<?= esc_attr($item->id) ?>">
                        <input type="hidden" name="aitcf_nonce" value="<?= esc_attr($aitcf_nonce) ?>">
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                      </form>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      <?php $i++; endforeach; ?>
    </div>
  <?php else: ?>
    <div class="alert alert-info">No household items found.</div>
  <?php endif; ?>
</div>
