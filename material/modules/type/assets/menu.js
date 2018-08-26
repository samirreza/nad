$(function() {
    fillTree(0);
    $(document).on('click', '.reload-tree', function(event){
        event.preventDefault();
        $('#cats-tree').tree('destroy');
        $('#loading').removeClass('hidden');
        fillTree($(this).data('rootid'));
    });
    $(document).on('click', '.refresh-tree', function(event){
        event.preventDefault();
        $('#loading').removeClass('hidden');
        fillTree($('#cats-tree').data('rootid'));
    })
});

function fillTree(rootId) {
    $.getJSON(
        'get-json-tree',
        'id='+rootId,
        function(data) {
            $('#loading').addClass('hidden');
            $('#cats-tree').attr('data-rootid', rootId);
            $('#cats-tree').tree({
                autoOpen: 1,
                autoEscape: false,
                selectable: false,
                data: data,
                rtl: true
            });
        }
    );
}
