function initializeAddEventModal() {
    $('#title').val('');
    $('#details').val('');
    $('#category').val(-1);
    $('#first_name').val('');
    $('#last_name').val('');
    $('#phone').val('');
    $('#repeats').val('');
    $('#addNewEventForm').find('input').parent().find('span').hide();;
    $('#addNewEventForm').find('select').parent().find('span').hide();
    $('#addNewEventForm').find('textarea').parent().find('span').hide();
    $('#addNewEventForm .alert').hide();
}

function AddEventFormValidation() {
    var valid_state=true;
    var inputs=$('#addNewEventForm').find('input');
    for (var i=0;i<inputs.length;i++){
        if ($(inputs[i]).prop('required') && $(inputs[i]).val()==''){  // if it is requried element.
            $(inputs[i]).parent().find('span').slideDown('slow').css('display','block');
            valid_state=false;
        }
    }
    var selects=$('#addNewEventForm').find('select');
    for (var i=0;i<selects.length;i++){
        if ($(selects[i]).prop('required') && !$(selects[i]).val()){  // if it is requried element.
            $(selects[i]).parent().find('span').slideDown('slow').css('display','block');
            valid_state=false;
        }
    }
    var texts=$('#addNewEventForm').find('textarea');
    for (var i=0;i<texts.length;i++){
        if ($(texts[i]).prop('required') && !$(texts[i]).val()){  // if it is requried element.
            $(texts[i]).parent().find('span').slideDown('slow').css('display','block');
            valid_state=false;
        }
    }
    return valid_state;
}

function appendEventToLeftPanel(id){
    var title=$('#title').val();
    var details=$('#details').val();
    var category_temp=$('#category option:selected').val().split('-');
    var category_id=parseInt(category_temp[0]);
    var color=category_temp[1];

    var first_name=$('#first_name').val();
    var last_name=$('#last_name').val();
    var phone=$('#phone').val();
    var repeats=$('#repeats').val();

    var temp=`
        <a class="list-group-item calendar-event" data-title="${title}" data-stick=true data-category-id="${category_id}" data-color="${color}"
            href="javascript:void(0)">
            <i class="md-circle mr-10" style="color:${color}" aria-hidden="true"></i>${title}
        </a>`;
    var lists=$('.calendar-list');
    // $('#addNewEventBtn').prepend($(temp));
    $(temp).insertBefore('#addNewEventBtn');
}

function updateEvent(){
    var formData=$('#editEventForm').serialize();
    $.ajax({
        method:"post",
        url:"update_slot",
        data:formData,
        success:function (result) {
            $('#editEventForm .event-success-message').slideDown('slow');
            setTimeout(function () {
                $('#editNewEvent').modal('hide');
            },1000)
        },
        error:function (err) {
            console.log(err);
        }
    });
}



$(document).ready(function () {
    $('#addNewEventForm input,#addNewEventForm textarea').keyup(function () {
        $(this).parent().find('span').slideUp('slow');
    })
    $('#addNewEventForm select').change(function () {
        if($(this).val()>=0)
            $(this).parent().find('span').slideUp();
    })
})