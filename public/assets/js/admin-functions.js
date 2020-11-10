jQuery(document).ready(function($) {
    "use strict";

    var tableWrapper = $('.user-table-wrapper');

    var elEditButton = $('.action-edit');
    var elDeleteButton = $('.action-delete');
    var elUpdateButton = $('.action-update');
    var elCloseButton = $('.action-close');

    var roles = tableWrapper.data('roles');
    var nonce = tableWrapper.data('nonce');

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
            var next = parent.next();
            if(!next.hasClass('appended-user-info-wrapper')){
                parent.after(markup);
            }

            updateUi();

        })
    });

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

            $.post(ajax.ajaxUrl, data, function(response){

                deleteRow(parent);
                
            });
        })
    });

    function deleteRow(parent){

        var next = parent.next();

        if(next.hasClass('appended-user-info-wrapper')){
            next.remove();
        }

        parent.remove();

    }

    function updateUi(){

        elUpdateButton = $('.action-update');

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
    
                $.post(ajax.ajaxUrl, data, function(response){
                    prev.find('.user-name').text(userName);
                    prev.find('.user-role').text(userRole);
                });
    
                deleteRow(parent);

            });
        });

        elCloseButton = $('.action-close');

        $.each(elCloseButton, function(index, value){

            $(this).on('click', function(e){

                e.preventDefault();

                var parent = $(this).parents('.appended-user-info-wrapper');
    
                deleteRow(parent);

            });
        });

    }

});
