jQuery(function ($) {
  function updateDateFields() {
    const selected = $("#dateFlexibility").val();
    console.log("selected values", selected);

    if (selected === "unknown") {
      $("#preferred-date, #start-time").hide();
      $("#date-period").val("");
      $("#start-time-select").val("17:30");
      $("#preferred-date-hidden").val("");
      $("#date-period-wrapper").addClass("d-none-important");
    } else if (selected === "estimate") {
      // $("#preferred-date, #start-time").show();
            $("#preferred-date, #start-time").hide();
      $("#date-period-wrapper").removeClass("d-none-important");
    } else if (selected === "certain") {
      $("#date-period-wrapper").addClass("d-none-important");
      $("#date-period").val("");
      $("#preferred-date, #start-time").show();
    }
  }

  // Initial check on page load
  updateDateFields();

  // Trigger on change
  $("#dateFlexibility").on("change", updateDateFields);


    // Listen for input or change on #date-period
  $('#date-period').on('input change', function () {
    const value = $(this).val().trim();

    if (value !== '') {
      $("#preferred-date, #start-time").show();
    } else {
      $("#preferred-date, #start-time").hide(); // Optional: hide if empty
    }
  });
});
