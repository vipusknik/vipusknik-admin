@extends ('layouts.app')

@section ('title', 'Новые клиенты')
@section('style')
   <style>
        body > .grid {
          height: 100%;
        }
        .image {
          margin-top: -100px;
        }
        .column {
          max-width: 450px;
        }
    </style>
@endsection
@section ('subnavigation')
    @include ('users/clients/partials/_navigation', ['heading' => 'Новые клиенты'])
@endsection

@section ('content')
  <div class="ui custom container">
            @include ('includes/_flash')

            <div class="ui middle aligned center aligned grid">
              <div class="column">
                <h2 class="ui teal image header">
                  <img src="/images/logo.png" class="image">
                  <div class="content">
                    Регистрация
                  </div>
                </h2>
                @include ('includes/_form-errors')
                <form action ="{{ route('clients.store') }}" method ="post" class="ui large form">
                  {{ csrf_field() }}
                  <div class="ui stacked segment">
                    
                    <div class="field">
                      <select class="ui selection search dropdown" name="institution" required>
                        <option value="">Учебное заведение</option>
                        @foreach ($institutions as $institution)
                          <option value="{{ $institution->id }}">
                            {{ $institution->title }}
                          </option>
                        @endforeach
                      </select>
                    </div>
                    <div class="field">
                      <div class="ui left icon input">
                        <i class="mail icon"></i>
                        <input type="email"
                               name="email"
                               value="{{ old('email', '') }}"
                               placeholder="E-mail"
                               required
                               autocomplete="off"
                               autofocus>
                      </div>
                    </div>

                    <div class="field">
                      <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input type="text"
                               name="username"
                               value="{{ old('username', '') }}"
                               placeholder="Логин"
                               required
                               autocomplete="off">
                      </div>
                    </div>

                    <div class="field">
                      <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input type="password" name="password" placeholder="Пароль" required autocomplete="off">
                      </div>
                    </div>

                    <div class="field">
                      <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input type="password"
                               name="password_confirmation"
                               placeholder="Повторите пароль"
                               required autocomplete="off">
                      </div>
                    </div>

                    <button type="submit" class="ui fluid large teal submit button">
                        Добавить
                    </button>
                  </div>

                  <div class="ui error message"></div>

                </form>
              </div>
            </div>
        </div>
@endsection
