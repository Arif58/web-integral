<table>
    <thead>
        <tr>
            <th style="background: #84e184"><b>No</b></th>
            <th style="background: #84e184"><b>Kode Peserta</b></th>
            <th style="background: #84e184"><b>Asal Sekolah</b></th>
            <th style="background: #84e184"><b>Nama Lengkap</b></th>
            @foreach ($subTestName as $id => $name)
                <th style="background: #80bfff"><b>Subtes {{ $name }}</b></th>
            @endforeach
            <th style="background: #ffdb4d"><b>Total</b></th>

        </tr>
    </thead>
    <tbody>
        @foreach ($averageScores as $participantId => $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data['participantId'] }}</td>
                <td>{{ $data['school'] }}</td>
                <td>{{ $data['fullname'] }}</td>
                @foreach ($subTestName as $subTestId => $name)
                    <td>{{ $data['subTestScores'][$subTestId] ?? 0 }}</td>
                @endforeach
                <td>{{ $data['total'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
