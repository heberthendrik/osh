@php
$notif = App\Models\Notification::where('receiver', Auth::user()->id)->where('read','0');
$notification = App\Models\Notification::where('receiver', Auth::user()->id)->orderBy('created_at', 'desc')->Limit(5);
@endphp

<li class="dropdown messages-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-bell-o"></i>
        <span class="label label-warning">{{ $notif->count() }}</span>
    </a>
    <ul class="dropdown-menu">
        <li class="header">You have {{ $notification->count() }} notifications</li>
        <li>
            <ul class="menu">
                @foreach($notification->get() as $rd)
                @php
                $image = App\Models\User::where('id', $rd->sender)->first();
                @endphp
                <li class="{{$rd->read ? '' : 'bg-gray disabled color-palette'}}">
                    <a href="{{route('api.postStatus', $rd->id)}}">
                        <div class="pull-left">
                            @if($image['image'])
                            <img class="img-circle" src="{{asset('storage/'.$image['image'])}}"
                                 alt="user image">
                            @else
                            <img class="img-circle" src="{{asset('adminlte/dist/img/avatar5.png')}}"
                                 alt="User Image">
                            @endif
                        </div>
                        <h4>
                            {{$rd->sender_name}}
                            <small><i class="fa fa-clock-o"></i> {{$rd->created_at->diffForHumans()}}</small>
                        </h4>
                        <p>{{$rd->text}}</p>
                    </a>
                </li>
                @endforeach
            </ul>
        </li>
        <li class="footer"><a href="{{route('profile.show', Auth::user()->id)}}">View all</a></li>
    </ul>
</li>