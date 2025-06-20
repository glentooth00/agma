    //loadscreen
    window.onload = function () {
        console.log("im present in member.php");
        // Hide the loading overlay
        document.getElementById("loaderOverlay").style.display = "none";

        // Show the main content
        document.getElementById("pageContent").style.display = "block";
    };

    //delete popup
    function deletePopup(button) {
        var x = document.getElementById("deletePopup");

        var id = button.getAttribute('data-id');

        document.getElementById('deleteIdValue').value = id;

        // Toggle the popup display
        x.style.display = (x.style.display === "block") ? "none" : "block";
    }


    //hide popup cancel delete
    function cancelDelete(){
        var x = document.getElementById("deletePopup");
        if(x.style.display === "none"){
            x.style.display = "block";

        }else{
            x.style.display = "none";
        }
    }