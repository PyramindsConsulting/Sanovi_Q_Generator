function SelectView() {
    var elem = "";
    var view = "";
    elem = document.getElementById('view_selector').value;
    view = "dashboard.php?View=" + elem;
    window.location.href = view;
}

function RefreshApprovals(){
	location.reload();
}