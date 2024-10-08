@extends('layouts.admin.file')
@section('page_title', 'エラーリスト')
@section('title', 'エラーリスト')
@section('content')

    <table>
        <thead>
            <tr>
                <th style="text-align:left;">倉庫コード</th>
                <th style="text-align:left;">JANコード</th>
                <th style="text-align:left;">棚番1</th>
                <th style="text-align:left;">棚番2</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 0; @endphp
            @foreach ($params['datas'] as $data)
                <tr>
                    <td data-format="#"
                        style="text-align:left; @if (in_array('倉庫コード', $params['errorsList'][$i] ?? [])) background-color: #FF0000; @endif">
                        {{ $data['倉庫コード'] }}</td>
                    <td data-format="#"
                        style="width:120px; text-align:left; @if (in_array('JANコード', $params['errorsList'][$i] ?? [])) background-color: #FF0000; @endif">
                        {{ $data['JANコード'] }}</td>
                    <td style="text-align:left; @if (in_array('棚番1', $params['errorsList'][$i] ?? [])) background-color: #FF0000; @endif">
                        {{ $data['棚番1'] }}</td>
                    <td style="text-align:left; @if (in_array('棚番2', $params['errorsList'][$i] ?? [])) background-color: #FF0000; @endif">
                        {{ $data['棚番2'] }}</td>
                    <td style="text-align:left;">{{ $data['エラー内容'] ?? '' }}</td>
                    @php $i++; @endphp
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
