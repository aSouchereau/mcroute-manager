import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

const btnList = document.querySelectorAll(
    '[data-field-editor="edit-button"],[data-field-editor="create-button"],[data-field-editor="cancel-button"]');

btnList.forEach((btn) => {
    btn.addEventListener('click', function () {
        let formId = btn.dataset.targetFormId;
        if (formId === 'new') {
            toggleForm(); // Switch from full table width create button to the create form
        } else {
            toggleFormElms(formId);
            toggleButtonSet(formId);
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

function toggleButtonSet(formId) {
    const btnSetList = document.querySelectorAll(
            `[data-field-editor="default-button-set"][data-form-id="${formId}"],
            [data-field-editor="edit-button-set"][data-form-id="${formId}"]`
        );
    btnSetList.forEach((btnSet) => {
        if (btnSet.style.display !== "none") {
            btnSet.style.display = "none";
        } else if (btnSet.style.display === "none") {
            btnSet.style.display = "flex";
        }
    });
}

/* *****************************
         Form Validation
*********************************/
const saveBtnList = document.querySelectorAll('[data-field-editor="save-button"]');
const cancelBtnList = document.querySelectorAll('[data-field-editor="cancel-button"]');

/* Clear validation error css on form cancel */
cancelBtnList.forEach((btn) => {
    let formId = btn.getAttribute('data-target-form-id');
    btn.addEventListener('click', function () {
        removeAllErrorStyles(formId);
    });
});

saveBtnList.forEach( (btn) => {
    let table = document.querySelector('section#content table');
    btn.addEventListener('click', function (e) {
        e.preventDefault();
        if (table.getAttribute('id') === 'routes') {
            submitRouteHandler(btn.getAttribute('form'));
        } else {
            submitGroupHandler(btn.getAttribute('form'));
        }
    });
});


function submitRouteHandler(formId) {

    let result = formValidator(formId, [
        validateDomain(formId),
        validateHost(formId)
    ]);

    if (result) {
        document.getElementById(formId).submit();
    }
}

function submitGroupHandler(formId) {

    let result = formValidator(formId, [
        validateName(formId),
        validateDescription(formId)
    ]);

    if (result) {
        document.getElementById(formId).submit();
    }
}

function formValidator(formId, resultObjArray) {
    let errorFound = resultObjArray.find(obj => obj && obj.status === false);

    if (errorFound) {
        // call function to show error message under input box
        console.log(errorFound.errorMsg);
        errorFound.element.focus();
        resultObjArray.forEach((result) => {
            if (result.status === true) {
                removeErrorStyles(result.element);
            } else {
                result.element.setAttribute('data-validation-error', "");
                const errorTooltip = new bootstrap.Tooltip(result.element, {
                    html: true,
                    placement: 'top',
                    customClass: 'error-tooltip',
                    title: result.errorMsg,
                    trigger: 'focus'
                });
                errorTooltip.show();
            }
        });
        return false;
    }
    else {
        removeAllErrorStyles(formId);
        return true;
    }
}

function removeErrorStyles(element) {
    if (element.hasAttribute('data-validation-error')) {
        element.removeAttribute('data-validation-error');
    }
    const tooltip = bootstrap.Tooltip.getInstance(element);
    if (tooltip) {
        tooltip.hide();
        //TODO fix this somehow
        tooltip.dispose();
        /* dispose function call causing type error when attempting to destroy tooltip instance,
        the tooltip still becomes hidden from user so not an issue,
        however having multiple useless instances of old tooltips isn't ideal  */
    }
}

function removeAllErrorStyles(formId) {
    let inputList = document.querySelectorAll(`input[form="row-form-${formId}"]`);
    inputList.forEach((element) => {
        removeErrorStyles(element);
    });
}


/* *****    Route form     *******/
function validateDomain(formId) {
    const regex = new RegExp('^(([^:\\/?#]*)(?::([0-9]+))?)$');
    let inputElm = document.querySelector(`[form="${formId}"][name="domain_name"]`);
    let value = inputElm.value;
    if (!value) {
        return {
            status: false,
            errorMsg: "Source domain is required",
            element: inputElm
        }
    } else if (!regex.test(value)) {
        return {
            status: false,
            errorMsg: "Enter a valid source domain",
            element: inputElm
        }
    } else {
        return {
            status: true,
            errorMsg: null,
            element: inputElm
        }
    }
}

function validateHost(formId) {
    const regex = new RegExp('^([0-9]{1,3}(\\.[0-9]{1,3}){3}):[0-9]{1,5}$');
    let inputElm = document.querySelector(`[form="${formId}"][name="host"]`);
    let value = inputElm.value;
    if (!value) {
        return {
            status: false,
            errorMsg: "Destination address is required",
            element: inputElm
        }
    } else if (!regex.test(value)) {
        return {
            status: false,
            errorMsg: "Enter a valid destination address and port",
            element: inputElm
        }
    } else {
        return {
            status: true,
            errorMsg: null,
            element: inputElm
        }
    }
}


/* *****    Group form     *******/
function validateName(formId) {
    let inputElm = document.querySelector(`[form="${formId}"][name="name"]`);
    let value = inputElm.value;
    if (!value) {
        return {
            status: false,
            errorMsg: "Group name is required",
            element: inputElm
        }
    } else {
        return {
            status: true,
            errorMsg: null,
            element: inputElm
        }
    }
}

function validateDescription(formId) {
    let inputElm = document.querySelector(`[form="${formId}"][name="description"]`);
    let value = inputElm.value;
    if (!value) {
        return {
            status: false,
            errorMsg: "Description is required",
            element: inputElm
        }
    } else {
        return {
            status: true,
            errorMsg: null,
            element: inputElm
        }
    }
}
