<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $booking->id }}</title>
    <style>
        body { font-family: 'Helvetica Neue', 'Helvetica', sans-serif; color: #333; margin: 0; padding: 20px; }
        .invoice-box { max-width: 800px; margin: auto; padding: 30px; border: 1px solid #eee; font-size: 16px; line-height: 24px; }
        .header { text-align: center; margin-bottom: 40px; }
        .header h1 { margin: 0; color: #4f46e5; }
        .details-table { width: 100%; margin-bottom: 40px; }
        .details-table td { padding: 5px; vertical-align: top; }
        .title-row td { padding-bottom: 20px; border-bottom: 2px solid #eee; }
        .items-table { width: 100%; border-collapse: collapse; }
        .items-table th, .items-table td { text-align: left; padding: 10px; border-bottom: 1px solid #eee; }
        .items-table th { background: #f9fafb; font-weight: bold; }
        .total-row { font-weight: bold; font-size: 20px; }
        .total-row td { border-top: 2px solid #333; padding-top: 15px; }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="header">
            <h1>CarRent BD</h1>
            <p>Official Booking Invoice</p>
        </div>
        
        <table class="details-table">
            <tr class="title-row">
                <td width="50%">
                    <strong>Billed To:</strong><br>
                    {{ $booking->customer->name }}<br>
                    {{ $booking->customer->email }}
                </td>
                <td width="50%" style="text-align: right;">
                    <strong>Invoice #:</strong> {{ $booking->id }}<br>
                    <strong>Date:</strong> {{ date('M d, Y') }}<br>
                    <strong>Status:</strong> <span style="text-transform: uppercase;">{{ $booking->status }}</span>
                </td>
            </tr>
        </table>
        
        <table class="items-table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Dates</th>
                    <th>Rate/Day</th>
                    <th style="text-align: right;">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <strong>{{ $booking->car->brand }} {{ $booking->car->title }}</strong><br>
                        <small>Listed by: {{ $booking->car->owner->name }}</small>
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($booking->start_date)->format('M d, Y') }} - <br>
                        {{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}
                        <?php 
                            $days = \Carbon\Carbon::parse($booking->start_date)->diffInDays(\Carbon\Carbon::parse($booking->end_date));
                            $days = $days === 0 ? 1 : $days;
                        ?>
                        <br><small>({{ $days }} Days)</small>
                    </td>
                    <td>BDT {{ number_format($booking->car->price_per_day) }}</td>
                    <td style="text-align: right;">BDT {{ number_format($booking->total_price) }}</td>
                </tr>
                <tr class="total-row">
                    <td colspan="3" style="text-align: right;">Total Due:</td>
                    <td style="text-align: right;">BDT {{ number_format($booking->total_price) }}</td>
                </tr>
            </tbody>
        </table>
        
        <div style="margin-top: 50px; text-align: center; color: #777; font-size: 12px;">
            <p>Thank you for using CarRent BD. If you have any questions, please contact the host directly.</p>
        </div>
    </div>
</body>
</html>
