<h1>
    {{ $title }} List
</h1>
<table>
    @foreach($data as $item)
        <tr>
            @foreach($fields as $field)
            <td>
                {{ $item->{$field} }}
            </td>
            @endforeach
        </tr>
    @endforeach
</table>
