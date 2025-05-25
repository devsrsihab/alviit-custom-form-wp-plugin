jQuery(function ($) {
  let currentPage = 1;
  const perPage = 10;

  function load_alviit_cf_data(page = 1) {
    $.ajax({
      url: aitcf_ajax_url,
      type: "GET",
      data: {
        action: "alviit_cf_load_data_ajax_handler",
        param: "load_alviit_cf_data",
        page: page,
        limit: perPage,
      },
      success: function (response) {
        const tableBody = $("#alviit-cf-form-table-body");
        tableBody.empty();
        $("#alviit-cf-form-data-count").text(response?.data?.total);
        if (
          response.success &&
          response.data &&
          response.data.rows.length > 0
        ) {
          response.data.rows.forEach((entry, index) => {
            const row = `
            <tr>
              <td>${(page - 1) * perPage + index + 1}</td>
              <td>${entry?.full_name}</td>
              <td>${entry?.email}</td>
              <td>${entry?.telephone}</td>
              <td>${entry?.created_at}</td>
              <td>
                <a href="${aitcf_admin_url}?page=alviit-cf-view-record&alviitcrequestid=${
              entry?.request_id
            }" class="alviif-cf-view-btn btn btn-sm btn-primary">View</a>
                <button data-id="${
                  entry?.request_id
                }" class="alviif-cf-delete-btn btn btn-sm btn-danger">Delete</button>
              </td>
            </tr>
          `;
            tableBody.append(row);
          });

          renderPagination(response.data.total, page);
        } else {
          tableBody.append(
            '<tr><td colspan="6" class="text-center">No data found.</td></tr>'
          );
          $("#pagination").empty();
        }
      },
    });
  }

  function renderPagination(totalItems, currentPage) {
    const totalPages = Math.ceil(totalItems / perPage);
    const paginationContainer = $("#pagination");
    paginationContainer.empty();

    for (let i = 1; i <= totalPages; i++) {
      const btn = $(
        `<button class="btn btn-sm btn-outline-primary mx-1">${i}</button>`
      );
      if (i === currentPage) {
        btn.addClass("active");
      }
      btn.on("click", function () {
        load_alviit_cf_data(i);
      });
      paginationContainer.append(btn);
    }
  }
  load_alviit_cf_data();

  // Delete function
  jQuery(document).on("click", ".alviif-cf-delete-btn", function () {
    if (confirm("Are you sure want to delete?")) {
      // true
      var request_id = jQuery(this).attr("data-id");

      var deleteFormData =
        "action=alviit_cf_delete_data_ajax_handler&param=delete_alviit_cf_data&request_id=" +
        request_id;

      jQuery.ajax({
        url: aitcf_ajax_url,
        data: deleteFormData,
        method: "POST",
        success: function (response) {
          console.log("delete response", response);

          // var data = jQuery.parseJSON(response);

          toastr.success(response?.data?.message);

          setTimeout(function () {
            location.reload();
          }, 500);
        },
        error: function () {
          toastr.error("An error occurred while deleting the student.");
        },
      });
    }
  });

  const target = $('li a:contains("VIEW_RECORD")').filter(function () {
    return $(this).text().trim() === "VIEW_RECORD";
  });

  if (target.length) {
    target.closest("li").hide();
  }
});
