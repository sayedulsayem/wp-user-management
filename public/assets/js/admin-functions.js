jQuery(document).ready(function($) {
    "use strict";

    var tableWrapper = $('.user-table-wrapper');

    var elEditButton = $('.action-edit');
    var elDeleteButton = $('.action-delete');
    var elUpdateButton = $('.action-update');

    var roles = tableWrapper.data('roles');
    var nonce = tableWrapper.data('nonce');

    // console.log(roles);

    $.each(elEditButton, function( index, value ) {
        $(this).on('click', function(e){
            e.preventDefault();
            var parent = $(this).parents('.user-info-wrapper');
            var userId = parent.data('id');
            var userName = parent.find('.user-name').text();
            var userRole = parent.find('.user-role').text();
            var markup = '<tr class="user-info-wrapper" data-id="'+userId+'">';
                markup += '<th></th><td><div class="form-grou">';
                markup += '<input class="edit-user-name" name="username" type="text" value="'+userName+'">';
                markup += '</div></td><td><div class="form-group"><select name="user-role" class="edit-user-role form-control">';
            $.each(roles, function(index, value){
                var selected = ( (value == userRole)? "selected": "" );
                markup += '<option '+selected+' value="'+value+'">'+value+'</option>';
            });
                markup += '</select></div></td><td><a class="action-update btn btn-success" href="#">Update</a></td></tr>';
            parent.after(markup);

            updateUi();
        })
    });

    $.each(elDeleteButton, function( index, value ) {
        $(this).on('click', function(e){
            e.preventDefault();
            
        })
    });

    function deleteRow(parent){
        parent.remove();
    }

    function updateUi(){
        // console.log('update called');
        elUpdateButton = $('.action-update');
        // console.log(elUpdateButton);
        $.each(elUpdateButton, function(index, value){

            $(this).on('click', function(e){
                e.preventDefault();
                // console.log('update button clicked');
                var parent = $(this).parents('.user-info-wrapper');
                var prev = parent.prev();
                var userId = parent.data('id');
                var userName = parent.find('.edit-user-name').val();
                var userRole = parent.find('.edit-user-role').val();
                var data = {
                    action: 'update_user_info',
                    nonce: nonce,
                    userId: userId,
                    userName: userName,
                    userRole: userRole,
                };
    
                $.post(ajax.ajaxUrl, data, function(response){
                    prev.find('.user-name').text(userName);
                    prev.find('.user-role').text(userRole);
                });
    
                deleteRow(parent);
    
            });
        });
    }

});
