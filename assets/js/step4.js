jQuery(function ($) {
  const $handymanSwitch = $("#handymanSwitch");
  const $handymanDescription = $("#handymanDescription");
  const $handymanInfo = $("#handymanInfo");
  const $step4Alert = $("#step-4-alert");

  $(".card-clickable").on("click", function (e) {
    // Ignore interactive elements
    const tag = e.target.tagName;
    if (
      ["INPUT", "TEXTAREA", "LABEL", "BUTTON"].includes(tag) ||
      $(e.target).closest("label").length
    ) {
      return;
    }

    const $checkbox = $(this).find('input[type="checkbox"]');

    if ($checkbox.length) {
      // ✅ Skip if checkbox is disabled
      if ($checkbox.prop("disabled")) {
        return;
      }

      const isChecked = $checkbox.prop("checked");
      const willBeChecked = !isChecked;
      $checkbox.prop("checked", willBeChecked);

      if ($checkbox.attr("id") === "handymanSwitch") {
        $handymanDescription.toggleClass("d-none", !willBeChecked);
        $handymanInfo.toggleClass("d-none", willBeChecked);
      }

      // Show or hide #step-4-alert based on current state of handymanSwitch
      if ($handymanSwitch.prop("checked")) {
        $step4Alert.removeClass("d-none");
      } else {
        $step4Alert.addClass("d-none");
      }
    }
  });
});
