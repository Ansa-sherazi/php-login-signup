
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("sellerForm");

    // Real-time Validation for all input fields
    function validateField(input, regex, errorMsg) {
        const errorSpan = input.parentElement.querySelector(".error-message");
        input.addEventListener("input", function () {
            if (!regex.test(input.value.trim())) {
                errorSpan.textContent = errorMsg;
                errorSpan.style.display = "block";
                input.classList.add("error-input");
            } else {
                errorSpan.style.display = "none";
                input.classList.remove("error-input");
            }
        });
    }

    // ✅ Updated Regex from Signup Code
    validateField(
        document.getElementById("username"),
        /^[a-zA-Z0-9]{3,20}$/,
        "Only letters & numbers (3-20 characters)."
    );

    validateField(
        document.getElementById("email"),
        /^[^\s@]+@[a-z]+\.[a-z]+$/,
        "Invalid email format."
    );

    validateField(
        document.getElementById("password"),
        /^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/,
        "At least 8 characters, 1 uppercase, 1 number, 1 special character."
    );

    function validatePasswordMatch() {
        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("confirmPassword").value;
        const confirmError = document.getElementById("confirmPassword").parentElement.querySelector(".error-message");

        if (confirmPassword !== password) {
            confirmError.textContent = "Passwords do not match";
            confirmError.style.display = "block";
            document.getElementById("confirmPassword").classList.add("error-input");
        } else {
            confirmError.style.display = "none";
            document.getElementById("confirmPassword").classList.remove("error-input");
        }
    }

    document.getElementById("confirmPassword").addEventListener("input", validatePasswordMatch);

    validateField(
        document.getElementById("contactNumber"),
        /^[0-9]{10,15}$/,
        "Enter a valid phone number (10-15 digits)."
    );

    document.getElementById("address").addEventListener("input", function () {
        const errorSpan = this.parentElement.querySelector(".error-message");
        if (this.value.trim() === "") {
            errorSpan.textContent = "Address cannot be empty";
            errorSpan.style.display = "block";
            this.classList.add("error-input");
        } else {
            errorSpan.style.display = "none";
            this.classList.remove("error-input");
        }
    });

    // Form Submit Validation
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        let valid = true;
        const inputs = form.querySelectorAll("input");

        inputs.forEach(input => {
            const event = new Event("input"); // Trigger input event
            input.dispatchEvent(event);
            if (input.classList.contains("error-input")) valid = false;
        });

        if (valid) {
            alert("Seller Registered Successfully!"); // Backend call yahan karna hai
            form.reset();
        }
    });
});

/* Password Show/Hide Toggle */
function togglePassword(fieldId, icon) {
    const input = document.getElementById(fieldId);
    if (input.type === "password") {
        input.type = "text";
        icon.innerHTML = '<i class="fa-solid fa-eye-slash"></i>';
    } else {
        input.type = "password";
        icon.innerHTML = '<i class="fa-solid fa-eye"></i>';
    }
}

// 🔹 Password Copy-Paste Restriction
document.getElementById("password").addEventListener("copy", function (event) {
    event.preventDefault();
    navigator.clipboard.writeText(this.value).catch(err => console.error("Copy failed:", err));
});

document.getElementById("confirmPassword").addEventListener("paste", function (event) {
    event.preventDefault();
    setTimeout(() => {
        this.value = document.getElementById("password").value;
        validatePasswordMatch();
    }, 50);
});












document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("sellerForm");
    const fileInput = document.getElementById("fileUpload");
    const fileNameDisplay = document.getElementById("file-name");

  

    fileInput.addEventListener("change", function () {
        if (fileInput.files.length > 0) {
            fileNameDisplay.textContent = fileInput.files[0].name; // Show selected file name
            fileNameDisplay.style.color = "#fff"; // Reset color to white
        } else {
            fileNameDisplay.textContent = "No file chosen"; // Default text
            fileNameDisplay.style.color = "#fff";
        }
    });
});












