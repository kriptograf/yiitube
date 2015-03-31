/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
    $('#container').masonry({
        // указываем элемент-контейнер в котором расположены блоки для динамической верстки
        itemSelector: '.item',
        // указываем класс элемента являющегося блоком в нашей сетке
        singleMode: false,
        // true - если у вас все блоки одинаковой ширины
        isResizable: true,
        // перестраивает блоки при изменении размеров окна
        isAnimated: true,
        // анимируем перестроение блоков
        animationOptions: {
            queue: false,
            duration: 500
        }
        // опции анимации - очередь и продолжительность анимации
    });
    $('#container2').masonry({
        // указываем элемент-контейнер в котором расположены блоки для динамической верстки
        itemSelector: '.item',
        // указываем класс элемента являющегося блоком в нашей сетке
        singleMode: false,
        // true - если у вас все блоки одинаковой ширины
        isResizable: true,
        // перестраивает блоки при изменении размеров окна
        isAnimated: true,
        // анимируем перестроение блоков
        animationOptions: {
            queue: false,
            duration: 500
        }
        // опции анимации - очередь и продолжительность анимации
    });
});


