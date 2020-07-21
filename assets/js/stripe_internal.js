window.onload = () => {
	let stripe = Stripe('PUBLIC_KEY');
 
	let elements = stripe.elements();
	let cardholderName = document.getElementById('cardholder-name');
	let cardButton = document.getElementById('card-button');
	let clientSecret = cardButton.dataset.secret;

	let card = elements.create("card");

	card.mount("#card-element");

	cardButton.addEventListener('click', () => {

	    stripe.handleCardPayment(
	    	
	        clientSecret, card, {
	            payment_method_data: {
	                billing_details: {name: cardholderName.value}
	            }
	        }

	    ).then(function(result) {
	        if (result.error) {

	        	if (result.error.message.includes("You passed an empty string for")) {
	        		result.error.message = "Vérifiez que tous les champs ont été complété.";
	        	}

	            document.getElementById("errors").innerText = result.error.message;

	        } else {
	        	document.getElementById("result").value = result.paymentIntent.status;
				document.getElementById("submit").submit();
			}
		})
	})
}
