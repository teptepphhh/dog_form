$( document ).ready(function() {
    console.log( "ready!" );

    //Fetch the list of breeds for the dropdown menu
    $.ajax({
      url: '/breeds',  // Endpoint to fetch breed list
      type: 'GET',
      success: function(response) {
          if (response.breeds) {
              const breedSelect = $('#breed-select'); //Dropdown element
              // Populate dropdown with the available breeds
              response.breeds.forEach(breed => {
                  const option = $('<option>').attr('value', breed).text(breed); //Creating the option for each breed
                  breedSelect.append(option);
              });
          } else {
              console.error('Failed to load breeds:', response.error); //Server-side error
          }
      },
      error: function(xhr) {
          console.error('Error fetching breeds:', xhr.responseText); //AJAX error
      }
  });

  // Handle the button click to fetch and display the dog image
  $('.generate-dog').click(function() {
      const breed = $('#breed-select').val();  // Get the selected breed

      //Error Validation if no breed is selected
      if (!breed) {
          alert("Please select a breed!");
          return;
      }

      console.log("Showing the spinner..."); //Debug log for spinner

      $('#spinner').show();  // Show spinner while fetching the image 
      $('#image-container').html('');  // Clear the image container before the new image 


      console.log("Spinner display: ", $('#spinner').css('display')); // Check display style

      const csrfToken = $('meta[name="csrf-token"]').attr('content'); //CSRF token for secure POST requests

      // Make the POST request to fetch the image for the selected breed
      $.ajax({
          url: '/fetch_dog',  // Laravel endpoint to fetch dog image by breed
          type: 'POST',
          data: { 
            breed: breed // Send selected breed in the request
          },  
          headers: {
            'X-CSRF-TOKEN': csrfToken  // Include the CSRF token for Laravel
        },
          success: function(response) {
            console.log("Hiding the spinner..."); // Debug log when spinner should be hidden

            $('#spinner').hide(); // Hide the spinner

              if (response.image_url) {
                  // Clear previous images
                  $('#image-container').html('');

                  // Create a new img element with the fetched URL
                  const imgElement = $('<img>').attr('src', response.image_url).attr('alt', 'Dog Image');

                  // Append the img element to the container
                  $('#image-container').append(imgElement);
              } else {
                  console.error('Failed to fetch image:', response.error); //For server-side error
              }
          },
          error: function(xhr) {
            $('#spinner').hide(); // Hide the spinner
              console.error('Error fetching dog image:', xhr.responseText); //For error response
          }
        });
      });

});