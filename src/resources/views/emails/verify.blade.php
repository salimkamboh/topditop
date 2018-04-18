<!DOCTYPE html>
<html lang="de-DE">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Verifizierung Ihrer Email Addresse</h2>

<p>
    Vielen Dank für Ihre Anmeldung bei TopDiTop. Bitte klicken Sie auf den folgenden Link um Ihre Emailadresse zu verifizieren:
    <a href="{{ url('register/verify/' . $confirmation_code) }}" target="_blank">{{ url('register/verify/' . $confirmation_code) }}</a>
</p>
<p>
    Bei Fragen zu Ihrem TopDiTop Store schreiben Sie uns gerne eine Email an <a href="mailto:alexander.geringer@topditop.com">alexander.geringer@topditop.com</a>
</p>
<p>
    Mit freundlichen Grüssen
</p>
<p>
    Ihr TopdiTop Team
</p>

</body>
</html>