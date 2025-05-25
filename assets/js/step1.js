jQuery(function ($) {
  // Handle card clicks globally
  $(".card-clickable").on("click", function (e) {
    const card = $(this);
    const isDisabled = $("#movingLiftSwitch").prop("disabled");

    // Only apply restriction to the specific card
    if (card.is("#movingLiftClickableCard") && isDisabled) {
      e.preventDefault(); // prevent label / input toggle
      return; // stop toggle
    }

    // Proceed with visual toggle
    card.toggleClass("border-primary bg-light");
  });

  // Handle floor number changes
  $("#floorNumber, #floorNumber_a_b").on("change", function () {
    const isFloorAB = this.id === "floorNumber_a_b";

    // Use correct IDs based on which dropdown was changed
    const isLiftWrapper = isFloorAB
      ? $("#isLiftWrapper_a_b")
      : $("#isLiftWrapper");
    const movingLiftNotPossibleAlert = $("#movingLiftNotPossibleAlert");
    const movingLiftSwitch = $("#movingLiftSwitch");
    const selectedFloor = $(this).val();

    // Show or hide lift wrapper
    if (
      selectedFloor !== "Ground floor" &&
      selectedFloor !== "Short flight of entrance stairs"
    ) {
      isLiftWrapper.removeClass("d-none");
    } else {
      isLiftWrapper.addClass("d-none");
    }

    // Parse floor number
    let floorNum = null;
    const floorRegex = /^(\d+)(st|nd|rd|th)\s+floor$/i;
    const match = selectedFloor.match(floorRegex);
    if (match) {
      floorNum = parseInt(match[1]);
    } else if (selectedFloor === "10+ floor") {
      floorNum = 10;
    }

    // Floor logic
    if (floorNum !== null && floorNum > 5) {
      movingLiftNotPossibleAlert.removeClass("d-none");
      movingLiftSwitch.prop("checked", false);
      movingLiftSwitch.prop("disabled", true);

      const card = $("#movingLiftClickableCard");
      if (card.hasClass("border-primary") && card.hasClass("bg-light")) {
        card.removeClass("border-primary bg-light");
      }
    } else {
      movingLiftNotPossibleAlert.addClass("d-none");
      movingLiftSwitch.prop("disabled", false);
    }
  });
});
