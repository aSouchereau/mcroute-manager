const btnList = document.querySelectorAll(
    '[data-field-editor="edit-button"],[data-field-editor="create-button"],[data-field-editor="cancel-button"]');

btnList.forEach((btn) => {
    btn.addEventListener('click', function () {
        let formId = btn.dataset.targetFormId ?? "new"; // Sets formId to "new" for the create button, since its not associated with any route and has no id
        toggleForm(formId);
        toggleButtonSet(formId, "edit");
        toggleButtonSet(formId, "default");
    });
});


function toggleForm(formId) {
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
