$(document).ready(function () {
        document.getElementById('gobtn').style.display = "none";
    if(document.getElementById('opportunity_name').value==""){
        document.getElementById('opportunity_name').style.display = "none";
//        document.getElementById('gobtn').style.display = "none";
    }else{
        document.getElementById('opportunity_name').style.display = "inline";
        document.getElementById('gobtn').style.display = "inline";
    }
    if(document.getElementById('customer_name').value==""){
        document.getElementById('customer_name').style.display = "none";
    }else{
        document.getElementById('customer_name').style.display = "inline";
        document.getElementById('gobtn').style.display = "inline";
    }
    if(document.getElementById('partner_name').value==""){
        document.getElementById('partner_name').style.display = "none";
//        document.getElementById('gobtn').style.display = "none";
    }else{
        document.getElementById('partner_name').style.display = "block";
        document.getElementById('gobtn').style.display = "block";
    }
//    document.getElementById('customer_name').style.display = "none";
//    document.getElementById('partner_name').style.display = "none";
});

function SelectView() {
    var elem = "";
    var view = "";
    elem = document.getElementById('view_selector').value;
//    if (elem == "SearchQuotes") {
//        document.getElementById('opportunity_name').style.display = "none";
//        document.getElementById('customer_name').style.display = "none";
//        document.getElementById('partner_name').style.display = "none";
//    }
    view = "dashboard.php?View=" + elem;
    window.location.href = view;
    
}

function RefreshApprovals() {
    location.reload();
}

function SelectSearch() {
    var elem = document.getElementById('search_selector').value;
    if (elem == "Opportunity") {
        document.getElementById('opportunity_name').style.display = "block";
        document.getElementById('customer_name').style.display = "none";
        document.getElementById('partner_name').style.display = "none";
    }
    else if (elem == "Customer") {
        document.getElementById('customer_name').style.display = "block";
        document.getElementById('opportunity_name').style.display = "none";
        document.getElementById('partner_name').style.display = "none";
    }
    else if (elem == "Partner") {
        document.getElementById('opportunity_name').style.display = "none";
        document.getElementById('customer_name').style.display = "none";
        document.getElementById('partner_name').style.display = "block";
    }
    else {
        document.getElementById('opportunity_name').style.display = "none";
        document.getElementById('customer_name').style.display = "none";
        document.getElementById('partner_name').style.display = "none";
    }
}

function loadSearchQuotes() {
//    var elem = "";
    var view = "";
//    elem = document.getElementById('view_selector').value;
//    view = "dashboard.php?View=" + elem;
//    window.location.href = view;
    var search = document.getElementById('search_selector').value;
    if (search == "Opportunity") {
        var elem = document.getElementById('opportunity_name').value;
    }
    else if (search == "Customer") {
        var elem = document.getElementById('customer_name').value;
    }
    else if (search  == "Partner") {
        var elem = document.getElementById('partner_name').value;
    }
    view = "dashboard.php?View=SearchQuotes&SearchOn="+ search+"&Key="+elem;
    window.location.href = view;
}

function executeSearch(key) {
    var search_selector = document.getElementById('search_selector').value;
    
    if (search_selector == "Opportunity") {
        var elem = document.getElementById('opportunity_name').value;
    }
    else if (search_selector == "Customer") {
        var elem = document.getElementById('customer_name').value;
    }
    else if (search_selector == "Partner") {
        var elem = document.getElementById('partner_name').value;
    }
    else {
        var elem = 0;
    }
    if (key.keyCode === 13) {
        if (elem.length > 0) {
            loadSearchQuotes();
        }
    }
    else if (key.keyCode === 8) {
        if (elem.length - 1 === 0) {
            document.getElementById('gobtn').style.display = "none";
        }
    }
    else {
        if (elem.length === 0) {
            document.getElementById('gobtn').style.display = "inline";
        }
        else {
            document.getElementById('gobtn').style.display = "inline";
        }
    }
}