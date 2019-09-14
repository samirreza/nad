$(function() {
    fillTree(0);
    $(document).on("click", ".reload-tree, .refresh-tree", function(event) {
        event.preventDefault();
        $("#loading").removeClass("hidden");
        fillTree($(this).attr("data-rootid"));
    });
});

function fillTree(rootId) {
    $.getJSON("get-json-tree", "id=" + rootId, function(data) {
        var autoOpen = $("#tree-widget-config").attr("auto-open");
        $(".refresh-tree").attr("data-rootid", rootId);
        $("#loading").addClass("hidden");
        $('#cats-tree').tree('loadData', data);
    });
}
