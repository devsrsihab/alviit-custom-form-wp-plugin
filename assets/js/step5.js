jQuery(function ($) {
  const $isBusinessCheckbox = $("#isBusiness");
  const $isBusinessSection = $("#isBusinessSection");

  // Toggle on checkbox change
  $isBusinessCheckbox.on("change", function () {
    if (this.checked) {
      $isBusinessSection.removeClass("d-none");
    } else {
      $isBusinessSection.addClass("d-none");
      $("#businessName").val("");
      $("#kvkNumber").val("");
    }
  });

  // Optional: Run once on page load in case the checkbox is pre-checked
  if ($isBusinessCheckbox.prop("checked")) {
    $isBusinessSection.removeClass("d-none");
  }
});
