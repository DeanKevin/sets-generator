// Application functionality
$(document).ready(function()    
{

    document.body.addEventListener('submit', onSubmit);
    display = document.querySelector('#display');
    reset = document.querySelector('#reset');
    display.addEventListener('click', onDisplay);
    reset.addEventListener('click', onReset);
    
    function onDisplay(e) {
        e.preventDefault();

        var state = $(this).hasClass('activated');
        if(state) {
            $(this).removeClass('activated');
            $('#sets').css('display', 'none');
        } else {
            $(this).addClass('activated');
            $('#sets').css('display', 'block');
        }
        
    }
    
    function onReset(e) {
        e.preventDefault();

        // ToDo: Add confirmation dialog.
        // ToDo: form reset.
        
    }

    function onSubmit(e) {
        e.preventDefault();

        var set = $("select#set").val();
        dataString = "set=" + set;

        $.ajax({
            type: "POST",
            url: "index.php",
            data: dataString,
            success: function(data) {

                //success
                var sets = jQuery.parseJSON(data);
                updateSets(sets);
                
            }
        });
        return false;
    }

    function updateSets(sets) {

        var set1 = '<ul>';
        var set2 = '<ul>';
        var set3 = '<ul>';

        $.each(sets[0], function(index, value) {
            set1 = set1 + '<li>' + value + '</li>';
        });
        $.each(sets[1], function(index, value) {
            set2 = set2 + '<li>' + value + '</li>';
        });
        $.each(sets[2], function(index, value) {
            set3 = set3 + '<li>' + value + '</li>';
        });
        
        set1 = set1 + '<ul>';
        set2 = set2 + '<ul>';
        set3 = set3 + '<ul>';

        $('#set1').empty().append(set1);
        $('#set2').empty().append(set2);
        $('#set3').empty().append(set3);

    }

});