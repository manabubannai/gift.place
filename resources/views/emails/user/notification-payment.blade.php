<html>
<p>{{ $user->name }} 様</p>

<p>いつも<span style="margin: 0 0.5em">{{ config('app.name') }}</span>を応援いただきありがとうございます。</p>
<p>以下のお支払いを受け付けましたのでご連絡します。</p>
<table>
    <thead></thead>
    <tbody>
    <tr>
        <th>月額料金</th>
        <td>&yen; 390</td>
    </tr>
    <tr>
        <th>次回課金予定日</th>
        <td>{{ $next_charge_at->format('Y年m月d日') }}</td>
    </tr>
    </tbody>
</table>

<p>万一、身に覚えのない場合はお手数ですが、下記までご連絡ください。</p>

@include('emails.common._footer')
</html>
