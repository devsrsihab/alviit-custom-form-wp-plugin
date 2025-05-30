jQuery(function ($) {
  let currentDate = new Date();
  let selectedDate = null;


    // Function to format date as "10 jun. 2025"
  function formatDateToDutchStyle(date) {
    const months = ["jan.", "feb.", "mrt.", "apr.", "mei", "jun.", "jul.", "aug.", "sep.", "okt.", "nov.", "dec."];
    const d = new Date(date);
    const day = d.getDate();
    const month = months[d.getMonth()];
    const year = d.getFullYear();
    return `${day} ${month} ${year}`;
  }

  function renderCalendar(date) {
    const year = date.getFullYear();
    const month = date.getMonth();
    const today = new Date();
    const firstDay = new Date(year, month, 1).getDay();
    const daysInMonth = new Date(year, month + 1, 0).getDate();

    $("#monthYear").text(
      date.toLocaleString("default", { month: "long", year: "numeric" })
    );
    const $calendarBody = $("#calendar-body");
    $calendarBody.empty();
    let row = $("<tr></tr>");

    for (let i = 0; i < firstDay; i++) {
      row.append("<td></td>");
    }

    for (let day = 1; day <= daysInMonth; day++) {
      const cell = $("<td></td>").text(day);

      if (
        day === today.getDate() &&
        month === today.getMonth() &&
        year === today.getFullYear()
      ) {
        cell.addClass("today");
      }

      cell.on("click", function () {
        $("td.selected").removeClass("selected");
        $(this).addClass("selected");
        selectedDate = `${String(day).padStart(2, "0")}-${String(
          month + 1
        ).padStart(2, "0")}-${year}`;
        console.log("Selected Date:", selectedDate);

        if (month !== undefined && year !== undefined) {
          const selectedDate = new Date(year, month, day);
          const formattedDate = formatDateToDutchStyle(selectedDate);

            $("#preferred-date-hidden").val(selectedDate);

          $('#calc-date').text(formattedDate);
        }
        
      });

      row.append(cell);

      if ((firstDay + day) % 7 === 0 || day === daysInMonth) {
        $calendarBody.append(row);
        row = $("<tr></tr>");
      }

      // Listen for changes in time select
      $('#start-time-select').on('change', function () {
        const selectedTime = $(this).val();
        $('#calc-time').text(selectedTime);
      });



    }
  }

  $("#prevMonth").on("click", function (e) {
    e.preventDefault();
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar(currentDate);
  });

  $("#nextMonth").on("click", function (e) {
    e.preventDefault();
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar(currentDate);
  });

  renderCalendar(currentDate);
});
