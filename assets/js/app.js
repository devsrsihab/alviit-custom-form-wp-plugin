jQuery(function ($) {
  $('input[name="date-period"]').daterangepicker({
    opens: "bottom",
    autoUpdateInput: false, // Prevent automatic input value
  });

  // Optionally update the input manually when a date range is selected
  $('input[name="date-period"]').on(
    "apply.daterangepicker",
    function (ev, picker) {
      $(this).val(
        picker.startDate.format("MM/DD/YYYY") +
          " - " +
          picker.endDate.format("MM/DD/YYYY")
      );
    }
  );

  // Clear the input when the cancel button is used
  $('input[name="date-period"]').on(
    "cancel.daterangepicker",
    function (ev, picker) {
      $(this).val("");
    }
  );

  const $input = $('input[name="preferred-date"]');

  $input.daterangepicker({
    opens: "bottom",
    autoUpdateInput: false,
  });

  // Open the date picker immediately on page load
  $input?.data("daterangepicker")?.show();
});
