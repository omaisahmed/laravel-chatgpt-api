<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<style>
		.container {
			max-width: 800px;
			margin: 0 auto;
			padding: 20px;
			border: 1px solid #ccc;
			border-radius: 10px;
		}

		input[type="text"] {
			width: 100%;
			padding: 10px;
			border: none;
			border-radius: 5px;
			box-shadow: 0 0 5px #ccc;
		}

		button {
			display: block;
			margin-top: 10px;
			padding: 10px;
			background-color: #007bff;
			color: #fff;
			border: none;
			border-radius: 5px;
			cursor: pointer;
		}

		.message {
			margin-top: 10px;
			padding: 10px;
			background-color: #f5f5f5;
			border-radius: 5px;
		}
	</style>
</head>
<body>
	<div class="container">
		{{-- <h1>ChatGPT Tool</h1> --}}
        {{-- <form method="GET">
        @csrf --}}
		<input type="text" id="userMessage" placeholder="Enter your message...">
		<button id="sendBtn">Send</button>
        {{-- </form> --}}
		<div id="responseContainer"></div>
	</div>

	<script>
		const sendBtn = document.querySelector('#sendBtn');
		const userMessage = document.querySelector('#userMessage');
		const responseContainer = document.querySelector('#responseContainer');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

		sendBtn.addEventListener('click', async () => {
			const message = userMessage.value.trim();
			if (!message) return;

			const response = await fetch('/api/chatbot', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
				},
				body: JSON.stringify({
					message: message
				})
			});

			const data = await response.json();
			const generatedText = data.message;
			responseContainer.innerHTML += `<div class="message"><strong>You:</strong> ${message}</div>`;
			responseContainer.innerHTML += `<div class="message"><strong>ChatGPT:</strong> ${generatedText}</div>`;
			userMessage.value = '';
		});
	</script>
</body>
</html>
