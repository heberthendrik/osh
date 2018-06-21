@php
$notif = App\Models\Notification::where('receiver', Auth::user()->id)->where('read','0')->orderBy('created_at', 'desc');
@endphp

<ul class="notifications">
	<li>
		<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
			<i class="fa fa-bell"></i>
			<span class="badge">{{ $notif->count() }}</span>
		</a>

		<div class="dropdown-menu notification-menu">
			<div class="notification-title">
				<span class="pull-right label label-default">{{ $notif->count() }}</span>
                Alerts
			</div>

			<div class="content">
				<ul>
					@foreach($notif->get() as $rd)
                    <li class="{{$rd->read ? '' : 'bg-gray disabled color-palette'}}">
                        <a href="{{route('api.postStatus', $rd->id)}}" class="clearfix">
                            <span class="title">{{$rd->text}}</span>
                            <span class="message">Date: {{$rd->created_at->diffForHumans()}}</span>
                        </a>
                    </li>
	                @endforeach
				</ul>

				<hr />

				<div class="text-right">
					<a href="{{route('profile.show', Auth::user()->id)}}" class="view-more">View All</a>
				</div>
			</div>
		</div>
	</li>
</ul>
