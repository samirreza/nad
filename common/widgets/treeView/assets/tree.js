$(function() {
    let queryStrings = getUrlVars();
    let rootId = queryStrings["id"];
    if(typeof rootId === 'undefined')
        rootId = 0;
    fillTree(rootId);
    $(document).on("click", ".reload-tree, .refresh-tree", function(event) {
        event.preventDefault();
        $("#loading").removeClass("hidden");
        fillTree($(this).attr("data-rootid"));
    });
});

function fillTree(rootId) {
    let myTree = $('#cats-tree');
    $.getJSON(
        "get-json-tree",
        "id=" + rootId,
        function(data) {
            $(".refresh-tree").attr("data-rootid", rootId);
            $("#loading").addClass("hidden");
            myTree.tree({
                autoOpen: 1,
                autoEscape: 1,
                selectable: 1,
                data: data,
                rtl: 1
            });
            myTree.tree('loadData', data);
        }
    );
}
