<style>
    svg {
        margin: 0 auto;
        display: block;
    }
</style>
<div class="card">
    <div class="card-body">
        {!! QrCode::size(300)->generate(base64_decode($qr->qr_str)) !!}
    </div>
</div>