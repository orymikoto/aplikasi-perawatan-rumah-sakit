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
      <p>10 BESAR PENYAKIT RAWAT INAP {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('F Y') }}</p>
  </div>
  <table style="margin: 0 auto">
    <thead>
      <tr>
        <th rowspan="2" style="text-align: center; border: 0.05rem solid black">No</th>
        <th rowspan="2" width="24" style="text-align: center; border: 0.05rem solid black">ICD 10</th>
        <th rowspan="2" width="32" style="text-align: center; border: 0.05rem solid black">Jenis Penyakit</th>
        <th colspan="3" style="text-align: center; border: 0.05rem solid black">TNI AD</th>
        <th colspan="3" style="text-align: center; border: 0.05rem solid black">ANGKATAN LAIN</th>
        <th rowspan="2" style="text-align: center; border: 0.05rem solid black">BPJS</th>
        <th rowspan="2" style="text-align: center; border: 0.05rem solid black">PASIEN UMUM</th>
        <th rowspan="2" style="text-align: center; border: 0.05rem solid black">JUMLAH</th>
      </tr>
      <tr>
        <th style="text-align: center; border: 0.05rem solid black">MIL</th>
        <th style="text-align: center; border: 0.05rem solid black">PNS</th>
        <th style="text-align: center; border: 0.05rem solid black">KEL</th>
        <th style="text-align: center; border: 0.05rem solid black">MIL</th>
        <th style="text-align: center; border: 0.05rem solid black">PNS</th>
        <th style="text-align: center; border: 0.05rem solid black">KEL</th>
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
        <th style="text-align: center; border: 0.05rem solid black">9</th>
        <th style="text-align: center; border: 0.05rem solid black">10</th>
        <th style="text-align: center; border: 0.05rem solid black">11</th>
        <th style="text-align: center; border: 0.05rem solid black">12</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($laporan as $key => $value)
        <tr data-entry-id="{{ $value->id }}" class="h-12 text-lg font-josefin-sans font-medium text-neutral-800">
          <td style="border: 0.05rem solid black">
            {{ $key + 1 }}
          </td>
          <td style="border: 0.05rem solid black">
            {{ $value->kode_penyakit }}</td>
          <td style="border: 0.05rem solid black">
            {{ $value->jenis_penyakit }}</td>
          <td style="border: 0.05rem solid black">
            {{ $value->tni_ad_mil }}</td>
          <td style="border: 0.05rem solid black">
            {{ $value->tni_ad_pns }}</td>
          <td style="border: 0.05rem solid black">
            {{ $value->tni_ad_kel }}</td>
          <td style="border: 0.05rem solid black">
            {{ $value->tni_al_mil }}</td>
          <td style="border: 0.05rem solid black">
            {{ $value->tni_al_pns }}</td>
          <td style="border: 0.05rem solid black">
            {{ $value->tni_al_kel }}</td>
          <td style="border: 0.05rem solid black">
            {{ $value->bpjs }}
          </td>
          <td style="border: 0.05rem solid black">
            {{ $value->pasien_umum }}</td>
          <td style="border: 0.05rem solid black">
            {{ $value->jumlah_pasien }}</td>
        </tr>
      @empty
        <tr>
          <td colspan="12" style="text-align: center; border: 0.05rem solid black">{{ __('Data Kosong') }}</td>
        </tr>
      @endforelse
      @if ($laporan->count() >= 1)
        <tr>
          <td colspan="3" style="text-align: center; border: 0.05rem solid black">JUMLAH</td>
          <td style="text-align: center; border: 0.05rem solid black">{{ $jumlah['tni_ad_mil'] }}</td>
          <td style="text-align: center; border: 0.05rem solid black">{{ $jumlah['tni_ad_pns'] }}</td>
          <td style="text-align: center; border: 0.05rem solid black">{{ $jumlah['tni_ad_kel'] }}</td>
          <td style="text-align: center; border: 0.05rem solid black">{{ $jumlah['tni_al_mil'] }}</td>
          <td style="text-align: center; border: 0.05rem solid black">{{ $jumlah['tni_al_pns'] }}</td>
          <td style="text-align: center; border: 0.05rem solid black">{{ $jumlah['tni_al_kel'] }}</td>
          <td style="text-align: center; border: 0.05rem solid black">{{ $jumlah['bpjs'] }}</td>
          <td style="text-align: center; border: 0.05rem solid black">{{ $jumlah['umum'] }}</td>
          <td style="text-align: center; border: 0.05rem solid black">{{ $jumlah['jumlah'] }}</td>
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
