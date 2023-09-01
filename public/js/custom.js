
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
});


function passVal() {
    return $('#newSurvey #name').val(function () {
        let string = $('#newSurvey #title').val();
        string = string.replace(/[^a-z0-9-]/gi, '-').
        replace(/-+/g, '-').
        replace(/^-|-$/g, '');
        return string.toLowerCase();
    });
}

function publishSwitch(){
    let check = $('#published');
    if (!check.prop('checked')) {
        check.val(false);
        check.prop('checked', true);
        return check;
    }
}

function disablePosition() {
    $('#' + $('#questions').children().first().prop('id') + ' .btn-position-up').prop('disabled', true);
    $('#' + $('#questions').children().last().prop('id') + ' .btn-position-down').prop('disabled', true);
    $('#' + $('#questions').children().last().prev().prop('id') + ' .btn-position-down').prop('disabled', false);
}

$('.survey-edit-action').click(function () {
    location.href = ("/surveys/" + $(this).val());
});

$('.survey-stats-action').click(function () {
    location.href = ("/stats/" + $(this).val());
});

// $('.confirm-delete').click(function () {
//
// });

$('.survey-delete-action').click(function () {
    let button = $(this);
    $('.confirm-delete').on('click', function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/surveys/delete/"+button.val(),
            dataType: 'json',
            data: {
                id: button.val()
            },
        }).done(function (data) {
            location.href = "/surveys";
        });
    });
});

$('#newSurveySubmit').click(function () {
    publishSwitch();
});

$('#editSurveySubmit').click(function () {
    publishSwitch();
});

$(document).ready(function (){
    let id = 0;
    let lastQuestion = $('#lastQuestion').val();
    if (lastQuestion) id = parseInt(lastQuestion);
    disablePosition();
    $('#addQuestion').click(function () {
        let questions = $('#questions');
        id = id + 1;
        let html = '<div class="row mb-5" id="question-' + id + '">' +
            '<div class="col-9"><div class="mb-3">' +
            '<label class="form-label"><strong>Question</strong></label>' +
            '<input type="text" name="questions[' + id + '][question]" class="form-control" id="questionsQuestion-' + id + '" placeholder="Example question?">' +
            '</div>' +
            '<div class="align-items-center">' +
            '<label class="flex justify-content-center"><strong>Type of Answer</strong></label>' +
            '<div class="flex justify-content-center">' +
            '<div class="form-check form-check-inline">' +
            '<input class="form-check-input" type="radio" name="questions[' + id + '][type]" id="questionsTypeTxt-' + id + '" value="text">' +
            '<label class="form-check-label">Text</label>' +
            '</div>' +
            '<div class="form-check form-check-inline">' +
            '<input class="form-check-input" type="radio" name="questions[' + id + '][type]" id="questionsTypeYesNo-' + id + '" value="boolean">' +
            '<label class="form-check-label">Yes / No</label>' +
            '</div></div></div>' +
            '<input hidden name="questions[' + id + '][id]" value="' + id + '">' +
            '</div>' +
            '<div class="col-2 align-self-center">' +
            '<button id="deleteQuestion-' + id + '" onClick="deleteQuestion(this.id)" type="button" class="btn btn-outline-danger">Delete</button>' +
            '</div><div class="col-1 align-self-center">' +
            '<div hidden><input id="position-' + id + '" name="questions[' + id + '][order]" type="number" value="' + (parseInt(questions.children().length)+1) + '" class="btn-position"></div>'+
            '<button id="positionUp-' + id + '" onClick="positionUp('+id+')" type="button" title="Position Up" ' +
            'class="btn btn-outline-secondary d-grid btn-position-up" data-bs-toggle="tooltip"><i class="zmdi zmdi-chevron-up"></i></button>'+
            '<button id="positionDown-' + id + '" onClick="positionDown('+id+')" type="button" title="Position Down" ' +
            'class="btn btn-outline-secondary d-grid btn-position-down" data-bs-toggle="tooltip"><i class="zmdi zmdi-chevron-down"></i></button>'+
            '</div></div>';

        questions.append(html);
        disablePosition();
    });
});

function deleteQuestion(id) {
    $('#'+id).parent().parent().remove();
    disablePosition();
}

function positionUp(id) {
    let question = $('#question-'+id);
    let questionUp = $('#question-'+id).prev();
    let pos = question.find('.btn-position');
    let posUp = questionUp.find('.btn-position');

    pos.val(parseInt(pos.val())-1);
    posUp.val(parseInt(posUp.val())+1);

    question.remove();
    question.insertBefore(questionUp);
    question.find('.btn-position-down').prop('disabled', false);
    questionUp.find('.btn-position-up').prop('disabled', false);

    disablePosition();
}

function positionDown(id) {
    let question = $('#question-'+id);
    let questionDown = $('#question-'+id).next();
    let pos = question.find('.btn-position');
    let posDown = questionDown.find('.btn-position');

    pos.val(parseInt(pos.val())+1);
    posDown.val(parseInt(posDown.val())-1);

    question.remove();
    question.insertAfter(questionDown);
    question.find('.btn-position-up').prop('disabled', false);
    questionDown.find('.btn-position-down').prop('disabled', false);

    disablePosition();
}

$(window).on('hashchange',function(){
    console.log(window.location.href);
    if (window.location.href) {
        var page = window.location.href.replace('#', '');
        if (page == Number.NaN || page <= 0) {
            return false;
        } else{
            getData(page);
        }
    }
});

$(document).ready(function(){
    $('[role="navigation"] a').click(function (event) {
        event.preventDefault();
        window.location.href.replace('#', '');
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        var url = $(this).attr('href');
        var page = $(this).attr('href').split('page=')[1];
        getData(page);
    });
});

function getData(page) {
    $.ajax({
        url : '?page=' + page,
        type : 'get',
        datatype : 'html',
    }).done(function(data){
        $('#existingSurveys').empty().html(data);
    }).fail(function(jqXHR,ajaxOptions,thrownError){
        alert('Response error');
    });
}
