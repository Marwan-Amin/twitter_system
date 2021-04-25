<!DOCTYPE html>
<html>

<head>
    <title>Users action report</title>
</head>

<body>
    <table class="table">
        <thead>
            <tr>
                <th style="margin:10px" scope="col">#</th>
                <th style="margin:10px" scope="col">user_name</th>
                <th style="margin:10px" scope="col">number_of_tweets</th>
                <th style="margin:20px" scope="col">average_tweets_per_day</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $user['user_id'] }}</th>
                    <td>{{ $user['name'] }}</td>
                    <td>{{ $user['countTweets'] }}</td>
                    <td>{{ $user['averageTweets'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
