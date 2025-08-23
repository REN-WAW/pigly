@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/weight.css')}}">
@endsection

@section('link')
<form action="/weight_logs/goal_setting" method="post">
    @csrf
    <input class="header__link" type="submit" value="目標体重設定">
</form>

<form action="/logout" method="post">
    @csrf
    <input class="header__link" type="submit" value="ログアウト">
</form>
@endsection

@section('content')
<main>
    <div>
        <h2>目標体重</h2>
        <p>{{ optional($targetWeight)->target_weight ?? '00.0' }} kg</p>
    dd();
</div>
    <div>
        <h2>目標まで</h2>
        <p>{{ optional($weightLogs->first())->weight - optional($targetWeight)->target_weight }} kg</p>
    </div>
    <div>
        <h2>最新体重</h2>
        <p>{{ optional($weightLogs->first())->weight ?? '00.0' }} kg</p>
    </div>
    
    <div>
        <input type="date" id="start_date">
        <input type="date" id="end_date">
        <button onclick="searchData()">検索</button>
        <button id="reset_button" style="display:none;" onclick="resetSearch()">リセット</button>
    </div>

    <button id="add_data_button">データを追加</button>

    <div id="search_result_info" style="display:none;">
        <p><span id="search_term"></span>の検索結果 <span id="result_count"></span>件</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>日付</th>
                <th>体重</th>
                <th>食事摂取カロリー</th>
                <th>運動時間</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($weightLogs as $log)
            <tr>
                <td>{{ \Carbon\Carbon::parse($log->date)->format('Y/m/d') }}</td>
                <td>{{ number_format($log->weight, 1) }}kg</td>
                <td>{{ $log->calories }}kcal</td>
                <td>{{ \Carbon\Carbon::parse($log->exercise_time)->format('H:i') }}</td>
                <td>
                    <a href="{{ route('weight_logs.edit', $log->id) }}">
                        <img src="{{ asset('images/pencil_icon.png') }}" alt="編集">
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    {{ $weightLogs->links() }}
</main>

<div id="registration_modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form id="registration_form" action="{{ route('weight_logs.store') }}" method="post">
            @csrf
            
            <div>
                <label for="date">日付:</label>
                <input type="date" id="date" name="date" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                @error('date')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="weight">体重:</label>
                <input type="number" step="0.1" id="weight" name="weight">kg
                @error('weight')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="calories">摂取カロリー:</label>
                <input type="number" id="calories" name="calories">cal
                @error('calories')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="exercise_time">運動時間:</label>
                <input type="time" id="exercise_time" name="exercise_time">
                @error('exercise_time')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="exercise_content">運動内容:</label>
                <textarea id="exercise_content" name="exercise_content"></textarea>
                @error('exercise_content')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
            
            <button type="submit">登録</button>
            <button type="button" class="close">戻る</button>
        </form>
    </div>
</div>

<script>
    // モーダルウィンドウの表示/非表示を制御するJavaScript
    var modal = document.getElementById("registration_modal");
    var btn = document.getElementById("add_data_button");
    var closeButtons = document.getElementsByClassName("close");

    btn.onclick = function() {
        modal.style.display = "block";
    }

    for (var i = 0; i < closeButtons.length; i++) {
        closeButtons[i].onclick = function() {
            modal.style.display = "none";
        }
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    // 検索機能のJavaScript
    function searchData() {
        var startDate = document.getElementById('start_date').value;
        var endDate = document.getElementById('end_date').value;
        
        // サーバーに検索リクエストを送信するロジック（Ajaxなど）をここに記述します
        // 例: fetch(`/search?start=${startDate}&end=${endDate}`).then(response => ...);
        
        // 検索結果の表示（ダミー）
        document.getElementById('search_result_info').style.display = 'block';
        document.getElementById('search_term').textContent = `${startDate}〜${endDate}`;
        document.getElementById('result_count').textContent = '5'; // 取得した件数を表示
        document.getElementById('reset_button').style.display = 'inline';
    }

    function resetSearch() {
        // ページをリロードするか、初期状態に戻すロジックを記述
        window.location.href = window.location.pathname;
    }
</script>

@endsection