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
    <ul>
        <li>Nama: {{ $user->name }}</li>
        <li>E-Mail: {{ $user->email }}</li>
    </ul>
    <hr>
    @foreach ($user->modules as $usermodule)
        @php
            $userquestions = 0;
        @endphp
        @foreach ($usermodule->module->characters as $character)
            @foreach ($character->quizzes as $quiz)
                @php
                    $the_quiz = $user->quizzes->where('quiz_id', $quiz->id)->first();
                @endphp
                @if ($the_quiz)
                    @foreach ($the_quiz->quiz->questions->sortBy('order') as $key => $question)
                        @php
                            $userquestions += $question->answers->where('user_id', $user->id)->count();
                        @endphp
                    @endforeach
                @endif
            @endforeach
        @endforeach
        @if ($userquestions > 0)
            <div class="text-3xl">Report Modul {{ $usermodule->module->name }}</div>
            @foreach ($usermodule->module->characters as $character)
                @php
                    $answered = false;
                @endphp
                @foreach ($character->quizzes as $quiz)
                    @php
                        $the_quiz = $user->quizzes->where('quiz_id', $quiz->id)->first();
                    @endphp
                    @if ($the_quiz)
                        @php
                            $answered = true;
                        @endphp
                    @endif
                @endforeach
                @if ($answered)
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
                                $the_quiz = $user->quizzes->where('quiz_id', $quiz->id)->first();
                                $successes = 0;
                                $emptyopenquestion = 0;
                            @endphp
                            @if ($the_quiz)
                                <tr>
                                    <td class="border border-black">{{ $loop->iteration }}. {{ $the_quiz->quiz->name }}
                                    </td>
                                    <td class="border border-black">
                                        @foreach ($the_quiz->quiz->questions->sortBy('order') as $key => $question)
                                            @if ($key == 2)
                                                {{ $question->question }}
                                                ({{ $question->answers->where('user_id', $user->id)->first()->choice == '0' ? 'Gagal' : 'Berhasil' }})
                                            @else
                                                @if ($question->questiontype_id == 2)
                                                    @if ($question->answers->where('user_id', $user->id)->first()->open_question)
                                                        <br>{{ $question->answers->where('user_id', $user->id)->first()->open_question }}
                                                        ({{ $question->answers->where('user_id', $user->id)->first()->choice == '0' ? 'Gagal' : 'Berhasil' }})
                                                    @else
                                                        @php
                                                            $emptyopenquestion = 1;
                                                        @endphp
                                                    @endif
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
                                        {{ $successes >= $the_quiz->quiz->questions->count() - 1 - $successes - $emptyopenquestion ? 'Berhasil' : 'Gagal' }}
                                    </td>
                                    <td class="border border-black">{{ $successes }}</td>
                                    <td class="border border-black">{{ $quiz->questions->count() - 1 - $successes - $emptyopenquestion }}
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                @endif
            @endforeach
        @endif
    @endforeach
    <script>
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
                    $the_quiz = $user->quizzes->where('quiz_id', $quiz->id)->first();
                    $successes = 0;
                @endphp
                @if ($the_quiz)
                    @foreach ($the_quiz->quiz->questions->sortBy('order') as $key => $question)
                        @php
                            //sukses dari question
                            $successes += $question->answers->where('user_id', $user->id)->first()->choice;
                        @endphp
                    @endforeach
                    <script>
                        if (@json($successes >= $the_quiz->quiz->questions->count() - 1 - $successes)) {
                            sukses++;
                        } else {
                            gagal++;
                        }
                        series[@json($keyed)] = [{
                            name: 'Jumlah',
                            data: [sukses, gagal]
                        }]
                    </script>
                @endif
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
                        // visible: false,
                        labels: {
                            // enabled: false
                        },
                        categories: ['Berhasil', 'Gagal']
                    },
                    yAxis: {
                        min: 0,
                        max: 10,
                        title: {
                            text: 'Jumlah'
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
                    series: series[@json($keyed)],
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
