<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report - {{ $user->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
</head>

<body>
    @foreach ($user->modules as $usermodule)
        @php
            $userquestions = 0;
        @endphp
        @foreach ($usermodule->module->characters as $character)
            @foreach ($character->quizzes as $quiz)
                @php
                    $the_quiz = $user->quizzes->where('quiz_id', $quiz->id)->first()->quiz;
                @endphp
                @foreach ($the_quiz->questions->sortBy('order') as $key => $question)
                    @php
                        $userquestions += $question->answers->where('user_id', $user->id)->count();
                    @endphp
                @endforeach
            @endforeach
        @endforeach
        @if ($userquestions > 0)
            <div class="text-4xl">Report Modul {{ $usermodule->module->name }}</div>
            @foreach ($usermodule->module->characters as $character)
                <div class="text-2xl">{{ $loop->iteration }}. {{ $character->name }}</div>
                <div class="w-96 h-20" id="container-{{ $character->id }}"></div>
                <table class="border border-black">
                    <tr>
                        <th class="border border-black">Hari</th>
                        <th class="border border-black">Pertanyaan</th>
                        <th class="border border-black">Status</th>
                        <th class="border border-black">Berhasil</th>
                        <th class="border border-black">Gagal</th>
                    </tr>
                    @foreach ($character->quizzes as $quiz)
                        @php
                            $the_quiz = $user->quizzes->where('quiz_id', $quiz->id)->first()->quiz;
                            $successes = 0;
                        @endphp
                        <tr>
                            <td class="border border-black">{{ $loop->iteration }}. {{ $the_quiz->name }}</td>
                            <td class="border border-black">
                                @foreach ($the_quiz->questions->sortBy('order') as $key => $question)
                                    @if ($key == 2)
                                        {{ $question->question }}
                                        ({{ $question->answers->where('user_id', $user->id)->first()->choice == '0' ? 'Gagal' : 'Berhasil' }})
                                    @else
                                        @if ($question->questiontype_id == 2)
                                            <br>{{ $question->answers->where('user_id', $user->id)->first()->open_question }}
                                            ({{ $question->answers->where('user_id', $user->id)->first()->choice == '0' ? 'Gagal' : 'Berhasil' }})
                                        @elseif ($question->questiontype_id == 1)
                                            <br>{{ $question->question }}
                                            ({{ $question->answers->where('user_id', $user->id)->first()->choice == '0' ? 'Gagal' : 'Berhasil' }})
                                        @endif
                                    @endif
                                    @php
                                        $successes += $question->answers->where('user_id', $user->id)->first()->choice;
                                    @endphp
                                @endforeach
                            </td>
                            <td class="border border-black">
                                {{ $successes >= $the_quiz->questions->count() - 1 - $successes ? 'Berhasil' : 'Gagal' }}
                            </td>
                            <td class="border border-black">{{ $successes }}</td>
                            <td class="border border-black">{{ $quiz->questions->count() - 1 - $successes }}</td>
                        </tr>
                    @endforeach
                </table>
            @endforeach
        @endif
    @endforeach
    <script>
        Highcharts.setOptions({
            colors: ['#B72619', '#0284c7']
        });
        var series = [];
    </script>
    @foreach ($user->modules as $usermodule)
        @foreach ($usermodule->module->characters as $keyed => $character)
            <script>
                //sukses gagalnya quiz
                var sukses = 0;
                var gagal = 0;
            </script>
            @foreach ($character->quizzes as $quiz)
                @php
                    $the_quiz = $user->quizzes->where('quiz_id', $quiz->id)->first()->quiz;
                    $successes = 0;
                @endphp
                @foreach ($the_quiz->questions->sortBy('order') as $key => $question)
                    @php
                        //sukses dari question
                        $successes += $question->answers->where('user_id', $user->id)->first()->choice;
                    @endphp
                @endforeach
                <script>
                    if (@json($successes >= $the_quiz->questions->count() - 1 - $successes)) {
                        sukses++;
                    } else {
                        gagal++;
                    }
                    series[@json($keyed)] = [{
                        name: 'Gagal',
                        data: [gagal]
                    }, {
                        name: 'Sukses',
                        data: [sukses]
                    }]
                </script>
            @endforeach
        @endforeach
    @endforeach
    @foreach ($user->modules as $usermodule)
        @foreach ($usermodule->module->characters as $keyed => $character)
            <script>
                Highcharts.chart('container-' + @json($character->id), {
                    chart: {
                        type: 'bar',
                        marginTop: 0,
                        marginBottom: 0
                    },
                    title: {
                        text: ''
                    },
                    xAxis: {
                        visible: false,
                        labels: {
                            enabled: false
                        },
                        categories: ['Marcel']
                    },
                    yAxis: {
                        min: 0,
                        max: 10,
                        title: {
                            text: 'Jumlah Berhasil/Gagal'
                        }
                    },
                    legend: {
                        enabled: false,
                        reversed: true
                    },
                    plotOptions: {
                        series: {
                            stacking: 'normal'
                        }
                    },
                    series: [series[@json($keyed)][0], series[@json($keyed)][1]]
                });
            </script>
        @endforeach
    @endforeach
    <script>
        setTimeout(() => {
            print();
        }, 1000);
    </script>
</body>

</html>
