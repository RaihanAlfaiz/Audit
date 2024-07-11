<!DOCTYPE html>
<html>
<head>
    <title>Reminder Email</title>
</head>
<body>
    <p>Dear {{ $event->tenant_name }},</p>
    <p>This is a reminder to complete your payment for the event <strong>{{ $event->event_name }}</strong> scheduled on {{ $event->event_date }}.</p>
    <p>Please complete the payment by providing the required documents within the next 4 days to avoid cancellation.</p>
    <p>Thank you!</p>
</body>
</html>
