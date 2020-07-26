(function () {
    function rickRaw(length, idChain) {

        length = length + 1
        for (let i = 1; i < length; i++) {
            var raw = new Rickshaw.Graph({
                element: document.querySelector('#'+idChain+i),
                renderer: 'area',
                max: 80,
                series: [{
                    data: [
                        { x: 0, y: Math.ceil(Math.random() * 80) },
                        { x: 1, y: Math.ceil(Math.random() * 80) },
                        { x: 2, y: Math.ceil(Math.random() * 80) },
                        { x: 3, y: Math.ceil(Math.random() * 80) },
                        { x: 4, y: Math.ceil(Math.random() * 80) },
                        { x: 5, y: Math.ceil(Math.random() * 80) },
                        { x: 6, y: Math.ceil(Math.random() * 80) },
                        { x: 7, y: Math.ceil(Math.random() * 80) },
                        { x: 8, y: Math.ceil(Math.random() * 80) },
                        { x: 9, y: Math.ceil(Math.random() * 80) },
                        { x: 10, y: Math.ceil(Math.random() * 80) },
                        { x: 11, y: Math.ceil(Math.random() * 80) },
                        { x: 12, y: Math.ceil(Math.random() * 80) }
                    ],
                    color: 'rgba(255,255,255,0.5)'
                }]
            });
            raw.render();

            // Responsive Mode
            new ResizeSensor($('.br-mainpanel'), function(){
                ch1.configure({
                    width: $('#'+idChain+i).width(),
                    height: $('#'+idChain+i).height()
                });
                ch1.render();
            });
        }
    }

    const raw = document.querySelector('#counter')
    const sellLenght = parseInt(raw.getAttribute('data-count-sellpoint'))
    const wareLengnt = parseInt(raw.getAttribute('data-count-warehouse'))

    rickRaw(sellLenght, 'sellpoint')
    rickRaw(wareLengnt, 'warehouse')
})()
