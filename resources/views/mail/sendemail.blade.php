<!DOCTYPE html>
<html>
<head>
    <title>Bukti Peminjaman</title>
</head>
<body>
    <h1>Bukti Peminjaman Auditiorium</h1>
    <p>Tenant Name: {{ $data['tenant_name'] }}</p>
    <p>Event Name: {{ $data['event_name'] }}</p>
    <p>Institution Origin: {{ $data['institution_origin'] }}</p>
    <p>Phone: {{ $data['phone'] }}</p>
    <p>Package Name: {{ $data['package_name'] }}</p>
    <p>Total Payment: {{ $data['total_payment'] }}</p>
    <p><img src="{{ $data['qr_code_url'] }}" alt="QR Code" width="190px"></p>
</body>
</html>
