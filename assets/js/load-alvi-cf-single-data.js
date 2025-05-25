jQuery(function ($) {
  // ... your existing code

  // Use event delegation for dynamically created elements
  $(document).on("click", ".alviif-cf-view-btn", function () {
    console.log("View button clicked!");
  });

  // ... rest of your code
});
