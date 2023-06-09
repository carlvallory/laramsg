<div class="card">
    <div class="card-header">
        <h2>Simple QR Code</h2>
    </div>
    <div class="card-body">
        {!! QrCode::size(300)->generate(base64_decode($qr->qr_str)) !!}
    </div>
</div>