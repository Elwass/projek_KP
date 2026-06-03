@if ($status == 'hadir')
    <span class="badge badge-success">hadir</span>
@elseif ($status == 'terlambat')
    <span class="badge badge-warning">terlambat</span>
@else
    <span class="badge badge-info">izin</span>
@endif
