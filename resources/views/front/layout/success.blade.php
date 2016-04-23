<script src="{{ asset('plugins/notificationJs/notie.js') }}" type="text/javascript"></script>

@if (Session::has('flash_message'))
    <script>
        notie.alert(1, '<?= Session::get('flash_message') ?>', 5);
    </script>
@endif
