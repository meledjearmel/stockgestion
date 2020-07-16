
let use = parseFloat(document.getElementById('chartPie').getAttribute('data-used'))
let noUse = parseFloat(document.getElementById('chartPie').getAttribute('data-no-used'))

    /**************** PIE CHART ************/
    let pieData = [{
        name: 'Stokage',
        type: 'pie',
        radius: '80%',
        center: ['50%', '50%'],
        data: [
            {value: use, name: 'Utilisé'},
            {value: noUse, name: 'Disponible'}
        ],
        label: {
            normal: {
                fontFamily: 'Roboto, sans-serif',
                fontSize: 11
            }
        },
        labelLine: {
            normal: {
                show: false
            }
        },
        markLine: {
            lineStyle: {
                normal: {
                    width: 1
                }
            }
        }
    }];

    let pieOption = {
        tooltip: {
            trigger: 'item',
            formatter: '{a} <br/>{b}: {c} ({d}%)',
            textStyle: {
                fontSize: 11,
                fontFamily: 'Roboto, sans-serif'
            }
        },
        series: pieData
    };

    let pie = document.getElementById('chartPie');
    let pieChart = echarts.init(pie);
    pieChart.setOption(pieOption);
