// document.addEventListener('DOMContentLoaded', function () {
//     let hasUnsavedChanges = false;

//     // Track form modifications
//     const form = document.querySelector('form'); // Select your form
//     if (form) {
//         form.addEventListener('input', function () {
//             hasUnsavedChanges = true;
//         });
//     }

//     // Intercept navigation events
//     // window.addEventListener('beforeunload', function (event) {
//     //     if (hasUnsavedChanges) {
//     //         const message = "You have unsaved changes. Are you sure you want to leave?";
//     //         event.returnValue = message;
//     //         return message;
//     //     }
//     // });

//     // Reset unsaved changes flag when form is submitted
//     if (form) {
//         form.addEventListener('submit', function () {
//             hasUnsavedChanges = false;
//         });
//     }
// });
