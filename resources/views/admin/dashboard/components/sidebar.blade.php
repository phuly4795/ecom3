@php
    $segment = request()->segment(2);
@endphp

<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                        <img alt="image" class="img-circle" src="{{ asset('img/profil') }}e_small.jpg" />
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong
                                    class="font-bold">{{ Auth::user()->name }}</strong>
                            </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span>
                        </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="profile.html">Profile</a></li>
                        <li><a href="contacts.html">Contacts</a></li>
                        <li><a href="mailbox.html">Mailbox</a></li>
                        <li class="divider"></li>
                        <li><a href="login.html">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>

            @foreach (config('apps.module.module') as $key => $item)
            {{-- {{dd( $segment, $item['name'] )}} --}}
                <li class="{{ (in_array($segment, $item['name'] ) ? 'active' : '') }}">
                    <a href="">
                        <i class="{{ $item['icon'] }}"></i>
                        <span class="nav-label">{{ $item['title'] }} </span>
                        <span class="fa arrow"></span>
                    </a>
                    @if ($item['subModule'])
                        <ul class="nav nav-second-level">
                            @foreach ($item['subModule'] as $key => $subModule)
                                {{-- {{dd($subModule['name'])}} --}}
                                <li class="{{( !empty($subModule['name'] ) ? ($segment == $subModule['name'] ? 'active' : '' ) : '' )}}">
                                    <a href="{{ route($subModule['route']) }}">{{ $subModule['title'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                </li>
            @endforeach


        </ul>

    </div>
</nav>
