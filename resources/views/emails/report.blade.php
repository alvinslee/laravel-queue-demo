<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Your Inventory Report</title>
</head>
<body>
    <h1>Your Inventory Report is Ready</h1>
    <p>Your requested report "{{ $report->name }}" has been generated and is attached to this email.</p>
    <p>Generated at: {{ $report->completed_at->format('Y-m-d H:i:s') }}</p>
</body>
</html> 