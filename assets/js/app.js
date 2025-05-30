jQuery(function ($) {
  // Date range picker for date-period input
  $('input[name="date-period"]').daterangepicker({
    opens: "bottom",
    autoUpdateInput: false, // Prevent automatic input value
  });

  // When a date is selected in date-period
  $('input[name="date-period"]').on("apply.daterangepicker", function (ev, picker) {
    $(this).val(
      picker.startDate.format("MM/DD/YYYY") + " - " + picker.endDate.format("MM/DD/YYYY")
    );

    // Show preferred-date and start-time when value is set
    $("#preferred-date, #start-time").show();
  });

  // Clear date-period input
  $('input[name="date-period"]').on("cancel.daterangepicker", function (ev, picker) {
    $(this).val("");
  });

  const $preferredDateInput = $('input[name="preferred-date"]');

  $preferredDateInput.daterangepicker({
    opens: "bottom",
    autoUpdateInput: false,
  });

  // Show preferred-date and start-time on apply
  $preferredDateInput.on("apply.daterangepicker", function (ev, picker) {
    $(this).val(picker.startDate.format("MM/DD/YYYY"));
    
    // Trigger the desired show behavior
    $("#preferred-date, #start-time").show();
  });

  // Optionally open the date picker immediately on page load
  $preferredDateInput?.data("daterangepicker")?.show();
});
