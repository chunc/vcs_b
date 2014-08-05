
function push_btn() {
    // console.log("Button pressed");
    
    $('#num_test').html("Muhahahahaha"); 
    
}

update_btn();


// ====================
// Solid Functions
// ====================

// ------------------------------------------------
// Function updates button status in SQL database
// ------------------------------------------------
function update_btn() {
    $.ajaxSetup ({  
        cache: false  
    });
    $.get("update_btn_sql.php", { correct: 23, sys_error: 1, redo: 6, repeat: 3, next1: 0, next2: 0});
    console.log("bzzzzz");
}

// ------------------------------------------------
// Reads from SQL database and returns JSON result
// ------------------------------------------------
function get_db_info() {
    
    $.ajaxSetup ({  
        cache: false  
    });
    $.get('read_db_sql.php',getDB_complete,'json');
}

function getDB_complete(data) {
    // alert("boz");
    alert(data.correct);
    // alert(data.correct);
}

// --------------------
// Long Polling Stuff
// --------------------
var longpollstart = function() {
    $.post('longpoll_sql.php', longpoll_complete, 'json');
}

function longpoll_complete(data) {
    $('#num_test').html(data.correct);
    longpollstart();
}

$(document).ready(longpollstart);