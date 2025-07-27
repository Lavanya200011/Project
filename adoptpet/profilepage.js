
function previewImage(event) {
    let input = event.target;
    let reader = new FileReader();
    reader.onload = function(){
        let image = document.getElementById('uploadedImage');
        image.src = reader.result;
        image.style.display = 'block';
    };
    reader.readAsDataURL(input.files[0]);
    setTimeout(alertmsg, 400);
}



function displayIcon() {
    let ic = document.getElementById("imageUploadForm");
    ic.hidden = !ic.hidden;
}


function toggleEdit() {
    // Enable editing by removing the "readonly" attribute from input fields
    document.getElementsByName("name")[0].removeAttribute("readonly");
    document.getElementsByName("phone")[0].removeAttribute("readonly");
    document.getElementsByName("phone")[0].removeAttribute("readonly");

    // Hide the edit button and display the save button
    document.getElementById("edit").style.display = "none";
    document.getElementById("save").style.display = "block";
}

function saveChanges() {
    // Disable editing by adding the "readonly" attribute to input fields
    document.getElementsByName("name")[0].setAttribute("readonly", "readonly");
    document.getElementsByName("phone")[0].setAttribute("readonly", "readonly");
    document.getElementsByName("email")[0].setAttribute("readonly", "readonly");

    
    // Submit the form
    document.getElementById("profile-info1").submit();
   
    // Show the edit button and hide the save button
    document.getElementById("edit").style.display = "block";
    document.getElementById("save").style.display = "none";
    window.location="profile.php";

}