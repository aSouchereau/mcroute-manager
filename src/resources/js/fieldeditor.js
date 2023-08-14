const editButtonList = document.querySelectorAll('[data-field-editor="edit-button"]');
const cancelButtonList = document.querySelectorAll('[data-field-editor="cancel-button"]');

for (let i = 0; i < editButtonList.length; i++) {
    editButtonList[i].addEventListener('click', function () {
        toggleForm(editButtonList[i].dataset.targetFormId);
    });
}

for (let i = 0; i < cancelButtonList.length; i++) {
    cancelButtonList[i].addEventListener('click', function () {
       toggleForm(cancelButtonList[i].dataset.targetFormId);
    });
}

function toggleForm(formId) {
    const formElmList = document.querySelectorAll(`[form='row-form-${formId}']`)
    for (let i = 0; i < formElmList.length; i++) {
        formElmList[i].toggleAttribute("readonly");
        formElmList[i].classList.toggle("form-control-plaintext");
        formElmList[i].classList.toggle("form-control");


    }
}

function toggleButtonSet() {

}
