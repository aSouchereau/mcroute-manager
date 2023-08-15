const editBtnList = document.querySelectorAll('[data-field-editor="edit-button"]');
const cancelBtnList = document.querySelectorAll('[data-field-editor="cancel-button"]');

editBtnList.forEach((editBtn) => {
    editBtn.addEventListener('click', function () {
        let formId = editBtn.dataset.targetFormId;
        toggleForm(formId);
        toggleButtonSet(formId, "edit");
        toggleButtonSet(formId, "default");
    });
});

cancelBtnList.forEach((cancelBtn) => {
    cancelBtn.addEventListener('click', function () {
        let formId = cancelBtn.dataset.targetFormId;
        toggleForm(formId);
        toggleButtonSet(formId, "default");
        toggleButtonSet(formId, "edit");
    });
});

function toggleForm(formId) {
    const formElmList = document.querySelectorAll(`[form='row-form-${formId}']`);
    formElmList.forEach((formElm) => {
        formElm.toggleAttribute("readonly");
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
