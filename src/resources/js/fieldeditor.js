const btnList = document.querySelectorAll(
    '[data-field-editor="edit-button"],[data-field-editor="create-button"],[data-field-editor="cancel-button"]');

btnList.forEach((btn) => {
    btn.addEventListener('click', function () {
        let formId = btn.dataset.targetFormId;
        if (formId === 'new') {
            toggleForm(); // Switch from full table width create button to the create form
        } else {
            toggleFormElms(formId);
            toggleButtonSet(formId, "edit");
            toggleButtonSet(formId, "default");
       }
    });
});

function toggleForm() {
    const rowList = document.querySelectorAll('tr[data-field-editor="create-button-row"],tr[data-field-editor="form-row"]');
    rowList.forEach((row) => {
        if (row.style.display !== "none") {
            row.style.display = "none";
        } else if (row.style.display === "none") {
            row.style.display = "table-row"
        }
    });
}


function toggleFormElms(formId) {
    const formElmList = document.querySelectorAll(`input[form='row-form-${formId}'],select[form='row-form-${formId}']`);
    formElmList.forEach((formElm) => {
        formElm.toggleAttribute("readonly");
        formElm.toggleAttribute("disabled");
        formElm.classList.toggle("form-control-plaintext");
        formElm.classList.toggle("form-control");
    });
}

function toggleButtonSet(formId, btnSetType) {
    const btnSet = document.querySelector(`[data-field-editor="${btnSetType}-button-set"][data-form-id="${formId}"]`);
        if (btnSet.style.display !== "none") {
            btnSet.style.display = "none";
        } else if (btnSet.style.display === "none") {
            btnSet.style.display = "flex";
        }
}
