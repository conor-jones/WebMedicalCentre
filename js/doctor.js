window.onload = function() {
    //validates delete patient
    var deleteLinks = document.getElementsByClassName('deleteDoctor');
    for (var i =0; i !== deleteLinks.length; i++) {
        var link = deleteLinks[i];
        link.addEventListener("click", deleteLink);
    }
    
    function deleteLink (event) {
        if (!confirm("are you sure you want to delete this doctor?")) {
            event.preventDefault();
        }
    }
    
    //validates update patient
    var editDoctorForm = document.getElementById('editDoctorForm');
    if (editDoctorForm !== null) {
        editDoctorForm.addEventListener('submit', validateDoctorForm);
    }
    
   
    
    //validates create patient
    var createDoctorForm = document.getElementById('createDoctorForm');
    if (createDoctorForm !== null) {
        createDoctorForm.addEventListener('submit', validateDoctorForm);
    }
    
    function validateDoctorForm(event) {
        var form = event.target;
        
        var name = form['name'].value;
        var phone = form['phone'].value;
        var email = form['email'].value;
        var expertise = form['expertise'].value;
        
        var spanElements = document.getElementsByClassName("error");
        for (var i =0; i !== spanElements.length; i++) {
            spanElements[i].innerHTML = "";
        }
        
        var errors = new Object();
        
        if (name === "") {
            errors["name"] = "This field cannot be left empty!"; 
        }
        if (phone === "") {
            errors["phone"] = "this field cannot be left empty!";
        }
        if (email === "") {
            errors["email"] = "This field cannot be left empty!";
        }
        if (expertise === "") {
            errors["expertise"] = "This field cannot be left empty!";
        }
        
        var valid = true;
        for (var index in errors) {
            valid = false;
            var errorMessage = errors[index];
            var spanElement = document.getElementById(index + "Error");
            spanElement.innerHTML = errorMessage;
        }
        if (!valid) {
            event.preventDefault();
        }
        else if (!confirm("Save Doctor?")) {
            event.preventDefault();
        }
    }
};