$(function() {
    let queryStrings= getUrlVars();
    fillTree(queryStrings['id']);
    $(document).on('click', '.reload-tree, .refresh-tree', function(event){
        event.preventDefault();
        $('#cats-tree').tree('destroy');
        $('#loading').removeClass('hidden');
        fillTree($(this).attr('data-rootid'));
    });
});

function fillTree(rootId) {
    $.getJSON(
        'get-json-tree',
        'id=' + rootId,
        function(data) {
            $('.refresh-tree').attr('data-rootid', rootId);
            $('#loading').addClass('hidden');
            $('#cats-tree').tree({
                autoOpen: false,
                autoEscape: false,
                selectable: false,
                data: data,
                rtl: true,
                onCreateLi: function(node, $li, is_selected) {
                    $li.addClass('depth-' + node.depth);
                }
            });
        }
    );
}

function getUrlVars()
{
    let vars = [], hash;
    let hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(let i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}
