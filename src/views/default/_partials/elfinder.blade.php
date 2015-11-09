<script>
    function elFinderBrowser(callback, value, meta) {
        var request = "{{ action('\Barryvdh\Elfinder\ElfinderController@showTinyMCE4') }}";
        tinymce.activeEditor.windowManager.open({
            title: 'File Manager',
            url: request,
            width: 900,
            height: 550,
        }, {
            oninsert: function (url) {
                callback(url);
            }
        });

        return false;
    }
</script>