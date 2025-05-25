<?php 
  $aitcf_nonce = wp_create_nonce("wp_nonce_aitcf_househol_option");
?>

<div class="container mt-4">
  <!-- Header -->
  <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 p-4 mb-4 bg-light border rounded shadow-sm">
    <div>
      <h3 class="mb-1 fw-bold">Household Options</h3>
      <p class="mb-0 text-muted">Below is the detailed summary of the Household options data.</p>
    </div>
    <a href="<?= esc_url(admin_url('admin.php?page=alviit-cf-households-options&action-page=household-option-list')) ?>" class="btn btn-success">View Options</a>
  </div>

  <!-- Show alert if message exists -->
  <?php if (isset($_GET['msg']) && $_GET['msg'] === 'success'): ?>
    <div class="alert alert-success">Form submitted successfully.</div>
  <?php elseif (isset($_GET['msg']) && $_GET['msg'] === 'error'): ?>
    <div class="alert alert-danger"><?= esc_html($_GET['error'] ?? 'An error occurred.') ?></div>
  <?php endif; ?>

  <form class="container mt-4" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
    <input type="hidden" name="action" value="alviit_cf_handle_form_submission">
    <input type="hidden" name="nonce" value="<?php echo esc_attr($aitcf_nonce); ?>">
    <input type="hidden" name="request_id" value="YOUR_REQUEST_ID">

    <div class="row mb-3">
      <label for="room_type" class="col-sm-2 col-form-label">Room Type</label>
      <div class="col-sm-10">
        <select class="form-control" id="room_type" name="room_type" required>
          <option value="">Select Room Type</option>
          <option value="LIVING ROOM">Living Room</option>
          <option value="BEDROOM">Bedroom</option>
          <option value="BATHROOM">Bathroom</option>
          <option value="THE STUDY">The Study</option>
          <option value="KITCHEN">Kitchen</option>
          <option value="SHED">Shed</option>
          <option value="GARDEN">Garden</option>
          <option value="ATTIC">Attic</option>
          <option value="OTHER">Other</option>
        </select>
      </div>
    </div>

    <div class="row mb-3">
      <label for="item_name" class="col-sm-2 col-form-label">Item Name</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="item_name" name="item_name" required>
      </div>
    </div>

    <div class="row mb-3">
      <label for="m3_value" class="col-sm-2 col-form-label">Cubic Meter Value (m³)</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" id="m3_value" name="m3_value" step="any min="0" value="0">
      </div>
    </div>

    <div class="row">
      <div class="col-sm-10 offset-sm-2">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </form>
</div>
