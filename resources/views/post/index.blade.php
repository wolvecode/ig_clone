@extends('layouts.master')

@section('content')
    <div class="flex justify-center">
        <div class="w-6/12 bg-white p-6 rounded-lg">
            <form action="{{route('posts')}}" method="post" class="mb-4">
                @csrf
                <div class="mb-4">
                    <label for="body" class="sr-only">Body</label>
                    <textarea name="body" id="body" cols="30" rows="4" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror" placeholder="Enter your post"></textarea>
                    @error('password')
                    <div class="text-red-500 mt-2 text-sm">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium">
                        Post
                    </button>
                </div>
            </form>

            @if($posts->count())
               @foreach($posts as $post)
                   <div class="mb-4">
                       <a href="" class="font-bold pr-4">{{$post->user->name}}</a> <span
                           class="text-gray-600 text-sm">{{$post->created_at->diffForHumans()}}</span>
                       <p>{{$post->body}}</p>
                       <div>
                           @if($post->ownedBy(auth()->user()))
                               <form action="{{route('post.delete', $post->id)}}" method="post" class="mr-1">
                                   @csrf
                                   @method('DELETE')
                                   <button type="submit" class="text-blue-500"> Delete</button>
                               </form>
                           @endif
                       </div>
                       <div class="flex item-center">
                           @auth()
                               @if(!$post->likedBy(auth()->user()))

                                   <form action="{{route('post.like', $post->id)}}" method="post" class="mr-1">
                                       @csrf
                                       <button type="submit" class="text-blue-500">Like</button>
                                   </form>
                               @else
                                   <form action="{{route('post.unlike', $post->id)}}" method="post" class="mr-1">
                                       @csrf
                                       @method('DELETE')
                                       <button type="submit" class="text-blue-500"> Unlike</button>
                                   </form>
                               @endif
                           @endauth
                           <span>{{$post->likes->count()}} {{ Str::plural('like', $post->likes->count())}}</span>
                       </div>
                   </div>
                @endforeach
                {{ $posts->links() }}
            @else
                <p class="text-center">There are no post available</p>
            @endif

        </div>
    </div>
@endsection
