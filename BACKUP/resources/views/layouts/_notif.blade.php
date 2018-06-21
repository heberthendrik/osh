@php
$notif = App\Models\Notification::where('receiver', Auth::user()->id)->where('read','0');
$notification = App\Models\Notification::where('receiver', Auth::user()->id)->orderBy('created_at', 'desc')->Limit(5);
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
				You have {{ $notification->count() }} notifications
			</div>

			<div class="content">
				<ul>
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
	                
	                <!--
					<li>
						<a href="#" class="clearfix">
							
							<span class="title">Report #123456 - Need Approval</span>
							<span class="message">Date: 2 minutes ago</span>
						</a>
					</li>
					-->
					
				</ul>

				<hr />

				<div class="text-right">
					<a href="{{route('profile.show', Auth::user()->id)}}" class="view-more">View All</a>
				</div>
			</div>
		</div>
	</li>
</ul>
