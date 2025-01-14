<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Proxy Test - Vinicius Boscolo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        input, button {
            margin: 5px;
            padding: 10px;
            font-size: 16px;
        }
        #response {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
            white-space: pre-wrap;
        }
    </style>
</head>
<body>
    <h1>API Proxy</h1>
    <p>Please input the token, and click the botton to execute de function.</p>

    <input type="text" id="token" placeholder="Input the token here" style="width: 300px;">
    <br>

    <button onclick="callApi('/api/getNumber?country=se&service=wa')">Get Number</button>
    <button onclick="callApi('/api/getSms?activation={activation}')">Get SMS</button>
    <button onclick="callApi('/api/cancelNumber?activation={activation}')">Cancel Number</button>
    <button onclick="callApi('/api/getStatus?activation={activation}')">Get Status</button>
    <h2>Resposta:</h2>
    <div id="response">
        <p>A resposta da API aparecerá aqui.</p>
    </div>
</body>
</html>
<script>
    let activationId = null; 

    async function callApi(endpoint) {
        const token = document.getElementById('token').value;
        const responseDiv = document.getElementById('response');

        if (!token) {
            responseDiv.innerHTML = '<p style="color: red;">Please, input a valid token..</p>';
            return;
        }

        if (endpoint.includes('{activation}') && activationId) {
            endpoint = endpoint.replace('{activation}', activationId);
        }

        responseDiv.innerHTML = 'Loading...';

        try {
            const response = await fetch(`${endpoint}&token=${token}`);
            const data = await response.json();

           
            if (endpoint.includes('getNumber') && data.code === 'ok') {
                activationId = data.activation;
                responseDiv.innerHTML = `<pre>${JSON.stringify(data, null, 2)}</pre>`;
                responseDiv.innerHTML += `<p style="color: green;">Activation ID saved: ${activationId}</p>`;
            } else {
                responseDiv.innerHTML = `<pre>${JSON.stringify(data, null, 2)}</pre>`;
            }
        } catch (error) {
            responseDiv.innerHTML = `<p style="color: red;">Erro to call API: ${error.message}</p>`;
        }
    }
</script>