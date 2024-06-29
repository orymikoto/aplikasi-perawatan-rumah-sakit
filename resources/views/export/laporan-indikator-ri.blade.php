<table>
    <tr>
        <td colspan="4">DETASEMEN KESEHATAN WILAYAH MALANG</td>
    </tr>
    <tr>
        <td colspan="4">RUMAH SAKIT TINGKAT III BALADHIKA HUSADA</td>
    </tr>
    <tr></tr>
    <tr></tr>
    <tr>
        <td colspan="11">NILAI PARAMETER DAN KINERJA FKTL RUMKIT</td>
    </tr>
    <tr>
        <td colspan="4"></td>
        <td>BULAN</td>
        <td>:</td>
        <td colspan="3">{{ \Carbon\Carbon::parse($tanggal)->translatedFormat('F') }}</td>
    </tr>
    <tr>
        <td colspan="4"></td>
        <td>TRIWUL</td>
        <td>:</td>
        <td colspan="3">{{ ceil((int) \Carbon\Carbon::parse($tanggal)->month / 4) }}</td>
    </tr>
    <tr>
        <td colspan="4"></td>
        <td>TAHUN</td>
        <td>:</td>


        <td colspan="3">{{ \Carbon\Carbon::parse($tanggal)->year }}</td>
    </tr>
    <thead>
        <tr>
            <th rowspan="2" style="text-align: center; border: 1rem solid black">No</th>
            <th rowspan="2" width="24" style="text-align: center; border: 1rem solid black">ICD 10</th>
            <th rowspan="2" width="32" style="text-align: center; border: 1rem solid black">Jenis Penyakit</th>
            <th colspan="3" style="text-align: center; border: 1rem solid black">TNI AD</th>
            <th colspan="3" style="text-align: center; border: 1rem solid black">ANGKATAN LAIN</th>
            <th rowspan="2" style="text-align: center; border: 1rem solid black">BPJS</th>
            <th rowspan="2" style="text-align: center; border: 1rem solid black">PASIEN UMUM</th>
            <th rowspan="2" style="text-align: center; border: 1rem solid black">JUMLAH</th>
        </tr>
        <tr>
            <th style="text-align: center; border: 1rem solid black">MIL</th>
            <th style="text-align: center; border: 1rem solid black">PNS</th>
            <th style="text-align: center; border: 1rem solid black">KEL</th>
            <th style="text-align: center; border: 1rem solid black">MIL</th>
            <th style="text-align: center; border: 1rem solid black">PNS</th>
            <th style="text-align: center; border: 1rem solid black">KEL</th>
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
            <th style="text-align: center; border: 1rem solid black">9</th>
            <th style="text-align: center; border: 1rem solid black">10</th>
            <th style="text-align: center; border: 1rem solid black">11</th>
            <th style="text-align: center; border: 1rem solid black">12</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($laporan as $key => $value)
            <tr data-entry-id="{{ $value->id }}" class="h-12 text-lg font-josefin-sans font-medium text-neutral-800">
                <td style="border: 1rem solid black">
                    {{ $key + 1 }}
                </td>
                <td style="border: 1rem solid black">
                    {{ $value->kode_penyakit }}</td>
                <td style="border: 1rem solid black">
                    {{ $value->jenis_penyakit }}</td>
                <td style="border: 1rem solid black">
                    {{ $value->tni_ad_mil }}</td>
                <td style="border: 1rem solid black">
                    {{ $value->tni_ad_pns }}</td>
                <td style="border: 1rem solid black">
                    {{ $value->tni_ad_kel }}</td>
                <td style="border: 1rem solid black">
                    {{ $value->tni_al_mil }}</td>
                <td style="border: 1rem solid black">
                    {{ $value->tni_al_pns }}</td>
                <td style="border: 1rem solid black">
                    {{ $value->tni_al_kel }}</td>
                <td style="border: 1rem solid black">
                    {{ $value->bpjs }}
                </td>
                <td style="border: 1rem solid black">
                    {{ $value->pasien_umum }}</td>
                <td style="border: 1rem solid black">
                    {{ $value->jumlah_pasien }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="12" style="text-align: center; border: 1rem solid black">{{ __('Data Kosong') }}</td>
            </tr>
        @endforelse
        @if ($laporan->count() >= 1)
            <tr>
                <td colspan="3" style="text-align: center; border: 1rem solid black">JUMLAH</td>
                <td style="text-align: center; border: 1rem solid black">{{ $jumlah['tni_ad_mil'] }}</td>
                <td style="text-align: center; border: 1rem solid black">{{ $jumlah['tni_ad_pns'] }}</td>
                <td style="text-align: center; border: 1rem solid black">{{ $jumlah['tni_ad_kel'] }}</td>
                <td style="text-align: center; border: 1rem solid black">{{ $jumlah['tni_al_mil'] }}</td>
                <td style="text-align: center; border: 1rem solid black">{{ $jumlah['tni_al_pns'] }}</td>
                <td style="text-align: center; border: 1rem solid black">{{ $jumlah['tni_al_kel'] }}</td>
                <td style="text-align: center; border: 1rem solid black">{{ $jumlah['bpjs'] }}</td>
                <td style="text-align: center; border: 1rem solid black">{{ $jumlah['umum'] }}</td>
                <td style="text-align: center; border: 1rem solid black">{{ $jumlah['jumlah'] }}</td>
            </tr>
        @endif
    </tbody>
    <tr></tr>
    <tr>
        <td colspan="4"></td>
        <td colspan="9" style="text-align: center;">Jember
            {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('F Y') }}</td>
    </tr>
    <tr>
        <td colspan="4"></td>
        <td colspan="9" style="text-align: center;">Karumkit Tk. III Baladhika Husada</td>
    </tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr>
        <td colspan="4"></td>
        <td colspan="9" style="text-align: center; vertical-align: baseline" height="24">dr. Arif Puguh Santoso,
            Sp.PD., M.Kes</td>
    </tr>
    <tr>
        <td colspan="4"></td>
        <td colspan="9" style="text-align: center; vertical-align: baseline" height="24">Letnan Kolonel Ckm NRP
            21980081340177</td>
    </tr>
</table>
