

// sign up
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("signupForm");
    const username = document.getElementById("username");
    const email = document.getElementById("email");
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirmPassword");

    function showError(input, message) {
        let errorContainer = input.parentElement.querySelector(".error-message");
        errorContainer.textContent = message;
        input.parentElement.classList.add("has-error");
    }

    function clearError(input) {
        let errorContainer = input.parentElement.querySelector(".error-message");
        errorContainer.textContent = "";
        input.parentElement.classList.remove("has-error");
    }

    function validateInput(input, regex, message) {
        if (!regex.test(input.value)) {
            showError(input, message);
            return false;
        } else {
            clearError(input);
            return true;
        }
    }

    function validatePassword() {
        let errorMsg = "";
        if (password.value.length < 8) errorMsg += "At least 8 characters. ";
        if (!/[A-Z]/.test(password.value)) errorMsg += "1 uppercase letter. ";
        if (!/\d/.test(password.value)) errorMsg += "1 number. ";
        if (!/[\W_]/.test(password.value)) errorMsg += "1 special character. ";

        if (errorMsg) {
            showError(password, errorMsg);
        } else {
            clearError(password);
        }

        if (confirmPassword.value.length > 0) {
            validatePasswordMatch();
        }
    }

    function validatePasswordMatch() {
        if (password.value !== confirmPassword.value) {
            showError(confirmPassword, "Passwords do not match!");
        } else {
            clearError(confirmPassword);
        }
    }

    username.addEventListener("input", function () {
        validateInput(username, /^[a-zA-Z0-9]{3,20}$/, "Only letters & numbers (3-20 characters).");
    });

    email.addEventListener("input", function () {
        validateInput(email, /^[^\s@]+@[a-z]+\.[a-z]+$/, "Invalid email format.");
    });

    password.addEventListener("input", validatePassword);
    confirmPassword.addEventListener("input", validatePasswordMatch);

    form.addEventListener("submit", function (event) {
        if (
            !validateInput(username, /^[a-zA-Z0-9]{3,20}$/, "Only letters & numbers (3-20 characters).") ||
            !validateInput(email, /^[^\s@]+@[a-z]+\.[a-z]+$/, "Invalid email format.") ||
            password.parentElement.classList.contains("has-error") ||
            confirmPassword.parentElement.classList.contains("has-error")
        ) {
            event.preventDefault();
            alert("Please fix the errors before submitting.");
        } else {
            alert("Your form has been submitted successfully!");
        }
    });

    // 🔹 Show/Hide Password Toggle
    window.togglePassword = function (inputId, icon) {
        const input = document.getElementById(inputId);
        if (input.type === "password") {
            input.type = "text";
            icon.innerHTML = '<i class="fa-solid fa-eye-slash"></i>'; // Change icon
        } else {
            input.type = "password";
            icon.innerHTML = '<i class="fa-solid fa-eye"></i>'; // Change back
        }
    };

    // 🔹 Password Copy-Paste Restriction
    password.addEventListener("copy", function (event) {
        event.preventDefault();
        navigator.clipboard.writeText(password.value).catch(err => console.error("Copy failed:", err));
    });

    confirmPassword.addEventListener("paste", function (event) {
        event.preventDefault();
        setTimeout(() => {
            confirmPassword.value = password.value;
            validatePasswordMatch();
        }, 50);
    });

});































// login


document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("loginForm");
    const username = document.getElementById("loginUsername");
    const password = document.getElementById("loginPassword");

    function validateInput(input, regex) {
        return regex.test(input.value.trim());
    }

    function validatePassword() {
        return (
            password.value.length >= 8 &&
            /[A-Z]/.test(password.value) &&
            /\d/.test(password.value) &&
            /[\W_]/.test(password.value)
        );
    }

    form.addEventListener("submit", function (event) {
        event.preventDefault(); // Default Submit روکنا

        const isUsernameValid = validateInput(username, /^[a-zA-Z0-9]{3,20}$/); // Signup جیسا Regex
        const isPasswordValid = validatePassword(); // Signup کی طرح Password Validation

        if (!isUsernameValid || !isPasswordValid) {
            alert("Incorrect Email or Password!"); // صرف Alert Show ہوگا
        } else {
            alert("Login Successful!"); // Replace with actual login authentication
        }
    });

    // Show/Hide Password Function
    window.togglePassword = function (fieldId, icon) {
        let field = document.getElementById(fieldId);
        if (field.type === "password") {
            field.type = "text";
            icon.innerHTML = `<i class="fa-solid fa-eye-slash"></i>`;
        } else {
            field.type = "password";
            icon.innerHTML = `<i class="fa-solid fa-eye"></i>`;
        }
    };
});






// function redirectToSignup() {
//     let type = document.getElementById("signupType").value;
//     if (type) {
//         window.location.href = type;
//     }
// }















// document.addEventListener("DOMContentLoaded", function () {
//     const form = document.querySelector("form");
//     const email = document.querySelector("input[type='email']");

//     function validateEmail(emailValue) {
//         const emailRegex =/^[^\s@]+@[a-z]+\.[a-z]+$/ ; // Signup والا Regex
//         return emailRegex.test(emailValue.trim());
//     }

//     form.addEventListener("submit", function (event) {
//         event.preventDefault(); // Default Submit روکنا

//         if (!validateEmail(email.value)) {
//             alert("Invalid Email Address!"); // غلط Email پر Alert Show ہوگا
//         } else {
//             alert("Password Reset Link Sent!"); // صحیح Email پر یہ Show ہوگا
//         }
//     });
// });
























    // Forget Password Form Handle
    const forgetForm = document.querySelector("#forgetForm");
    if (forgetForm) {
        forgetForm.addEventListener("submit", function (event) {
            const recoveryEmail = document.querySelector("input[name='recoveryemail']").value.trim();
            const emailRegex = /^[^\s@]+@[a-z]+\.[a-z]+$/;

            if (!emailRegex.test(recoveryEmail)) {
                event.preventDefault();
                alert("Invalid Recovery Email!");
            }
        });
    }





















































