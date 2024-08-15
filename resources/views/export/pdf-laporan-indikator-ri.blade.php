<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PDF Laporan Indikator RI</title>
</head>

<body>
  <div style="text-align: center">
    <h4>DETASEMEN KESEHATAN WILAYAH MALANG</h4>
    <h4>RUMAH SAKIT TINGKAT III BALADHIKA HUSADA</h5>
      <p>NILAI PARAMETER DAN KINERJA FKTL RUMKIT BULAN {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('F Y') }}</p>
  </div>
  <table style="margin: 0 auto">
    <thead>
      <tr>
        <th rowspan="2" style="text-align: center; border: 0.05rem solid black; word-wrap: break-word; vertical-align: middle">NO</th>
        <th rowspan="2" width="36" style="text-align: center; border: 0.05rem solid black; word-wrap: break-word; vertical-align: middle">NAMA
          FKTL
        </th>
        <th rowspan="3" style="text-align: center; border: 0.05rem solid black; word-wrap: break-word; vertical-align: middle">TEMPAT TIDUR</th>
        <th colspan="6" style="text-align: center; border: 0.05rem solid black; word-wrap: break-word; vertical-align: middle">NILAI PARAMETER</th>
        <th rowspan="2" style="text-align: center; border: 0.05rem solid black; word-wrap: break-word; vertical-align: middle">TOTAL NILAI KINERJA
        </th>
        <th rowspan="2" style="text-align: center; border: 0.05rem solid black; word-wrap: break-word; vertical-align: middle">KETERANGAN</th>
      </tr>
      <tr>
        <th width="16" style="text-align: center; border: 0.05rem solid black">BOR</th>
        <th width="16" style="text-align: center; border: 0.05rem solid black">BTO</th>
        <th width="16" style="text-align: center; border: 0.05rem solid black">ALOS</th>
        <th width="16" style="text-align: center; border: 0.05rem solid black">TOI</th>
        <th width="16" style="text-align: center; border: 0.05rem solid black">GDR</th>
        <th width="16" style="text-align: center; border: 0.05rem solid black">NDR</th>
      </tr>
      <tr>
        <th style="text-align: center; border: 0.05rem solid black">1</th>
        <th style="text-align: center; border: 0.05rem solid black">2</th>
        <th style="text-align: center; border: 0.05rem solid black">3</th>
        <th style="text-align: center; border: 0.05rem solid black">4</th>
        <th style="text-align: center; border: 0.05rem solid black">5</th>
        <th style="text-align: center; border: 0.05rem solid black">6</th>
        <th style="text-align: center; border: 0.05rem solid black">7</th>
        <th style="text-align: center; border: 0.05rem solid black">8</th>
        <th width="16" style="text-align: center; border: 0.05rem solid black">9</th>
        <th width="16" style="text-align: center; border: 0.05rem solid black">10</th>
      </tr>
    </thead>
    <tbody>
      @if ($laporan)
        <tr height="72" data-entry-id="{{ $laporan->id }}" class="h-12 text-lg font-josefin-sans font-medium text-neutral-800">
          <td style="border: 0.05rem solid black;  text-align: center; vertical-align: middle;">
            1
          </td>
          <td style="border: 0.05rem solid black; vertical-align: middle;">
            RUMKIT TK. III BALADHIKA HUSADA</td>
          <td style="border: 0.05rem solid black;  text-align: center; vertical-align: middle;">
            {{ $laporan->jumlah_tempat_tidur }}</td>
          <td style="border: 0.05rem solid black; text-align: center; vertical-align: middle;">{{ $laporan->nilai_bor }}%</td>
          <td style="border: 0.05rem solid black; text-align: center; vertical-align: middle;">{{ $laporan->nilai_bto }}</td>
          <td style="border: 0.05rem solid black; text-align: center; vertical-align: middle;">{{ $laporan->nilai_alos }}</td>
          <td style="border: 0.05rem solid black; text-align: center; vertical-align: middle;">{{ $laporan->nilai_toi }}</td>
          <td style="border: 0.05rem solid black; text-align: center; vertical-align: middle;">{{ $laporan->nilai_gdr }}&#8240;</td>
          <td style="border: 0.05rem solid black; text-align: center; vertical-align: middle;">{{ $laporan->nilai_ndr }}&#8240;</td>
          <td style="border: 0.05rem solid black; text-align: center; vertical-align: middle;"></td>
          <td style="border: 0.05rem solid black; text-align: center; vertical-align: middle;"></td>
        </tr>
      @else
        <tr>
          <td colspan="11" style="text-align: center; border: 0.05rem solid black">{{ __('Data Kosong') }}</td>
        </tr>
      @endif
    </tbody>
  </table>
  <div style="position: absolute; right: 8pt; bottom: 24pt; ">
    <div style="display: flex; flex-direction: column; row-gap: 0.1rem; margin-bottom: 4rem">
      <p>Jember {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('F Y') }}</p>
      <p>Karumkit Tk. III Baladhika Husada</p>
    </div>
    <div style="display: flex; flex-direction: column; row-gap: 0.1rem">
      <p>dr. Arif Puguh Santoso, Sp.PD., M.Kes</p>
      <p>Letnan Kolonel Ckm NRP 21980081340177</p>
    </div>
  </div>
</body>


</html>
