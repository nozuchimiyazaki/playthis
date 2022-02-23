@extends('layouts.adminbase')

@section('content')

    <div class="common_wrap">
        <h1 class="admin_title">プレイスタイル登録：</h1>

        <div class="styles_list_area mt-4">
            <table class="styles_list">
                <tr>
                    <th class="style_id">id</th>
                    <th class="stylename">プレイスタイル名</th>
                    <th class="order">並び順</th>
                    <th class="edit">編集</th>
                </tr>
                @foreach($styles as $style)

                    <tr class="border-bottom">
                        <td><div id="styleid{{ $loop->index }}">{{ $style->id }}</div></td>
                        <td><div id="stylename{{ $loop->index }}">{{ $style->name }}</div></td>
                        <td><div id="order{{ $loop->index }}">{{ $style->order }}</div></td>
                        <td><button onclick="setInputArea({{ $loop->index }})">編集</button></td>
                    </tr>
                @endforeach
            </table>
        </div>

        <div class="styles_list_area mt-4">
            <table class="styles_list">
                <tr>
                    <th class="style_id">id</th>
                    <th class="stylename">プレイスタイル名</th>
                    <th class="order">並び順</th>
                    <th class="edit">編集</th>
                </tr>
                <tr class="border-bottom">
                    {!! Form::open(['route' => 'admin.savestyle']) !!}
                    <td><input type="hidden" name="id" id="styleid" value=""><label id="lblStyleid"></label></td>
                    <td>{!! Form::text('name',null, ['class' => 'form-control', 'id' => 'stylename']) !!}</td>
                    <td>{!! Form::text('order',null, ['class' => 'form-control', 'id' => 'order']) !!}</td>
                    <td>
                        <a href="" class="btn btn-secondary btn-block" id="btnClear" onclick="clearInputs">クリア</a>
                        <input type="submit" class="btn btn-primary btn-block" name="save" value="登録">
                        <input type="submit" class="btn btn-danger btn-block" name="delete" value="削除">
                    </td>
                    {!! Form::close() !!}
                </tr>
            </table>
        </div>

    </div>
    <script>
        function setInputArea(idx) {
            let styleid = document.getElementById('styleid'+idx).textContent;
            let stylename = document.getElementById('stylename'+idx).textContent;
            let order = document.getElementById('order'+idx).textContent;

            let inputStyleid = document.getElementById('styleid');
            let lblStyleid = document.getElementById('lblStyleid');
            let inputStylename = document.getElementById('stylename');
            let inputOrder = document.getElementById('order');

            inputStyleid.value = styleid;
            lblStyleid.innerText = styleid;
            inputStylename.value = stylename;
            inputOrder.value = order;

            // alert(styleid + ' ' + stylename + ' ' + order);
        }

        function clearInputs() {
            let inputStyleid = document.getElementById('styleid');
            let lblStyleid = document.getElementById('lblStyleid');
            let inputStylename = document.getElementById('stylename');
            let inputOrder = document.getElementById('order');

            inputStyleid.value = '';
            lblStyleid.innerText = '';
            inputStylename.value = '';
            inputOrder.value = '';
        }
    </script>
@endsection
