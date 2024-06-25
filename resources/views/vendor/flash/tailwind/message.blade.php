<div
  class="p-4 rounded font-jakarta-sans flex justify-between
            {{ config('flash.class') }}
            {{ session('flash_notification.class') }}">
  <div>{!! session('flash_notification.message') !!}</div>

  @if (session('flash_notification.dismissible'))
    <button class="ml-2 px-2" onclick="this.parentElement.remove();">&times;</button>
  @endif
</div>
