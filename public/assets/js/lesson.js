
var Lesson = function (words) {
    this.words = parseInt(words);
    this.timeout = this.words * 30;

    if (localStorage.getItem('count_down') && parseInt(localStorage.getItem('count_down')) > 0) {
        this.timeout = parseInt(localStorage.getItem('count_down'));
    }
};

Lesson.prototype = {
    init: function () {
        var _self = this;
        _self.initClock();
        _self.initEvent();
    },

    initClock: function () {
        var _self = this;
        var clock = $('.clock').FlipClock({
            countdown: true,
            callbacks: {
                interval: function () {
                    var time = clock.getTime().time;
                    localStorage.setItem('count_down', time);
                }
            },

            stop: function() {
                $("#lesson").click();
            }
        });

        clock.setTime(_self.timeout);
        clock.start();
    },

    initEvent: function () {
        $("#lesson").on('click', function() {
            localStorage.clear();
        });
    }

};
