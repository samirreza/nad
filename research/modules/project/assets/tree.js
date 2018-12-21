$(function() {
    fillTree(0);
    $(document).on("click", ".reload-tree, .refresh-tree", function(event) {
        event.preventDefault();
        $("#cats-tree").tree("destroy");
        $("#loading").removeClass("hidden");
        fillTree($(this).attr("data-rootid"));
    });
});

function fillTree(rootId) {
    $.getJSON("get-json-tree", "id=" + rootId, function(data) {
        $(".refresh-tree").attr("data-rootid", rootId);
        $("#loading").addClass("hidden");
        $("#cats-tree").tree({
            autoOpen: false,
            autoEscape: false,
            selectable: false,
            data: data,
            rtl: true,
            onCreateLi: function(node, $li, is_selected) {
                $li.addClass("depth-" + node.depth);
            }
        });
    });
}
