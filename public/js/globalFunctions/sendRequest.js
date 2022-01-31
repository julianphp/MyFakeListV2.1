async function sendRequest(url, body = {},headers = {}, method = 'POST') {

    headers['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').content;
    headers['Content-Type'] = typeof headers['Content-Type'] === 'undefined' ? 'application/json' : headers['Content-Type'];
    console.log(headers);
    const response = await fetch(APP_URL + url, {
        method: method,
        body: JSON.stringify(
            body
        ),
        headers: headers,
    });
    if (!response.ok) {
        return {'error': true};
    }
    return response.json();
}
