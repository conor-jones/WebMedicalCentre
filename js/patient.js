window.onload = function() {
    //validates delete patient
    var deleteLinks = document.getElementsByClassName('deletePatient');
    for (var i =0; i !== deleteLinks.length; i++) {
        var link = deleteLinks[i];
        link.addEventListener("click", deleteLink);
    }
    
    function deleteLink (event) {
        if (!confirm("are you sure you want to delete this patient?")) {
            event.preventDefault();
        }
    }
    
    //validates update patient
    var editPatientForm = document.getElementById('editPatientForm');
    if (editPatientForm !== null) {
        editPatientForm.addEventListener('submit', validatePatientForm);
    }
    
   
    
    //validates create patient
    var createPatientForm = document.getElementById('createPatientForm');
    if (createPatientForm !== null) {
        createPatientForm.addEventListener('submit', validatePatientForm);
    }
    
    function validatePatientForm(event) {
        var form = event.target;
        
        var fName = form['fName'].value;
        var lName = form['lName'].value;
        var address = form['address'].value;
        var phone = form['phone'].value;
        var doctorID = form['doctorID'].value;
        
        var spanElements = document.getElementsByClassName("error");
        for (var i =0; i !== spanElements.length; i++) {
            spanElements[i].innerHTML = "";
        }
        
        var errors = new Object();
        
        if (fName === "") {
            errors["fName"] = "This field cannot be left empty!"; 
        }
        if (lName === "") {
            errors["lName"] = "this field cannot be left empty!";
        }
        if (address === "") {
            errors["address"] = "This field cannot be left empty!";
        }
        if (phone === "") {
            errors["phone"] = "This field cannot be left empty!";
        }
        if (doctorID === "") {
            errors["doctorID"] = "This field cannot be left empty!"
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
        else if (!confirm("Save Patient?")) {
            event.preventDefault();
        }
    }
};












