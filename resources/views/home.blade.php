@extends('layouts.app')

@section('content')
<div class="col-lg-3">
</div>
<div class="col-lg-6 row m-0 p-0">
         <div class="col-sm-12">
            <div id="post-modal-data" class="card card-block card-stretch card-height">
               <div class="card-header d-flex justify-content-between">
                  <div class="header-title">
                     <h4 class="card-title">Create Post</h4>
                  </div>
               </div>
               <div class="card-body">
                  <div class="d-flex align-items-center">
                     <div class="user-img">
                              @if (auth()->user()->image)
                              <img src="{{ asset('storage/images/users/' . auth()->user()->image) }}" alt="userimg" class="avatar-60 rounded-circle">
                              @else
                              <img src="{{URL::asset('assets/images/user/default.jpg')}}" alt="userimg" class="avatar-60 rounded-circle">
                              @endif
                     </div>
                     <form class="post-text ms-3 w-100 "  data-bs-toggle="modal" data-bs-target="#post-modal" action="javascript:void();">
                        <input type="text" class="form-control rounded" placeholder="Write something here..." style="border:none;">
                     </form>
                  </div>
               </div>
               <div class="modal fade" id="post-modal" tabindex="-1"  aria-labelledby="post-modalLabel" aria-hidden="true" >
                  <div class="modal-dialog   modal-fullscreen-sm-down">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title" id="post-modalLabel">Create Post</h5>
                           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="ri-close-fill"></i></button>
                        </div>
                        <div class="modal-body">
                           <div class="d-flex align-items-center">
                              <div class="user-img">
                              @if (auth()->user()->image)
                              <img src="{{ asset('storage/images/users/' . auth()->user()->image) }}" alt="userimg" class="avatar-60 rounded-circle img-fluid">
                              @else
                              <img src="{{URL::asset('assets/images/user/default.jpg')}}" alt="userimg" class="avatar-60 rounded-circle img-fluid">
                              @endif
                              </div>
                              <form id="create-post-form" class="post-text ms-3 w-100" enctype="multipart/form-data">
                                <input type="text" id="post-text" name="text" class="form-control rounded" placeholder="Write something here..." style="border:none;">
                                <label for="post-image" class="bg-soft-primary rounded p-2 pointer me-3">
                                    <a href="#"></a>
                                    <img src="../assets/images/small/07.png" alt="icon" class="img-fluid"> Photo
                                </label>
                                <input type="file" id="post-image" name="image" class="form-control rounded mb-1" style="display: none;">
                                <div id="uploaded-image-container"></div>
                                <button id="action-button" type="button" onclick="createPost();" class="btn btn-primary d-block w-100 mt-3">Post</button>
                            </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

        <div class="col-sm-12">
            <div id="post-modal-data-edit" class="card card-block card-stretch card-height mt-2">
               <div class="modal fade" id="post-modal-edit" tabindex="-1"  aria-labelledby="post-modalLabel-edit" aria-hidden="true" >
                  <div class="modal-dialog  modal-fullscreen-sm-down">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title" id="post-modalLabel-edit">Edit Post</h5>
                           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="ri-close-fill"></i></button>
                        </div>
                        <div class="modal-body">
                           <div class="d-flex align-items-center">
                              <div class="user-img">
                              @if (auth()->user()->image)
                              <img src="{{ asset('storage/images/users/' . auth()->user()->image) }}" alt="userimg" class="avatar-60 rounded-circle img-fluid">
                              @else
                              <img src="{{URL::asset('assets/images/user/default.jpg')}}" alt="userimg" class="avatar-60 rounded-circle img-fluid">
                              @endif
                              </div>
                              <form id="edit-post-form" class="post-text ms-3 w-100" enctype="multipart/form-data">
                                <input type="text" id="post-text-edit" name="text" class="form-control rounded" placeholder="Write something here..." style="border:none;">
                                <input type="text" id="post-id" name="text" class="form-control rounded" style="border:none; display:none;">
                                <label for="post-image-edit" class="bg-soft-primary rounded p-2 pointer me-3">
                                    <a href="#"></a>
                                    <img src="../assets/images/small/07.png" alt="icon" class="img-fluid"> Photo
                                </label>
                                <input type="file" id="post-image-edit" name="image" class="form-control rounded mb-1" style="display: none;">
                                <div id="uploaded-image-container-edit"></div>
                                <button id="action-button" type="button" onclick="updatePost();" class="btn btn-primary d-block w-100 mt-3">Post</button>
                            </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

         </div>

        </div>

         @foreach ($homeFeedPosts as $post)
         <div class="col-sm-12" id="post-{{$post->id}}">
                <div class="card card-block card-stretch card-height mb-4">
                    <div class="card-body">
                        <div class="user-post-data">
                            <div class="d-flex justify-content-between">
                                <div class="me-3">
                                    @if ($post->user->image)
                                        <img style="width:60px;" class="rounded-circle img-fluid" src="{{ asset('storage/images/users/' . $post->user->image) }}" alt="User Image">
                                    @else
                                        <img style="width:60px;" class="rounded-circle img-fluid" src="{{ asset('storage/images/users/default.jpg') }}" alt="Default User Image">
                                    @endif
                                </div>
                                <div class="w-100">
                                    <div class="d-flex justify-content-between">
                                        <div class="">
                                            <h5 class="mb-0 d-inline-block">{{ $post->user->name }}</h5>
                                            <span class="mb-0 d-inline-block"></span>
                                            <p class="mb-0 text-primary">{{ $post->created_at->diffForHumans() }}</p>
                                        </div>
                                        <div class="card-post-toolbar">
                                            @auth
                                                @if(auth()->user()->id == $post->user->id)                                                   
                                                    <div style="position:absolute; top:20px; right:20px;">
                                                        <i class="fas fa-edit me-2" style="cursor: pointer;" onclick="editPostModal('{{ $post->text }}', '{{ $post->image }}' , '{{ $post->id }}')"></i>
                                                        <i class="fas fa-trash-alt" style="cursor: pointer;" onclick="deletePost({{ $post->id }})"></i>
                                                    </div>
                                                @endif
                                            @endauth
                                            
                                         </div>
                                        <div class="card-post-toolbar">
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <p>{{ $post->text }}</p>
                        </div>
                        <div class="user-post">
                        @if ($post->image)
                        <img src="{{ asset('storage/images/posts/' . $post->image) }}" alt="post-image" class="img-fluid rounded w-100">
                        @endif
                        </div>
                        <div class="comment-area mt-3">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="like-block position-relative d-flex align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="like-data">
                                <span
                                    class="like-toggle"
                                    onclick="toggleLike({{ $post->id }})"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    role="button"
                                    data-post-id="{{ $post->id }}"
                                    style="cursor: pointer;"
                                    >   
                                    <img src="{{ URL::asset('assets/images/icon/01.png') }}" class="img-fluid" alt="">
                                    </span>
                                    <div class="dropdown-menu py-2">
                                </div>
                            </div>
                            <div class="total-like-block ms-2 me-3">
                                <div class="dropdown">
                                <span id="like-count-{{ $post->id }}" class="dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                {{ $post->likes->count() }} Likes
                                </span>
                                    <div class="dropdown-menu" id="like-dropdown-{{$post->id}}">
                                        @foreach($post->likes as $like)
                                            <a class="dropdown-item" id="like-user-{{ $like->user->id }}" href="#">{{ $like->user->name }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="total-comment-block">
                            <div class="dropdown">
                                <span id="comment-count-{{ $post->id }}" class="dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                {{ $post->comments->count() }} Comments
                                </span>
                                <div class="dropdown-menu">
                                @foreach($post->comments->unique('user.id') as $comment)
                                    <a class="dropdown-item" href="#">{{ $comment->user->name }}</a>
                                @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <ul class="post-comments list-inline p-0 m-0" id="post-comments-{{$post->id}}">
                    @foreach($post->comments as $comment)
                    <li class="mb-2" id="comment-{{$comment->id}}">
                        <div class="d-flex align-items-start">
                            <div class="user-img">
                                @if($comment->user->image)
                                    <img src="{{ asset('storage/images/users/' . $comment->user->image) }}" alt="userimg" class="avatar-35 rounded-circle img-fluid">
                                @else
                                    <img src="{{ asset('storage/images/users/default.jpg') }}" alt="userimg" class="avatar-35 rounded-circle img-fluid">
                                @endif
                            </div>
                            <div class="comment-data-block ms-3">
                                <h6>{{ $comment->user->name }}</h6>

                                <form style="display:none;" id="edit-comment-form-{{ $comment->id }}" class="mb-2">
                                    <div class="input-group">
                                        <input type="text" class="form-control rounded" value="{{ $comment->text }}" id="edit-comment-{{ $comment->id }}" required>
                                        <button type="button" onclick="updateComment({{ $comment->id }})" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></button>
                                    </div>
                                </form>
                                    
                                    <p id="comment-content-{{$comment->id }}" class="mb-0">{{ $comment->text }}</p>

                                <div class="d-flex flex-wrap align-items-center comment-activity">
                                    <span>{{ $comment->created_at->diffForHumans() }}</span>

                                    @auth
                                     @if(auth()->user()->id == $comment->user->id)                                                   
                                    <i class="fas fa-edit ms-2" style="cursor: pointer;" onclick="toggleEditComment({{ $comment->id }})"></i>

                                    <i class="fas fa-trash-alt ms-2" style="cursor: pointer;" onclick="deleteComment({{ $comment->id }} , {{ $post->id }})"></i>
                                    @endif
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
                <form class="comment-text d-flex align-items-center mt-3" action="javascript:void(0);">
                <input id="comment-text-{{ $post->id }}" type="text" class="form-control rounded" placeholder="Enter Your Comment">
                    <button type="button" onclick="addComment({{$post->id}})" class="btn btn-primary">
                    <i class="fas fa-comment"></i> 
                    </button>
                </form>
            </div>
                    </div>
                </div>

            @if (empty($homeFeedPosts))
                <p>No posts yet.</p>
            @endif

        </div>
        @endforeach
        <div class="col-lg-3">
        </div>


     <script>

    function editPostModal(text, image , postId) {
            document.getElementById('post-text-edit').value = text;
            document.getElementById('post-id').value = postId;

            var uploadedImageContainer = document.getElementById('uploaded-image-container-edit');
            uploadedImageContainer.innerHTML = image ? '<img style="height:300px; width:300px;" src="{{ asset('storage/images/posts/') }}' + '/' + image + '" alt="Uploaded Image" class="img-fluid mt-1">' : '';

            var postModal = new bootstrap.Modal(document.getElementById('post-modal-edit'));
            postModal.show();
        }

        document.getElementById('post-image-edit').addEventListener('change', function (event) {
            var input = event.target;
            var imageContainer = document.getElementById('uploaded-image-container-edit');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    imageContainer.innerHTML = '<img style="width:300px; height:300px;" src="' + e.target.result + '" alt="Uploaded Image" class="img-fluid mt-1">';
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                imageContainer.innerHTML = '';
            }
        });


        document.getElementById('post-image').addEventListener('change', function (event) {
            var input = event.target;
            var imageContainer = document.getElementById('uploaded-image-container');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    imageContainer.innerHTML = '<img style="width:300px; height:300px;" src="' + e.target.result + '" alt="Uploaded Image" class="img-fluid mt-1">';
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                imageContainer.innerHTML = '';
            }
        });


    function createPost() {
    var text = document.getElementById('post-text').value;
    var imageInput = document.getElementById('post-image');
    var imageContainer = document.getElementById('uploaded-image-container');

    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    var formData = new FormData();
    formData.append('text', text);
    formData.append('_token', csrfToken);

    
    var imageInput = document.getElementById('post-image'); 
    if (imageInput.files.length > 0) {
        formData.append('image', imageInput.files[0]);
    }


    $.ajax({
        url: '{{ route("post.create") }}', 
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
        if (response.success) {

            alert('Post created successfully');

            window.location.reload();
        } else {
            console.error('Post creation failed:', response.message);
        }
    },
    error: function(error) {
        console.error('Error:', error);
    }
    });
}

function updatePost() {
    var postId = parseInt(document.getElementById('post-id').value);
    var text = document.getElementById('post-text-edit').value;
    var imageInput = document.getElementById('post-image-edit');
    var imageContainer = document.getElementById('uploaded-image-container-edit');

    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    console.log('CSRF Token:', csrfToken);

    var formData = new FormData();
    formData.append('text', text);
    formData.append('_token', csrfToken);

    var imageInput = document.getElementById('post-image-edit');
    if (imageInput.files.length > 0) {
        formData.append('image', imageInput.files[0]);
    }

    console.log(text);
    console.log('FormData:', formData);

    $.ajax({
    url: "{{ route('post.update', ':postId') }}".replace(':postId', postId),
    type: 'POST',
    data: formData,
    processData: false,
    contentType: false, 
    headers: {
        'X-CSRF-TOKEN': csrfToken, 
    },
    success: function(response) {
        if (response.success) {
            alert('Post updated successfully');
            window.location.reload();
        } else {
            console.error('Post update failed:', response.message);
        }
    },
    error: function(error) {
        console.error('Error:', error);
    }
});
}

function deletePost(postId) {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: "{{ route('post.delete', ':postId') }}".replace(':postId', postId),
        type: 'DELETE',
        data: {
            _token: csrfToken
        },
        success: function(response) {
            if (response.success) {
                alert('Post deleted successfully');
                $('#post-' + postId).hide();
            } else {
                console.error('Post deletion failed:', response.message);
            }
        },
        error: function(error) {
            console.error('Error:', error);
        }
    });
}


function toggleLike(postId) {
        $.ajax({
            url: '{{ route("like.create") }}',
            type: 'POST',
            data: {
                post_id: postId,
                _token: '{{ csrf_token() }}',
            },
            success: function (response) {
            if (response.success) {
            var likeCountElement = $('#like-count-' + postId);
            var newLikeCount = response.likeCount;
            likeCountElement.text(newLikeCount + ' Likes');


            var likeDropdown = $('#like-dropdown-' + postId);
            var userId = {{ auth()->user()->id }};
            var userName = '{{ auth()->user()->name }}'; 
            console.log(response);
                if (response.likeStatus == "like") {
                    likeDropdown.append('<a class="dropdown-item" id="like-user-' + userId + '" href="#">' + userName + '</a>');
                } else {
                    $('#like-user-' + userId).remove();
                }

            }
         },
            error: function (xhr, status, error) {
                alert('Error: ' + error);
            }
        });
    }


    function addComment(postId) {
        var commentText = $('#comment-text-' + postId).val();
        $.ajax({
            url: "{{ route('comment.create', ':postId') }}".replace(':postId', postId),
            type: 'POST',
            data: {
                text: commentText,
                _token: '{{ csrf_token() }}',
            },
            success: function (response) {
                if (response.success) {
                    console.log(response);
                    var commentCountElement = $('#comment-count-' + postId);
                    var newCommentCount = response.commentsCount;
                    commentCountElement.text(newCommentCount + ' Comments');

                    $('#comment-text-' + postId).val('');
                $('#post-comments-' + postId).append(`
                    <li class="mb-2" id="comment-${response.comment.id}">
                        <div class="d-flex">
                            <div class="user-img">
                                <img src="{{ asset('storage/images/users/' . (auth()->user()->image ?? 'default.jpg')) }}" alt="userimg" class="avatar-35 rounded-circle img-fluid">
                            </div>
                            <div class="comment-data-block ms-3">
                                <h6>{{ auth()->user()->name }}</h6>
                                <form style="display:none;" id="edit-comment-form-${response.comment.id}" class="mb-2">
                                    <div class="input-group">
                                        <input type="text" class="form-control rounded" value="${commentText}" id="edit-comment-${response.comment.id}" required>
                                        <button type="button" onclick="updateComment(${response.comment.id})" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></button>
                                    </div>
                                </form>
                                <p id="comment-content-${response.comment.id}" class="mb-0">${commentText}</p>
                                <div class="d-flex flex-wrap align-items-center comment-activity">
                                    <span>Just now</span>
                                    <i class="fas fa-edit ms-2" style="cursor: pointer;" onclick="toggleEditComment(${response.comment.id})"></i>
                                    <i class="fas fa-trash-alt ms-2" style="cursor: pointer;" onclick="deleteComment(${response.comment.id})"></i>
                                </div>
                            </div>
                        </div>
                    </li>
                `);
                } else {
                    alert('Error adding comment. Please try again.');
                }
            },
            error: function (xhr, status, error) {
                alert('Error: ' + error);
            }
        });
    }

        function toggleEditComment(commentId) {
            var editFormElement = $('#edit-comment-form-' + commentId);
            var commentContent = $('#comment-content-' + commentId);
            editFormElement.toggle();
            commentContent.toggle();
        }
        
    function updateComment(commentId) {
        var updatedText = $('#edit-comment-' + commentId).val();
        $.ajax({
            url: "{{ route('comment.update', ['comment' => ':comment']) }}".replace(':comment', commentId),
            type: 'PUT',
            data: {
                text: updatedText,
                _token: '{{ csrf_token() }}',
            },
            success: function (response) {
                if (response.success) {
                    $('#comment-content-' + commentId).text(updatedText);
                    toggleEditComment(commentId);
                } else {
                    alert('Error updating comment. Please try again.');
                }
            },
            error: function (xhr, status, error) {
                alert('Error: ' + error);
            }
        });
    }


    function deleteComment(commentId , postId) {
    var confirmation = confirm("Are you sure you want to delete this comment?");
    
    if (confirmation) {
        $.ajax({
            url: "{{ route('comment.delete', ':commentId') }}".replace(':commentId', commentId),
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}',
            },
            success: function (response) {
                console.log(response);
                if (response.success) {
                    $('#comment-' + commentId).hide();
                    var commentCountElement = $('#comment-count-' + postId);
                    var newCommentCount = response.commentsCount;
                    commentCountElement.text(newCommentCount + ' Comments');

                } else {
                    alert('Error deleting comment. Please try again.');
                }
            },
            error: function (xhr, status, error) {
                alert('Error: ' + error);
            }
        });
    }
}


</script>

@endsection