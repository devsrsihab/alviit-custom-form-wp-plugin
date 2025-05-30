jQuery(function ($) {
  let aitcfcurrentStep = 1;
  let aitcfFormAllData = {};
  let travelTime = 0;
  let travelCost = 0;
  let totalPrice = 0;
  let addressObj = {};

  const stepWidths = {
    1: 8.33333,
    2: 25,
    3: 41.6667,
    4: 58.3333,
    5: 75,
    6: 100,
  };

  // Format date to short month
  function formatDateToShortMonth(dateStr) {
    if (!dateStr) {
      return "Not Exist";
    }
    const [day, month, year] = dateStr.split("-");
    const monthNames = [
      "Jan.",
      "Feb.",
      "Mar.",
      "Apr.",
      "May.",
      "Jun.",
      "Jul.",
      "Aug.",
      "Sep.",
      "Oct.",
      "Nov.",
      "Dec.",
    ];
    return `${parseInt(day)} ${monthNames[parseInt(month) - 1]} ${year}`;
  }

  // Function to validate a specific step
  function validateStep(stepNumber) {
    const $step = $(`#step-${stepNumber}`);
    const $inputs = $step.find("input[required], select[required], textarea[required]");
    let valid = true;

    $inputs.each(function () {
      const value = $(this).val()?.trim();
      $(this).siblings(".invalid-feedback").remove(); // Remove previous error

      if (!value) {
        $(this).addClass("is-invalid");
        $(this).after('<div class="invalid-feedback">This field is required.</div>');
        valid = false;
      } else {
        $(this).removeClass("is-invalid");
      }
    });

    return valid;
  }

  // Unified show step function
  function showStep(step) {
    $(".step").removeClass("active").hide();
    $(`#step-${step}`).addClass("active").show();

    $(".indicator").each(function (index) {
      const stepIndex = index + 1;
      $(this).removeClass("active bg-secondary");
      if (stepIndex < step) {
        $(this).addClass("bg-secondary");
      } else if (stepIndex === step) {
        $(this).addClass("active");
      }
    });

    $(".indicator-wrapper").removeClass("active");
    $(`#indicator-wrapper-${step}`).addClass("active");

    const widthPercentage = stepWidths[step] || 0;
    const $progressBar = $("#aitcf-progress-bar .progress-bar");
    $progressBar.css("width", `${widthPercentage}%`);
    $progressBar.attr("aria-valuenow", widthPercentage.toFixed(1));
    $progressBar.attr("aria-valuetext", `${Math.round(widthPercentage)}%`);

    aitcfcurrentStep = step;
  }

  // Function to go to a target step after validating previous ones
  function goToStep(targetStep) {
    let allValid = true;

    for (let i = 1; i < targetStep; i++) {
      if (!validateStep(i)) {
        showStep(i);
        allValid = false;
        return;
      }
    }

    if (allValid) {
      showStep(targetStep);

      // Call form data functions by step
      if (targetStep === 2) {
        stepm1FormData();
        calculateTravel(addressObj.fromAddress, addressObj.toAddress);
      }
      if (targetStep === 3) stepm2FormData();
      if (targetStep === 4) stepm3FormData();
      if (targetStep === 5) stepm4FormData();
      if (targetStep === 6) stepm5FormData();

      calculations();
    }
  }

  // Step 1 data
  function stepm1FormData() {
    const fromAddress = {
      country: $("#country").val(),
      postal: $("#postal").val(),
      houseNumber: $("#houseNumber").val(),
      addition: $("#addition").val(),
      city: $("#city").val(),
      street: $("#street").val(),
      floorNumber: $("#floorNumber").val(),
      isLiftAvailable: $("#isLiftAvailable").is(":checked"),
      jobDescription: $("#jobDescription").val(),
    };

    const toAddress = {
      country: $("#country_a_b").val(),
      postal: $("#postal_a_b").val(),
      houseNumber: $("#houseNumber_a_b").val(),
      addition: $("#addition_a_b").val(),
      city: $("#city_a_b").val(),
      street: $("#street_a_b").val(),
      floorNumber: $("#floorNumber_a_b").val(),
      isLiftAvailable: $("#isLiftAvailable_a_b").is(":checked"),
      jobDescription: $("#jobDescription_a_b").val(),
    };

    const step1Data = { fromAddress, toAddress };
    console.log("Step 1 form data:", step1Data);

    addressObj = { ...addressObj, ...step1Data };

    // Merge into global form data
    aitcfFormAllData = {
      ...aitcfFormAllData,
      ...step1Data,
    };

    return step1Data;
  }

  // Step 2 data
  function stepm2FormData() {
    const preferred_date = {
      dateFlexibility: $("#dateFlexibility").val(),
      datePeriod: $("#date-period").val(),
      preferredDate: $("#preferred-date-hidden").val(),
      startTime: $("#start-time-select").val(),
    };
    console.log("step 2 form data", preferred_date);
    aitcfFormAllData = { ...aitcfFormAllData, preferred_date };
    return preferred_date;
  }

  // Step 3 data
  function stepm3FormData() {
    const household = {};

    $("input[input-of]").each(function () {
      const $input = $(this);
      const tabKey = $input.attr("input-of"); // e.g., LIVING_ROOM
      const id = parseInt($input.data("id"), 10); // Requires data-id="23" in HTML
      const qty = parseInt($input.val(), 10) || 0;

      if (qty > 0 && id) {
        if (!household[tabKey]) {
          household[tabKey] = [];
        }

        household[tabKey].push({ id, qty });
      }
    });

    // Optionally keep specialObject separately if needed elsewhere
    const specialObject = $("#specialObject").val();
    aitcfFormAllData = { ...aitcfFormAllData, household };
    console.log("step 3 form data (new format)", household);
    return household;
  }

  // Step 4 data
  function stepm4FormData() {
    const extra_options = {};
    $("#step-4 input[name], #step-4 textarea[name]").each(function () {
      const $el = $(this);
      const key = $el.attr("name");
      extra_options[key] = $el.is(":checkbox")
        ? $el.prop("checked")
        : $el.val().trim();
    });
    console.log("step 4 form data", extra_options);
    aitcfFormAllData = { ...aitcfFormAllData, extra_options };
    return extra_options;
  }

  // Step 5 data
  function stepm5FormData() {
    const contact_details = {};
    $("#step-5 [name]").each(function () {
      const $el = $(this);
      const key = $el.attr("name");
      contact_details[key] = $el.is(":checkbox")
        ? $el.prop("checked")
        : $el.val().trim();
    });
    console.log("step 5 form data", contact_details);
    aitcfFormAllData = { ...aitcfFormAllData, contact_details };
    return contact_details;
  }

  // Extra options
  function calculationExtraOption() {
    const toggles = [
      {
        input: "#handymanSwitch",
        checkIcon: "#checkedHandyman",
        crossIcon: "#crossHandyman",
      },
      {
        input: "#movingLiftSwitch",
        checkIcon: "#checkedMovingLift",
        crossIcon: "#crossMovingLift",
      },
      {
        input: "#fullServiceSwitch",
        checkIcon: "#checkedFullService",
        crossIcon: "#crossFullService",
      },
    ];

    toggles.forEach(({ input, checkIcon, crossIcon }) => {
      const isChecked = $(input).is(":checked");
      $(checkIcon).toggle(isChecked);
      $(crossIcon).toggle(!isChecked);
    });
  }

  // tranvel calculation
  const API_KEY = "5b3ce3597851110001cf62486640910e307a4feeb78ae69f314e5c42";

  // Format full address from object
  function formatAddress(address) {
    return `${address?.street}, ${address?.city}, ${address?.country}`;
  }

  // Convert degrees to radians
  function toRadians(degrees) {
    return degrees * (Math.PI / 180);
  }

  // Haversine distance (in km)
  function haversineDistance(lat1, lon1, lat2, lon2) {
    const R = 6371;
    const dLat = toRadians(lat2 - lat1);
    const dLon = toRadians(lon2 - lon1);
    const a =
      Math.sin(dLat / 2) ** 2 +
      Math.cos(toRadians(lat1)) *
        Math.cos(toRadians(lat2)) *
        Math.sin(dLon / 2) ** 2;
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    return R * c;
  }

  // Get coordinates from OpenRouteService
  async function getCoordinates(addressText) {
    const url = `https://api.openrouteservice.org/geocode/search?api_key=${API_KEY}&text=${encodeURIComponent(
      addressText
    )}`;
    const response = await fetch(url);
    const data = await response.json();
    const coords = data.features[0]?.geometry.coordinates; // [lon, lat]
    if (!coords) throw new Error("No coordinates found");
    return { lat: coords[1], lon: coords[0] };
  }

  // Main calculation function
  async function calculateTravel(fromAddress, toAddress) {
    try {
      const fromFull = formatAddress(fromAddress);
      const toFull = formatAddress(toAddress);

      const fromCoords = await getCoordinates(fromFull);
      const toCoords = await getCoordinates(toFull);

      const distance = haversineDistance(
        fromCoords.lat,
        fromCoords.lon,
        toCoords.lat,
        toCoords.lon
      );
      const speed = 60; // km/h
      travelTime = distance / speed; // convert to minutes
      travelCost = distance * 1; // 1 euro/km
      // showring the travel time
      $("#calc_travel_time").text(`${travelTime.toFixed(2)}`);
      $("#calc_travel_cost").text(`€${travelCost.toFixed(2)}`);

      console.log(`Distance: ${distance.toFixed(2)} km`);
      console.log(`Travel Time: ${travelTime.toFixed(2)} hours`);
      console.log(`Travel Cost: €${travelCost.toFixed(2)}`);
    } catch (error) {
      console.error("Error:", error.message);

      // Return defaults
      $("#calc_travel_time").text("0.00");
      $("#calc_travel_cost").text("€0.00");
    }
  }

  // Final calculation
  function calculations() {
    // Same constants as backend
    const baseVolume = 2.5;
    totalPrice = 0;
    const basePrice = 301.8;
    const extraStepPrice = 9.36;
    const baseTimeMin = 120;
    const stepVolume = 0.5;
    const stepTime = 2; // per 0.5 m³
    const volume = parseFloat($("#calc-volume").text()) || 0;

    // Use floor instead of ceil
    const extraVolume = Math.max(volume - baseVolume, 0);
    const extraSteps = Math.floor(extraVolume / stepVolume);

    const extraLoadMin = extraSteps * stepTime;
    const extraUnloadMin = extraSteps * stepTime;
    const loadTime = extraLoadMin + 2; // buffer 2 min
    const unloadTime = extraUnloadMin + 2; // buffer 2 min
    const travelTimeMin = travelTime * 60;
    const totalTimeMin = baseTimeMin + loadTime + unloadTime + travelTimeMin;

    const extraVolumeCost = extraSteps * extraStepPrice;
    totalPrice = basePrice + extraVolumeCost + travelCost;

    function toHHMM(minutes) {
      const totalMinutes = Math.round(minutes); // Round to nearest minute
      const h = Math.floor(totalMinutes / 60)
        .toString()
        .padStart(2, "0");
      const m = (totalMinutes % 60).toString().padStart(2, "0");
      return `${h}:${m}`;
    }
    $("#calc_loading_time").text(toHHMM(loadTime));
    $("#calc_unloading_time").text(toHHMM(unloadTime));
    $("#calc_travel_time").text(travelTime.toFixed(2).padStart(5, "0")); // ✅ fixed
    $("#calc_total_hours").text(toHHMM(totalTimeMin)); // ✅ fixed
    $("#calc_total_price").html(`€&nbsp;${totalPrice.toFixed(2)}`);

    calculationExtraOption();
  }

  // Next step
  $(".aitcf-nextstep-btn").on("click", function () {
    nextStep();
    console.log("form all data ==>", aitcfFormAllData);
  });
  
  function nextStep() {
    if (validateStep(aitcfcurrentStep)) {
      if (aitcfcurrentStep < 6) {
        goToStep(aitcfcurrentStep + 1);
      }
    }
  }

  // Previous step
  $(".aitcf-prevstep-btn").on("click", function () {
    prevStep();
  });
  
  function prevStep() {
    if (aitcfcurrentStep > 1) {
      showStep(aitcfcurrentStep - 1);
    }
  }

  // Bind click event on step indicators
  $(".indicator-wrapper.pointer").on("click", function () {
    const id = $(this).attr("id"); // e.g., indicator-wrapper-3
    const stepNumber = parseInt(id.split("-").pop(), 10); // Get 3
    if (!isNaN(stepNumber)) {
      goToStep(stepNumber);
    }
  });

  // On DOM ready
  showStep(1);
  console.log("aitcfcurrentStep", aitcfcurrentStep);

  $("#aitcf-multiStepForm").on("submit", function (e) {
    e.preventDefault();
    const $submitBtn = $("#btn-aitcf-multiStepForm");

    if (!validateStep(aitcfcurrentStep)) {
      return;
    }

    // Disable button and show spinner
    $submitBtn.prop("disabled", true);
    const originalBtnText = $submitBtn.html();
    $submitBtn.html(
      `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Submitting...`
    );

    console.log("see form data", aitcfFormAllData);
    const alviit_nonce = $("#wp_nonce_alviitcf_msf").val();

    jQuery.ajax({
      url: aitcf_ajax_url,
      type: "POST",
      data: {
        action: "alviit_cf_submit_ajax_handler",
        nonce: alviit_nonce,
        param: "save_form",
        payload: JSON.stringify(aitcfFormAllData),
      },
      success: function (response) {
        if (response?.data?.success) {
          toastr.success(response?.data?.message, "Success!");
          setTimeout(() => {
            if (aitcf_has_thank_you_page) {
              window.location.href = "/thank-you";
            } else {
              window.location.reload();
            }
          }, 1000);
        }
        console.log("server success Res", response);
      },
      error: function (error) {
        const serverErrJsonRes = error.responseJSON;
        if (!serverErrJsonRes?.data?.success) {
          toastr.error(serverErrJsonRes?.data?.message, "Error!");
        }
        console.log("server Error", serverErrJsonRes);
      },
      complete: function () {
        // Restore button state
        $submitBtn.prop("disabled", false);
        $submitBtn.html(originalBtnText);
      },
    });
  });
});