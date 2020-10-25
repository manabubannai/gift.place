<html>
<p>{{ $user->name }} 様</p>

<p>いつも<span style="margin: 0 0.5em">{{ config('app.name') }}</span>をご利用いただきありがとうございます。</p>
<p>
    以下のお支払いでエラーが発生しました。{{ config('app.name') }}への入会は一時停止中です。<br>
    再入会いただくことで復帰することができます。
</p>
<table>
    <thead></thead>
    <tbody>
    <tr>
        <th>月額料金</th>
        <td>&yen;<span style="margin-left: 0.25em">390</span></td>
    </tr>
    <tr>
        <th>エラー内容</th>
        <td>
            <ul>
                @foreach ($errors as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </td>
    </tr>
    </tbody>
</table>

<p>万一、身に覚えのない場合はお手数ですが、下記までご連絡ください。</p>

@include('emails.common._footer')
</html>
