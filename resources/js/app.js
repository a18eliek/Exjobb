
helpers = {
    timerStart: function(func, file) {
        var tpl = 'background-color:greenyellow; border:3px solid green; font-weight: bold;padding:3px 5px;color:';
        console.log('%c[' + helpers.timeStamp() + ']' + '%c[start]' + '%c' + file + '::' + func, 
                     tpl+'magenta', tpl+'red', tpl+'blue');
        window['timer_' + file + '_' + func] = new Date();

    },
    timerEnd: function(func, file) {
        var curTime = new Date();
        var tpl = 'background-color:greenyellow; border:3px solid red; font-weight: bold;padding:3px 5px;color:';
        console.log('%c[' + helpers.timeStamp() + ']' + '%c[end]' + '' + '%cTime: ' + (curTime - window['timer_' + file + '_' + func]) + ' ms' + '%c' + file + '::' + func, 
                     tpl+'magenta', tpl+'red', tpl+'red', tpl+'blue');
    },
    timeStamp: function() {
        let d = new Date();
        // current hours
        let hours = d.getHours();

        // current minutes
        let minutes = d.getMinutes();

        // current seconds
        let seconds = d.getSeconds();

        // current milliseconds
        let milliseconds = d.getMilliseconds();

        // Return HH:mm:ss.S
        return hours + ":" + minutes + ":" + seconds + "." + milliseconds;
    }
}

require('./bootstrap');
require('alpinejs');
require('./react');
require('./vue');