function validateForm() {
    // Name
    let name = document.getElementById("name").value.trim();
    if (name === "") {
        alert("Name cannot be empty");
        return false;
    }
    let words = name.split(" ");
    if (words.length < 2) {
        alert("Name must contain at least two words");
        return false;
    }

    let firstChar = name[0];
    if (!(firstChar >= 'A' && firstChar <= 'Z') &&
        !(firstChar >= 'a' && firstChar <= 'z')) {
        alert("Name must start with a letter");
        return false;
    }

    for (let i = 0; i < name.length; i++) {
        let ch = name[i];

        if (!(
            (ch >= 'A' && ch <= 'Z') ||
            (ch >= 'a' && ch <= 'z') ||
            ch === '.' ||
            ch === '-' ||
            ch === ' '
        )) {
            alert("Invalid character found");
            return false;
        }
    }

    // Email
    let email = document.getElementById("email").value.trim();
    if (email === "") {
        alert("Email cannot be empty");
        return false;
    }

    if (!email.includes("@") || !email.includes(".")) {
        alert("Invalid email format");
        return false;
    }

    let atIndex = email.indexOf("@");
    let dotIndex = email.lastIndexOf(".");
    if (atIndex < 1 || dotIndex < atIndex + 2 || dotIndex === email.length - 1) {
        alert("Invalid email format");
        return false;
    }

    // Gender
    let genders = document.getElementsByName("gender");
    let genderSelected = false;
    for (let i = 0; i < genders.length; i++) {
        if (genders[i].checked) {
            genderSelected = true;
        }
    }
    if (!genderSelected) {
        alert("Please select a gender");
        return false;
    }

    // Date of Birth
    let dd = document.getElementById("dd").value.trim();
    let mm = document.getElementById("mm").value.trim();
    let yyyy = document.getElementById("yyyy").value.trim();

    if (dd === "" || mm === "" || yyyy === "") {
        alert("Date of Birth cannot be empty");
        return false;
    }
    if (isNaN(dd) || isNaN(mm) || isNaN(yyyy)) {
        alert("Date of Birth must be numeric");
        return false;
    }

    dd = Number(dd);
    mm = Number(mm);
    yyyy = Number(yyyy);

    if (dd < 1 || dd > 31) {
        alert("Day must be between 1 and 31");
        return false;
    }

    if (mm < 1 || mm > 12) {
        alert("Month must be between 1 and 12");
        return false;
    }

    if (yyyy < 1900 || yyyy > 2016) {
        alert("Year must be between 1900 and 2016");
        return false;
    }

    // Blood Group
    let blood = document.getElementById("bldGroup").value;
    if (blood === "") {
        alert("Please select blood group");
        return false;
    }

    // Degree
    let ssc = document.getElementById("SSC").checked;
    let hsc = document.getElementById("HSC").checked;
    let bsc = document.getElementById("BSc").checked;
    let msc = document.getElementById("MSc").checked;

    if (!ssc && !hsc && !bsc && !msc) {
        alert("Please select at least one degree");
        return false;
    }

    // Photo
    let photo = document.getElementById("photo").value;
    if (photo === "") {
        alert("Please upload a photo");
        return false;
    }

    alert("Form submitted successfully!");
    return true;
}