<div class="container py-4">
<!-- Elegant Header Panel for Form Data -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 p-4 mb-4 bg-white border rounded shadow-sm">
    <div>
        <h4 class="mb-1">Submitted Form Data</h4>
        <p class="mb-0 text-muted">
            Form Shortcode
            <strong  class="text-primary ">[alviit_cf_form]</strong> 
            use this shortcode to display the form on your website.
        </p>
        <p class="mb-0 text-muted">
            Below is the list of form submissions received through the system. 
            <strong id="alviit-cf-form-data-count" class="text-primary fs-3">0</strong> entries in total.
        </p>
    </div>

</div>



  <!-- Responsive Table for Form Data -->
  <div class="table-responsive">
    <table id="alviit-cf-form-table" class="table table-hover table-bordered align-middle">
        <thead class="table-light">
            <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Submitted At</th>
            <th>Actions</th>
            </tr>
        </thead>
        <tbody id="alviit-cf-form-table-body">
            
        </tbody>

        
    </table>
    <div id="pagination" class="mt-3 text-center"></div>
  </div>
</div>
