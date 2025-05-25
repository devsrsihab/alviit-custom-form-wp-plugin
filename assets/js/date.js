jQuery(function ($) {
  let currentDate = new Date();
  let selectedDate = null;

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
        $("#preferred-date-hidden").val(selectedDate);
      });

      row.append(cell);

      if ((firstDay + day) % 7 === 0 || day === daysInMonth) {
        $calendarBody.append(row);
        row = $("<tr></tr>");
      }
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
