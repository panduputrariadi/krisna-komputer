<div class="overview">
    <div class="title">
        <i class="uil uil-tachometer-fast-alt"></i>
        <span class="text">Dashboard</span>
    </div>

    <div class="boxes">
        <div class="box box1">
            <i class="uil uil-package"></i>
            <span class="text">Total Pembelian</span>
            <span class="number">Rp {{ number_format($count, 0, ',', '.') }}</span>
        </div>
        <div class="box box2">
            <i class="uil uil-box"></i>
            <span class="text">Produk Tersedia</span>
            <span class="number">{{$countItems}}</span>
        </div>
        <div class="box box3">
            <i class="uil uil-share"></i>
            <span class="text">Total Share</span>
            <span class="number">10,120</span>
        </div>
    </div>
</div>
