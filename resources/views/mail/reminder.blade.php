<!DOCTYPE html>
<html>
<head>
    <title>Event Reminder</title>
</head>
<body>
    <h1>Hello, {{ $tenant_name }}</h1>
    <p>This is a reminder for your upcoming event:</p>
    <p>Event Name: {{ $event_name }}</p>
    <p>Event Date: {{ date('d F Y', strtotime($event_date)) }}</p>
    <p>Thank you!</p>
</body>
</html>