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
        }
    });

    return allValid;
}

function showError(errorBox, msg) {
    if (errorBox) errorBox.innerHTML = msg;
}
