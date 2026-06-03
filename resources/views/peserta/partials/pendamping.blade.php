<div class="card">
    <div class="card-header">
        <h3 class="card-title">Pendamping Lapangan</h3>
    </div>
    <div class="card-body">
        @if ($pendamping)
            <table class="table table-sm table-borderless col-6">
                <tbody>
                    <tr>
                        <td>Nama</td>
                        <td> : </td>
                        <td>{{ $pendamping->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>No Telpon</td>
                        <td> : </td>
                        <td>{{ $pendamping->no_telp ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td> : </td>
                        <td>{{ $pendamping->email ?? '-' }}</td>
                    </tr>
                </tbody>
            </table>
        @else
            <p class="mb-0">Pendamping lapangan belum tersedia.</p>
        @endif
    </div>
</div>
