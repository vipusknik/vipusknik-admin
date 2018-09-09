<div
  class="ui right pointing right floated icon dropdown basic button content">
  <i class="ellipsis vertical icon"></i>
  <div class="menu">
    <div class="header"><i class="tags icon"></i>  Действия </div>
    <div class="divider"></div>

    <div class="item">
      <i class="left teal dropdown icon"></i>
      <span class="text">
        Учебные заведения
      </span>
      <div class="left menu">
        @foreach ($user->institutions as $institution)
          <a class="header" href="{{ route('institutions.show', [$institution->type, $institution]) }}">
              {{ $institution->title }}
          </a>
        @endforeach
      </div>
    </div>

    <div class="divider"></div>

    <a class="item"
       onclick="event.preventDefault();
       document.getElementById('user-{{ $user->id }}-update-active-status').submit()">
      <i class="orange trash icon"></i> {{ $user->is_active ? 'Деактивировать' : 'Активировать' }}
    </a>

    <form action="{{ route('users.active-status.update', $user) }}"
          method="post"
          id="user-{{ $user->id }}-update-active-status">
      {{ csrf_field() }}
      {{ method_field('PATCH') }}
    </form>

    <a class="item"
       onclick="confirmDeletion('delete-user-{{ $user->id }}', '{{ $user->getNameOrUsername() }}');">
      <i class="red trash icon"></i> Удалить
    </a>

    <form action="{{ route('users.destroy', $user) }}"
          method="post"
          id="delete-user-{{ $user->id }}">
      {{ csrf_field() }}
      {{ method_field('DELETE') }}
    </form>

  </div>
</div>
