@if ($status == 'pending')
    <span class="badge badge-warning">pending</span>
@elseif ($status == 'disetujui')
    <span class="badge badge-success">disetujui</span>
@elseif ($status == 'revisi')
    <span class="badge badge-info">revisi</span>
@else
    <span class="badge badge-danger">ditolak</span>
@endif
