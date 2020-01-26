
window.onload = function () {

    $("#editor-template").load("templates/base-template.php", function () {
        $(this).trigger("pagecreate");
    });
 

    $(function(){
        $('#editor-save').click(function () {
            var mysave = $('#col-1').html();
            $('#col-1-hidden').val(mysave);
        });
    });

    $(function(){
        $('#editor-save').click(function () {
            var mysave = $('#col-2').html();
            $('#col-2-hidden').val(mysave);
        });
    });

    $(function(){
        $('#editor-save').click(function () {
            var mysave = $('#col-3').html();
            $('#col-3-hidden').val(mysave);
        });
    });
};
