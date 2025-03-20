
$(document).on("click", ".addwish", function () {
    var button = $(this);
    var id = button.attr("id");
    var heartIcon = button.find("i");

    // Apply the rotation effect using CSS
    heartIcon.css({
        "transition": "transform 0.5s", // Smooth transition for rotation
        "transform": "rotateY(360deg)"   // 360-degree rotation
    });

    // Wait for the rotation to finish before changing the button's appearance
    setTimeout(function () {
        // Send AJAX request after rotation
        $.ajax({
            url: 'wishlist.php',
            type: 'POST',
            data: { product_id: id }, // Send the correct product ID
            success: function (response) {
                // Parse response if necessary
                if (typeof response !== "object") {
                    response = JSON.parse(response);
                }

                // Handle the response
                if (response.status === "added") {
                    button
                        .addClass('added')
                        .attr('title', 'Added to wishlist')
                        .html('<i class="fa-solid fa-heart heart"></i>');  // Heart filled
                    showMessage("Product added to wishlist", false);
                } else if (response.status === "removed") {
                    button
                        .removeClass('added')
                        .attr('title', 'Add to wishlist')
                        .html('<i class="fa-regular fa-heart heart"></i>');  // Heart outline
                    showMessage("Product removed from wishlist", false);
                } else if (response.status === "error") {
                    // This part handles when the user is not logged in
                    showMessage(response.message, true); // Show login error message
                } else {
                    showMessage("Something went wrong", true); // Fallback error message
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", error);
                showMessage("An error occurred. Please try again.", true);
            }
        });
    }, 500); // Ensure the button appearance change happens after rotation is completed (500ms)
    
});

// Function to display messages
function showMessage(message, isError) {
    const alertDiv = $("#message-alert");
    
    // Set the message and remove/add error class based on the type
    alertDiv
        .removeClass("error success")
        .text(message)
        .addClass(isError ? "error" : "success")
        .fadeIn(); // Show the alert

    // Automatically hide the message after 3 seconds
    setTimeout(() => {
        alertDiv.fadeOut(); // Fade out and hide the message
    }, 3000);
}
$(document).on('click', '.delete-btn', function () {
    const productId = $(this).data('product-id');
    const productElement = $(this).closest('.product');
// alert(productId);
    $.ajax({
        url: 'delete_wishlist.php',
        type: 'POST',
        data: { product_id: productId },
        success: function (response) {
            const result = JSON.parse(response);
            if (result.status === 'success') {
                productElement.remove(); // Remove the product from UI
                alert(result.message); // Show success message
            } else {
                alert(result.message); // Show error message
            }
        },
        error: function () {
            alert('Error processing your request.');
        }
    });
});

