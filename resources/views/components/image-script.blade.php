<script>
    var loadFile = function(event) {
        var output = document.getElementById('image-preview');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src);
        }
    };
</script>
