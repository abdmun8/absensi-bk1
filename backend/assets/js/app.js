var halaman = "";
var menuActive = "Siswa";

$(document).ready(function () {
  init();
  if (halaman == "") {
    loadPage();
  }
});

/**
 * Page initialization
 */
function init() {
  $("#header-menu")
    .children()
    .each(function (index, item) {
      item.addEventListener("click", function () {
        let textMenu = this.children[0].innerHTML;
        changeMenu(textMenu);
      });
    });
}

/**
 * Load page
 * @param {string} page page want to load
 * @param {object} param Parameter object
 */
function loadPage(page = "siswa/data", param = null) {
  if (param) {
    return $(".dynamic").load(
      `view/${page}.php${objectToQueryString(param, true)}`
    );
  }

  return $(".dynamic").load(`view/${page}.php`);
}

/**
 * Change active menu
 * @param {string} currentMenu menu text that want to highlight
 */
function changeMenu(currentMenu = "Siswa") {
  if (currentMenu == menuActive) return;
  $("#header-menu")
    .children()
    .each((index, item) => {
      let textMenu = item.children[0].innerHTML;
      if (textMenu == menuActive) {
        item.classList.remove("active");
      }

      if (textMenu == currentMenu) {
        item.classList.add("active");
      }
    });
  menuActive = currentMenu;
  switch (currentMenu) {
    case "Nilai Kelas":
      currentMenu = "nilai_kelas";
      break;
    case "Nilai Siswa":
      currentMenu = "nilai_siswa";
      break;
    case "Cluster Data Siswa":
      currentMenu = "clustering";
      break;
  }
  loadPage(currentMenu.toLowerCase() + "/data");
}

/**
 *
 * @param {array} formField form field
 */
function clearForm(formField) {
  formField.forEach(function (item, index) {
    $(`#${item}`).val("");
  });
}

/**
 * promised jquery ajax
 * @param {string} url url
 * @param {string} method GET | POST
 * @param {object} params params on GET or body on POST
 */
function req(url, method = "GET", params) {
  return new Promise(function (resolve, reject) {
    $.ajax({
      url: url ? url : base_url,
      dataType: "json",
      data: params,
      method: method,
      success: function (res, status, xhr) {
        if (res.success) {
          resolve(res);
        } else {
          reject(res);
        }
      },
      error: function (xhr, status, err) {
        reject(err);
      },
    });
  });
}

/**
 * Delete data and refresh datatable
 * @param {string} table table name
 * @param {string|number} id id
 * @param {object} datatabel DataTable Object
 */
function deleteData(table, id, dt) {
  var data = {
    id: id,
    table: table,
    action: "delete",
  };
  req(base_url, "POST", data)
    .then((res) => {
      alert(res.msg);
      dt.ajax.reload();
      // datatabel.ajax.reload();
    })
    .catch((err) => console.log(err));
}

/**
 * Add index column on the first row
 * @param {object} table Datatble object
 */
function addIndexColumn(table) {
  table
    .on("order.dt search.dt", function () {
      table
        .column(0, {
          search: "applied",
          order: "applied",
        })
        .nodes()
        .each(function (cell, i) {
          cell.innerHTML = i + 1;
        });
    })
    .draw();
}

/**
 * get data by ID from a table form
 * @param {string} table table name
 * @param {string|number} id id record
 */
function getDataById(table, id) {
  $.get(
    base_url,
    {
      id: id,
      row: 1,
      table: table,
      action: "data",
    },
    function (res) {
      if (res.success) {
        Object.entries(res.data).forEach(function ([key, value], index) {
          $(`#${key}`).val(value);
        });
      }
    },
    "json"
  );
}

/**
 * Convert object to query string
 * @param {obj} obj object want to convert to query string
 * @param {boolean} start using (?) at start query string
 */
function objectToQueryString(obj, start = true) {
  return Object.keys(obj).reduce(function (str, key, i) {
    var delimiter, val;
    if (start) {
      delimiter = i === 0 ? "?" : "&";
    } else {
      delimiter = "&";
    }
    key = encodeURIComponent(key);
    val = encodeURIComponent(obj[key]);
    return [str, delimiter, key, "=", val].join("");
  }, "");
}

/**
 * Save data to server
 * @param {object} extraData extra data param
 */
function saveData(extraData) {
  var form = $("#form-input").serialize();
  var data = form + objectToQueryString(extraData, false);
  $.post(
    base_url,
    data,
    function (res) {
      if (res.success) {
        $(".alert-success").text(res.msg);
        $(".alert-success").css("display", "block");
        setTimeout(function () {
          $(".alert-success").css("display", "none");
        }, 5000);
      }
    },
    "json"
  );
}

/**
 * Form validator
 * @param {array} formValue array id of input tag required
 */
function validateForm(formValue) {
  var failed = 0;
  formValue.forEach(function (item) {
    var value = $(`#${item}`).val();
    if (value == null || value == "" || value == undefined) {
      var el = $(`#${item}`).after(
        '<label class="error-input">Field ini harus diisi</label>'
      );
      setTimeout(function () {
        $(`#${item}`).next("label").remove();
      }, 5000);
      failed++;
    }
  });

  if (failed > 0) return false;
  return true;
}

/**
 * Loader Moadal
 * @param {boolean} show show modal
 */
function loader(show = true) {
  if (show) {
    $("#backdrop-loader").modal("show");
  } else {
    $("#backdrop-loader").modal("hide");
  }
}
