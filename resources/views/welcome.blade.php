@extends('shopify-app::layouts.default')

@section('content')
    <!-- You are: (shop domain name) -->
    <p>You are: {{ Auth::user()->name }}</p>
    <form action="" >
        <select name="subscription" class="form-control">
            <option value="1">Monthly</option>
            <option value="2">Yearly</option>
            <option value="3">Lifetime</option>
        </select>
    </form>
@endsection

@section('scripts')
    @parent

    <script type="text/javascript">
        var AppBridge = window['app-bridge'];
        var actions = AppBridge.actions;
        var TitleBar = actions.TitleBar;
        var Button = actions.Button;
        var Redirect = actions.Redirect;
        var titleBarOptions = {
            title: 'Welcome',
        };
        var myTitleBar = TitleBar.create(app, titleBarOptions);
    </script>
@endsection