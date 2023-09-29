<div class="{{ $col ?? 'col-12' }}">
    <table class="table" id="{{ $id ?? '' }}">
        <thead>
            <tr>
                @foreach ($thead as $value)
                    <th scope="col">{{$value}}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($tbody as $key => $values)
                <tr data-row="{{ $key }}" data-{{ $data[$key]['data_name'] ?? '' }}="{{ $data[$key]['data_key'] ?? ''  }}" data-{{ $data[$key]['data_name_2'] ?? '' }}="{{ $data[$key]['data_key_2'] ?? ''  }}" class="{{ $data[$key]['class'] ?? ''}}">
                    @foreach ($values as $key2 => $value)
                        <td>
                            @switch($value['field'])
                                // check if the value is a image and if so, display it
                                @case('image')
                                    @if(!empty($value['content']))
                                        <img src="{{ $value['content'] }}" alt="{{ $value['content'] }}" class="{{ $value['class'] ?? '' }}">
                                    @endif
                                @break
                                @case('text')
                                    {{ $value['content'] }}
                                @break
                                @case('link')
                                    {{-- @can($editCheck) --}}
                                        <a class="{{ $value['class'] ?? '' }}" href="{{ $value['href'] }}">{{ $value['content'] }}</a>
                                    {{-- @else --}}
                                        <span class="{{ $value['class'] ?? '' }}">{{ $value['content'] }}</span>
                                    {{-- @endcan --}}
                                @break
                                @case('label')
                                    @include('components.label', [
                                        'id' => $value['content']
                                    ])
                                @break
                                @case('textbox')
                                    <span data-modal="{{ $value['id'] }}"><span class="material-symbols-outlined">sms</span></span>
                                    @include('components.modal', [
                                        'id' => $value['id'],
                                        'header' => 'Opmerking',
                                        'main' => '<div>' . $value['content']. '</div>',
                                    ])
                                @break
                                @case('date')
                                    @php echo !empty($value['content']) ? strftime('%e %b, %Y', strtotime($value['content'])) : ''; @endphp
                                @break
                                @case('date-week')
                                    @php echo !empty($value['content']) ? 'Week ' . date('W', strtotime($value['content'])) : ''; @endphp
                                @break
                                @case('checkbox')
                                    <input type="checkbox" {{ $value['checked'] ?? '' }} class="{{ $value['class'] ?? '' }}">
                                @break
                                @case('manco')
                                    <input type="checkbox" {{ $value['checked'] ? 'checked disabled' : '' }} class="{{ $value['class'] ?? '' }}" data-modal="{{ $value['id'] ?? '' }}">
                                    @include('components.modal', [
                                        'id' => $value['id'] ?? '',
                                        'class' => $value['class'] ?? '',
                                        'header' => 'Manco melding',
                                        'main' => '
                                        <textarea class="manco-description"></textarea>
                                        <input type="file" name="file" class="file">
                                        <input class="manco-melding btn btn-blue" type="submit">',
                                        ])
                                @break
                                @case('date_input')
                                    <input type="date" value="{{ $value['content'] ?? '' }}" class="{{ $value['class'] ?? '' }}">
                                @break
                                @case('sterren')
                                    <div class="row">
                                        @php
                                            $stars = intval($value['content']) > 5 ? 5 : $value['content'];
                                            $leftover = 5 - $value['content'];
                                        @endphp
                                        @for($i=0; $i < $stars; $i++)
                                            <span class="material-icons medewerkerStar">star</span>
                                        @endfor
                                        @for($i=0; $i < $leftover; $i++)
                                            <span class="material-symbols-outlined medewerkerStar-empty">star</span>
                                        @endfor
                                    </div>
                                @break
                                @case('delete')
                                    @can($deleteCheck)
                                        @include('components.delete', [
                                            'id' => $value['id'],
                                            'table' => $value['table'],
                                            'content' => $value['content'],
                                        ])
                                    @endcan
                                @break
                            @endswitch
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
        <tfoot>

        </tfoot>
    </table>
    @isset($paginate)
        {{-- Pagination --}}
        <div class="pagination-container">
            {!! $paginate->links('pagination::bootstrap-5') !!}
        </div>
    @endisset
</div>