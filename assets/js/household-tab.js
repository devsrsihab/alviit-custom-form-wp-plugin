jQuery(function ($) {
  // Handle all decrease buttons
  $(".btn-decrease").on("click", function (e) {
    e.preventDefault();
    const $input = $(this).parent().find(".quantity-input");
    const current = parseInt($input.val()) || 0;
    $input.val(Math.max(0, current - 1));
    calculateTotalM3();
  });
  $(".alviit_cf_item_quantity").on("input", function () {
    calculateTotalM3();
  });

  // Handle all increase buttons
  $(".btn-increase").on("click", function (e) {
    e.preventDefault();
    const $input = $(this).parent().find(".quantity-input");
    const current = parseInt($input.val()) || 0;
    $input.val(current + 1);
    calculateTotalM3();
  });

  // Function to sum the m3 values
  function calculateTotalM3() {
    let totalM3 = 0;

    $("input[input-of]").each(function () {
      const $input = $(this);
      const m3 = parseFloat($input.data("m3")) || 0; // Get the m3 value from the data attribute
      const qty = parseInt($input.val(), 10) || 0; // Get the quantity from the input value

      totalM3 += m3 * qty; // Sum the m3 values, multiplying by quantity
    });

    // Display the total m3 in the elements
    $("#calc-volume").text(totalM3.toFixed(1));
    $("#totalVolume2").text(totalM3.toFixed(1));

    return totalM3; // Return the total m3 value
  }
});
