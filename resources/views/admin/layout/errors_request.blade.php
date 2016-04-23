<script src="{{ asset('plugins/notificationJs/notie.js') }}" type="text/javascript"></script>

@if ($errors->any())
    <ul>
        @foreach($errors->all() as $error)
            <li>
                <script>
                    notie.alert(2, '<?= $error ?>', 5);
                </script>
            </li>
        @endforeach
    </ul>
@endif