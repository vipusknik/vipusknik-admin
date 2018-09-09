@extends ('layouts.app')

@section ('title', 'Клиенты')

@section ('subnavigation')
    @include ('users/clients/partials/_navigation', ['heading' => 'Наши клиенты'])
@endsection

@section ('content')
  @include ('users/clients/partials/_users-table', [
      'table_heading' => 'Клиенты',
      'users' => $clients,
  ])
  <br>
  <br>
@endsection
