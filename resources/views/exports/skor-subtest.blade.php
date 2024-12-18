<h3>SubTest : {{ $subTestName }}</h3>
<table>
    <thead>
        <tr>
            <th style="background: #80bfff">Kode Peserta</th>
            <th style="background: #80bfff">Nama Lengkap</th>
            <th style="background: #80bfff">Asal Sekolah</th>
            @foreach ($questionId as $index => $question)
                <th style="background: #80bfff">Nomor: {{$index+1}} ({{ $question }})</th>
            @endforeach
            <th> </th>
            @foreach ($questionId as $index => $question)
                <th style="background: #ffdb4d">Skor: {{$index+1}} ({{ $question }})</th>
            @endforeach
            <th style="background: #5cd65c">Total</th>
            <th style="background: #2eb82e">Total+200</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($participants as $participant)
            @php
                $participantId = $participant['participantId'];
                $totalSkor = array_sum($score[$participantId]);
                $totalSkorUpdated = $totalSkor + 200;
            @endphp
            <tr>
                <td>{{ $participantId }}</td>
                <td>{{ $participant['fullname'] }}</td>
                <td>{{ $participant['school'] }}</td>
                @foreach ($questionId as $question)
                    <td>{{ $participant['correctAnswer'][$question] ?? "-" }}</td>
                @endforeach
                <td> </td>
                @foreach ($questionId as $question)
                    <td>{{ $score[$participantId][$question] ?? "-" }}</td>
                @endforeach
                <td>{{$totalSkor}}</td>
                <td>{{$totalSkorUpdated}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
