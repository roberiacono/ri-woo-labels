jQuery(document).ready(function ($) {
  // conditions
  const defaultConditions = ri_woo_labels_meta_box_scripts.conditions;
  console.log("defaultConditions ", defaultConditions);
  let counter = $("#conditions-wrapper .conditions-wrapper__row").length;
  console.log("Found " + counter + " conditions");
  $("#add-new-condition").on("click", function () {
    addNewCondition();
  });
  $(document).on("click", ".remove-condition", function () {
    $(this).closest(".conditions-wrapper__row").remove();
  });

  $(document).on("change", ".select-type", function () {
    const selectedCondition = $(this).val();
    const selectCompare = $(this)
      .closest(".conditions-wrapper__row")
      .find(".select-compare");

    const selectValues = $(this)
      .closest(".conditions-wrapper__row")
      .find(".select-values");

    selectCompare.empty();
    selectValues.empty();

    if (selectedCondition === "null") {
      return;
    }

    Object.keys(defaultConditions[selectedCondition].compare).forEach(
      (element) => {
        selectCompare.append(`<option value="${element}">
        ${defaultConditions[selectedCondition].compare[element]} 
         </option>`);
      }
    );

    Object.keys(defaultConditions[selectedCondition].values).forEach(
      (element) => {
        selectValues.append(`<option value="${element}">
          ${defaultConditions[selectedCondition].values[element]} 
           </option>`);
      }
    );
  });

  function addNewCondition() {
    let typeOptions = "";
    let compareOptions = "";
    let valuesOptions = "";
    Object.keys(defaultConditions).forEach((el, index) => {
      typeOptions += `<option value="${el}">
       ${defaultConditions[el].label} 
        </option>`;
    });

    let relation = "";
    if (counter > 0) {
      relation = '<div class="relation">AND</div>';
    }

    $("#conditions-wrapper").append(
      `
            <div class="conditions-wrapper__row">
                ` +
        relation +
        `
                <div class="conditions-wrapper__row__inner-wrapper">
                    <div class="conditions-wrapper__row__inner" >
                        <select name="conditions[` +
        counter +
        `][type]" class="select-type" >
            <option value="null">Select</option>
            ` +
        typeOptions +
        `     
                        </select>
                        <select name="conditions[` +
        counter +
        `][compare]"  class="select-compare">
                        </select>
                        <select name="conditions[` +
        counter +
        `][value]" class="select-values">
                        </select>
                    </div>
                    <button type="button" class="remove-condition button btn">` +
        ri_woo_labels_meta_box_scripts.removeButtonText +
        `</button>
                </div>
            </div>
        `
    );
    counter++;
  }

  if (counter === 0) {
    addNewCondition();
  }

  function update_where(selected) {
    if (selected === "before_title") {
      $(".form-field.ri_wl_label_setting_position").hide();
      $(
        ".ri_woo_labels_preview_panel .before-title .ri-wl_span-container"
      ).show();
      $(
        ".ri_woo_labels_preview_panel .ri_wl_div_wrapper .ri-wl_span-container"
      ).hide();
    } else {
      $(".form-field.ri_wl_label_setting_position").show();
      $(
        ".ri_woo_labels_preview_panel .before-title .ri-wl_span-container"
      ).hide();
      $(
        ".ri_woo_labels_preview_panel .ri_wl_div_wrapper .ri-wl_span-container"
      ).show();
    }
  }
  update_where($("select[name='ri_wl_label_setting_where']").val());
  /* settings section */
  $(document).on(
    "change",
    "select[name='ri_wl_label_setting_where']",
    function () {
      const selected = $(this).val();
      update_where(selected);
    }
  );

  function update_position(selected) {
    $(
      ".ri_woo_labels_preview_panel .ri_wl_div_wrapper .ri-woo-labels-wrapper-container "
    )
      .css("top", "")
      .css("left", "")
      .css("bottom", "")
      .css("right", "");

    if (selected === "top-left") {
      $(
        ".ri_woo_labels_preview_panel .ri_wl_div_wrapper .ri-woo-labels-wrapper-container"
      )
        .css("top", 0)
        .css("left", 0);
    } else if (selected === "top-right") {
      $(
        ".ri_woo_labels_preview_panel .ri_wl_div_wrapper .ri-woo-labels-wrapper-container"
      )
        .css("top", 0)
        .css("right", 0);
    } else if (selected === "bottom-right") {
      $(
        ".ri_woo_labels_preview_panel .ri_wl_div_wrapper .ri-woo-labels-wrapper-container"
      )
        .css("bottom", 0)
        .css("right", 0);
    } else if (selected === "bottom-left") {
      $(
        ".ri_woo_labels_preview_panel .ri_wl_div_wrapper .ri-woo-labels-wrapper-container"
      )
        .css("bottom", 0)
        .css("left", 0);
    }
  }
  update_position($("select[name='ri_wl_label_setting_position']").val());
  // on position change
  $(document).on(
    "change",
    "select[name='ri_wl_label_setting_position']",
    function () {
      const selected = $(this).val();
      update_position(selected);
    }
  );

  // on change template
  $(document).on(
    "change",
    "input[name='ri_wl_label_setting_template']",
    function () {
      let borderRadius = $(this).data("border-radius");
      let padding = $(this).data("padding");
      const template = $(this).val();
      const postID = $("#post_ID").val();

      console.log("template", template);

      $(".ri_woo_labels_preview_panel .ri-wl_span-container")
        .removeClass()
        .addClass("ri-wl_span-container")
        .addClass(template)
        .addClass(template + "-" + postID);

      // border radius
      $(
        ".radio-wrapper .woo-labels-ri_wl_label_setting_predefined_colors__span"
      ).css("border-radius", borderRadius);

      $(".ri_woo_labels_preview_panel .ri-wl_span-container").css(
        "border-radius",
        borderRadius
      );

      if (borderRadius) {
        borderRadius = borderRadius.replaceAll("px", "").split(" ");
      } else {
        borderRadius = ["", "", "", ""];
      }

      $("input[name='ri_wl_label_setting_border_radius[]']").each(function (
        index
      ) {
        $(this).val(borderRadius[index]);
      });

      // padding
      $(
        ".radio-wrapper .woo-labels-ri_wl_label_setting_predefined_colors__span"
      ).css("padding", padding);

      $(".ri_woo_labels_preview_panel .ri-wl_span-container").css(
        "padding",
        padding
      );

      if (padding) {
        padding = padding.replaceAll("px", "").split(" ");
      } else {
        padding = ["", "", "", ""];
      }
      $("input[name='ri_wl_label_setting_padding[]']").each(function (index) {
        $(this).val(padding[index]);
      });
    }
  );

  var styleElem = document.head.appendChild(document.createElement("style"));
  styleElem.innerHTML =
    ".ri-wl_span-container." +
    $("input[name='ri_wl_label_setting_template']:checked").val() +
    ":before {border-color: " +
    $("input[name='ri_wl_label_setting_predefined_colors']:checked").data(
      "background-color"
    ) +
    ";}";

  // change colors on predefined changes
  function backgroundColorChanged(backgroundColor) {
    // preview
    var styleElem = document.head.appendChild(document.createElement("style"));
    styleElem.innerHTML =
      ".ri-wl_span-container:before {border-color: " +
      backgroundColor +
      " !important;}";
    // end preview
    $(".radio-wrapper .woo-labels-ri_wl_label_setting_template__span").css(
      "background-color",
      backgroundColor
    );

    $(".ri_wl_label_setting_background_color button").css(
      "background-color",
      backgroundColor
    );

    $("input[name='ri_wl_label_setting_background_color']").val(
      backgroundColor
    );

    $(".ri_woo_labels_preview_panel .ri-wl_span-container").css(
      "background-color",
      backgroundColor
    );
  }
  $(document).on(
    "change",
    "input[name='ri_wl_label_setting_predefined_colors']",
    function () {
      const backgroundColor = $(this).data("background-color");
      const color = $(this).data("color");
      if (backgroundColor) {
        backgroundColorChanged(backgroundColor);
      }

      if (color) {
        $(".radio-wrapper .woo-labels-ri_wl_label_setting_template__span").css(
          "color",
          color
        );

        $(".ri_wl_label_setting_text_color button").css(
          "background-color",
          color
        );

        $("input[name='ri_wl_label_setting_text_color']").val(color);

        $(".ri_woo_labels_preview_panel .ri-wl_span-container").css(
          "color",
          color
        );
      }
    }
  );

  // on change padding, set empty template
  $(document).on(
    "change",
    "input[name='ri_wl_label_setting_padding[]']",
    function () {
      $("input[name='ri_wl_label_setting_template']").prop("checked", false);

      let padding = [];
      $("input[name='ri_wl_label_setting_padding[]']").each(function (index) {
        padding.push($(this).val() + "px");
      });
      padding = padding.join(" ");
      $(".ri_woo_labels_preview_panel .ri-wl_span-container").css(
        "padding",
        padding
      );
      $(".woo-labels-ri_wl_label_setting_predefined_colors span").css(
        "padding",
        padding
      );
    }
  );

  // on change border radius, set empty template
  $(document).on(
    "change",
    "input[name='ri_wl_label_setting_border_radius[]']",
    function () {
      $("input[name='ri_wl_label_setting_template']").prop("checked", false);

      let borderRadius = [];
      $("input[name='ri_wl_label_setting_border_radius[]']").each(function (
        index
      ) {
        borderRadius.push($(this).val() + "px");
      });
      borderRadius = borderRadius.join(" ");
      $(".ri_woo_labels_preview_panel .ri-woo-labels-container span").css(
        "border-radius",
        borderRadius
      );
      $(".woo-labels-ri_wl_label_setting_predefined_colors span").css(
        "border-radius",
        borderRadius
      );
    }
  );

  // on change margin
  $(document).on(
    "change",
    "input[name='ri_wl_label_setting_margin[]']",
    function () {
      //$("input[name='ri_wl_label_setting_template']").prop("checked", false);

      let margin = [];
      $("input[name='ri_wl_label_setting_margin[]']").each(function (index) {
        margin.push($(this).val() + "px");
      });
      margin = margin.join(" ");
      $(".ri_woo_labels_preview_panel .ri-wl_span-container").css(
        "margin",
        margin
      );
    }
  );

  // on change color, set empty predefined colors

  $(
    ".ri_wl_label_setting_background_color .ri-woo-labels-color-field"
  ).wpColorPicker({
    /**
     * @param {Event} event - standard jQuery event, produced by whichever
     * control was changed.
     * @param {Object} ui - standard jQuery UI object, with a color member
     * containing a Color.js object.
     */
    change: function (event, ui) {
      var element = event.target;
      var color = ui.color.toString();
      $("input[name='ri_wl_label_setting_predefined_colors']").prop(
        "checked",
        false
      );

      backgroundColorChanged(color);

      /* $(".radio-wrapper .woo-labels-ri_wl_label_setting_template__span").css(
        "background-color",
        color
      );

      $(".ri_woo_labels_preview_panel .ri-wl_span-container").css(
        "background-color",
        color
      ); */
    },
  });

  $(".ri_wl_label_setting_text_color .ri-woo-labels-color-field").wpColorPicker(
    {
      /**
       * @param {Event} event - standard jQuery event, produced by whichever
       * control was changed.
       * @param {Object} ui - standard jQuery UI object, with a color member
       * containing a Color.js object.
       */
      change: function (event, ui) {
        var element = event.target;
        var color = ui.color.toString();
        $("input[name='ri_wl_label_setting_predefined_colors']").prop(
          "checked",
          false
        );

        $(".radio-wrapper .woo-labels-ri_wl_label_setting_template__span").css(
          "color",
          color
        );

        $(".ri_woo_labels_preview_panel .ri-wl_span-container").css(
          "color",
          color
        );
      },
    }
  );

  $("input[name='ri_wl_label_setting_text']").keyup(function () {
    // Getting the current value of textarea
    var currentText = $(this).val();

    // Setting the Div content
    $(".ri_woo_labels_preview_panel .ri-wl_span-container span").text(
      currentText
    );
  });
});
