$(document).ready(function (){

    let dates = $.ajax({
        url: 'get-dates-output',
        async: false,
        dataType: 'json'
    }).responseJSON;
    console.log(dates);

    let data = $.ajax({
        url: 'get-array-output',
        async: false,
        dataType: 'json'
    }).responseJSON;

    Highcharts.setOptions({
        lang: {
            loading: 'Загрузка...',
            months: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
            weekdays: ["Воскресенье", "Понедельник", 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'],
            shortMonths: ['Янв', 'Фев', 'Март', 'Апр', 'Май', 'Июнь', 'Июль', 'Авг', 'Сент', 'Окт', 'Нояб', 'Дек'],
            exportButtonTitle: "Экспорт",
            printButtonTitle: "Печать",
            rangeSelectorFrom: 'С',
            rangeSelectorTo: "По",
            rangeSelectorZoom: "Период",
            downloadPNG: 'Скачать PNG',
            downloadJPEG: 'Скачать JPEG',
            downloadPDF: 'Скачать PDF',
            downloadSVG: 'Скачать SVG',
            printChart: 'Напечатать график',
            exitFullscreen : 'Выйти из режима "Во весь экран"',
            viewFullscreen : 'Во весь экран'
        }
    });

    Highcharts.chart('containerHighcharts', {
        title: {
            text: 'Статистика Итераций'
        },
        yAxis: [{
            title: {
                text: ""
            }
        }],
        xAxis: {
            categories : dates
        },
        tooltip: {
            shared : true,
            useHTML: true,
            formatter: function() {
                let points = this.points;
                let pointsLength = points.length;
                let tooltipMarkup = pointsLength ? '<span style="font-size: 10px">' + points[0].key + '</span><br/>' : '';
                let index;

                for(index = 0; index < pointsLength; index += 1) {
                    if (points[index].point.description != null) {
                        tooltipMarkup +=
                            '<span style="color:' + points[index].series.color + '">\u25CF</span> ' +
                            points[index].series.name + ': <b>' + points[index].point.y  + '</b><br/>' +
                            points[index].point.description + '<br/>';
                    } else {
                        tooltipMarkup +=
                            '<span style="color:' + points[index].series.color + '">\u25CF</span> ' +
                            points[index].series.name + ': <b>' + points[index].point.y  + '</b><br/>';
                    }
                }

                return tooltipMarkup;
            }
        },

        series: data
    }, function(chart) {
        $('.discussion').click(function() {
            Highcharts.each(chart.series, function(p) {
                if ('Запланировано времени на обсуждение' === p.name) {
                    (!p.visible) ? p.show(): p.hide()
                }
                if ('Потратили времени на обсуждение' === p.name) {
                    (!p.visible) ? p.show(): p.hide()
                }
            })
        })
        $('.releases').click(function() {
            Highcharts.each(chart.series, function(p) {
                if ('Запланировано релизов' === p.name) {
                    (!p.visible) ? p.show(): p.hide()
                }
                if ('Успешных релизов' === p.name) {
                    (!p.visible) ? p.show(): p.hide()
                }
            })
        })
        $('.development').click(function() {
            Highcharts.each(chart.series, function(p) {
                if ('Взяли задач в разработку' === p.name) {
                    (!p.visible) ? p.show(): p.hide()
                }
                if ('Кол-во выполненных задач в разраб.' === p.name) {
                    (!p.visible) ? p.show(): p.hide()
                }
                if ('Кол-во невыполненных задач в разраб.' === p.name) {
                    (!p.visible) ? p.show(): p.hide()
                }
            })
        })
        $('.testing').click(function() {
            Highcharts.each(chart.series, function(p) {
                if ('Взяли задач в тестирование' === p.name) {
                    (!p.visible) ? p.show(): p.hide()
                }
                if ('Кол-во выполненных задач в тест.' === p.name) {
                    (!p.visible) ? p.show(): p.hide()
                }
                if ('Кол-во невыполненных задач в тест.' === p.name) {
                    (!p.visible) ? p.show(): p.hide()
                }
            })
        })
        $('.testCases').click(function() {
            Highcharts.each(chart.series, function(p, i) {
                if ('Взяли тест-кейсов в тестирование' === p.name) {
                    (!p.visible) ? p.show(): p.hide()
                }
                if ('Кол-во выполненных тест-кейсов в тест.' === p.name) {
                    (!p.visible) ? p.show(): p.hide()
                }
                if ('Кол-во невыполненных тест-кейсов в тест.' === p.name) {
                    (!p.visible) ? p.show(): p.hide()
                }
            })
        })
        $('.circumstances').click(function() {
            Highcharts.each(chart.series, function(p, i) {
                if ('Кол-во срочных задач' === p.name) {
                    (!p.visible) ? p.show(): p.hide()
                }
                if ('Кол-во аварий на сервере' === p.name) {
                    (!p.visible) ? p.show(): p.hide()
                }
                if ('Кол-во аварий на клиенте' === p.name) {
                    (!p.visible) ? p.show(): p.hide()
                }
            })
        })
    });
});