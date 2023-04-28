<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chatbot Tool</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div id="chatbot">
        <div id="messages">
            <p class="bot-message">Bot: Hello! How can I help you?</p>
        </div>
        <form id="message-form">
            <input type="text" id="message-input">
            <button type="submit">Send</button>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            $('#message-form').submit(function(event) {
                event.preventDefault();
                var message = $('#message-input').val();
                $('#messages').append('<p class="user-message">You: ' + message + '</p>');
                $('#message-input').val('');
                $.ajax({
                    url: '/api/chatgpt-bot',
                    type: 'POST',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + '{{ env('OPENAI_API_KEY') }}'
                    },
                    data: JSON.stringify({
                        prompt: message,
                        temperature: 0.5,
                        max_tokens: 100,
                        n: 1,
                        stop: '\n'
                    }),
                    success: function(response) {
                        $('#messages').append('<p class="bot-message">Bot: ' + response.choices[0].text + '</p>');
                    },
                    error: function(xhr) {
                        console.log(xhr);
                    }
                });
            });
        });
    </script>
</body>
</html>
