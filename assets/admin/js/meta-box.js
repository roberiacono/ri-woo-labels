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
});
