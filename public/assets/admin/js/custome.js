$(function () {

    if ($('.repeater').length) {
        $(".repeater").repeater({
            defaultValues: {
                'due_date': '',

            },
            show: function () {
                console.log('hello show');
                $(this).slideDown();
            },

            hide: function (deleteElement) {

                    $(this).slideUp(deleteElement);

                $('.repeater-btn').on('click', function (e) {
                    e.preventDefault();
                });
            },
            repeaters: [
                {
                    selector: ".inner-repeater"
                }
            ],
            isFirstItemUndeletable: false,
            initEmpty: false,
        });
    }

    $('#btn-delete').click(function () {
        alert('hello');
    })
});
