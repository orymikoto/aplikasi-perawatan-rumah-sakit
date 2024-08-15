<table>
  <tr style="border: 0;">
    <td colspan="4" style="border: 0;">DETASEMEN KESEHATAN WILAYAH MALANG</td>
  </tr>
  <tr>
    <td colspan="4">RUMAH SAKIT TINGKAT III BALADHIKA HUSADA</td>
  </tr>
  <tr></tr>
  <tr></tr>
  <tr>
    <td colspan="11" style="text-align: center;">NILAI PARAMETER DAN KINERJA FKTL RUMKIT</td>
  </tr>
  <tr>
    <td colspan="11" style="text-align: center;">BULAN {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('F Y') }}</td>
  </tr>
  <tr></tr>
  <thead>
    <tr>
      <th rowspan="2" style="text-align: center; border: 1rem solid black; word-wrap: break-word; vertical-align: middle">NO</th>
      <th rowspan="2" width="36" style="text-align: center; border: 1rem solid black; word-wrap: break-word; vertical-align: middle">NAMA FKTL
      </th>
      <th rowspan="3" style="text-align: center; border: 1rem solid black; word-wrap: break-word; vertical-align: middle">TEMPAT TIDUR</th>
      <th colspan="6" style="text-align: center; border: 1rem solid black; word-wrap: break-word; vertical-align: middle">NILAI PARAMETER</th>
      <th rowspan="2" style="text-align: center; border: 1rem solid black; word-wrap: break-word; vertical-align: middle">TOTAL NILAI KINERJA</th>
      <th rowspan="2" style="text-align: center; border: 1rem solid black; word-wrap: break-word; vertical-align: middle">KETERANGAN</th>
    </tr>
    <tr>
      <th width="16" style="text-align: center; border: 1rem solid black">BOR</th>
      <th width="16" style="text-align: center; border: 1rem solid black">BTO</th>
      <th width="16" style="text-align: center; border: 1rem solid black">ALOS</th>
      <th width="16" style="text-align: center; border: 1rem solid black">TOI</th>
      <th width="16" style="text-align: center; border: 1rem solid black">GDR</th>
      <th width="16" style="text-align: center; border: 1rem solid black">NDR</th>
    </tr>
    <tr>
      <th style="text-align: center; border: 1rem solid black">1</th>
      <th style="text-align: center; border: 1rem solid black">2</th>
      <th style="text-align: center; border: 1rem solid black">3</th>
      <th style="text-align: center; border: 1rem solid black">4</th>
      <th style="text-align: center; border: 1rem solid black">5</th>
      <th style="text-align: center; border: 1rem solid black">6</th>
      <th style="text-align: center; border: 1rem solid black">7</th>
      <th style="text-align: center; border: 1rem solid black">8</th>
      <th width="16" style="text-align: center; border: 1rem solid black">9</th>
      <th width="16" style="text-align: center; border: 1rem solid black">10</th>
    </tr>
  </thead>
  <tbody>
    @if ($laporan)
      <tr height="72" data-entry-id="{{ $laporan->id }}" class="h-12 text-lg font-josefin-sans font-medium text-neutral-800">
        <td style="border: 1rem solid black;  text-align: center; vertical-align: middle;">
          1
        </td>
        <td style="border: 1rem solid black; vertical-align: middle;">
          RUMKIT TK. III BALADHIKA HUSADA</td>
        <td style="border: 1rem solid black;  text-align: center; vertical-align: middle;">
          {{ $laporan->jumlah_tempat_tidur }}</td>
        <td style="border: 1rem solid black; text-align: center; vertical-align: middle;">{{ $laporan->nilai_bor }}%</td>
        <td style="border: 1rem solid black; text-align: center; vertical-align: middle;">{{ $laporan->nilai_bto }}</td>
        <td style="border: 1rem solid black; text-align: center; vertical-align: middle;">{{ $laporan->nilai_alos }}</td>
        <td style="border: 1rem solid black; text-align: center; vertical-align: middle;">{{ $laporan->nilai_toi }}</td>
        <td style="border: 1rem solid black; text-align: center; vertical-align: middle;">{{ $laporan->nilai_gdr }}&#8240;</td>
        <td style="border: 1rem solid black; text-align: center; vertical-align: middle;">{{ $laporan->nilai_ndr }}&#8240;</td>
        <td style="border: 1rem solid black; text-align: center; vertical-align: middle;"></td>
        <td style="border: 1rem solid black; text-align: center; vertical-align: middle;"></td>
      </tr>
    @else
      <tr>
        <td colspan="11" style="text-align: center; border: 1rem solid black">{{ __('Data Kosong') }}</td>
      </tr>
    @endif
  </tbody>
  <tr></tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="4" style="text-align: center;">Jember
      {{ \Carbon\Carbon::parse($tanggal)->addMonth(1)->translatedFormat('F Y') }}</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="4" style="text-align: center;">Karumkit Tk. III Baladhika Husada</td>
  </tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="4" style="text-align: center; vertical-align: baseline" height="24">dr. Arif Puguh Santoso,
      Sp.PD., M.Kes</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="4" style="text-align: center; vertical-align: baseline" height="24">Letnan Kolonel Ckm NRP
      21980081340177</td>
  </tr>
</table>
