const buttonList = document.querySelectorAll('[data-field-editor="button"]');
for (let i = 0; i < buttonList.length; i++) {
    buttonList[i].addEventListener('click', function () {
        toggleForm(buttonList[i].dataset.targetFormId);
    });
}

function toggleForm(fieldId) {
    console.log("event triggered");
    const formElmList = document.querySelectorAll(`[data-form-id='${fieldId}']`)
    for (let i = 0; i < formElmList.length; i++) {
        formElmList[i].toggleAttribute("readonly");
        formElmList[i].classList.toggle("form-control-plaintext");
        formElmList[i].classList.toggle("form-control");


    }
}
