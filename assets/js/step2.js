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
      $("#preferred-date, #start-time").show();
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
});
