/*
Template Name: Material Pro Admin
Author: Themedesigner
Email: niravjoshi87@gmail.com
File: js
*/
var sales_overview_labels, sales_overview_income, sales_overview_expense, total_income, total_expense;

$(function() {
    $.get( "dashboard/get_sales_overview", function( data ) {
        sales_overview_labels =  data.label;
        sales_overview_income =  data.income;
        sales_overview_expense =  data.expense;
        total_income = data.total_income;
        total_expense = data.total_expense;
        render_chart();

        $('#total-income-idr-id').html(data.total_income_idr);
        $('#total-expense-idr-id').html(data.total_expense_idr);
    });
});

function render_chart() {
    // ============================================================== 
    // Sales overview
    // ==============================================================
    var chart2 = new Chartist.Line('.amp-pxl', {
        labels: sales_overview_labels,
        series: [
            sales_overview_income,
            sales_overview_expense
        ]
    }, {
        axisX: {
            // On the x-axis start means top and end means bottom
            position: 'end',
            showGrid: false
        },
        axisY: {
            // On the y-axis start means left and end means right
            position: 'start',
            offset: 50
        },
        showArea: true,
        fullWidth: true,
        plugins: [
            Chartist.plugins.tooltip()
        ]
    });

    var chart = [chart2];

    // ============================================================== 
    // This is for the animation
    // ==============================================================

    for (var i = 0; i < chart.length; i++) {
        chart[i].on('draw', function(data) {
            if (data.type === 'line' || data.type === 'area') {
                data.element.animate({
                    d: {
                        begin: 500 * data.index,
                        dur: 500,
                        from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
                        to: data.path.clone().stringify(),
                        easing: Chartist.Svg.Easing.easeInOutElastic
                    }
                });
            }
        });
    }

    // ============================================================== 
    // Our visitor
    // ============================================================== 

    var chart = c3.generate({
        bindto: '#visitor',
        data: {
            columns: [
                ['Pengeluaran', total_expense],
                ['Penjualan', total_income],
            ],

            type: 'donut'
        },
        donut: {
            label: {
                show: false
            },
            title: "In & Out",
            width: 20,

        },

        legend: {
            hide: true
                //or hide: 'data1'
                //or hide: ['data1', 'data2']
        },
        color: {
            pattern: ['#26c6da', '#1e88e5']
        }
    });
}