/**
 * Created by bondarenko.iiu on 09.08.2017.
 */

//нужен для получение кол-ва дней доставки в регион. Пишет это значение в указанный элемент.
$("#region").change(function (e) {
    var region = $(this).val();
    $.ajax({
        type: "POST",
        url: "/main/countDateTo.php",
        data: {"REGION_ID":region}
    }).done(function(data) {
        $(".time").fadeIn();
        $("#timeToDeliver").html(data);
        console.log(data);


    }).fail(function(data) {
        console.log('fail');

    });
    //отмена действия по умолчанию для кнопки submit
    e.preventDefault();
})
//аякс запрос добавления маршрута
$("#setRoutes").submit(function (e) {
    var $form = $(this);
    $.ajax({
        type: $form.attr('method'),
        url: $form.attr('action'),
        datatype:"json",
        data: $form.serialize()
    }).done(function(data) {
        if(data==1) {
            console.log('success');
            console.log(data);
            alert("Запись добавлена");
        }else{
            alert("Курьер занят");
        }
    }).fail(function(data) {
        console.log('fail');
        alert("Произошла ошибка");
    });
    //отмена действия по умолчанию для кнопки submit
    e.preventDefault();
})
//аякс получения регионов
$("#period").submit(function (e) {
    var $form = $(this);
    $.ajax({
        type: $form.attr('method'),
        url: $form.attr('action'),
        data: $form.serialize()
    }).done(function(data) {
        console.log('success');
        $("#resultPeroid").html(data);
    }).fail(function(data) {
        console.log('fail');
        alert("Произошла ошибка");
    });
    //отмена действия по умолчанию для кнопки submit
    e.preventDefault();
})
