function generateListErrors(errors) {
    let errorList = '';
    if (errors && typeof errors === 'object') {
        errorList = '<ul style="text-align:left">';
        for (const key in errors) {
            if (errors.hasOwnProperty(key)) {
                errorList += `<li><strong>${key}:</strong> ${errors[key]}</li>`;
            }
        }
        errorList += '</ul>';
    }
    return errorList;
}