jQuery(document).ready(function($) {
    "use strict";

    var tableWrapper = $('.user-table-wrapper');

    var elEditButton = $('.action-edit');
    var elDeleteButton = $('.action-delete');
    var elUpdateButton = $('.action-update');
    var elCloseButton = $('.action-close');

    var roles = tableWrapper.data('roles');
    var nonce = tableWrapper.data('nonce');

    // all edit button on click function loop
    $.each(elEditButton, function( index, value ) {

        $(this).on('click', function(e){
            e.preventDefault();
            var parent = $(this).parents('.user-info-wrapper');
            var userId = parent.data('id');
            var userName = parent.find('.user-name').text();
            var userRole = parent.find('.user-role').text();
            var markup = '<tr class="appended-user-info-wrapper" data-id="'+userId+'">';
                markup += '<th></th><td><div class="form-group">';
                markup += '<input class="edit-user-name" name="username" type="text" value="'+userName+'">';
                markup += '</div></td><td><div class="form-group"><select name="user-role" class="edit-user-role form-control">';
            $.each(roles, function(index, value){
                var selected = ( (value == userRole)? "selected": "" );
                markup += '<option '+selected+' value="'+value+'">'+value+'</option>';
            });
                markup += '</select></div></td><td><a class="action-update btn btn-success" href="#">Update</a> | <a class="action-close btn btn-info" href="#">Close</a></td></tr>';
            // prevent multiple append edit form
            var next = parent.next();
            if(!next.hasClass('appended-user-info-wrapper')){
                parent.after(markup);
            }

            // update DOM for getting edit form's elements
            updateUi();

        })
    });

    // all delete button on click function loop
    $.each(elDeleteButton, function( index, value ) {

        $(this).on('click', function(e){
            e.preventDefault();
            var parent = $(this).parents('.user-info-wrapper');
            var userId = parent.data('id');
            var data = {
                action: 'delete_user_info',
                nonce: nonce,
                userId: userId,
            };

            // ajax call for deleting user
            $.post(ajax.ajaxUrl, data, function(response){
                // delete data from UI
                deleteRow(parent);
            });
        })
    });

    // delete data from UI function
    function deleteRow(parent){

        // check if the edit form of data exists
        var next = parent.next();
        if(next.hasClass('appended-user-info-wrapper')){
            // remove if exists
            next.remove();
        }
        // remove data from UI
        parent.remove();

    }

    // update UI function for getting editing form's DOM
    function updateUi(){

        elUpdateButton = $('.action-update');

        // all update button on click function loop
        $.each(elUpdateButton, function(index, value){

            $(this).on('click', function(e){
                e.preventDefault();
                var parent = $(this).parents('.appended-user-info-wrapper');
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

                // ajax call for updating user data
                $.post(ajax.ajaxUrl, data, function(response){
                    // assign updated data to the UI
                    prev.find('.user-name').text(userName);
                    prev.find('.user-role').text(userRole);
                });

                // delete editing form's DOM after updating user data
                deleteRow(parent);
            });
        });

        elCloseButton = $('.action-close');
        // all close button on click function loop
        $.each(elCloseButton, function(index, value){
            $(this).on('click', function(e){
                e.preventDefault();
                var parent = $(this).parents('.appended-user-info-wrapper');
                // delete editing form's DOM by clicking close
                deleteRow(parent);
            });
        });

    }

});
