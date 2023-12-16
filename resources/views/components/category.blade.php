{{--<div>--}}
{{--    <!-- When there is no desire, all things are at peace. - Laozi -->--}}
{{--</div>--}}

<tr>
    <th scope="row">#</th>
    <td @if($category->Parent)
            {{"style=padding-left:35px"}}
    @endif>
        <input type="checkbox" name="deletedIds[]" id="" value="{{$category->id}}" />
        @for($i=0 ; $i < $category->level; $i++)
            {{"-"}}
        @endfor
        &nbsp;&nbsp;{{$category->name}}
    </td>
    <td>
        @if($category->Parent)
            {{$category->Parent->name}}
        @else
            {{"---"}}
        @endif
    </td>
    <td>{{convertDateToFarsi($category->updated_at)}}</td>
    <td>
        <div class="dropdown">
            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                    data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{route('categories.edit',['id'=>$category->id])}}"><i
                        class="bx bx-edit-alt me-2"></i> ویرایش</a>
                <a class="dropdown-item" href="{{route('categories.destroy',['id'=>$category->id])}}"><i
                        class="bx bx-trash me-2"></i> حذف</a>
            </div>
        </div>
    </td>
</tr>

<x-categories :categories="$category->Children" />
