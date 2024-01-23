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

saveBtnList.forEach( (btn) => {
    btn.addEventListener('click', function (e) {
        e.preventDefault();
        validateFormData(btn.getAttribute('form'));
    });
});

function validateFormData(formId) {
    console.log(formId);
    let validationStatusArr = [
        validateDomain(formId),
        validateHost(formId),
        validateName(formId),
        validateDescription(formId)
    ]
    let firstError = validationStatusArr.find(obj => obj && obj.status === false);
    if (firstError) {
        // call function to show error message under input box
        console.log(firstError.errorMsg);
    }
    else {
        console.log("Form Submitted");
        document.getElementById(formId).submit();
    }
}


function validateDomain(formId) {
    const regex = new RegExp('^(([^:\\/?#]*)(?:\\:([0-9]+))?)$');
    let input = document.querySelector(`[form="${formId}"][name="domain_name"]`);
    let value = input.getAttribute('value');
    if (!value) {
        return {
            status: false,
            errorMsg: "Source domain is required",
            element: input
        }
    } else if (!regex.test(value)) {
        return {
            status: false,
            errorMsg: "Enter a valid source domain",
            element: input
        }
    } else {
        return {
            status: true,
            errorMsg: null
        }
    }
}
