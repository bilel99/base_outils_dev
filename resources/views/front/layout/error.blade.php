<script src="{{ asset('plugins/notificationJs/notie.js') }}" type="text/javascript"></script>

@if (Session::has('flash_message_error'))
    <script>
        notie.alert(3, '<?= Session::get('flash_message_error') ?>', 5);
    </script>
@endif
