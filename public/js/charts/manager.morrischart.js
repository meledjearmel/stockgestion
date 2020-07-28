// new Morris.Line({
//     element: 'morrisLine2',
//     data: [
//         { y: '2016', a: 20},
//         { y: '2007', a: 30},
//         { y: '2008', a: 50},
//         { y: '2009', a: 40},
//         { y: '2010', a: 30},
//         { y: '2011', a: 45},
//         { y: '2012', a: 60},
//     ],
//     xkey: 'y',
//     ykeys: ['a'],
//     labels: ['Series A'],
//     lineColors: ['#14A0C1'],
//     lineWidth: 2,
//     ymax: 'auto',
//     gridTextSize: 11,
//     hideHover: 'auto',
//     resize: true,
// });
// Morris.Area({
//     element: 'morrisLine2',
//     data: [
//         {period: '2010 Q1', iphone: 2666, ipad: null, itouch: 2647},
//         {period: '2010 Q2', iphone: 2778, ipad: 2294, itouch: 2441},
//         {period: '2010 Q3', iphone: 4912, ipad: 1969, itouch: 2501},
//         {period: '2010 Q4', iphone: 3767, ipad: 3597, itouch: 5689},
//         {period: '2011 Q1', iphone: 6810, ipad: 1914, itouch: 2293},
//         {period: '2011 Q2', iphone: 5670, ipad: 4293, itouch: 1881},
//         {period: '2011 Q3', iphone: 4820, ipad: 3795, itouch: 1588},
//         {period: '2011 Q4', iphone: 15073, ipad: 5967, itouch: 5175},
//         {period: '2012 Q1', iphone: 10687, ipad: 4460, itouch: 2028},
//         {period: '2012 Q2', iphone: 8432, ipad: 5713, itouch: 1791}
//     ],
//     xkey: 'period',
//     ykeys: ['iphone', 'ipad', 'itouch'],
//     labels: ['iPhone', 'iPad', 'iPod Touch'],
//     pointSize: 2,
//     hideHover: 'auto'
// });

let weekSells = JSON.parse(document.querySelector('#morrisLine2').getAttribute('data-weeksell')),
    selling = [];

for (const key in weekSells) {
    selling.push(weekSells[key])
}

Morris.Bar({
    element: 'morrisLine2',
    data: selling,
    xkey: 'day',
    ykeys: ['articles'],
    labels: ['Article(s)'],
    barRatio: 0.4,
    xLabelAngle: 35,
    hideHover: 'auto'
});
