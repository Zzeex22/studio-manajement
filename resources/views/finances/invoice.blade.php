<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kuitansi Pembayaran Resmi</title>
    <style>
        body {
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #333;
            line-height: 1.4;
            margin: 0;
            padding: 20px;
        }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        }
        .title-section {
            text-align: right;
            margin-bottom: 40px;
        }
        .title-section h1 {
            margin: 0;
            color: #2c3e50;
            font-size: 28px;
            text-transform: uppercase;
        }
        .info-table {
            width: 100%;
            margin-bottom: 40px;
            border-collapse: collapse;
        }
        .info-table td {
            padding-bottom: 20px;
            vertical-align: top;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }
        .details-table th {
            background: #2c3e50;
            color: #fff;
            text-align: left;
            padding: 10px;
            font-size: 14px;
        }
        .details-table td {
            padding: 12px 10px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }
        .total-section {
            text-align: right;
            margin-top: 20px;
        }
        .total-section h2 {
            margin: 0;
            color: #2c3e50;
        }
        .footer-note {
            margin-top: 60px;
            text-align: center;
            font-size: 12px;
            color: #777;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
    </style>
</head>
<body>

    <div class="invoice-box">
        <table class="info-table">
            <tr>
                <td>
                    <strong style="font-size: 18px; color: #2c3e50;">3 ALL STORE STUDIO</strong><br>
                    Layanan Kreatif Desain Grafis & Digital<br>
                    Medan, Sumatera Utara<br>
                    Email: studio@3allstore.com
                </td>
                <td style="text-align: right;">
                    <span style="font-size: 13px; color: #777;">NOMOR NOTA:</span><br>
                    <strong>{{ $invoice_number }}</strong><br><br>
                    <span style="font-size: 13px; color: #777;">TANGGAL CETAK:</span><br>
                    <strong>{{ $date }}</strong>
                </td>
            </tr>
        </table>

        <div class="title-section">
            <h1>Kuitansi Bukti Transaksi</h1>
            <p style="margin: 5px 0 0 0; color: #777;">Status: 
                <span style="color: green; font-weight: bold;">
                    {{ $finance->transaction_type === 'income' ? 'PEMBAYARAN DITERIMA' : 'PENGELUARAN SAH' }}
                </span>
            </p>
        </div>

        <table class="details-table">
            <thead>
                <tr>
                    <th>Deskripsi Transaksi</th>
                    <th>Terkait Project</th>
                    <th>Nama Klien / Instansi</th>
                    <th style="text-align: right;">Total Nominal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $finance->description }}</td>
                    <td>{{ $finance->project ? $finance->project->title : 'Operasional Umum' }}</td>
                    <td>{{ $finance->project && $finance->project->client ? $finance->project->client->name : 'Internal Studio' }}</td>
                    <td style="text-align: right; font-weight: bold;">
                        Rp {{ number_format($finance->amount, 0, ',', '.') }}
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="total-section">
            <p style="margin: 0; color: #777; font-size: 13px;">TOTAL JUMLAH</p>
            <h2>Rp {{ number_format($finance->amount, 0, ',', '.') }}</h2>
        </div>

        <div class="footer-note">
            Terima kasih telah memercayakan project desain Anda kepada kami.<br>
            Kuitansi ini diterbitkan secara sah oleh sistem komputerisasi manajemen internal studio.
        </div>
    </div>

</body>
</html>