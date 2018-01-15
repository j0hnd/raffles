$(function() {

    // $('.datepicker').datepicker({
    //     autoclose: true,
    //     todayHighlight: true,
    //     format: 'mm/dd/yyyy'
    // });

    $('.raffle-ended').tooltip({
        placement: 'top',
        title: 'This raffle is already ended.'
    });

    $(document).on('click', '#toggle-create-raffle', function(e) {
        $('#raffleAddModal').modal({
            backdrop: 'static',
            keyboard: false
        });
    });

    $(document).on('click', '#toggle-raffle-entries', function(e) {

        $.ajax({
            url: '/raffle-entries/' + $(this).data('id'),
            dataType: 'json',
            success: function (response) {
                $('#raffleEntriesModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });

                $('.modal-body').find('#raffle-entries-container').html(response.data.list);
            }
        });
    });

    $(document).on('click', '#toggle-delete-raffle', function(e) {
        $('#raffleDeleteModal').modal({
            backdrop: 'static',
            keyboard: false
        });

        $('.modal-body').find('#id').val($(this).data('id'));
        $('.modal-body').find('#delete-message').html("Delete this <strong>"+$(this).data('name')+"</strong> raffle?");
    });

    $(document).on('click', '#toggle-edit-raffle', function(e) {
        $('#raffleEditModal').modal({
            backdrop: 'static',
            keyboard: false
        });

        $('.modal-body').find('#id').val($(this).data('id'));
        $('.modal-body').find('#raffle-name').val($(this).data('name'));
        // $('.modal-body').find('#raffle-url').val($(this).data('url'));
        $('.modal-body').find('#start-date').val($(this).data('start'));
        $('.modal-body').find('#end-date').val($(this).data('end'));

        console.log($(this).data('start'));
        console.log($(this).data('end'));
    });

    $(document).on('click', '#toggle-delete', function() {
        $.ajax({
            url: 'raffle/' + $('#id').val(),
            type: 'delete',
            data: { _token: $('meta[name=csrf-token]').attr("content"), id: $('#id').val() },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    $('.success-message-container').removeClass('hidden');
                    $('.success-message-container').find('.message').text(response.message);
                    setTimeout(function() {
                        $('.success-message-container').addClass('hidden');
                        $('#raffleDeleteModal').modal('hide');

                        $.ajax({
                            url: '/raffle/reload/list',
                            dataType: 'json',
                            beforeSend: function () {
                                var loader = "<tr><td colspan='5' class='text-center padding-20'><i class='fa fa-cog fa-2x fa-spin' aria-hidden='true'></i><br>Loading...</td></tr>";
                                $('#raffle-list-container').html(loader);
                              },
                            success: function(response) {
                                $('#raffle-list-container').html(response.data.list);
                            }
                        });
                    }, 3000);
                }
            }
        });
    });

    $(document).on('click', '#toggle-submit', function() {
        $.ajax({
            url: '/raffle',
            type: 'post',
            data: $('#raffle-form').serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#raffle-form')[0].reset();

                    $('.success-message-container').removeClass('hidden');
                    $('.success-message-container').find('.message').text(response.message);
                    setTimeout(function() {
                        $('.success-message-container').addClass('hidden');
                        $('#raffleAddModal').modal('hide');

                        $.ajax({
                            url: '/raffle/reload/list',
                            dataType: 'json',
                            beforeSend: function () {
                                var loader = "<tr><td colspan='5' class='text-center padding-20'><i class='fa fa-cog fa-2x fa-spin' aria-hidden='true'></i><br>Loading...</td></tr>";
                                $('#raffle-list-container').html(loader);
                              },
                            success: function(response) {
                                $('#raffle-list-container').html(response.data.list);
                            }
                        });
                    }, 3000);
                }
            },
            error: function(data) {
                var errors = data.responseJSON;
                var error_message = "";
                $.each(errors.errors, function(key, value) {
                    if (value !== undefined) {
                        error_message += "<li>"+ value +"</li>";
                    }
                });

                $('.error-wrapper').append(error_message);
                $('.error-container').removeClass('hidden');
                setTimeout(function () {
                    $('.error-container').addClass('hidden');
                }, 5000);
            }
        });
    });

    $(document).on('click', '#toggle-update', function(e) {
        $.ajax({
            url: '/raffle/' + $('#id').val(),
            type: 'put',
            data: $('#edit-raffle-form').serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#edit-raffle-form')[0].reset();

                    $('.success-message-container').removeClass('hidden');
                    $('.success-message-container').find('.message').text(response.message);
                    setTimeout(function() {
                        $('.success-message-container').addClass('hidden');
                        $('#raffleEditModal').modal('hide');

                        $.ajax({
                            url: '/raffle/reload/list',
                            dataType: 'json',
                            beforeSend: function () {
                                var loader = "<tr><td colspan='5' class='text-center padding-20'><i class='fa fa-cog fa-2x fa-spin' aria-hidden='true'></i><br>Loading...</td></tr>";
                                $('#raffle-list-container').html(loader);
                              },
                            success: function(response) {
                                $('#raffle-list-container').html(response.data.list);
                            }
                        });
                    }, 3000);
                }
            },
            error: function(data) {
                var errors = data.responseJSON;
                var error_message = "";
                $.each(errors.errors, function(key, value) {
                    if (value !== undefined) {
                        error_message += "<li>"+ value +"</li>";
                    }
                });

                $('.error-wrapper').append(error_message);
                $('.error-container').removeClass('hidden');
                setTimeout(function () {
                    $('.error-container').addClass('hidden');
                }, 5000);
            }
        });
    });
});
