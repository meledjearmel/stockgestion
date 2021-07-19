let articles = document.getElementById('chartPieContent').getAttribute('data-articles')
articles = JSON.parse(articles)
/**************** PIE CHART ************/
let pieDataContent = [{
    name: 'Articles',
    type: 'pie',
    radius: '80%',
    center: ['50%', '50%'],
    data: articles,
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

let pieOptionContent = {
    tooltip: {
        trigger: 'item',
        formatter: '{a} <br/>{b}: {c} ({d}%)',
        textStyle: {
            fontSize: 11,
            fontFamily: 'Roboto, sans-serif'
        }
    },
    series: pieDataContent
};

let pieContent = document.getElementById('chartPieContent');
let pieChartContent = echarts.init(pieContent);
pieChartContent.setOption(pieOptionContent);
