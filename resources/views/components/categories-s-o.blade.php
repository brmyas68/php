{{--<div>--}}
{{--    <!-- Let all your things have their places; let each part of your business have its time. - Benjamin Franklin -->--}}
{{--</div>--}}

@foreach($categories as $category)
    <x-category-s-o :category="$category" :parentId="$parentId" />
@endforeach
