@props(['post' => $post])
<div>
    <div class="mb-4">
        <a href="{{route('user.post', $post->user)}}" class="font-bold pr-4">{{$post->user->name}}</a> <span
            class="text-gray-600 text-sm">{{$post->created_at->diffForHumans()}}</span>
        <p>{{$post->body}}</p>

        {{--                       @can('delete', $post)--}}
        @can('delete', $post)
            <form action="{{route('post.delete', $post->id)}}" method="post" class="mr-1">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-blue-500"> Delete</button>
            </form>
        @endcan
        {{--                      @endcan--}}

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
</div>
