  <li class="dropdown user user-menu">

    <!-- Menu Toggle Button -->
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
      <!-- The user image in the navbar-->
      <img src="{{  isset(Auth::user()->avatar) ? Auth::user()->avatar : asset('adminlte/dist/img/user.png') }} " class="user-image">
      <!-- hidden-xs hides the username on small devices so only the image appears. -->
       <span class="hidden-xs">
            @if(Auth::user())
               {{ Auth::user()->name }}
            @else
                Ingresar
           @endif
      </span>
    </a>

    <ul class="dropdown-menu">
      <!-- The user image in the menu -->
            @if(Auth::user())
            <li class="user-header">
                <img src="{{  isset(Auth::user()->avatar) ? Auth::user()->avatar : asset('adminlte/dist/img/user.png') }}" class="img-circle">
                  <p>
                    {{ Auth::user()->name }}
                  </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
                <div class="pull-right">
                    <a href="{{ url('logout') }}" class="btn btn-default btn-flat">Finalizar</a>
                </div>
            </li>
          @else
            <div class="box box-info">
                <div class="box-header with-border">

                    <form action="{{ url('/atlogin') }}" method="post" class="form">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" />
                        </div>
                        <div style="text-align: center;">
                            <button type="submit" class="btn btn-sm btn-success">Ingresar</button>
                            <button class="btn btn-sm btn-default" ng-click="showLoginBox=0">Cancelar</button>
                        </div>
                    </form>

                    <hr>
                    <a href="http://localhost/expenses/public/auth/facebook" class="btn btn-block btn-facebook"><i class="fa fa-facebook"></i> Ingresar con Facebook</a>

                </div>
            </div>
        @endif

    </ul>
  </li>
