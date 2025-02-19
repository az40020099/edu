document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("certificateForm");
    const nameInput = document.getElementById("nameInput");
    const templateSelect = document.getElementById("templateSelect");
    const exportButton = document.getElementById("exportButton");
    const shareButton = document.getElementById("shareButton");

    form.addEventListener("submit", function(event) {
        event.preventDefault();
        validateForm();
    });

    exportButton.addEventListener("click", function() {
        exportCertificate();
    });

    shareButton.addEventListener("click", function() {
        shareCertificate();
    });

    function validateForm() {
        if (nameInput.value.trim() === "") {
            alert("Please enter a name.");
            return false;
        }
        // Additional validation logic can be added here
        return true;
    }

    function exportCertificate() {
        if (validateForm()) {
            // Logic to export the certificate as PDF or image
            alert("Certificate exported successfully!");
        }
    }

    function shareCertificate() {
        // Logic to share the certificate via WhatsApp and Facebook
        alert("Certificate shared successfully!");
    }
});