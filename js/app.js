// Application functionality
$(document).ready(function()
{
    window.version = '1.0';

    document.body.addEventListener('submit', onSubmit);
    display = document.querySelector('#display');
    reset = document.querySelector('#reset');
    display.addEventListener('click', onDisplay);
    reset.addEventListener('click', onReset);
    $('#sets-display').on("click", ".set-item", function(e) {
        e.preventDefault();
        onSets(e);
    });

    function onSets(event) {
        
        var set_id = $(event.target).parents('.set-item').attr('id');
        var set = $('#' + set_id + ' .set-values ul li');
        var set_count = set.length;
        var set_array = [];

        if(set_count > 0) {
            
            $.each(set, function(index, value) {

                set_array.push($(this).text());

            });

            dataString = "select=" + JSON.stringify(set_array);

            $.ajax({
                type: "POST",
                url: "index.php",
                data: dataString,
                success: function(data) {

                    //success
                    var message = jQuery.parseJSON(data);
                    
                    alert(message['message']);
                    //updateSets(sets);
                
                }
            });

        }
        
        console.log("Detected click event within the sets display.");
        return false;

    }
    
    function onDisplay(e) {
        e.preventDefault();

        var state = $(this).hasClass('activated');
        if(state) {
            $(this).removeClass('activated');
            $('.set-values').css('display', 'none');
        } else {
            $(this).addClass('activated');
            $('.set-values').css('display', 'block');
        }

    }
    
    function onReset(e) {
        e.preventDefault();

        // ToDo: Add confirmation dialog.
        
        dataString = "reset=true";

        $.ajax({
            type: "POST",
            url: "index.php",
            data: dataString,
            success: function(data) {

                //success
                var response = jQuery.parseJSON(data);

                if(response['message'] === 'success') {
                    resetApp();
                };
                
            }
        });

        return false;
    }

    function onSubmit(e) {
        e.preventDefault();

        dataString = "generate=true";

        $.ajax({
            type: "POST",
            url: "index.php",
            data: dataString,
            success: function(data) {

                //success
                var sets = jQuery.parseJSON(data);
                updateInterface(sets);
                
            }
        });
        return false;
    }

    function updateInterface(sets) { 

        // update sets
        var set1 = '<ul>';
        var set2 = '<ul>';
        var set3 = '<ul>';

        $.each(sets[0].values, function(index, value) {
            set1 = set1 + '<li>' + value + '</li>';
        });
        $.each(sets[1].values, function(index, value) {
            set2 = set2 + '<li>' + value + '</li>';
        });
        $.each(sets[2].values, function(index, value) {
            set3 = set3 + '<li>' + value + '</li>';
        });
        
        set1 = set1 + '</ul>';
        set2 = set2 + '</ul>';
        set3 = set3 + '</ul>';

        $('#set1 .set-values').empty().append(set1);
        $('#set2 .set-values').empty().append(set2);
        $('#set3 .set-values').empty().append(set3);

        // display matched
        $.each(sets, function(index, set) {
            
            set.unique = 'false';
            
            if(set.unique == 'false') {

                var matched = '<div class="set-item">Set' + set.set + '<ul>';

                $.each(set.values, function(index, value) {
                    matched = matched + '<li>' + value + '</li>';
                });

                matched = matched + '</div></ul>';

                $('#matched-sets').append(matched);

            }

        });

        $('#matched-sets').append('<div class="clear-fix"></div>');
        $('#matched').css('display', 'block');

    }

    function resetApp() {
        
        // ToDo: Rest application dashboard
        $('#set1 .set-values').empty();
        $('#set2 .set-values').empty();
        $('#set3 .set-values').empty();

        console.log("The dashboard has been reset.");

    }

});