// Set publishable key
Stripe.setPublishableKey('pk_test_j2jVkiqtsogg9pz7X981wMAG');

// Get the form
var $form = $('#ch-form');

$form.submit(function (event){ // Upon form submission execute followin code
    // Hide all errors. There can't be any errors at this stage
    $('#charge-error').addClass('hidden');
    
    // Disable form's submission untill we get the response
    $form.find('button').prop('disabled', true);
    
    // Converts card data to a single-use token that you can safely pass to your server to charge the user
    Stripe.card.createToken({
        name: $('#card-name').val(),
        number: $('#card-number').val(),
        cvc: $('#card-cvc').val(),
        exp_month: $('#card-expiry-month').val(),
        exp_year: $('#card-expiry-year').val()
    }, stripeResponseHandler);
    
    // Stop form submission until we get the response and process it with the handler
    return false;
});

function stripeResponseHandler(status, response) {
    if (response.error) { // Problem!

        // Show the errors on the form
        $('#charge-error').removeClass('hidden');
        $('#charge-error').text(response.error.message);
        $form.find('button').prop('disabled', false); // Re-enable submission

    } else { // Token was created!
        
        // Get the token ID:        
        var token = response.id;
        
        // Insert the token into the form so it gets submitted to the server:
        $form.append($('<input type="hidden" name="stripe_token" />').val(token));

        // Submit the form:
        $form.get(0).submit();
    }
}