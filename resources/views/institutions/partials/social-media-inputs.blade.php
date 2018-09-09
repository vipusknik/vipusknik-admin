<div class="fields" style="margin-left: .125rem">
  @foreach (\App\Models\Institution\Institution::SOCIAL_MEDIA_SITES as $site)
    <input type="text"
           name="{{ $site }}_url"
           value="{{ old("{$site}_url", $institution->{$site . '_url'}) }}"
           placeholder="{{ $site }} ссылка"
           style="margin-right: 1rem">
  @endforeach
</div>

<div class="fields" style="margin-left: .125rem">
  @foreach (\App\Models\Institution\Institution::SOCIAL_MEDIA_SITES as $site)
    <input type="text"
           name="{{ $site }}_display_title"
           value="{{ old("{$site}_display_title", $institution->{$site . '_display_title'}) }}"
           placeholder="{{ $site }} текст ссылки"
           style="margin-right: 1rem">
  @endforeach
</div>
