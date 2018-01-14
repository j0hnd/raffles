$(function() {

    $('.datepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'mm/dd/yyyy'
        });

    $(document).on('click', '#toggle-create-raffle', function(e) {
        $('#raffleAddModal').modal({
            backdrop: 'static',
            keyboard: false
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
                    $('.success-message-container').removeClass('hidden');
                    $('.success-message-container').find('.message').text(response.message);
                    setTimeout(function() {
                        $('.success-message-container').addClass('hidden');
                        $('#raffleAddModal').modal('hide');

                        $.ajax({
                            url: '/raffle/reload/list',
                            dataType: 'json',
                            beforeSend: function () {
                                var loader = "<tr><td colspan='4' class='text-center padding-20'><i class='fa fa-cog fa-2x fa-spin' aria-hidden='true'></i><br>Loading...</td></tr>";
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