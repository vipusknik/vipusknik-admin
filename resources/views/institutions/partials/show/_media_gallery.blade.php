@if ($institution->media->count())
  <div id="gallery" style="display:none;">

    @if ($institution->hasLogo())
        @include ('institutions/partials/show/_gallery-image', ['image' => $institution->logo()])
    @endif

    @if ($media = $institution->getMedia('images'))
        @each ('institutions/partials/show/_gallery-image', $media, 'image')
    @endif

  </div>

  <a href="#"
     onclick="event.preventDefault();
     $('#delete-gallery-items-modal').modal({ inverted: true }).modal('show');"
     style="text-decoration:none; color: #000; opacity:0.7;">
    Редактировать галерею
  </a>
  <br>
  <br>
  <br>

  @include ('institutions/partials/show/_edit-gallery-modal')

@endif

<div style="margin-bottom: 3rem">
  @if (! $institution->profilePhoto())
    <form action="{{ route('institutions.profile-photo.store', $institution) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="file" name="photo" required>
        <button type="submit">Загрузить фото профиля</button>
      </form>
  @else
    <a href="{{ $institution->profilePhoto()->getUrl() }}" target="_blank">
      <img src="{{ $institution->profilePhoto()->getUrl('thumb') }}" style="margin-bottom: 1rem">
    </a>

    <form action="{{ route('institutions.profile-photo.destroy', $institution) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('delete') }}
        <button type="submit">Удалить фото профиля</button>
      </form>
  @endif
</div>
