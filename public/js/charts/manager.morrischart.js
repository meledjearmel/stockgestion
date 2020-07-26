new Morris.Line({
    element: 'morrisLine2',
    data: [
        { y: '2006', a: 20, b: 10, c: 40 },
        { y: '2007', a: 30, b: 15, c: 45 },
        { y: '2008', a: 50, b: 40, c: 65 },
        { y: '2009', a: 40, b: 25, c: 55 },
        { y: '2010', a: 30, b: 15, c: 45 },
        { y: '2011', a: 45, b: 20, c: 65 },
        { y: '2012', a: 60, b: 40, c: 70 }
    ],
    xkey: 'y',
    ykeys: ['a', 'b', 'c'],
    labels: ['Series A', 'Series B', 'Series C'],
    lineColors: ['#14A0C1', '#5058AB', '#72DF00'],
    lineWidth: 1,
    ymax: 'auto 100',
    gridTextSize: 11,
    hideHover: 'auto',
    resize: true,
});
