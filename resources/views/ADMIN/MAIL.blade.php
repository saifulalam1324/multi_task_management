<!DOCTYPE html>
<html>
<body>
    <h2>Hello {{ $customerName }},</h2>

    <p>Your service request has been <strong>approved</strong>!</p>

    <p><strong>Service:</strong> {{ $serviceName }}</p>
    <p><strong>Assigned Service Provider:</strong> {{ $providerName }}</p>

    <p>They will contact you soon.</p>

    <br>
    <p>Thank you!</p>
</body>
</html>
