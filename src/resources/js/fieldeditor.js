const buttonList = document.querySelectorAll('[data-field-editor="edit-button"]');
for (let i = 0; i < buttonList.length; i++) {
    buttonList[i].addEventListener('click', function () {
        toggleForm(buttonList[i].dataset.targetFormId);
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
