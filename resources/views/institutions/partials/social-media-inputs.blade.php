<div class="fields" style="margin-left: .125rem">
  @foreach (\App\Models\Institution\SocialMedia::SERVICES as $service)
    <input type="text"
           name="social_media[{{ $service }}][url]"
           value="{{ old("social_media.$service.url", isset($socialMedia[$service]) ? $socialMedia[$service]['url'] : '') }}"
           placeholder="{{ $service }} ссылка"
           style="margin-right: 1rem">
  @endforeach
</div>

<div class="fields" style="margin-left: .125rem">
  @foreach (\App\Models\Institution\SocialMedia::SERVICES as $service)
    <input type="text"
           name="social_media[{{ $service }}][display_title]"
           value="{{ old("social_media.$service.display_title", isset($socialMedia[$service]) ? $socialMedia[$service]['display_title'] : '') }}"
           placeholder="{{ $service }} текст ссылки"
           style="margin-right: 1rem">
  @endforeach
</div>
