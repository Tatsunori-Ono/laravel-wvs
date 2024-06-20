@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">

<!-- デフォルトのLaravelロゴ -->
<!-- @if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
@else
{{ $slot }}
@endif -->

<img src="{{ asset('/images/logo-noBG.png') }}" class="logo" alt="{{ $slot }}">

</a>
</td>
</tr>
