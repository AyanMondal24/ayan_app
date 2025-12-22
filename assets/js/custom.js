// search box searching wait keyup 
function debounce(func, delay) {
    let timer;
    return function (...args) {
        clearTimeout(timer);
        timer = setTimeout(() => {
            func.apply(this, args);
        }, delay);
    };
}


function validate(fields) {

    // Allow single object or array
    const items = Array.isArray(fields) ? fields : [fields];

    let allValid = true;

    items.forEach(field => {
        const element = field.element;
        const value = element.value.trim();
        const rules = field.rules || [];
        const errorBox = document.querySelector(field.errorSelector);

        // clear previous error
        if (errorBox) errorBox.innerHTML = "";

        for (let ruleObj of rules) {

            const msg = ruleObj.message;

            // REQUIRED
            if (ruleObj.rule === "required" && value === "") {
                showError(errorBox, msg || "This field is required");
                allValid = false;
                return; // move to next field
            }

            // EMAIL
            if (ruleObj.rule === "email") {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(value)) {
                    showError(errorBox, msg || "Invalid email address");
                    allValid = false;
                    return;
                }
            }

            // MIN
            if (ruleObj.rule === "min") {
                if (value.length < ruleObj.value) {
                    showError(errorBox, msg || `Minimum ${ruleObj.value} characters required`);
                    allValid = false;
                    return;
                }
            }

            // MAX
            if (ruleObj.rule === "max") {
                if (value.length > ruleObj.value) {
                    showError(errorBox, msg || `Maximum ${ruleObj.value} characters allowed`);
                    allValid = false;
                    return;
                }
            }

            // NUMBER
            if (ruleObj.rule === "number") {
                if (isNaN(value)) {
                    showError(errorBox, msg || "Only numbers allowed");
                    allValid = false;
                    return;
                }
            }

            // REGEX
            if (ruleObj.rule === "regex") {
                if (!ruleObj.pattern.test(value)) {
                    showError(errorBox, msg || "Invalid input format");
                    allValid = false;
                    return;
                }
            }

            // CUSTOM FUNCTION
            if (ruleObj.rule === "custom") {
                if (typeof ruleObj.func === "function") {
                    const result = ruleObj.func(value);
                    if (result !== true) {
                        showError(errorBox, msg || result || "Invalid input");
                        allValid = false;
                        return;
                    }
                }
            }
            // IMAGE 
            // IMAGE VALIDATION
            if (ruleObj.rule === "image") {

                const file = element.files[0];

                if (!file) {
                    showError(errorBox, msg || "Please upload an image");
                    allValid = false;
                    return;
                }

                const validTypes = ["image/jpeg", "image/jpg", "image/png"];

                // Check MIME type
                if (!validTypes.includes(file.type)) {
                    showError(errorBox, msg || "Only JPG, JPEG, PNG images are allowed");
                    allValid = false;
                    return;
                }

                // Check file size (max 2MB)
                const maxSize = 2 * 1024 * 1024; // 2MB
                if (file.size > maxSize) {
                    showError(errorBox, msg || "Image must be less than 2MB");
                    allValid = false;
                    return;
                }
            }
        }
    });




    return allValid;
}

function showError(errorBox, msg) {
    if (errorBox) errorBox.innerHTML = msg;
}

//input field 

function numberField(fieldId, minLen, maxLen, error_msg) {
    const input = document.querySelector(fieldId);
    const error = document.querySelector(error_msg);

    if (!input) {
        console.error("Field not found:", fieldId);
        return;
    }

    input.addEventListener('input', function () {
        // allow only digits
        this.value = this.value.replace(/\D/g, '');

        // trim extra digits
        if (this.value.length > maxLen) {
            this.value = this.value.slice(0, maxLen);
        }

        // auto cursor out when max length reached
        if (this.value.length === maxLen) {
            this.blur();
        }
    });

    input.addEventListener('blur', function () {
        // min length validation
        error.innerHTML = '';
        if (this.value.length > 0 && this.value.length < minLen) {
            error.innerHTML = `Please enter at least ${minLen} digits`;
            this.focus();
        }
    });
}

