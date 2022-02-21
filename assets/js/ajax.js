// Ajax requests JS
(function() {
	// Lets create an object for our data
	let obj = {};
	obj.data = 'Hello world!';

	// Lets format the data to send via ajax
	let data = 'action=send_hello_world&security=' + wp_example_admin_ajax.security + '&sendData=' + JSON.stringify(obj);

	// New request
	let request = new XMLHttpRequest();

	request.onreadystatechange = function () {
		if (request.readyState === 4) {
			// Format response
			const response = JSON.parse(request.response);

			// Console.log the response
			console.log(response.message);
		}
	};

	// Send the data
	request.open('POST', wp_example_admin_ajax.ajaxurl, true);
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
	request.send(data);
} ());