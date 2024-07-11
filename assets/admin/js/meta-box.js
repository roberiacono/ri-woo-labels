jQuery(document).ready(function ($) {
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

  /* settings section */
  $(document).on(
    "change",
    "select[name='ri_wl_label_setting_where']",
    function () {
      const selected = $(this).val();
      if (selected === "before_title") {
        $(".form-field.ri_wl_label_setting_position").hide();
      } else {
        $(".form-field.ri_wl_label_setting_position").show();
      }
    }
  );

  // change text on template button
  let text = $("input[name='ri_wl_label_setting_text']").val();
  console.log("text", text);
  $(".radio-wrapper .woo-labels-ri_wl_label_setting_template__span").html(text);

  $(document).on(
    "change",
    "input[name='ri_wl_label_setting_text']",
    function () {
      $(".radio-wrapper .woo-labels-ri_wl_label_setting_template__span").html(
        $(this).val()
      );
    }
  );

  // on change template
  $(document).on(
    "change",
    "input[name='ri_wl_label_setting_template']",
    function () {
      let borderRadius = $(this).data("border-radius");
      let padding = $(this).data("padding");

      // border radius
      $(
        ".radio-wrapper .woo-labels-ri_wl_label_setting_predefined_colors__span"
      ).css("border-radius", borderRadius);

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

  // change colors on predefined changes
  $(document).on(
    "change",
    "input[name='ri_wl_label_setting_predefined_colors']",
    function () {
      const backgroundColor = $(this).data("background-color");
      const color = $(this).data("color");
      if (backgroundColor) {
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
      }
    }
  );
});
