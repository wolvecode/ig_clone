@component('mail::message')
{{$liker->name}} Your post was liked

X liked one of your post

@component('mail::button', ['url' => route('post.show', $post)])
View post
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
