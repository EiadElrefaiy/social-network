@extends('layouts.app')

@section('content')
<div class="col-sm-10">
               <div class="card">
                  <div class="card-body">
                     <div class="friend-list-tab mt-2">
                            <div class="card-body p-0">
                                 <div class="row">
                             @if(count($users) > 0)     
                                 @foreach ($users as $user)
                                    <div class="col-md-6 col-lg-6 mb-3">
                                        <div class="iq-friendlist-block">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <a href="{{ route('user.profile', ['user' => $user->id]) }}">
                                                    @if ($user->image)
                                                        <img style="width:150px" src="{{ asset('storage/images/users/' . $user->image) }}" alt="profile-img" class="img-fluid">
                                                        @else
                                                        <img style="width:150px" src="{{ asset('storage/images/users/default.jpg') }}" alt="profile-img" class="img-fluid">
                                                        @endif
                                                    </a>
                                                    <div class="friend-info ms-3">
                                                        <h5>{{ $user->name }}</h5>
                                                        <p class="mb-0">{{ $user->friends->count() }} friends</p>
                                                    </div>
                                                </div>
                                                <div class="card-header-toolbar d-flex align-items-center">

                                                @auth
                                                @if(auth()->user()->id != $user->id)                                                   
                                                @php
                                                    $friendship = auth()->user()->friendships
                                                        ->where('friend_id', $user->id)
                                                        ->first();

                                                    if (!$friendship) {
                                                        $friendship = $user->friendships
                                                            ->where('friend_id', auth()->user()->id)
                                                            ->first();
                                                    }
                                                @endphp
                                                @if (!empty($friendship))
                                                    @if ($friendship->status === 'accepted')
                                                        <div class="dropdown dr-{{$user->id}}">
                                                            <span class="dropdown-toggle btn btn-secondary me-2 text-white" id="dropdownMenuButton{{ $user->id }}" data-bs-toggle="dropdown" aria-expanded="true" role="button">
                                                                <i class="ri-check-line me-1 text-white"></i> Friend
                                                            </span>
                                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton{{ $user->id }}">
                                                                <a onclick="deleteFriend({{ $friendship->id }} , {{$user->id}})" class="dropdown-item" href="#">Unfriend</a>
                                                            </div>
                                                        </div>
                                                    @elseif ($friendship->status === 'pending')
                                                        
                                                        @if ($friendship->user_id === auth()->user()->id)
                                                            
                                                            <div class="dropdown dr-{{$user->id}}">
                                                                <span class="dropdown-toggle btn btn-warning me-2 text-white" id="dropdownMenuButton{{ $user->id }}" data-bs-toggle="dropdown" aria-expanded="true" role="button">
                                                                     Request Sent
                                                                </span>
                                                                
                                                            </div>
                                                        @else
                                                            
                                                            <div class="dropdown dr-{{$user->id}}">
                                                                <span onclick="acceptFriendRequest({{ $friendship->id }} , {{$user->id}})" class="dropdown-toggle btn btn-success me-2 text-white" id="dropdownMenuButton{{ $user->id }}" data-bs-toggle="dropdown" aria-expanded="true" role="button">
                                                                     Accept Request
                                                                </span>
                                                                
                                                            </div>
                                                        @endif
                                                    @else
                                                        <!-- Other status -->
                                                        <!-- ... -->
                                                    @endif
                                                @else
                                                    
                                                    <div class="dropdown dr-{{$user->id}}">
                                                        <span onclick="sendFriendRequest({{ $user->id }});" class="dropdown-toggle btn btn-primary me-2" id="dropdownMenuButton{{ $user->id }}" data-bs-toggle="dropdown" aria-expanded="true" role="button">
                                                             Add Friend
                                                        </span>
                                                    </div>
                                                @endif
                                              @endif
                                            @endauth

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @else
                                    <p>No users found.</p>
                                @endif
                              </div>
                           </div>
                       </div>
                   </div>
                </div>
                <script>
                    function sendFriendRequest(friendId) {
                        var csrfToken = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            type: 'POST',
                            url: "{{route('friendRequest.create')}}",
                            data: {
                                friend_id: friendId,
                                _token: csrfToken,
                            },
                            dataType: 'json',
                            success: function (response) {
                                if (response.success) {
                                    alert('Friendship request sent successfully.');
                                    $(".dr-" + friendId).html('<span class="dropdown-toggle btn btn-warning me-2 text-white" id="dropdownMenuButton'+friendId+'" data-bs-toggle="dropdown" aria-expanded="true" role="button">Request Sent</span>')
                                } else {
                                    alert('Failed to send friendship request: ' + response.message);
                                }
                            },
                            error: function (xhr, status, error) {
                                console.error('Error sending friendship request:', error);    
                          }
                        });
                    }

                    function acceptFriendRequest(friendRequestId , friendId) {
                        var csrfToken = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            type: 'POST',
                            url: "{{route('friendRequest.accept')}}",
                            data: {
                                id: friendRequestId,
                                _token: csrfToken,
                            },
                            dataType: 'json',
                            success: function (response) {
                                if (response.success) {
                                    alert('Friend request accepted.');
                                    $(".dr-" + friendId).html('<span class="dropdown-toggle btn btn-secondary me-2 text-white" id="dropdownMenuButton'+friendId+'" data-bs-toggle="dropdown" aria-expanded="true" role="button"><i class="ri-check-line me-1 text-white"></i>Friend</span> <div class="dropdown-menu dropdown-menu-right"> <a class="dropdown-item" href="#">Unfriend</a> </div> ')
                                } else {
                                    alert('Failed to send friend request: ' + response.message);
                                }
                            },
                            error: function (xhr, status, error) {
                                console.error('Error sending friend request:', error);    
                          }
                        });
                    }

                    function deleteFriend(friendshipId , friendId) {
                        var csrfToken = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            type: 'Delete',
                            url: "{{route('friend.delete')}}",
                            data: {
                                id: friendshipId,
                                _token: csrfToken,
                            },
                            dataType: 'json',
                            success: function (response) {
                                if (response.success) {
                                    alert('Friend deleted');
                                    $(".dr-" + friendId).html('<span onclick="sendFriendRequest('+friendId+');" class="dropdown-toggle btn btn-primary me-2 text-white" id="dropdownMenuButton'+friendId+'" data-bs-toggle="dropdown" aria-expanded="true" role="button">Add Friend</span>');
                                } else {
                                    alert('Failed to send friend request: ' + response.message);
                                }
                            },
                            error: function (xhr, status, error) {
                                console.error('Error sending friend request:', error);    
                          }
                        });
                    }
                </script>

@endsection