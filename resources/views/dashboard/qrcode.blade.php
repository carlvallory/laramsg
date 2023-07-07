<style>
    svg {
        margin: 40px auto;
        display: block;
    }
</style>
<div class="card">
    <div class="card-body">
        {!! QrCode::size(300)->generate(base64_decode($qr->qr_str)) !!}
    </div>
</div>