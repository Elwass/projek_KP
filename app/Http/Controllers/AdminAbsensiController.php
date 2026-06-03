<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\User;
use Illuminate\Http\Request;
use ZipArchive;

class AdminAbsensiController extends Controller
{
    public function index(Request $request)
    {
        $absensis = $this->absensiSesuaiFilter($request);

        $pesertas = $this->queryPesertaSesuaiRole()->get(array(
            'users.id AS id',
            'users.name AS name',
            'pendaftars.nim AS nim',
        ));

        return view('admin.absensi.index', [
            'title' => 'Absensi Scan Wajah',
            'active' => 'absensi',
            'absensis' => $absensis,
            'pesertas' => $pesertas,
        ]);
    }

    public function detail($id)
    {
        $absensi = $this->queryAbsensiSesuaiRole()
            ->where('absensi.id', $id)
            ->first(array(
                'absensi.*',
                'users.name AS nama_peserta',
                'users.email AS email_peserta',
                'pendaftars.nim AS nim',
                'pendaftars.universitas AS universitas',
                'pendaftars.jurusan AS jurusan',
                'pendamping.name AS nama_pendamping',
            ));

        abort_if($absensi === null, 404);

        return view('admin.absensi.detail', [
            'title' => 'Detail Absensi Scan Wajah',
            'active' => 'absensi',
            'absensi' => $absensi,
        ]);
    }

    public function exportPdf(Request $request)
    {
        $absensis = $this->absensiSesuaiFilter($request);
        $fileName = $this->namaFileExport($request, 'pdf');

        if (class_exists('Barryvdh\\DomPDF\\Facade\\Pdf')) {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.absensi.pdf', [
                'absensis' => $absensis,
                'tanggal' => $request['tanggal'],
            ]);

            return $pdf->download($fileName);
        }

        return response($this->buatPdfSederhana($absensis), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="'.$fileName.'"',
        ]);
    }

    public function exportExcel(Request $request)
    {
        $absensis = $this->absensiSesuaiFilter($request);
        $fileName = $this->namaFileExport($request, 'xlsx');
        $path = $this->buatXlsx($absensis);

        return response()->download($path, $fileName, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ])->deleteFileAfterSend(true);
    }

    private function absensiSesuaiFilter(Request $request)
    {
        $query = $this->queryAbsensiSesuaiRole();

        if ($request['tanggal']) {
            $query->whereDate('absensi.tanggal_waktu', $request['tanggal']);
        }

        if ($request['user_id']) {
            $query->where('absensi.user_id', $request['user_id']);
        }

        return $query->orderBy('absensi.tanggal_waktu', 'DESC')
            ->get(array(
                'absensi.*',
                'users.name AS nama_peserta',
                'pendaftars.nim AS nim',
                'pendamping.name AS nama_pendamping',
            ));
    }

    private function queryAbsensiSesuaiRole()
    {
        $query = Absensi::join('users', 'users.id', '=', 'absensi.user_id')
            ->leftJoin('pendaftars', 'pendaftars.id_user', '=', 'users.id')
            ->leftJoin('pesertas', 'pesertas.id_pendaftar', '=', 'pendaftars.id')
            ->leftJoin('users as pendamping', 'pendamping.id', '=', 'pesertas.id_user');

        if (auth()->user()->role != 'admin') {
            $query->where('pesertas.id_user', auth()->user()->id);
        }

        return $query;
    }

    private function queryPesertaSesuaiRole()
    {
        $query = User::join('pendaftars', 'pendaftars.id_user', '=', 'users.id')
            ->join('pesertas', 'pesertas.id_pendaftar', '=', 'pendaftars.id')
            ->where('users.role', 'peserta');

        if (auth()->user()->role != 'admin') {
            $query->where('pesertas.id_user', auth()->user()->id);
        }

        return $query;
    }

    private function namaFileExport(Request $request, $extension)
    {
        $tanggal = $request['tanggal'] ?: 'semua_tanggal';
        return 'absensi_scan_'.$tanggal.'.'.$extension;
    }

    private function barisExport($absensis)
    {
        $rows = [[
            'No',
            'Nama Peserta',
            'NIM',
            'Waktu Absen',
            'Pendamping',
            'Status',
        ]];

        foreach ($absensis as $index => $absensi) {
            $rows[] = [
                $index + 1,
                $absensi->nama_peserta,
                $absensi->nim ?: '-',
                $absensi->tanggal_waktu,
                $absensi->nama_pendamping ?: '-',
                $absensi->status_absen,
            ];
        }

        return $rows;
    }

    private function buatXlsx($absensis)
    {
        $rows = $this->barisExport($absensis);
        $path = tempnam(sys_get_temp_dir(), 'absensi_scan_');
        $zip = new ZipArchive();
        $zip->open($path, ZipArchive::OVERWRITE);
        $zip->addFromString('[Content_Types].xml', '<?xml version="1.0" encoding="UTF-8"?><Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types"><Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml"/><Default Extension="xml" ContentType="application/xml"/><Override PartName="/xl/workbook.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml"/><Override PartName="/xl/worksheets/sheet1.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml"/></Types>');
        $zip->addFromString('_rels/.rels', '<?xml version="1.0" encoding="UTF-8"?><Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships"><Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="xl/workbook.xml"/></Relationships>');
        $zip->addFromString('xl/workbook.xml', '<?xml version="1.0" encoding="UTF-8"?><workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships"><sheets><sheet name="Absensi" sheetId="1" r:id="rId1"/></sheets></workbook>');
        $zip->addFromString('xl/_rels/workbook.xml.rels', '<?xml version="1.0" encoding="UTF-8"?><Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships"><Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet1.xml"/></Relationships>');
        $zip->addFromString('xl/worksheets/sheet1.xml', $this->sheetXml($rows));
        $zip->close();

        return $path;
    }

    private function sheetXml($rows)
    {
        $xmlRows = '';
        foreach ($rows as $rowIndex => $row) {
            $xmlRows .= '<row r="'.($rowIndex + 1).'">';
            foreach ($row as $columnIndex => $value) {
                $cell = chr(65 + $columnIndex).($rowIndex + 1);
                $xmlRows .= '<c r="'.$cell.'" t="inlineStr"><is><t>'.$this->xmlEscape($value).'</t></is></c>';
            }
            $xmlRows .= '</row>';
        }

        return '<?xml version="1.0" encoding="UTF-8"?><worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main"><sheetData>'.$xmlRows.'</sheetData></worksheet>';
    }

    private function buatPdfSederhana($absensis)
    {
        $lines = ['Laporan Absensi Scan Wajah', ''];
        foreach ($this->barisExport($absensis) as $row) {
            $lines[] = implode(' | ', $row);
        }

        $content = "BT\n/F1 10 Tf\n50 790 Td\n";
        foreach ($lines as $line) {
            $content .= '('.$this->pdfEscape(substr($line, 0, 150)).") Tj\n0 -16 Td\n";
        }
        $content .= "ET";

        $objects = [];
        $objects[] = '<< /Type /Catalog /Pages 2 0 R >>';
        $objects[] = '<< /Type /Pages /Kids [3 0 R] /Count 1 >>';
        $objects[] = '<< /Type /Page /Parent 2 0 R /MediaBox [0 0 595 842] /Resources << /Font << /F1 4 0 R >> >> /Contents 5 0 R >>';
        $objects[] = '<< /Type /Font /Subtype /Type1 /BaseFont /Courier >>';
        $objects[] = '<< /Length '.strlen($content).' >>' . "\nstream\n" . $content . "\nendstream";

        $pdf = "%PDF-1.4\n";
        $offsets = [0];
        foreach ($objects as $number => $object) {
            $offsets[] = strlen($pdf);
            $pdf .= ($number + 1)." 0 obj\n".$object."\nendobj\n";
        }
        $xref = strlen($pdf);
        $pdf .= "xref\n0 ".(count($objects) + 1)."\n0000000000 65535 f \n";
        for ($i = 1; $i <= count($objects); $i++) {
            $pdf .= sprintf('%010d 00000 n ', $offsets[$i])."\n";
        }
        $pdf .= "trailer\n<< /Size ".(count($objects) + 1)." /Root 1 0 R >>\nstartxref\n".$xref."\n%%EOF";

        return $pdf;
    }

    private function xmlEscape($value)
    {
        return htmlspecialchars((string) $value, ENT_QUOTES | ENT_XML1, 'UTF-8');
    }

    private function pdfEscape($value)
    {
        return str_replace(['\\', '(', ')'], ['\\\\', '\\(', '\\)'], (string) $value);
    }
}
